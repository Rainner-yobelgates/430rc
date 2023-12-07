<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'owner',
            'email' => '430rc@gmail.com',
            'password' => bcrypt('adminfor430rc'),
        ]);
        foreach (json_decode(get_api_province())->rajaongkir->results as $province) {
            Province::create([
                'province' => $province->province
            ]);
        }
        foreach (json_decode(get_api_city())->rajaongkir->results as $city) {
            City::create([
                'province_id' => $city->province_id,
                'type' => $city->type,
                'city' => $city->city_name,
                'postal_code' => $city->postal_code
            ]);
        }

    }
}
