<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //Mielőtt seedelünk, minden táblát töröljünk le.
        DB::statement('DELETE FROM user');
        DB::statement('DELETE FROM playingsport');
        DB::statement('DELETE FROM student');
        DB::statement('DELETE FROM schoolclass');
        DB::statement('DELETE FROM sport');

        //Ami Seeder osztály itt fel van sorolva, annak lefut a run() metódusa
        $this->call([
            UserSeeder::class,
            SchoolclassSeeder::class,
            SportSeeder::class,
            StudentSeeder::class,
            PlayingsportSeeder::class,
        ]);
    }
}
