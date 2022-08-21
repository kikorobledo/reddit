<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsCommentsController extends Controller
{
    public function store(Request $request, Post $post){

        $post->load('community');

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment_text' => $request->comment_text
        ]);

        return redirect()->route('communities.posts.show', [$post->community, $post]);

    }
}
