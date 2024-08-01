<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $orders = Order::get();
                return view('admin.home', compact('orders'));
            } else {
                return view('user.home');
            }
        } else {
            return view('user.home');
        }
    }
}
