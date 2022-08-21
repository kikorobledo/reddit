<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PostReportNotification;

class CommunityPostController extends Controller
{

    public function index(Community $community){

        $post = $community->posts()->latest('id')->paginate(10);

    }

    public function create(Community $community){

        return view('posts.create', compact('community'));
    }

    public function store(Community $community, StorePostRequest $request){


        $post = $community->posts()->create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'post_text' => $request->post_text ?? null,
            'post_url' => $request->post_url ?? null,
        ]);

        if($request->hasFile('post_image')){

            $image = $request->file('post_image')->getClientOriginalName();
            $request->file('post_image')->storeAs('posts/' . $post->id, $image);

            $post->update(['post_image' => $image]);

            $file = Image::make(Storage::disk('posts')->url($post->id . '/' . $post->post_image));

            $file->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $file->save('posts/' . $post->id . '/thumbnail_' . $image);

        }

        return redirect()->route('communities.show', $community);

    }

    public function show($postId){

        $post = Post::with('comments.user', 'community')->findOrFail($postId);

        return view('posts.show', compact('post'));

    }

    public function edit(Community $community, Post $post){

        if(Gate::denies('post-edit', $post))
            abort(403);

        return view('posts.edit', compact('post', 'community'));

    }

    public function update(Community $community, StorePostRequest $request, Post $post){

        if(Gate::denies('post-edit', $post))
            abort(403);

        $post->update($request->validated());

        if($request->hasFile('post_image')){

            $image = $request->file('post_image')->getClientOriginalName();
            $request->file('post_image')->storeAs('posts/' . $post->id, $image);

            if($post->post_image != '' && $post->post_image != $image){
                Storage::disk('post')->delete($post->id . '/' . $post->post_image);
            }

            $post->update(['post_image' => $image]);

            $file = Image::make(Storage::disk('posts')->url($post->id . '/' . $post->post_image));

            $file->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $file->save('posts/' . $post->id . '/thumbnail_' . $image);

        }

        return redirect()->route('communities.posts.show', [$community, $post]);

    }

    public function destroy(Community $community, Post $post){

        if(Gate::denies('post-delete', $post))
            abort(403);

        $post->delete();

        return redirect()->route('communities.show', $community);

    }

    public function report($post_id){

        $post = Post::with('community.user')->findOrFail($post_id);

        $post->community->user->notify(new PostReportNotification($post));

        return redirect()->route('communities.posts.show', [$post->community, $post])->with('message', 'Your report has been sent.');

    }
}
