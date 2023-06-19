<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            'cat_name'=>'Appartment',
            'address'=>'Test Appartment number 2, tester Town USA',
            'header_pic'=>'https://reqres.in/img/faces/10-image.jpg',
            'description'=>'Appartment is so Beautiful',
            'facilities'=>'free gas, electricty, internet, food',
        ]);
        // $faker=Faker::create();
        // foreach(range(1,10)as $property)
        // {
        //     DB::table('properties')->insert([
        //         'cat_name'=>$faker->company(),
        //         'address'=>$faker->address(),
        //         'agent_mail'=>$faker->email(),
        //         'phone_no'=>$faker->phoneNumber(),

        //     ]);
        // }
    }
}
