<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perizinan;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 'dashboard');
        $data = [];

        return view('auths.home1', compact('data', 'page'));
    }

    public function home_admin(Request $request)
    {
        // Ambil data perizinan agar $izinData tersedia di dashboard admin
        $izinData = collect([]);
        if (class_exists('App\Models\Perizinan')) {
            try {
                $izinData = Perizinan::orderBy('created_at', 'desc')->get();
            } catch (\Exception $e) {}
        }

        $page = $request->get('page', 'dashboard');

        return view('auths.home1', compact('izinData', 'page'));
    }
}