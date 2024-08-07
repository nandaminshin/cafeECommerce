<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $orders = Order::where('status', '=', 'pending')->with(['user'])->get();
                view()->share('orders', $orders);
                return view('admin.home', compact('orders'));
            } else {
                return view('user.home');
            }
        } else {
            $prodcuts = Product::get();


            return view('user.home');
        }
    }
}
