<?php
namespace App\References;

class ProductReferences {

    public static function userFields() {

        return [
            [
                'title' => "When do you arrive at the country destination?",
                'slug' => "arrival_date",
                'entity' => "order",
                'type' => "date",
                'placeholder' => "",
                'tooltip' => "If your arrival point isn't listed, we can't process your request.",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "trip",
                'icon' => 'location-2.svg',
            ],
            [
                'title' => "Which airport do you arrive?",
                'slug' => "destination_airport",
                'entity' => "order",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "airport",
                'default' => true,
                'section' => "trip",
                'icon' => 'location-2.svg',
            ],
            [
                'title' => "Your full name",
                'slug' => "full_name",
                'entity' => "order",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "trip",
                'icon' => 'location-2.svg',
            ],
            [
                'title' => "Phone number",
                'slug' => "phone_number",
                'entity' => "order",
                'type' => "phone",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "trip",
                'icon' => 'location-2.svg',
            ],
            [
                'title' => "Email address",
                'slug' => "email",
                'entity' => "order",
                'type' => "email",
                'placeholder' => "",
                'tooltip' => "We use this to create your account and send you updates about your application.",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "trip",
                'icon' => 'location-2.svg',
            ],
        ];

    }

}