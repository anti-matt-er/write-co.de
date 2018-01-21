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
        $validator = $this->validate($request, [
            'name' => 'required|string|max:100|min:3',
            'content' => 'required|string|max:2048|min:5',
        ]);

        $slug = Post::find($request->post_id)->slug;

        if ($validator->fails()) {
            return redirect("/post/$slug");
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

        session(["comments.$comment->id" => 'pending']);

        return redirect("/post/$slug#reply-$comment->id");
    }
}
