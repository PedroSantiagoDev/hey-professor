<?php

namespace Database\Seeders;

use App\Models\{Question, User};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
use Illuminate\Database\Eloquent\Factories\HasFactory\QuestionFactory;
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name'  => 'Pedro Santiago',
            'email' => 'pedro@example.com',
        ]);

        Question::factory()->count(20)->create();
    }
}
