<?php

namespace Database\Factories;

use App\Models\PullRequest;
use App\Models\Repository;
use App\Models\GitHubUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class PullRequestFactory extends Factory
{
    protected $model = PullRequest::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000000),
            'repository_id' => Repository::factory(),
            'pull_request_number' => $this->faker->unique()->numberBetween(1, 1000),
            'title' => $this->faker->sentence(),
            'state' => $this->faker->randomElement(['open', 'closed']),
            'user_id' => GitHubUser::factory(),
            'body' => $this->faker->optional()->paragraph(),
            'html_url' => $this->faker->url(),
            'commits_count' => $this->faker->numberBetween(1, 10),
            'additions_count' => $this->faker->numberBetween(1, 100),
            'deletions_count' => $this->faker->numberBetween(1, 100),
            'changed_files_count' => $this->faker->numberBetween(1, 5),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'closed_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
            'merged_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
} 