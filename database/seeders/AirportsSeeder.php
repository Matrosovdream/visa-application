<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Airport;
use Illuminate\Support\Facades\DB;

class AirportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prepare country map: [code => id]
        $country_ids = Country::pluck('id', 'code')->toArray();

        // Read JSON data
        $airports = json_decode(file_get_contents(database_path('references/airports.json')), true);

        // Tune chunk size to your server's capability
        $chunks = array_chunk($airports, 500); 

        foreach ($chunks as $chunk) {
            $values = [];

            foreach ($chunk as $airport) {
                if (!isset($country_ids[$airport['iso_country']])) {
                    continue;
                }

                $values[] = sprintf(
                    "('%s', '%s', '%s', '%s', '%s', %d, '%s', '%s', '%s', '%s', '%s')",
                    addslashes($airport['id']),
                    addslashes('airport'),
                    addslashes($airport['ident']),
                    addslashes($airport['type']),
                    addslashes($airport['name']),
                    $country_ids[$airport['iso_country']],
                    addslashes($airport['continent']),
                    addslashes($airport['iso_country']),
                    addslashes($airport['iso_region']),
                    addslashes($airport['municipality']),
                    addslashes($airport['wikipedia_link'])
                );
            }

            if (!empty($values)) {
                $sql = "
            INSERT INTO arrival_points (ref_id, entity, identity, type, name, country_id, continent, iso_country, iso_region, municipality, wiki_link)
            VALUES " . implode(',', $values) . "
            ON DUPLICATE KEY UPDATE
                entity = VALUES(entity),
                identity = VALUES(identity),
                type = VALUES(type),
                name = VALUES(name),
                country_id = VALUES(country_id),
                continent = VALUES(continent),
                iso_country = VALUES(iso_country),
                iso_region = VALUES(iso_region),
                municipality = VALUES(municipality),
                wiki_link = VALUES(wiki_link)
        ";

                DB::statement($sql);
            }
        }


    }

    protected function prepareFields($airport, $country_ids)
    {

        return [
            'entity' => 'airport',
            'identity' => $airport['ident'],
            'type' => $airport['type'],
            'name' => $airport['name'],
            'country_id' => $country_ids[$airport['iso_country']],
            'continent' => $airport['continent'],
            'iso_country' => $airport['iso_country'],
            'iso_region' => $airport['iso_region'],
            'municipality' => $airport['municipality'],
            'wiki_link' => $airport['wikipedia_link'],
        ];

    }

}
