<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\PaymentType;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentTypes = PaymentType::orderBy('nama')->get();
        return view('pages.admin.payment_types.index', compact('paymentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:payment_types,nama'],
        ]);

        PaymentType::create($data);

        return redirect()->route('admin.payment_types.index')
                        ->with('success', 'Tipe Pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paymentType = PaymentType::findOrFail($id);

        $data = $request->validate([
            'nama' => [
                'required', 'string', 'max:255',
                Rule::unique('payment_types', 'nama')->ignore($paymentType->id),
            ],
        ]);

        $paymentType->update($data);

        return redirect()->route('admin.payment_types.index')
                        ->with('success', 'Tipe Pembayaran berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymentType = PaymentType::findOrFail($id);
        $paymentType->delete();

        return redirect()->route('admin.payment_types.index')
                        ->with('success', 'Tipe Pembayaran berhasil dihapus');
    }
}
