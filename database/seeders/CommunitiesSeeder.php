<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommunitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Community::factory()->times(100)->create();
    }
}
