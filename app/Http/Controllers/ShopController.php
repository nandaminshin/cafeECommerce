<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function shopPage()
    {
        $product_data = Product::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->paginate(10);
        $product_data->appends(request()->all());
        return view('user.shop.shopping', compact('product_data'));
    }


    public function shopPageByCategory($id)
    {
        $product_data = Product::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->where('category_id', $id)->paginate(10);
        $product_data->appends(request()->all());
        return view('user.shop.shopping', compact('product_data'));
    }


    public function productDetailsPage($id)
    {
        $product = new Product();
        $data = $product->where('id', $id)->first();
        if (!$data) {
            abort(404);
        }

        $related_products = $product->where('category_id', $data->category_id)->where('id', '!=', $id)->get();
        return view('user.shop.productDetails', compact('data', 'related_products'));
    }


    public function addToCart(Request $request)
    {
        $id = (int) $request->input('id');
        $cart = session()->get('cart', []);

        if (!in_array($id, $cart)) {
            array_push($cart, $id);
        }
        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }


    public function removeItem(Request $request)
    {
        $id = (int) $request->input('id');
        $cart = session()->get('cart', []);
        $key = array_search($id, $cart);
        if ($key !== false) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            return response()->json(['message' => 'Item removed successfully']);
        }
        return response()->json(['message' => 'Item not found in cart']);
    }


    public function cartPage()
    {
        $product_data = Product::get();
        return view('user.shop.shoppingCart', compact('product_data'));
    }


    public function order(Request $request)
    {
        $user_id = $request->input('user_id');
        $items = $request->input('items');
        $total = $request->input('total');

        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Create a new order
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_cost = $total[0];
        $order->save();

        $order_id = $order->id;

        foreach ($items as $key => $item) {
            $product_id = $key;

            OrderProduct::create([
                'order_id' => $order_id,
                'product_id' => $product_id,
                'quantity' => $item['quantity']
            ]);
        }

        session()->forget('cart');

        return response()->json(['message' => 'Order processed successfully']);
    }


    public function orderList($id)
    {

        $user_id = $id;

        $orders = Order::where('user_id', $user_id)
            ->with(['orderProduct.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.shop.orderList', compact('orders'));
    }


    public function deleteOrder($id)
    {
        Order::where('id', $id)->delete();
        return back();
    }
}