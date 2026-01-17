<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Pass;

class PassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $showId = $request->input('show_id');

        $validatedData = $request->validate([
            'show_id' => ['required', 'exists:shows,id'],
            'tipe' => [
                'required',
                Rule::in(['regular', 'premium']),
                Rule::unique('passes', 'tipe')
                    ->where(fn($q) => $q->where('show_id', $showId)),
            ],
            'harga' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);

        // buat tiket
        Pass::create($validatedData);

        return redirect()->route('admin.shows.show', $validatedData['show_id'])
            ->with('success', 'Pass berhasil ditambahkan.');
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
        $pass = Pass::findOrFail($id);
        $showId = $pass->show_id;

        $validatedData = $request->validate([
            'tipe' => [
                'required',
                Rule::in(['regular', 'premium']),
                Rule::unique('passes', 'tipe')
                    ->where(fn($q) => $q->where('show_id', $showId))
                    ->ignore($pass->id),
            ],
            'harga' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);

        $pass->update($validatedData);

        return redirect()->route('admin.shows.show', $pass->show_id)
            ->with('success', 'Pass berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pass = Pass::findOrFail($id);
        $showId = $pass->show_id;
        $pass->delete();

        return redirect()->route('admin.shows.show', $showId)
            ->with('success', 'Pass berhasil dihapus.');
    }
}
