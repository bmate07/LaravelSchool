<?php

namespace Database\Seeders;

use App\Helpers\CsvReader;
use App\Models\Schoolclass;
use App\Models\Sport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileName = 'csv/sport.csv';
        $delimiter = ';';
        $data = CsvReader::csvToArray($fileName, $delimiter);
        Sport::factory()->createMany($data);
    }
}
