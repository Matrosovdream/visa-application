<?php
namespace App\References;

use App\Helpers\TravellerHelper;

class TravellerReferences
{

    public static function userFields()
    {

        return [
            // Personal Information
            [
                'title' => "Country of Residence",
                'slug' => "residence_country",
                'entity' => "traveller",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "country",
                'default' => true,
                'section' => "personal"
            ],
            [
                'title' => "Gender",
                'slug' => "gender",
                'entity' => "traveller",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "gender",
                'default' => true,
                'section' => "personal"
            ],
            [
                'title' => "Do you have another nationality?",
                'slug' => "dual_nationality",
                'entity' => "traveller",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "boolean",
                'default' => true,
                'section' => "personal"
            ],
            [
                'title' => "Dual Nationality Country",
                'slug' => "dual_nationality_country",
                'entity' => "traveller",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "country",
                'default' => true,
                'section' => "personal"
            ],
            [
                'title' => "Residence address",
                'slug' => "residence_address",
                'entity' => "traveller",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "personal"
            ],
            [
                'title' => "Residence city or Town",
                'slug' => "residence_city",
                'entity' => "traveller",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "personal"
            ],
            [
                'title' => "Residence state or province",
                'slug' => "residence_state",
                'entity' => "traveller",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "personal"
            ],
            [
                'title' => "Residence ZIP code",
                'slug' => "residence_zip",
                'entity' => "traveller",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "personal"
            ],
            [
                'title' => "Occupation",
                'slug' => "occupaion",
                'entity' => "traveller",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "personal"
            ],

            // Passport Information
            [
                'title' => "Name",
                'slug' => "name",
                'entity' => "traveller",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "passport"
            ],
            [
                'title' => "Last name",
                'slug' => "lastname",
                'entity' => "traveller",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "passport"
            ],
            [
                'title' => "Birthday",
                'slug' => "birthday",
                'entity' => "traveller",
                'type' => "date",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "passport"
            ],
            [
                'title' => "Passport",
                'slug' => "passport",
                'entity' => "traveller",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "passport"
            ],
            [
                'title' => "Passport Issue Date",
                'slug' => "passport_issue_date",
                'entity' => "traveller",
                'type' => "date",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "passport"
            ],
            [
                'title' => "Passport Expiration Date",
                'slug' => "passport_expiration_date",
                'entity' => "traveller",
                'type' => "date",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "passport"
            ],
            [
                'title' => "Country of Birth",
                'slug' => "birth_country",
                'entity' => "traveller",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "country",
                'default' => true,
                'section' => "passport"
            ],
            [
                'title' => "Which country issued your passport",
                'slug' => "passport_issue_country",
                'entity' => "traveller",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "country",
                'default' => true,
                'section' => "passport"
            ],

            // Family
            [
                'title' => "Marital status",
                'slug' => "marital_status",
                'entity' => "traveller",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "marital_status",
                'default' => true,
                'section' => "family"
            ],

            // Past travel
            [
                'title' => "Have you previously visited this country?",
                'slug' => "past_travel_country",
                'entity' => "traveller",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "boolean",
                'default' => true,
                'section' => "past_travel"
            ],
            [
                'title' => "During your Last visit this country, when did you arrive?",
                'slug' => "past_travel_date",
                'entity' => "traveller",
                'type' => "date",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "past_travel"
            ],
            [
                'title' => "When did you depart?",
                'slug' => "past_travel_departure",
                'entity' => "traveller",
                'type' => "date",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "past_travel"
            ],
            [
                'title' => "What city did you stay in?",
                'slug' => "past_travel_cities",
                'entity' => "traveller",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "past_travel"
            ],

            // Declarations
            [
                'title' => "Have you ever been deported from this country or another country?",
                'slug' => "is_previous_country_deport",
                'entity' => "traveller",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "boolean",
                'default' => true,
                'section' => "declarations"
            ],
            [
                'title' => "Which Country?",
                'slug' => "previous_country_deport_country",
                'entity' => "traveller",
                'type' => "reference",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "country",
                'default' => true,
                'section' => "declarations"
            ],
            [
                'title' => "Date deported",
                'slug' => "previous_country_deport_date",
                'entity' => "traveller",
                'type' => "date",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "declarations"
            ],
            [
                'title' => "Please provide details",
                'slug' => "previous_country_deport_details",
                'entity' => "traveller",
                'type' => "text",
                'placeholder' => "",
                'tooltip' => "",
                'description' => "",
                'default_value' => "",
                'reference_code' => "",
                'default' => true,
                'section' => "declarations"
            ],
            
        ];


    }

    public static function travellerFields()
    {

        $fields = [
            'personal' => [
                'residence_country' => [
                    'title' => 'Country of Residence',
                    'type' => 'select',
                    'required' => true,
                    'options' => TravellerHelper::getReference('countries'),
                    'relate' => 'meta',
                    'placeholder' => 'Select country',
                    'tooltip' => '',
                ],
                'gender' => [
                    'title' => 'Gender',
                    'type' => 'select',
                    'required' => true,
                    'options' => TravellerHelper::getReference('gender'),
                    'relate' => 'meta',
                    'placeholder' => 'Select gender',
                    'tooltip' => '',
                ],
                'dual_nationality' => [
                    'title' => 'Do you have another nationality?',
                    'type' => 'select',
                    'required' => true,
                    'options' => TravellerHelper::getReference('boolean'),
                    'relate' => 'meta',
                    'placeholder' => 'Yes or No',
                    'tooltip' => '',
                ],
                'dual_nationality_country' => [
                    'title' => 'Dual Nationality Country',
                    'type' => 'select',
                    'required' => true,
                    'options' => TravellerHelper::getReference('countries'),
                    'relate' => 'meta',
                    'placeholder' => 'Select country',
                    'tooltip' => '',
                ],
                'residence_address' => [
                    'icon' => 'location-2.svg',
                    'title' => 'Residence address',
                    'type' => 'text',
                    'required' => true,
                    'relate' => 'meta',
                    'placeholder' => 'Enter address',
                    'tooltip' => 'Enter your permanent mailing address if it’s different from your current residence address',
                ],
                'residence_city' => [
                    'icon' => 'location-2.svg',
                    'title' => 'Residence city or Town',
                    'type' => 'text',
                    'required' => true,
                    'relate' => 'meta',
                    'placeholder' => 'City/town',
                    'tooltip' => '',
                ],
                'residence_state' => [
                    'icon' => 'location-2.svg',
                    'title' => 'Residence state or province',
                    'type' => 'text',
                    'required' => true,
                    'relate' => 'meta',
                    'placeholder' => 'State/Province',
                    'tooltip' => '',
                ],
                'residence_zip' => [
                    'icon' => 'location-2.svg',
                    'title' => 'Residence ZIP code',
                    'type' => 'text',
                    'required' => true,
                    'relate' => 'meta',
                    'placeholder' => 'Zipcode',
                    'tooltip' => '',
                ],
                'occupation' => [
                    'icon' => 'user.svg',
                    'title' => 'Occupation',
                    'type' => 'text',
                    'required' => true,
                    'relate' => 'meta',
                    'placeholder' => 'Occupation',
                    'tooltip' => 'Provide occupation or work status that best matches your situation.',
                ],
            ],
            'passport' => [
                'name' => [
                    'icon' => 'user.svg',
                    'title' => 'Name',
                    'type' => 'text',
                    'required' => true,
                    'relate' => 'entity',
                    'placeholder' => 'Passport Number',
                    'tooltip' => '',
                ],
                'lastname' => [
                    'icon' => 'user.svg',
                    'title' => 'Last name',
                    'type' => 'text',
                    'required' => true,
                    'relate' => 'entity',
                    'placeholder' => 'Last name',
                    'tooltip' => '',
                ],
                'birthday' => [
                    'icon' => 'user.svg',
                    'title' => 'Birthday',
                    'type' => 'date',
                    'required' => true,
                    'relate' => 'entity',
                    'classes' => 'datepicker-birthday',
                    'placeholder' => 'Birthday',
                    'tooltip' => '',
                ],
                'passport' => [
                    'icon' => 'user.svg',
                    'title' => 'Passport',
                    'type' => 'text',
                    'required' => true,
                    'relate' => 'entity',
                    'placeholder' => 'Passport Number',
                    'tooltip' => '',
                ],
                'passport_issue_date' => [
                    'icon' => 'user.svg',
                    'title' => 'Passport Issue Date',
                    'type' => 'date',
                    'required' => true,
                    'relate' => 'meta',
                    'classes' => 'datepicker-birthday',
                    'placeholder' => 'Passport Issue Date',
                    'tooltip' => '',
                ],
                'passport_expiration_date' => [
                    'icon' => 'user.svg',
                    'title' => 'Passport Expiration Date',
                    'type' => 'date',
                    'required' => true,
                    'relate' => 'meta',
                    'classes' => 'datepicker-min-today',
                    'placeholder' => 'Passport Expiration Date',
                    'tooltip' => '',
                ],
                'birth_country' => [
                    'title' => 'Country of Birth',
                    'type' => 'select',
                    'required' => true,
                    'options' => TravellerHelper::getReference('countries'),
                    'relate' => 'meta',
                    'placeholder' => 'Select country',
                    'tooltip' => '',
                ],
                'passport_issue_country' => [
                    'title' => 'Which country issued your passport',
                    'type' => 'select',
                    'required' => true,
                    'options' => TravellerHelper::getReference('countries'),
                    'relate' => 'meta',
                    'placeholder' => 'Select country',
                    'tooltip' => '',
                ],
            ],
            'family' => [
                'marital_status' => [
                    'title' => 'Marital status',
                    'type' => 'select',
                    'required' => true,
                    'options' => TravellerHelper::getReference('marital_status'),
                    'relate' => 'meta',
                    'placeholder' => 'Select status',
                    'tooltip' => '',
                ],
            ],
            'past_travel' => [
                'past_travel_country' => [
                    'title' => 'Have you previously visited this country?',
                    'type' => 'select',
                    'required' => true,
                    'options' => TravellerHelper::getReference('boolean'),
                    'relate' => 'meta',
                    'placeholder' => 'Select country',
                    'tooltip' => '',
                ],
                'past_travel_date' => [
                    'icon' => 'location-2.svg',
                    'title' => 'During your Last visit this country, when did you arrive? ',
                    'type' => 'date',
                    'required' => false,
                    'relate' => 'meta',
                    'classes' => 'datepicker-birthday',
                    'placeholder' => '',
                    'tooltip' => '',
                ],
                'past_travel_departure' => [
                    'icon' => 'calendar.svg',
                    'title' => 'When did you depart?',
                    'type' => 'date',
                    'required' => false,
                    'relate' => 'meta',
                    'classes' => 'datepicker-birthday',
                    'placeholder' => '',
                    'tooltip' => '',
                ],
                'past_travel_cities' => [
                    'icon' => 'location.svg',
                    'title' => 'What city did you stay in?',
                    'type' => 'text',
                    'required' => true,
                    'relate' => 'meta',
                    'classes' => '',
                    'placeholder' => 'City/Town',
                    'tooltip' => '',
                ],
            ],
            'declarations' => [
                'is_previous_country_deport' => [
                    'icon' => 'location-2.svg',
                    'title' => 'Have you ever been deported from this country or another country?',
                    'type' => 'select',
                    'required' => true,
                    'options' => TravellerHelper::getReference('boolean'),
                    'relate' => 'meta',
                    'placeholder' => 'Yes or No',
                    'tooltip' => '',
                ],
                'previous_country_deport_country' => [
                    'title' => 'Which Country?',
                    'type' => 'select',
                    'required' => true,
                    'options' => TravellerHelper::getReference('countries'),
                    'relate' => 'meta',
                    'placeholder' => 'Select country',
                    'tooltip' => '',
                ],
                'previous_country_deport_date' => [
                    'icon' => 'calendar.svg',
                    'title' => 'Date deported',
                    'type' => 'date',
                    'required' => true,
                    'relate' => 'meta',
                    'classes' => 'birthday',
                    'placeholder' => 'Passport Expiration Date',
                    'tooltip' => '',
                ],
                'previous_country_deport_details' => [
                    'icon' => '',
                    'title' => 'Please provide details',
                    'type' => 'text',
                    'required' => false,
                    'relate' => 'meta',
                    'classes' => '',
                    'placeholder' => 'Any reasons',
                    'tooltip' => '',
                ],
            ],
        ];

        return $fields;

    }

    public static function genders()
    {

        $genders = [
            ['value' => 'male', 'title' => 'Male'],
            ['value' => 'female', 'title' => 'Female'],
        ];
        return $genders;

    }

    public static function maritalStatuses()
    {

        $statuses = [
            ['value' => 'single', 'title' => 'Single'],
            ['value' => 'married', 'title' => 'Married'],
            ['value' => 'divorced', 'title' => 'Divorced'],
            ['value' => 'widowed', 'title' => 'Widowed'],
        ];
        return $statuses;

    }

    public static function TravellerFieldCategories()
    {

        $cats = [
            'personal' => [
                'title' => __('Personal Information'),
                'slug' => 'personal',
                'route' => 'web.account.order.applicant.personal'
            ],
            'passport' => [
                'title' => __('Passport Information'),
                'slug' => 'passport',
                'route' => 'web.account.order.applicant.passport'
            ],
            'family' => [
                'title' => __('Family'),
                'slug' => 'family',
                'route' => 'web.account.order.applicant.family'
            ],
            'past_travel' => [
                'title' => __('Past Travel'),
                'slug' => 'past_travel',
                'route' => 'web.account.order.applicant.past-travel'
            ],
            'declarations' => [
                'title' => __('Declarations'),
                'slug' => 'declarations',
                'route' =>
                    'web.account.order.applicant.declarations'
            ],
            /*'documents' => [
                'title' => __('Documents'), 
                'slug' => 'documents', 
                'route' => 'web.account.order.applicant.documents'
            ],*/
        ];

        return $cats;

    }


}