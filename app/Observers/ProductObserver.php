<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\OrderField;
use App\Models\ProductFieldReference;


class ProductObserver
{
    public function created(Product $product): void
    {

        // Get default fields
        $defaultFields = OrderField::where('default', true)->get();

        // Loop through
        foreach ($defaultFields as $field) {

            ProductFieldReference::create([
                'field_id' => $field->id,
                'product_id' => $product->id,
                'entity' => 'order',
                'section' => 'trip',
                'required' => true,
                'default_value' => $field->default_value,
            ]);

        }

    }

}
