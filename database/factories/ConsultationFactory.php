<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['LookUp-001', 'LookUp-002', 'LookUp-003']);

        return [
            'student_id' => Student::all()->random()->id,
            'concern' => $this->faker->sentence(),
            'status' => $status,
            'counselor_comment' => $this->faker->sentence(),
            'counselor_id' => User::all()->random()->id,
            'schedule_date' => in_array($status, ['LookUp-002', 'LookUp-003']) ? $this->faker->dateTimeBetween('now', '+1 month') : null,
        ];
    }
}
