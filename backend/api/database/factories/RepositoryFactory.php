<?php

namespace Database\Factories;

use App\Models\Repository;
use App\Models\GitHubUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repository>
 */
class RepositoryFactory extends Factory
{
    protected $model = Repository::class;

    /**
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000000),
            'name' => $this->faker->word(),
            'description' => $this->faker->optional()->sentence(),
            'is_private' => $this->faker->boolean(),
            'user_id' => GitHubUser::factory(),
            'html_url' => $this->faker->url(),
        ];
    }
}
