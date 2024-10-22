<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->lastName,
            'nickname' => $this->faker->word,
            'gender' => $this->faker->randomElement(['M', 'F', 'O']),
            'course' => $this->faker->randomElement(['IT', 'EDUC', 'PSYCH', 'ACCOUNTING']),
            'year' => $this->faker->randomElement(['1', '2', '3', '4']),
            'birthdate' => $this->faker->date(),
            'mailing_address' => $this->faker->address,
            'mailing_contact_number' => $this->faker->phoneNumber,
            'permanent_address' => $this->faker->optional()->address,
            'permanent_contact_number' => $this->faker->optional()->phoneNumber,
            'residency' => $this->faker->randomElement(['owned', 'rent', 'others']),
            'civil_status' => $this->faker->randomElement(['single', 'married', 'divorced', 'widowed']),
            'religion' => $this->faker->word,
            'spouse_name' => $this->faker->optional()->name,
            'spouse_occupation' => $this->faker->optional()->jobTitle,
            'birth_order' => $this->faker->numberBetween(1, 3),
            'brother_count' => $this->faker->numberBetween(0, 5),
            'sister_count' => $this->faker->numberBetween(0, 5),
            'total_siblings' => function (array $attributes) {
                return $attributes['brother_count'] + $attributes['sister_count'];
            },
            'living_with' => $this->faker->word,
            'father_living' => $this->faker->boolean,
            'father_name' => $this->faker->name,
            'father_nationality' => $this->faker->word,
            'father_religion' => $this->faker->word,
            'father_educ_attainment' => $this->faker->word,
            'father_occupation' => $this->faker->jobTitle,
            'father_company' => $this->faker->company,
            'father_birthdate' => $this->faker->date(),
            'father_contact_number' => $this->faker->optional()->phoneNumber,
            'mother_living' => $this->faker->boolean,
            'mother_name' => $this->faker->name,
            'mother_nationality' => $this->faker->word,
            'mother_religion' => $this->faker->word,
            'mother_educ_attainment' => $this->faker->word,
            'mother_occupation' => $this->faker->jobTitle,
            'mother_company' => $this->faker->company,
            'mother_birthdate' => $this->faker->date(),
            'mother_contact_number' => $this->faker->optional()->phoneNumber,
            'monthly_income' => $this->faker->randomFloat(2, 1000, 10000),
            'guardian_name' => $this->faker->optional()->name,
            'guardian_relationship' => $this->faker->optional()->word,
            'guardian_address' => $this->faker->optional()->address,
            'guardian_contact_number' => $this->faker->optional()->phoneNumber,
            'guardian_email' => $this->faker->optional()->email,
            'emergency_contact' => $this->faker->optional()->name,
            'emergency_contact_number' => $this->faker->optional()->phoneNumber,
            'educ_status' => $this->faker->word,
            'educ_background' => json_encode([['year' => 'test 1', 'level' => 'tertiary', 'honors' => 'None', 'address' => '2024', 'schoolName' => 'test 1']]),
            'educ_assistance' => $this->faker->boolean,
            'educ_assistance_info' => $this->faker->optional()->sentence,
            'institutional_affiliations' => json_encode([['year' => 'test 1', 'status' => 'None', 'affiliation' => 'test 1', 'organization' => 'tertiary']]),
            'work_experience' => json_encode([['position' => 'test 1', 'dateRange' => 'test 1', 'companyName' => 'tertiary']]),
            'interest' => json_encode(['test 1', 'test 2', 'test 3']),
            'talents' => json_encode(['test 1', 'test 2', 'test 3']),
            'characteristics' => json_encode(['test 1', 'test 2', 'test 3']),
            'self_image_answer' => $this->faker->paragraph,
            'self_motivation_answer' => $this->faker->paragraph,
            'decision_making_answer' => $this->faker->paragraph,
        ];
    }
}
