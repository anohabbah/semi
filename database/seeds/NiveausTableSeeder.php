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
            'Sciences Informatiques', 'Sciences Mathématiques', 'Sciences pour l\'Ingénieur'
        ];
        collect($academicLevel)->each(function ($level) {
            \App\Niveau::create(['name' => $level]);
        });
    }
}
