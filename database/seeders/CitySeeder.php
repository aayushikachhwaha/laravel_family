<?php

namespace Database\Seeders;

use App\Models\City;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //If the table 'cities' exists, insert the data to the table.
        if (DB::table('cities')->get()->count() >= 0) {
            DB::table('cities')->insert([
                ['name' => 'Mumbai', 'state_id' => 1, 'abv'=>'MUM'],
                ['name' => 'Pune', 'state_id' => 1, 'abv'=>'PUN'],
                ['name' => 'Ahmedabad', 'state_id' => 2, 'abv'=>'AHM'],
                ['name' => 'Surat', 'state_id' => 2, 'abv'=>'SUR'],
                ['name' => 'Jodhpur', 'state_id' => 3, 'abv'=>'JOD'],
                ['name' => 'Jaipur', 'state_id' => 3, 'abv'=>'JAP'],
            ]);
        }
    }
}
