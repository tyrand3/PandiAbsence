<?php

use Illuminate\Database\Seeder;

class AbsencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Absence::class, 50)->create();
    }
}
