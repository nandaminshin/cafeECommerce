<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoadOrderData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $orders = Order::where('status', 'pending')->with(['user'])
            ->orderBy('created_at', 'desc')->paginate(5);
        view()->share('orders', $orders);
        return $next($request);
    }
}