<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\PostVote;

class PostVotes extends Component
{

    public $post;
    public $sumVotes;

    public function mount($post){

        $this->post = $post;
        $this->sumVotes = $this->post->votes;
    }

    public function vote($vote){

        if(!$this->post->postVotes->where('user_id', auth()->user()->id)->count() && in_array($vote, [-1,1]) && $this->post->user_id != auth()->user()->id){

            PostVote::create([
                'post_id' => $this->post->id,
                'user_id' => auth()->user()->id,
                'vote' => $vote
            ]);

        }

        $this->sumVotes += $vote;

    }

    public function render()
    {
        return view('livewire.post-votes');
    }
}
