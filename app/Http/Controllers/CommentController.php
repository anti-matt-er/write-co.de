<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|min:3',
            'content' => 'required|string|max:2048|min:5',
        ]);

        if ($validator->fails()) {
            //maybe anchor?
        }

        $inputs = [
            'name' => $request->name,
            'content' => $request->content,
            'post_id' => $request->post_id,
        ];

        if (isset($request->prompt_id)) {
            $inputs['reply_to'] = $request->prompt_id;
        }

        $comment = Comment::create($inputs);

        $slug = Post::find($request->post_id)->slug;

        return redirect("/post/$slug#reply-$comment->id");
    }
}
