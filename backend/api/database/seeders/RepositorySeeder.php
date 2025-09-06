<?php

namespace Database\Seeders;

use App\Models\GitHubUser;
use App\Models\Repository;
use Illuminate\Database\Seeder;

class RepositorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample GitHub users
        $user1 = GitHubUser::create([
            'id' => 1,
            'name' => 'sample-user',
            'avatar_url' => 'https://github.com/sample-user.png',
            'html_url' => 'https://github.com/sample-user',
        ]);

        $user2 = GitHubUser::create([
            'id' => 2,
            'name' => 'another-user',
            'avatar_url' => 'https://github.com/another-user.png',
            'html_url' => 'https://github.com/another-user',
        ]);

        // Create sample repositories
        Repository::create([
            'id' => 12345,
            'name' => 'awesome-project',
            'description' => 'An awesome open source project for learning and development.',
            'is_private' => false,
            'user_id' => $user1->id,
            'html_url' => 'https://github.com/sample-user/awesome-project',
            'created_at' => '2024-01-15 10:30:00',
            'updated_at' => '2024-03-20 14:45:00',
        ]);

        Repository::create([
            'id' => 12346,
            'name' => 'private-repo',
            'description' => 'A private repository for internal development.',
            'is_private' => true,
            'user_id' => $user1->id,
            'html_url' => 'https://github.com/sample-user/private-repo',
            'created_at' => '2024-02-10 09:15:00',
            'updated_at' => '2024-03-25 16:20:00',
        ]);

        Repository::create([
            'id' => 12347,
            'name' => 'data-analysis-tools',
            'description' => 'Collection of tools for data analysis and visualization.',
            'is_private' => false,
            'user_id' => $user2->id,
            'html_url' => 'https://github.com/another-user/data-analysis-tools',
            'created_at' => '2023-12-05 11:00:00',
            'updated_at' => '2024-03-18 13:30:00',
        ]);

        Repository::create([
            'id' => 12348,
            'name' => 'minimal-api',
            'description' => null,
            'is_private' => false,
            'user_id' => $user2->id,
            'html_url' => 'https://github.com/another-user/minimal-api',
            'created_at' => '2024-03-01 08:45:00',
            'updated_at' => '2024-03-22 10:15:00',
        ]);
    }
}