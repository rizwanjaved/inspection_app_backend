<?php

use Illuminate\Database\Seeder;

class ContraventionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('contravention_types')->truncate();
        DB::table('contravention_types')->insert([
            ['id' => 1, 'slug' => 'seat_belt', 'text' => 'Seat Belt', 'amount' => 20],
            ['id' => 2, 'slug' => 'no_parking', 'text' => 'No Parking', 'amount' => 20],
            ['id' => 3, 'slug' => 'red_signal', 'text' => 'Red Signal', 'amount' => 100],
            ['id' => 4, 'slug' => 'over_speeding', 'text' => 'Over Speeding', 'amount' => 50]
            ]);
        
    }
}
