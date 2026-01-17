<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Show;

class ShowController extends Controller
{
    public function show(Show $show)
    {
        $show->load(['passes', 'genre', 'user']);

        $passesData = $show->passes->map(function ($pass) {
        return [
            'id'    => $pass->id,
            'price' => $pass->harga ?? 0,
            'stock' => $pass->stok,
            'tipe'  => $pass->tipe,
        ];
    })->values();

        return view('shows.show', compact('show', 'passesData'));
    }
}
