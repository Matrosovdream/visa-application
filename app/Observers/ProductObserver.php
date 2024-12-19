<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductFieldReference;
use App\Models\ReferenceFormField;


class ProductObserver
{
    public function created(Product $product): void
    {

        // Get default fields
        $defaultFields = ReferenceFormField::where('default', true)->get();

        // Loop through
        foreach ($defaultFields as $field) {

            ProductFieldReference::create([
                'field_id' => $field->id,
                'product_id' => $product->id,
                'entity' => $field->entity,
                'section' => $field->section,
                'required' => true,
                'default_value' => $field->default_value,
            ]);

        }

    }

}
