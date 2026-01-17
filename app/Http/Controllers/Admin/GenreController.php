<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // menampilkan daftar genre
    {
        $genres = Genre::all(); // mengambil semua genre dari database
        return view('pages.admin.genre.index', compact('genres')); // mengirim data genres ke view admin genre, agar dpt ditampilkan dalam tabel
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // menampilkan form untuk membuat genre baru
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // menyimpan genre baru ke database
    {
        $payload = $request->validate([
            'nama' => 'required|string|max:255|unique:genres,nama',
        ]);

        Genre::create($payload); // membuat genre baru di database    ]);

        return redirect()->route('admin.genres.index')
                        ->with('success', 'Genre berhasil ditambahkan.'); // redirect kembali ke halaman genre dengan pesan sukses
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) // menampilkan detail genre tertentu
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) // menampilkan form untuk mengedit genre tertentu
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // memperbarui genre tertentu di database
    {
        $payload = $request->validate([
            'nama' => [
                'required', 'string', 'max:255',
                Rule::unique('genres', 'nama')->ignore($id),
            ],
        ]);

        $genre = Genre::findOrFail($id); // mencari genre berdasarkan id
        $genre->update($payload); // memperbarui data genre dengan data yang telah divalidasi

        return redirect()->route('admin.genres.index')
                        ->with('success', 'Genre berhasil diperbarui.'); // redirect kembali ke halaman genre dengan pesan sukses
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) // menghapus genre tertentu dari database
    {
        Genre::destroy($id); // menghapus genre berdasarkan id
        return redirect()->route('admin.genres.index')->with('success', 'Genre berhasil dihapus.'); // redirect kembali ke halaman genre dengan pesan sukses
    }
}
