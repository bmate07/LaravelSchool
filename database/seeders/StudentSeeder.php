<?php

namespace Database\Seeders;

use App\Models\Schoolclass;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //egy osztalyba atlag 28 jar
        $avgClassSize = 28;
        //osszesen hany osztalyunk van
        $numberOfClass = Schoolclass::count();
        //akkor hany tanulonk legyen
        $numberOfStudents = $avgClassSize * $numberOfClass;
        Student::factory()->count($numberOfStudents)->create();
    }
}