<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home () {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('admin.home');
            } else {
                return view('user.home');
            }
        } else {
            return view('user.home');
        }
        
    }
}
