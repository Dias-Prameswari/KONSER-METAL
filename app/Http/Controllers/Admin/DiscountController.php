<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::orderBy('nama')->get();
        return view('pages.admin.discounts.index', compact('discounts'));
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
        $disc = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:discounts,nama'],
            'type' => ['required', 'in:percent,fixed'],
            'value' => [
                'required',
                'numeric',
                'min:0',
                Rule::when($request->input('type') === 'percent', ['max:100']),
                Rule::when($request->input('type') === 'fixed', ['max:100000']),
            ],
            'start_at' => ['nullable', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        Discount::create($disc);

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Diskon berhasil ditambahkan');
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
        $discounts = Discount::findOrFail($id);

        $disc = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('discounts', 'nama')->ignore($discounts->id),
            ],
            'type' => ['required', 'in:percent,fixed'],
            'value' => [
                'required',
                'numeric',
                'min:0',
                Rule::when($request->input('type') === 'percent', ['max:100']),
                Rule::when($request->input('type') === 'fixed', ['max:100000']),
            ],
            'start_at' => ['nullable', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $discounts->update($disc);

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Diskon berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discounts = Discount::findOrFail($id);
        $discounts->delete();

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Diskon berhasil dihapus');
    }
}
