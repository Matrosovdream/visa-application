<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderField;
use App\References\ProductReferences;

class OrderFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $fields = ProductReferences::userFields();
        
        foreach ($fields as $field) {
            unset($field['section']);
            OrderField::firstOrCreate(['slug' => $field['slug']], $field);
        }

    }
}
