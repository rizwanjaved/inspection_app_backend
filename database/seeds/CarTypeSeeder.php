<?php

use Illuminate\Database\Seeder;

class CarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('car_types')->truncate();
        DB::table('car_types')->insert([
            ['id' => 1, 'type' => 'private'],
            ['id' => 2, 'type' => 'commercial']
            ]);
    }
}
