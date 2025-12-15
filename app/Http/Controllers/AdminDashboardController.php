<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $totalPackages = Package::count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $totalUsers = User::where('role', 'user')->count();
        
        $packages = Package::all();
        $recentBookings = Booking::with('user', 'package')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalPackages',
            'totalBookings',
            'pendingBookings',
            'totalUsers',
            'packages',
            'recentBookings'
        ));
    }
}
