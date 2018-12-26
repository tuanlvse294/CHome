<?php

use Illuminate\Database\Seeder;

class CityDistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\District::query()->delete();
        \App\City::query()->delete();
        $tree = json_decode(file_get_contents('database/seeds/tree.json'));
        foreach ($tree as $city_code => $city) {
            \App\City::query()->create(
                [
                    'id' => $city_code,
                    'name' => $city->name,
                    'slug' => $city->slug,
                ]
            );
            foreach ($city->districts as $district_code => $district)
                \App\District::query()->create(
                    [
                        'id' => $district_code,
                        'name' => $district->name,
                        'slug' => $district->slug,
                        'city_id' => $city_code,
                    ]
                );
        }
    }
}
