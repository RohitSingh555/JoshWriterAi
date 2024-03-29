<?php

namespace Database\Seeders;

use App\Models\ChatGpt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatGPTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChatGpt::create([
            'token' => 'sk-6RWYVGxfWXTmT0eajz7..........bQ9Fnxh4gmcHCUnIzDm',
            'default_tokens' => '150',
            'prompt_tokens' => '150',
        ]);
    }
}
