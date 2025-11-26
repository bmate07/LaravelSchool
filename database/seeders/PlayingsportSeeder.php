<?php

namespace Database\Seeders;

use App\Models\Playingsport;
use App\Models\Sport;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayingsportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //a tanulok hany szazaleka sportol: 65%
        $percentageOfStudentsPlayingSport = 0.65;
        //egy tanulo atlagosan hanyat sportol: 1.1
        $averageNumberOfSportsAStudentPlays = 1.1;

        $numberOfStudent = Student::count();
        $numberOfAthletes = round($numberOfStudent * $percentageOfStudentsPlayingSport);
        //tomeges beszuras modeszere:: a memoriaban felgyujti a rekordokat
        //amikor vége, akkor tárol tömegesen
        $numberOfSports = round($numberOfAthletes * $averageNumberOfSportsAStudentPlays);

        for ($i = 0; $i < $numberOfSports; $i++) {
            //Minden hívás után tárolja a rekordot
            Playingsport::factory()->create();
        }
    }
}
