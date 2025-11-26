<?php

namespace Database\Factories;

use App\Models\Schoolclass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected function withFaker()
    {
        // Manuális beállítás az app config felülírására
        return \Faker\Factory::create('hu_HU');
    }

    function kalkulalOsztöndijTömbbel(float $atlag): int
    {
        // float -> integer normalizálás (pl. 4.1 = 41)
        $norm = (int) round($atlag * 10);

        // tömbös szabályok: [határérték, ösztöndíj]
        $szabalyok = [
            ['max' => 19, 'penz' => 0],       // 1.0 – 1.9
            ['max' => 24, 'penz' => 8000],    // 2.0 – 2.4
            ['max' => 34, 'penz' => 25000],   // 2.5 – 3.4
            ['max' => 44, 'penz' => 42000],   // 3.5 – 4.4
            ['max' => 50, 'penz' => 59000],   // 4.5 – 5.0
        ];

        foreach ($szabalyok as $rule) {
            if ($norm <= $rule['max']) {
                return $rule['penz'];
            }
        }

        // elvileg sose fut ide, de biztonságnak marad
        return 0;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //neme
        $neme = $this->faker->boolean;
        $gender = $neme ? 'male' : 'female';

        $firstName = $this->faker->firstName($gender);
        $lastName = $this->faker->lastName();
        $diakNev = "$lastName $firstName";
        $iranyitoszam = $this->faker->postcode;
        $lakHelyseg = $this->faker->city;
        $szulHelyseg = $this->faker->city;
        $lakCim = $this->faker->streetAddress;
        $atlag = $this->faker->randomFloat(
            $nbMaxDecimals = 1,
            $min = 1,
            $max = 5
        );
        $igazolvanyszam = strtoupper($this->faker->unique()->bothify('??######'));
        $randomClass = Schoolclass::inRandomOrder()->first();
        $schoolclassId = $randomClass->Id;
        $grade = substr($randomClass->osztalyNev, 0, 1);
        $ageMin = $grade + 5;
        $ageMax = $grade + 6;
        $szulDatum = $this->faker->dateTimeBetween('-' . ($ageMax) . ' years', '-' . $ageMin . ' years');
        $osztondij = $this->kalkulalOsztöndijTömbbel($atlag);

        return [
            'diakNev' => $diakNev,
            'schoolclassId' => $schoolclassId,
            'neme' => $neme,
            'iranyitoszam' => $iranyitoszam,
            'lakHelyseg' => $lakHelyseg,
            'lakCim' => $lakCim,
            'szulHelyseg' => $szulHelyseg,
            'szulDatum' => $szulDatum,
            'igazolvanyszam' => $igazolvanyszam,
            'atlag' => $atlag,
            'osztondij' => $osztondij,
        ];
    }
}
