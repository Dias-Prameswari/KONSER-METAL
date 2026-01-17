<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Show;
use App\Models\Genre;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::all();

        $showsQuery = Show::withMin('passes', 'harga')
            ->orderBy('tanggal_waktu', 'asc');

        if ($request->filled('q')) {
            $showsQuery->where('judul', 'like', '%' . $request->q . '%');
        }

        if ($request->has('genre') && $request->genre) {
            $showsQuery->where('genre_id', $request->genre);
        }

        $shows = $showsQuery->get();

        return view('home', compact('shows', 'genres'));
    }
}
