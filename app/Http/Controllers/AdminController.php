<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class AdminController extends Controller
{
    public function index()
    {
        $messages = [
            'notices' => [],
            'warnings' => [],
            'messages' => [],
        ];
        $counters = [];

        $counters['pendingComments'] = count(Comment::whereNull('published_at')->get());
        $counters['pendingPosts'] = count(Post::whereNull('published_at')->get());
        $counters['scheduledPosts'] = count(Post::where('published_at', '>', Carbon::now()));
        $lastPublishedPost = Post::where('published_at', '<=', Carbon::now())
          ->orderBy('published_at', 'desc')
          ->first();

        if ($counters['pendingComments']) {
            $notifications['notices'][] = "You have $counters[pendingComments] comments pending review";
        }
        if ($counters['pendingPosts']) {
            $notifications['notices'][] = "You have $counters[pendingPosts] articles yet unpublished";
        }
        if ($counters['scheduledPosts']) {
            $notifications['messages'][] = "There are $counters[scheduledPosts] articles scheduled to be published";
        }
        if ($lastPublishedPost) {
            $lastPublishedPost = $lastPublishedPost->published_at->format('jS \o\f F, Y');
            $notifications['messages'][] = "Your last published article was on the $lastPublishedPost";
        } else {
            $notifications['messages'][] = 'You have not yet published any articles';
        }

        return view('admin.dashboard')->with([
            'counters' => $counters,
            'notifications' => $notifications,
        ]);
    }

    public function indexComments($showAll = false, $showDeleted = false)
    {
        if ($showAll) {
            $comments = Comment::withTrashed()->orderBy('created_at', 'asc');
            $title = 'All Comments';
        } elseif ($showDeleted) {
            $comments = Comment::onlyTrashed()->orderBy('created_at', 'asc');
            $title = 'Deleted Comments';
        } else {
            $comments = Comment::whereNull('published_at')->orderBy('created_at', 'asc');
            $title = 'Unapproved Comments';
        }
        $comments = $comments->paginate(20);

        return view('admin.comments')->with([
            'title' => $title,
            'comments' => $comments,
        ]);
    }

    public function filterComments(Request $request)
    {
        if ($request->field == 'name' ||
            $request->field == 'content'
        ) {
            $comments = Comment::where($request->field, 'like', "%$request->value%")->orderBy('created_at', 'asc');
        } else {
            $comments = Comment::where($request->field, $request->value)->orderBy('created_at', 'asc');
        }
        $comments = $comments->paginate(20);

        return view('admin.comments')->with([
            'title' => 'Filtered Comments',
            'comments' => $comments,
        ]);
    }

    public function ammendComment(Request $request)
    {
        $comment = Comment::withTrashed()->find($request->id);

        if (isset($request->action)) {
            switch ($request->action) {
                case 'approve':
                    return $this->approveComment($comment);
                    break;
                case 'unpublish':
                    return $this->unpublishComment($comment);
                    break;
                case 'restore':
                    return $this->restoreComment($comment);
                    break;
                default:
                    break;
            }
        }

        return;
    }

    public function approveComment($comment)
    {
        $comment->published_at = Carbon::now();
        $comment->save();

        return back();
    }

    public function unpublishComment($comment)
    {
        $comment->published_at = null;
        $comment->save();

        return back();
    }

    public function restoreComment($comment)
    {
        $comment->restore();

        return back();
    }

    public function deleteComment(Request $request)
    {
        if (isset($request->force) && $request->force) {
            Comment::find($request->id)->forceDelete();
        } else {
            Comment::find($request->id)->delete();
        }

        return back();
    }
}
