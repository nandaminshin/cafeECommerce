<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categoryCreatePage()
    {
        return view('admin.product.createCategory');
    }

    public function createNewCategory(Request $request)
    {

        Validator::make($request->all(), [
            'name' => ['required', 'unique:categories,name']
        ])->validate();

        $data = [
            'name' => $request->name
        ];

        $file_name = $this->storeImage($request);
        $data['image'] = $file_name;

        Category::create($data);
        return redirect()->route('admin#product')->with(['category_create_message' => 'A new category created!', 'created_category_name' => $request->name]);
    }


    public function categoryEditPage($id)
    {
        $data = Category::where('id', $id)->first();
        return view('admin.product.editCategory', compact('data'));
    }

    public function categoryEditSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'unique:categories,name,' . Category::where('id', $request->id)->value('id')]
        ])->validate();

        $data = [
            'name' => $request->name
        ];

        if ($request->new_image == 'yes') {
            Validator::make($request->all(),[
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048']
            ])->validate();
            $file_name = $this->storeImage($request);
            $data['image'] = $file_name;

            Category::where('id', $request->id)->update($data);
        }

        if ($request->new_image == 'no' || $request->new_image == null) {
            Category::where('id', $request->id)->update([
                'name' => $data['name']
            ]);
        }

        return redirect()->route('admin#product')->with(['category_update_message' => 'A categoroy updated!', 'updated_category_name' => $request->name]);
    }

    public function storeImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $old_image = Category::where('id', $request->id)->value('image');
            if ($old_image != null) {
                Storage::delete('public/' . $old_image);
            }
            $file_name = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $file_name);
            return $file_name;
        } else
            return null;
    }

    public function categoryDelete($id)
    {
        $category = Category::where('id', $id)->first();
        $image = $category->image;
        $deleted_category_name = $category->name;
        $product = Product::where('category_id', $category->id)->get();
        foreach ($product as $item) {
            Storage::delete('public/' . $item->image);
        }
        Storage::delete('public/' . $image);
        $category->delete();
        return redirect()->route('admin#product')->with(['category_delete_message' => 'A category deleted!', 'deleted_category_name' => $deleted_category_name]);
    }
}
