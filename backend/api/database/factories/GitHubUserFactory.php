<?php

namespace Database\Factories;

use App\Models\GitHubUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GitHubUser>
 */
class GitHubUserFactory extends Factory
{
    protected $model = GitHubUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000000),
            'name' => $this->faker->unique()->userName(),
            'avatar_url' => $this->faker->imageUrl(),
            'html_url' => $this->faker->url(),
        ];
    }
}
