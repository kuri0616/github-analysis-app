<?php

namespace Tests\Feature\GitHub;

use App\Models\GitHubUser;
use App\Models\Repository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FetchGitHubRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_リポジトリが存在するとき_200とリストを返す(): void
    {
        // GitHubユーザーを作成
        $githubUser = GitHubUser::factory()->create([
            'id' => 360340,
            'name' => 'officia'
        ]);

        // リポジトリを作成
        $repository = Repository::factory()->create([
            'id' => 499518,
            'name' => 'et',
            'description' => 'Amet est dolores at itaque ut dolores voluptas.',
            'is_private' => true,
            'user_id' => $githubUser->id,
            'html_url' => 'http://www.rempel.com/est-earum-sint-recusandae-omnis-quos',
        ]);

        $response = $this->getJson('/api/github/repositories');

        $response->assertStatus(200)
            ->assertJson([
                [
                    'id' => $repository->id,
                    'name' => $repository->name,
                    'html_url' => $repository->html_url
                ]
            ]);
    }

    public function test_リポジトリが存在しないとき_200と空配列を返す(): void
    {
        $response = $this->getJson('/api/github/repositories');

        $response->assertStatus(200)
            ->assertJson([]);
    }
} 