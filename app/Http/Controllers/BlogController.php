<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Post;
use App\User;
use App\Tag;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function getArchive()
    {
        $datesCollection = Post::orderBy('published_at', 'desc')
          ->get(['published_at']);
        $dates = [];
        foreach ($datesCollection as $date) {
            $dates[(string) $date->published_at->format('Y-m-d')] = $date->published_at->format('jS \o\f F, Y');
        }
        $dates = array_unique($dates);

        return $dates;
    }

    public function getTopTags($count = 5)
    {
        $tags = DB::table('tags_map')
                ->join('tags', 'tags_map.tag_id', 'tags.id')
                ->select(DB::raw('tag_id, tag, count(tag_id) as tag_count'))
                ->groupBy('tag_id')
                ->orderBy('tag_count', 'desc')
                ->orderBy('tag', 'asc')
                ->limit((int) $count)
                ->get();

        return $tags;
    }

    public function index()
    {
        $posts = Post::where('published_at', '<=', Carbon::now())
          ->orderBy('published_at', 'desc')
          ->paginate(config('blog.posts_per_page'));

        return view('public.home')->with([
            'posts' => $posts,
            'dates' => $this->getArchive(),
            'title' => 'Home',
            'topTags' => $this->getTopTags(),
        ]);
    }

    public function showPost($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();

        return view('public.post')->with([
            'post' => $post,
            'dates' => $this->getArchive(),
            'topTags' => $this->getTopTags(),
        ]);
    }

    public function showByDate($date)
    {
        $posts = Post::whereDate('published_at', '=', $date)
          ->orderBy('published_at', 'desc')
          ->paginate(config('blog.posts_per_page'));

        return view('public.home')->with([
            'posts' => $posts,
            'dates' => $this->getArchive(),
            'title' => 'Archive of posts from the '.Carbon::parse($date)->format('jS \o\f F, Y'),
            'topTags' => $this->getTopTags(),
        ]);
    }

    public function showByUser($user_id)
    {
        $posts = Post::where('user_id', '=', $user_id)
          ->orderBy('published_at', 'desc')
          ->paginate(config('blog.posts_per_page'));
        $name = User::find($user_id)->name;

        return view('public.home')->with([
            'posts' => $posts,
            'dates' => $this->getArchive(),
            'title' => "Posts published by $name",
            'topTags' => $this->getTopTags(),
        ]);
    }

    public function showByTag($tag_id)
    {
        $posts = Post::whereHas('tags', function ($q) use ($tag_id) {
            $q->where('id', '=', $tag_id);
        })->orderBy('published_at', 'desc')
          ->paginate(config('blog.posts_per_page'));
        $tag = Tag::find($tag_id)->tag;

        return view('public.home')->with([
            'posts' => $posts,
            'dates' => $this->getArchive(),
            'title' => "Posts tagged with #$tag",
            'topTags' => $this->getTopTags(),
        ]);
    }
}
