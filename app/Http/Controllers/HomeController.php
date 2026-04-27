<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        // Kode ini memanggil file resources/views/welcome.blade.php
        return view('welcome'); 
    }

    public function contact()
    {
        // Kode ini memanggil file resources/views/contact.blade.php
        return view('contact');
    }
}