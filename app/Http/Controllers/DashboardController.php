<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $packages = Package::where('status', 'active')->paginate(6);
        return view('dashboard', compact('packages'));
    }
}
