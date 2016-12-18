<?php

use Illuminate\Database\Seeder;
use App\Project;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        $faker = Faker\Factory::create();
        foreach (range(1,30) as $index) {
            Project::create([
                'title' => $faker->bs(),
                'fee' => "Rp" . $faker->numberBetween($min = 100000, $max = 900000) . " - Rp" . $faker->numberBetween($min = 1000000, $max = 9000000),
                'duration' => "Until " . $faker->date($format = 'd-m-Y'),
                'description' => $faker->realText($maxNbChars = 700),
                'contact' => $faker->phoneNumber()
            ]);
        }
    }
}
