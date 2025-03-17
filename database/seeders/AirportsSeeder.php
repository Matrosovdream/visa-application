<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Airport;

class AirportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Get all countries
        $countries = Country::all();
        foreach ($countries as $country) {
            $country_ids[$country->code] = $country->id;
        }

        // Retrieve the countries from the JSON file
        $countries = json_decode(file_get_contents(database_path('references/airports.json')), true);

        // Insert the countries into the database
        foreach ($countries as $country) {

            // Update or create aiport by ref_id
            Airport::updateOrCreate([
                'ref_id' => $country['id'],
            ], [
                'entity' => 'airport',
                'identity' => $country['ident'],
                'type' => $country['type'],
                'name' => $country['name'],
                'country_id' => $country_ids[ $country['iso_country'] ],
                'continent' => $country['continent'],
                'iso_country' => $country['iso_country'],
                'iso_region' => $country['iso_region'],
                'municipality' => $country['municipality'],
                'wiki_link' => $country['wikipedia_link'],
            ]);
        }

    }
}
