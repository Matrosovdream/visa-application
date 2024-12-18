<?php
namespace App\References;

class ProductReferences {

    public static function userFields() {

        return [
            [
                'title' => "When do you arrive at the country destination?",
                'slug' => "arrival_date",
                'type' => "date",
                'placeholder' => "",
                'tooltip' => "If your arrival point isn't listed, we can't process your request.",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "trip"
            ],
            [
                'title' => "Which airport do you arrive?",
                'slug' => "destination_airport",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "airport",
                'default' => true,
                'section' => "trip"
            ],
            [
                'title' => "Your full name",
                'slug' => "full_name",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "trip"
            ],
            [
                'title' => "Phone number",
                'slug' => "phone_number",
                'type' => "phone",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "trip"
            ],
            [
                'title' => "Email address",
                'slug' => "email",
                'type' => "email",
                'placeholder' => "",
                'tooltip' => "We use this to create your account and send you updates about your application.",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "trip"
            ],
        ];

    }

}