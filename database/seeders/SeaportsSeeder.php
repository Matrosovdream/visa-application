<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Country;

class SeaportsSeeder extends Seeder
{
    public function run(): void
    {
        // Get countries map [slug => [id, code]]
        $country_ids = Country::all()->pluck('code', 'slug')->mapWithKeys(function ($code, $slug) use (&$country_ids) {
            $id = Country::where('slug', $slug)->value('id');
            return [$slug => ['id' => $id, 'code' => $code]];
        })->toArray();

        // Load seaports JSON
        $ports = json_decode(file_get_contents(database_path('references/seaports.json')), true);

        $batchData = [];
        foreach ($ports as $code => $port) {
            $countrySlug = Str::slug($port['country']);

            if (!isset($country_ids[$countrySlug])) {
                continue; // Skip unknown country
            }

            $batchData[] = [
                'entity' => 'seaport',
                'identity' => $code,
                'name' => $port['name'] . ' Seaport',
                'municipality' => $port['city'],
                'country_id' => $country_ids[$countrySlug]['id'],
                'iso_country' => $country_ids[$countrySlug]['code'],
            ];
        }

        // Insert in chunks with upsert
        $chunkSize = 500;
        foreach (array_chunk($batchData, $chunkSize) as $chunk) {
            DB::table('arrival_points')->upsert(
                $chunk,
                ['identity'], // Unique key
                ['name', 'municipality', 'country_id', 'iso_country', 'entity'] // Fields to update
            );
        }
    }
}
