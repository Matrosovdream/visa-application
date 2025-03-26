<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class AirportsSeeder extends Seeder
{
    public function run(): void
    {
        // Get country codes mapped to their IDs
        $country_ids = Country::pluck('id', 'code')->toArray();

        // Read and decode airports JSON
        $airports = json_decode(file_get_contents(database_path('references/airports.json')), true);

        $batchData = [];

        foreach ($airports as $airport) {
            $code = $airport['iso_country'];

            if (!isset($country_ids[$code])) {
                continue;
            }

            $batchData[] = [
                'ref_id' => $airport['id'],
                'entity' => 'airport',
                'identity' => $airport['ident'],
                'type' => $airport['type'],
                'name' => $airport['name'],
                'country_id' => $country_ids[$code],
                'continent' => $airport['continent'],
                'iso_country' => $airport['iso_country'],
                'iso_region' => $airport['iso_region'],
                'municipality' => $airport['municipality'],
                'wiki_link' => $airport['wikipedia_link'],
            ];
        }

        // Insert in chunks using upsert
        $chunkSize = 500;
        foreach (array_chunk($batchData, $chunkSize) as $chunk) {
            DB::table('arrival_points')->upsert(
                $chunk,
                ['ref_id'], // Unique constraint column
                [
                    'entity',
                    'identity',
                    'type',
                    'name',
                    'country_id',
                    'continent',
                    'iso_country',
                    'iso_region',
                    'municipality',
                    'wiki_link',
                ]
            );
        }
    }
}
