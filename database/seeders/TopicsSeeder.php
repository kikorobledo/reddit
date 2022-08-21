<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::create(['name' => 'Programming']);
        Topic::create(['name' => 'Design']);
        Topic::create(['name' => 'SEO']);
        Topic::create(['name' => 'Bussiness']);
        Topic::create(['name' => 'Random']);
    }
}
