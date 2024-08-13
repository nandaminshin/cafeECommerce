<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function blogListPage()
    {
        $data = Blog::when(request('key'), function ($query) {
            $query->where('title', 'like', '%' . request('key') . '%');
        })->orderBy('created_at', 'desc')->paginate(10);
        $data->appends(request()->all());

        return view('admin.blogManagement.blogList', compact('data'));
    }


    public function adminBlogDetailPage($id)
    {
        $data  = Blog::where('id', $id)->first();

        return view('admin.blogManagement.blogDetail', compact('data'));
    }


    public function blogEditPage($id)
    {
        $data = Blog::where('id', $id)->first();
        return view('admin.blogManagement.editBlog', compact('data'));
    }


    public function blogEditSave(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'highlight' => ['required', 'string'],
            'body' => ['required', 'string']
        ])->validate();

        $data = [
            'title' => $request->title,
            'highlight' => $request->highlight,
            'body' => $request->body
        ];

        if ($request->new_image == 'yes') {
            Validator::make($request->all(), [
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:7000']
            ])->validate();
            $file_name = $this->storeImage($request);
            $data['image'] = $file_name;

            Blog::where('id', $request->id)->update($data);
        }

        if ($request->new_image == 'no' || $request->new_image == null) {
            Blog::where('id', $request->id)->update([
                'title' => $data['title'],
                'highlight' => $data['highlight'],
                'body' => $data['body']
            ]);
        }

        return redirect()->route('admin#blog_list')->with(['blog_update_message' => 'Blog updated successfully!']);
    }


    public function blogCreatePage()
    {
        return view('admin.blogManagement.createNewBlog');
    }


    public function createBlog(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'highlight' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:6000']
        ])->validate();

        $file_name = $this->storeImage($request);

        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'highlight' => $request->highlight,
            'image' => $file_name
        ];

        Blog::create($data);

        return back()->with(['blog_create_message' => 'New blog created successfully!']);
    }


    public function blogPage()
    {
        $data = Blog::when(request('key'), function ($query) {
            $query->where('key', 'like', '%' . request('key') . '%');
        })->orderBy('created_at', 'desc')->paginate(9);
        $data->appends(request()->all());

        return view('user.blog.blog', compact('data'));
    }


    public function blogDetailPage($id)
    {
        $blog = Blog::where('id', $id)->first();
        if ($blog) {
            $comments = Comment::where('blog_id', $blog->id)->with(['blog', 'user'])->orderBy('created_at', 'desc')->get();
            return view('user.blog.blogDetail', compact('blog', 'comments'));
        } else {
            abort(404);
        }
    }


    public function removeBlog(Request $request, $id)
    {
        $current_admin = User::where('id', $request->id)->first();
        if (Hash::check($request->password, $current_admin->password)) {
            Blog::where('id', $id)->delete();
            return back()->with(['blog_remove_message' => 'A blog is removed successfully!']);
        } else {
            return back()->with(['admin_remove_fail' => 'Failed to remove! Wrong password.']);
        }
    }





    public function storeImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $old_image = Blog::where('id', $request->id)->value('image');
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
