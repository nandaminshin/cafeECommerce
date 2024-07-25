<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productPage()
    {
        $category_data = Category::all();
        return view('admin.product.product', compact('category_data'));
    }

    public function productCreatePage()
    {
        $category = Category::select('id', 'name')->get();
        return view('admin.product.createProduct', compact('category'));
    }

    public function createNewProduct(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'unique:products,name'],
            'category_id' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048']
        ])->validate();

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description
        ];

        $file_name = $this->storeImage($request);
        $data['image'] = $file_name;

        Product::create($data);
        $category = Category::where('id', $request->category_id)->first();
        $category->update(['quantity' => DB::raw('COALESCE(quantity, 0) + 1')]);
        return redirect()->route('admin#product')->with(['product_create_message' => 'A new product created!', 'created_product_name' => $request->name, 'created_product_category' => $category->name]);
    }

    public function productDetail($id)
    {
        $data = Product::where('category_id', $id)->orderBy('id', 'desc')->get();
        $category_data = Category::where('id', $id)->first();
        return view('admin.product.productDetail', compact('data', 'category_data'));
    }

    public function productEditPage($id, $category_id)
    {
        $data = Product::where('id', $id)->first();
        $category_id = $category_id;
        return view('admin.product.editProduct', compact('data', 'category_id'));
    }

    public function productEditSave(Request $request, $category_id)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'unique:products,name,' . Product::where('id', $request->id)->value('id')],
            'price' => ['required'],
            'description' => ['required']
        ])->validate();

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ];

        if ($request->new_image == 'yes') {
            Validator::make($request->all(), [
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048']
            ])->validate();
            $file_name = $this->storeImage($request);
            $data['image'] = $file_name;

            Product::where('id', $request->id)->update($data);
        }

        if ($request->new_image == 'no' || $request->new_image == null) {
            Product::where('id', $request->id)->update([
                'name' => $data['name'],
                'price' => $data['price'],
                'description' => $data['description']
            ]);
        }

        return redirect()->route('admin#product_detail', $category_id)->with(['product_update_message' => 'A product updated!', 'updated_product_name' => $request->name]);
    }

    public function productDelete($id, $category_id)
    {
        $image = Product::where('id', $id)->value('image');
        Storage::delete('public/' . $image);
        $product = Product::where('id', $id)->first();
        $deleted_product_name = $product->name;
        $product->delete();
        Category::where('id', $category_id)->update(['quantity' => DB::raw('quantity - 1')]);
        return redirect()->route('admin#product_detail', $category_id)->with(['product_delete_message' => 'A product deleted!', 'deleted_product_name' => $deleted_product_name]);
    }

    public function storeImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $old_image = Product::where('id', $request->id)->value('image');
            if ($old_image != null) {
                Storage::delete('public/' . $old_image);
            }
            $file_name = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $file_name);
            return $file_name;
        } else
            return null;
    }
}
