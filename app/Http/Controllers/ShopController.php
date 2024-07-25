<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function shopPage()
    {
        $product_data = Product::get();
        //$previousUrl = url()->previous();
        //$cartActionPerformed = session('cart_action_performed', false);
        // if (str_contains($previousUrl, '/customer/product-details/') && $cartActionPerformed) {
        //     $status = "added";
        //     return view('user.shop.shopping', compact('product_data', 'status'));
        // } else {
        //     $status = 'not added';
        //     return view('user.shop.shopping', compact('product_data', 'status'));
        // }

        return view('user.shop.shopping', compact('product_data'));
    }

    public function shopPageByCategory($id)
    {
        $product_data = Product::where('category_id', $id)->get();
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
}
