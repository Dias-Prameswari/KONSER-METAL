<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PassType;
use Illuminate\Validation\Rule;

class PassTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passTypes = PassType::orderBy('nama')->get();
        return view('pages.admin.pass_types.index', compact('passTypes'));
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
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:pass_types,nama'],
        ]);

        PassType::create($validated);

        return redirect()->route('admin.pass-types.index')
                ->with('success', 'Tipe tiket berhasil ditambahkan');
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
        $passType = PassType::findOrFail($id);

        $validated = $request->validate([
            'nama' => [
                'required', 'string', 'max:255',
                Rule::unique('pass_types', 'nama')->ignore($passType->id),
            ],
        ]);

        $passType->update($validated);

        return redirect()->route('admin.pass-types.index')
            ->with('success', 'Tipe tiket berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $passType = PassType::findOrFail($id);
        $passType->delete();

        return redirect()->route('admin.pass-types.index')
            ->with('success', 'Tipe tiket berhasil dihapus');
    }
}
