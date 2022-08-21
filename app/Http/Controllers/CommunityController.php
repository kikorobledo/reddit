<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Topic;
use App\Models\PostVote;
use App\Models\Community;
use Illuminate\Support\Str;
use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;

class CommunityController extends Controller
{
    public function create(){

        $topics = Topic::all();

        return view('communities.create', compact('topics'));
    }

    public function store(StoreCommunityRequest $request){

        $community = Community::create($request->validated() + ['user_id' => auth()->user()->id]);

        $community->topics()->attach($request->topics);

        return redirect()->route('communities.show', $community);

    }

    public function show($slug){

        $community = Community::where('slug', $slug)->firstOrFail();

        $query = $community->posts()->with('postVotes');

        if(request('sort', '') == 'popular'){

            $query->orderBy('votes', 'desc');

        }else{

            $query->latest('id');

        }

        $posts = $query->paginate(5);

        return view('communities.show', compact('community', 'posts'));
    }

    public function index(){

        $communities = Community::where('user_id', auth()->user()->id)->get();

        return view('communities.index', compact('communities'));
    }

    public function edit(Community $community){

        if($community->user_id != auth()->user()->id)
            abort(403);

        $community->load('topics');

        $topics = Topic::all();

        return view('communities.edit', compact('community', 'topics'));

    }

    public function update(UpdateCommunityRequest $request, Community $community){

        if($community->user_id != auth()->user()->id)
            abort(403);

        $community->update($request->validated());

        $community->topics()->sync($request->topics);

        return redirect()->route('communities.index')->with('message', "Succesfully updated");

    }

    public function destroy(Community $community){

        if($community->user_id != auth()->user()->id)
            abort(403);

        $community->delete();

        return redirect()->route('communities.index')->with('message', "Succesfully deleted");

    }

    public function vote($post_id, $vote){

        $post = Post::with('community')->findOrFail($post_id);

        if(!PostVote::where('user_id', auth()->user()->id)->where('post_id', $post_id)->count() && in_array($vote, [-1,1]) && $post->user_id != auth()->user()->id){

            PostVote::create([
                'post_id' => $post->id,
                'user_id' => auth()->user()->id,
                'vote' => $vote
            ]);

        }

        redirect()->route('communities.show', $post->community);
    }
}
