<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Show;
use App\Models\Booking;
// use App\Models\Pass; 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalShows = Show::count(); // Menghitung total pertunjukan
        $totalGenre = \App\Models\Genre::count(); // Menghitung total genre
        $totalBookings = Booking::count(); // Menghitung total booking

        return view('admin.dashboard', compact('totalShows', 'totalGenre', 'totalBookings'));
    }
}
