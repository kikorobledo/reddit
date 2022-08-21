<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Community;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesTest extends TestCase
{

    /* use RefreshDatabase;

    protected $seed = true; */

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCommunityPage()
    {

        $community = Community::first();

        $response = $this->get('/c/'. $community->slug);

        $response->assertStatus(200);
    }

    public function testPostPage()
    {

        $post = Post::first();

        $response = $this->get('/p/'. $post->id);

        $response->assertStatus(200);
    }
}
