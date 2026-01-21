<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingItem;
use App\Models\Booking;
use App\Models\Pass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
            ->with('show')
            ->orderByDesc('created_at')
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    // show a specific order
    public function show(Booking $booking)
    {
        abort_unless($booking->user_id === Auth::id(), 403);
        $booking->load(['show', 'bookingItems.pass.passType']);
        return view('bookings.show', compact('booking'));
    }

    // store an order (AJAX POST)
    public function store(Request $request)
    {
        abort_unless(Auth::check(), 401);

        $data = $request->validate([
            'show_id' => 'required|exists:shows,id',
            'items' => 'required|array|min:1',
            'items.*.pass_id' => 'required|integer|exists:passes,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        try {
            // transaction
            $booking = DB::transaction(function () use ($data) {
                $total = 0;
                // validate stock and calculate total
                foreach ($data['items'] as $it) {
                    $t = Pass::with('passType')->lockForUpdate()->findOrFail($it['pass_id']);
                    if ($t->stok < $it['jumlah']) {
                        $namaTipe = $t->passType->nama ?? '-';
                        throw new \Exception("Stok tidak cukup untuk tipe: {$namaTipe}");
                    }
                    $total += ($t->harga ?? 0) * $it['jumlah'];
                }

                $booking = Booking::create([
                    'user_id' => Auth::id(),
                    'show_id' => $data['show_id'],
                    'order_date' => Carbon::now(),
                    'total_harga' => $total,
                ]);

                foreach ($data['items'] as $it) {
                    $t = Pass::findOrFail($it['pass_id']);
                    $subtotal = ($t->harga ?? 0) * $it['jumlah'];
                    BookingItem::create([
                        'booking_id' => $booking->id,
                        'pass_id' => $t->id,
                        'jumlah' => $it['jumlah'],
                        'subtotal_harga' => $subtotal,
                    ]);

                    // reduce stock
                    $t->stok = max(0, $t->stok - $it['jumlah']);
                    $t->save();
                }

                return $booking;
            });

            // flash success message to session so it appears after redirect
            session()->flash('success', 'Pesanan berhasil dibuat.');

            return response()->json(['ok' => true, 'booking_id' => $booking->id, 'redirect' => route('bookings.index')]);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => $e->getMessage()], 422);
        }
    }
}
