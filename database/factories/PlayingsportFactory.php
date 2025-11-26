<?php

namespace Database\Factories;

use App\Models\Playingsport;
use App\Models\Sport;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Playingsport>
 */
class PlayingsportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $randomStudentId = Student::inRandomOrder()->first()->id ?? null;
            $randomSportId = Sport::inRandomOrder()->first()->Id ?? null;

            if (is_null($randomStudentId) || is_null($randomSportId)) {
                break;
            }

            $exists = Playingsport::where('studentId', $randomStudentId)
                ->where('sportId', $randomSportId)->exists();
        } while ($exists);

        return [
            'studentId'->$randomStudentId,
            'sportId'->$randomSportId,
        ];
    }
}
