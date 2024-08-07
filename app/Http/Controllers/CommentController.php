<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function addComment($bid, $uid, Request $request)
    {
        Validator::make($request->all(), [
            'body' => ['required']
        ])->validate();

        $data = [
            'user_id' => $uid,
            'blog_id' => $bid,
            'body' => $request->body
        ];

        Comment::create($data);

        return back();
    }


    public function deleteComment($id)
    {
        Comment::where('id', $id)->delete();
        return back();
    }
}
