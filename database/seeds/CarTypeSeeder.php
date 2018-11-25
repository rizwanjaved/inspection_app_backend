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
            ['id' => 1, 'type' => 'small', 'registration_fee' => '400', 'late_fee' => '40'],
            ['id' => 2, 'type' => 'vagonR', 'registration_fee' => '500', 'late_fee' => '50']
            ]);
    }
}
