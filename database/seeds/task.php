<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class task extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Faker\Factory::create();

        DB::table('tasks')->insert([
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'task' => $faker->text(10)
        ]);
    }
}
