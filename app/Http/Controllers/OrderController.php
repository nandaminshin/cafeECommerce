<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderPage()
    {
        return view('admin.orderManagement.orderManagement');
    }



    public function confirmedOrderPage()
    {
        $data = Order::where('status', 'confirmed')->orderBy('created_at', 'desc')->paginate(5);;
        return view('admin.orderManagement.confirmedOrder', compact('data'));
    }



    public function deniedOrderPage()
    {
        $data = Order::where('status', 'denied')->orderBy('created_at', 'desc')->paginate(5);;
        return view('admin.orderManagement.deniedOrder', compact('data'));
    }



    public function removeOrder($id)
    {
        $order = Order::where('id', $id)->first();
        if ($order) {
            $order->delete();
            return back()->with(['order_remove_message' => 'Order removed successfully']);
        } else {
            return back();
        }
    }


    public function orderDetailPage($id)
    {
        $order = Order::where('id', $id)->first();
        if ($order) {
            $data = $order->where('id', $id)->with(['user', 'orderProduct.product'])->first();
            return view('admin.orderManagement.orderDetail', compact('data'));
        } else {
            return back()->with(['order_does_not_exist' => 'Order does not exist anymore!']);
        }
    }


    public function confirmOrder($id)
    {
        $order = Order::where('id', $id)->first();
        if ($order) {
            $order->update(['status' => 'confirmed']);
            return redirect()->route('admin#order_page')->with(['order_confirm_message' => 'Order confirmed successfully!']);
        } else {
            return redirect()->route('admin#order_page')->with(['order_does_not_exist' => 'Order does not exist anymore!']);
        }
    }


    public function denyOrder($id, Request $request)
    {
        $order = Order::where('id', $id)->first();
        if ($order) {
            $order->update([
                'status' => 'denied',
                'message' => $request->message
            ]);
            return redirect()->route('admin#order_page')->with(['order_deny_message' => 'An order has been denied!']);
        } else {
            return redirect()->route('admin#order_page')->with(['order_does_not_exist' => 'Order does not exist anymore!']);
        }
    }
}