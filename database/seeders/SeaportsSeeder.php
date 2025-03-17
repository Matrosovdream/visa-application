<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Airport;
use Illuminate\Support\Str;

class SeaportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Get all countries
        $countries = Country::all();
        foreach ($countries as $country) {
            $country_ids[$country->slug] = $country->id;
        }

        // Retrieve the countries from the JSON file
        $ports = json_decode(file_get_contents(database_path('references/seaports.json')), true);

        // Insert the countries into the database
        foreach ($ports as $code=>$port) {

            $countryCode = Str::slug( $port['country'] );
            if( !isset( $country_ids[ $countryCode ] ) ) {
                continue;
            }

            // Update or create aiport by ref_id
            Airport::updateOrCreate([
                'identity' => $code,
            ], [
                'entity' => 'seaport',
                'name' => $port['name'].' Seaport',
                'municipality' => $port['city'],
                'country_id' => $country_ids[ $countryCode ],
                'identity' => $code,
            ]);
        }

    }
}
