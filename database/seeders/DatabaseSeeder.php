<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 2 users, each with 3 projects, each project with 5 tasks
        \App\Models\User::factory(2)->create()->each(function ($user) {
            \App\Models\Project::factory(3)->create(['user_id' => $user->id])
                ->each(function ($project) {
                    \App\Models\Task::factory(5)->create(['project_id' => $project->id]);
                });
        });
    }
}