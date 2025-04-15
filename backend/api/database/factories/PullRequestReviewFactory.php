<?php

namespace Database\Factories;

use App\Models\PullRequestReview;
use App\Models\PullRequest;
use App\Models\GitHubUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class PullRequestReviewFactory extends Factory
{
    protected $model = PullRequestReview::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000000),
            'pull_request_id' => PullRequest::factory(),
            'user_id' => GitHubUser::factory(),
            'state' => $this->faker->randomElement(['APPROVED', 'CHANGES_REQUESTED', 'COMMENTED', 'DISMISSED', 'PENDING']),
            'body' => $this->faker->optional()->paragraph(),
            'submitted_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
} 