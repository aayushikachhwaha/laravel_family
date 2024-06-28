<?php
namespace Database\Seeders;

use App\Models\FamilyHead;
use App\Models\FamilyMember;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    public function run(): void
    {
        // Seed one family with head and members
        $family1 = FamilyHead::create([
            'name' => 'John',
            'surname' => 'Doe',
            'birthdate' => '1980-05-15',
            'mobile' => '1234567890',
            'address' => '123 Main St',
            'state' => 'Maharashtra',
            'city' => 'Mumbai',
            'pincode' => '90001',
            'marital_status' => 'Married',
            'wedding_date' => '2005-07-20',
            'hobbies' => 'Reading, Swimming',
            'photo' => '53C493X1Az7lqHq30lH3zqKhVGeQYyU4UhRgEkFj.png',
        ]);

        $family1->members()->createMany([
            [
                'name' => 'Jane Doe',
                'birthdate' => '1982-08-25',
                'marital_status' => 'Married',
                'wedding_date' => '2005-07-20',
                'education' => 'Bachelor of Science in Engineering',
                'photo' => 'nFpGucxCYa1ialbHwDjuL3RiukrGCbGbLz0Bl0N1.png',
            ],
            [
                'name' => 'Jimmy Doe',
                'birthdate' => '2010-03-10',
                'marital_status' => 'Unmarried',
                'education' => 'High School',
                'photo' => 'nFpGucxCYa1ialbHwDjuL3RiukrGCbGbLz0Bl0N1.png',
            ],
        ]);

        // Seed another family with head and members
        $family2 = FamilyHead::create([
            'name' => 'Michael',
            'surname' => 'Smith',
            'birthdate' => '1975-12-10',
            'mobile' => '9876543210',
            'address' => '456 Oak Ave',
            'state' => 'Gujrat',
            'city' => 'Ahmedabad',
            'pincode' => '10001',
            'marital_status' => 'Married',
            'wedding_date' => '2002-09-15',
            'hobbies' => 'Cooking, Traveling',
            'photo' => 'nFpGucxCYa1ialbHwDjuL3RiukrGCbGbLz0Bl0N1.png',
        ]);

        $family2->members()->createMany([
            [
                'name' => 'Emily Smith',
                'birthdate' => '1978-06-18',
                'marital_status' => 'Married',
                'wedding_date' => '2002-09-15',
                'education' => 'Master of Business Administration',
                'photo' => 'nFpGucxCYa1ialbHwDjuL3RiukrGCbGbLz0Bl0N1.png',
            ],
            [
                'name' => 'Sophia Smith',
                'birthdate' => '2005-11-30',
                'marital_status' => 'Unmarried',
                'education' => 'Middle School',
                'photo' => 'nFpGucxCYa1ialbHwDjuL3RiukrGCbGbLz0Bl0N1.png',
            ],
            [
                'name' => 'David Smith',
                'birthdate' => '2010-08-12',
                'marital_status' => 'Unmarried',
                'education' => 'Elementary School',
                'photo' => 'nFpGucxCYa1ialbHwDjuL3RiukrGCbGbLz0Bl0N1.png',
            ],
        ]);

        $this->command->info('Families seeded successfully!');
    }
}
