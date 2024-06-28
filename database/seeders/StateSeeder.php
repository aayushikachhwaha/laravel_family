<?php

namespace Database\Seeders;

use App\Models\State;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       //If the table 'states' exists, insert the data to the table.
       if (DB::table('states')->get()->count() >= 0) {
        DB::table('states')->insert([
            ['name' => 'Maharashtra', 'abv'=>'MH'],
            ['name' => 'Gujrat', 'abv'=>'GJ'],
            ['name' => 'Rajasthan', 'abv'=>'RJ']
        ]);
    }
    }
}
