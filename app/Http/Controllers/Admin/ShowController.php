<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Genre;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // menampilkan daftar show
    {
        $shows = Show::with('genre')->get(); // mengambil semua show dari database
        return view('pages.admin.show.index', compact('shows')); // mengirim data shows ke view admin show, agar dpt ditampilkan dalam tabel
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // menampilkan form untuk membuat show baru
    {
        $genres = Genre::all(); // mengambil semua genre dari database
        return view('pages.admin.show.create', compact('genres')); // mengirim data genres ke
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // menyimpan show baru ke database
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_waktu' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        // Handle file upload for 'gambar' if exists
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('shows', 'public');
            $validatedData['gambar'] = $path;
        }

        $validatedData['user_id'] = Auth::id(); // set user_id ke user yang sedang login

        Show::create($validatedData); // membuat show baru di database

        return redirect()->route('admin.shows.index')
            ->with('success', 'Show berhasil ditambahkan.'); // redirect kembali ke halaman show dengan
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) // menampilkan detail show tertentu
    {
        $show = Show::findOrFail($id); // mencari show berdasarkan id
        $genres = Genre::all(); // mengambil semua genre dari database
        $passes = $show->passes; // mengambil semua passes/ticket yang terkait dengan show ini

        return view('pages.admin.show.show', compact('show', 'genres', 'passes')); // mengirim data show ke

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) // menampilkan form untuk mengedit show tertentu
    {
        $show = Show::findOrFail($id); // mencari show berdasarkan id
        $genres = Genre::all(); // mengambil semua genre dari database
        return view('pages.admin.show.edit', compact('show', 'genres')); // mengirim data show dan genres ke view edit show
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // memperbarui show tertentu di database
    {
        try {
            $show = Show::findOrFail($id); // mencari show berdasarkan id

            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tanggal_waktu' => 'required|date',
                'lokasi' => 'required|string|max:255',
                'genre_id' => 'required|exists:genres,id',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ]);

            // Handle file upload for 'gambar' if exists
            if ($request->hasFile('gambar')) {
                Storage::disk('public')->delete($show->gambar); // menghapus gambar lama dari storage
                $validatedData['gambar'] = $request->file('gambar')->store('shows', 'public');
            }

            $show->update($validatedData); // memperbarui data show dengan data yang telah divalidasi

            return redirect()->route('admin.shows.index')
                ->with('success', 'Show berhasil diperbarui.'); // redirect kembali ke halaman show dengan

        } catch (\Exception $e) {
            return redirect()->route('admin.shows.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui show: ' . $e->getMessage()); // redirect kembali ke halaman show dengan pesan error
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) // menghapus show tertentu dari database
    {
        $show = Show::findOrFail($id); // mencari show berdasarkan id
        Storage::disk('public')->delete($show->gambar);
        $show->delete(); // menghapus show dari database

        return redirect()->route('admin.shows.index')
            ->with('success', 'Show berhasil dihapus.'); // redirect kembali ke halaman show dengan pesan sukses
    }
}
