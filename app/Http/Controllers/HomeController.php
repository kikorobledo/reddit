<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('community')->withCount(['postVotes' => function($q){

            $q->where('post_votes.created_at', '>' ,  now()->subDays(7))
                ->where('vote', 1);

        }])->orderBy('post_votes_count', 'desc')->take(10)->get();

        return view('dashboard', compact('posts'));
    }
}
