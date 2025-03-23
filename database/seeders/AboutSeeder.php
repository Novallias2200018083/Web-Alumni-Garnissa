<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        About::factory()->create([
            'title' => 'About IST Alumni Network',
            'content' => 'The IST Alumni Network is a community connecting past students to foster lifelong relationships, career opportunities, and mentorship.',
            'image' => 'about/default.jpg', 
        ]);
    }
}
