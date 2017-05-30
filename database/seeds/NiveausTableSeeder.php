<?php

use Illuminate\Database\Seeder;

class NiveausTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $academicLevel = [
            'Licence', 'Master', 'Doctorat'
        ];
        collect($academicLevel)->each(function ($level) {
            \App\Niveau::create(['name' => $level]);
        });
    }
}
