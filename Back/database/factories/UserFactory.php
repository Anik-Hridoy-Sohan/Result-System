<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $value = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('1234567890'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'role_id' => 1,
            'address' => fake()->address(),
            'mobile' => rand(100000000, 999999999),
            'father_name' => fake()->name(),
            'mother_name' => fake()->name(),
            'nationality' => fake()->country(),
            'dob' => fake()->date(),
            'emergency_mobile' => rand(100000000, 999999999),
            'dept_id' => 1,
            'status' => 0,
            'student_id' => rand(200000, 240000),
        ];

        return $value;
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => now(),
        ]);
    }
}
