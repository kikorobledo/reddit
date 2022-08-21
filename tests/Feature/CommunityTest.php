<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommunityTest extends TestCase
{

    use RefreshDatabase;

    protected $seed = true;

    public function testListOfMyCommunities(){

        $user = User::withCount('communities')->has('communities')->first();

        auth()->login($user);

        $response = $this->get('communities');
        $response->assertStatus(200);

        /* dd($user->communities_count. ' - ' . substr_count($response->getContent(), 'community-item')); */

        $this->assertEquals($user->communities_count, substr_count($response->getContent(), 'community-item'));

    }

    public function testCreateCommunity(){

        $user = User::first();

        auth()->login($user);

        $response = $this->post('/communities', [
            'name' => 'Some name 123aaaa',
            'description' => ' Some description 123aaaa'
        ]);

        $response->assertStatus(302);

        $response = $this->get('/communities');

        $response->assertStatus(200);

        $this->assertStringContainsString('Some name 123aaaa', $response->getContent());
    }
}
