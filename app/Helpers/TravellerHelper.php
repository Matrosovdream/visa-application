<?php
namespace App\Helpers;

use App\Models\Traveller;
use App\Models\File;
use App\Models\Country;
use App\Helpers\TravellerRefs;
use App\References\TravellerReferences;
use App\Repositories\Traveller\TravellerRepo;

class TravellerHelper
{

    public static function preparePostTraveller($data)
    {

        $groupedData = [];
        foreach ($data as $key => $values) {
            foreach ($values as $index => $value) {
                $groupedData[$index][$key] = $value;
            }
        }

        $newData = [];
        foreach ($groupedData as $key => $values) {
            $newData[] = self::prepareTraveller($values);
        }

        return $newData;

    }

    public static function prepareTraveller($values)
    {
        // Prepare Traveller fields
        $travellers_fields = [
            'full_name' => $values['name'] . ' ' . $values['lastname'],
            'name' => $values['name'],
            'lastname' => $values['lastname'],
            'birthday' => $values['birthday'],
            'passport' => $values['passport'],
        ];

        // Meta fields
        $meta_fields = [];
        $meta_fields[] = ['key' => 'passport_expiration_date', 'value' => $values['passport_expiration_date']];

        return [
            'traveller' => $travellers_fields,
            'meta' => $meta_fields,
        ];

    }

    public static function isCompletedForm($travellerModel)
    {

        $traveller = (new TravellerRepo)->getByID( $travellerModel->id );
        $order = (new TravellerRepo)->getOrder( $travellerModel->id );

        $fieldValues = $traveller['fieldValues']['items'];

        // Required and traveller fields
        $reqFields = array_filter( $order['product']['fields']['all'], function($field) {
            return $field['required'] && $field['entity'] == 'traveller';
        });

        // Check if all required fields are filled
        $completed = true;
        foreach( $reqFields as $field_id=>$field ) {

            $value = $fieldValues[ $field_id ]['value'] ?? null;

            if( $value == null || empty($value) ) {
                $completed = false;
                $empty[$field_id] = $field_id;
                //break;
            }

        }

        // Documents here


        return $completed;

    }

    public function getTravellerFields( $applicant_id, $product_id, $category ) {

        $data = [];

        $data['formFields'] = $this->getFormFields( 
            $product_id,
            'traveller', 
            $category
        );

        $data['fieldValues'] = $this->fieldValueRepo->getTravellerValues( $applicant_id );

        return $data;

    }

    public static function getRequiredFields($traveller_id)
    {

        $traveller = Traveller::find($traveller_id);
        $order = $traveller->orders()->first();

        $fields_main = [
            'name',
            'lastname',
            'birthday',
            'passport',
        ];

        // Retrieve all required fields
        $all_fields = self::getTravellerFieldList();
        foreach( $all_fields as $cat => $fields ) {
            foreach( $fields as $field_code => $field ) {
                if( 
                    isset($field['required']) && 
                    $field['required'] &&
                    $field['relate'] == 'meta'
                    ) {
                    $fields_meta[] = $field_code;
                }
            }
        }



        return [
            'main' => $fields_main,
            'meta' => $fields_meta,
        ];

    }

    public static function getTravellerFieldList($traveller_id = null, $product_id = null)
    {

        $cats = self::getTravellerFieldCategories();

        $fields = TravellerRefs::travellerFields();

        // Set an empty value for all
        foreach ($fields as $cat => $field) {
            foreach ($field as $field_code => $data) {
                $fields[$cat][$field_code]['value'] = '';
            }
        }

        // if isset traveller_id then fill in the array with values
        if ($traveller_id) {

            $traveller = Traveller::find($traveller_id);

            // Field values from the single table
            $fieldValues = $traveller->getFieldValues();

            //dd($fields);

            foreach ($fields as $cat => $field) {
                foreach ($field as $field_code => $data) {

                    switch ($data['relate']) {
                        case 'entity':
                            $fields[$cat][$field_code]['value'] = $traveller->{$field_code};
                            break;
                        case 'file':
                            $fileId = $traveller->getMeta($field_code);
                            $fields[$cat][$field_code]['value'] = File::find($fileId);
                            break;
                        case 'meta':

                            // If it's select then take the value from the
                            if ($data['type'] == 'select') {
                                foreach ($data['options'] as $option) {
                                    if ($option['value'] == $traveller->getMeta($field_code)) {
                                        $fields[$cat][$field_code]['valueModel'] = $option;
                                        break;
                                    }
                                }
                            }

                            $fields[$cat][$field_code]['value'] = $traveller->getMeta($field_code);

                            //$fields[$cat][$field_code]['value'] = $fieldValues[$field_code];

                            break;
                    }

                }
            }

        }

        //dd($fields);

        return $fields;

    }

    public static function getReference($ref_code)
    {

        $references = [
            'countries' => self::prepareCountryRef(),
            'gender' => self::prepareGenderRef(),
            'marital_status' => self::prepareMaritalStatusRef(),
            'boolean' => self::prepareBooleanRef(),
        ];
        return $references[$ref_code];

    }

    public static function prepareCountryRef()
    {

        $countries = Country::all();
        $countriesRef = [];
        foreach ($countries as $country) {
            $countriesRef[] = [
                'value' => $country->id,
                'title' => $country->name,
            ];
        }

        return $countriesRef;

    }

    public static function getTravellerFieldListAll()
    {

        $cats = self::getTravellerFieldList();

        $allFields = [];
        foreach ($cats as $cat => $fields) {
            foreach ($fields as $field_code => $data) {
                $data['code'] = $field_code;
                $allFields[$field_code] = $data;
            }
        }

        return $allFields;

    }

    public static function getTravellerField($field_code)
    {
        $fields = self::getTravellerFieldListAll();
        return $fields[$field_code];
    }

    public static function updateTravellerField($applicant_id, $field, $value)
    {

        $traveller = Traveller::find($applicant_id);

        //dd($field['code']);

        switch ($field['relate']) {
            case 'entity':
                $traveller->{$field['code']} = $value;
                $traveller->save();
                break;
            case 'file':
                // Upload file from request
                $file_raw = request()->file('fields.' . $field['code']);

                // Save file
                $file = $file_raw->store('public/files');

                // Save file using Files model
                $fileModel = new File();
                $fileModel->filename = $file_raw->getClientOriginalName();
                $fileModel->path = $file;
                $fileModel->type = 'general';
                $fileModel->size = $file_raw->getSize();
                $fileModel->extension = $file_raw->getClientOriginalExtension();
                $fileModel->visibility = 'private';
                $fileModel->save();

                $traveller->setMeta($field['code'], $fileModel->id);

                break;
            case 'meta':
                $traveller->setMeta($field['code'], $value);
                break;
        }

    }

    public static function getTravellerFieldCategories()
    {
        return TravellerReferences::TravellerFieldCategories();
    }

    public static function uploadDocument($applicant_id, $request_file, $data = [])
    {

        $path = 'uploads/travellers/'.$applicant_id;
        $disk = 'local';

        $file = request()->file($request_file);
        $filename = $file->getClientOriginalName();
        $filesize = $file->getSize();
        $type = $file->getMimeType();
        $extension = $file->getClientOriginalExtension();

        // We set an origin filename to the file
        $filePath = request()->file($request_file)->storeAs($path, $filename, $disk);

        // Insert into the database
        $file = new File();
        $file->filename = $filename;
        $file->path = $filePath;
        $file->type = $type;
        $file->size = $filesize;
        $file->extension = $extension;
        $file->description = '';
        $file->disk = $disk;
        $file->visibility = 'private';
        $file->user_id = auth('')->user()->id;
        $file->save();

        // Save the file path in the database
        $traveller = Traveller::find($applicant_id);
        $traveller->documents()->create([
            'file_id' => $file->id,
        ]);

    }

    public static function prepareGenderRef()
    {
        return TravellerRefs::Genders();
    }

    public static function prepareMaritalStatusRef()
    {
        return TravellerRefs::MaritalStatuses();
    }

    public static function prepareBooleanRef()
    {

        $boolean = [
            ['value' => 'yes', 'title' => 'Yes'],
            ['value' => 'no', 'title' => 'No'],
        ];
        return $boolean;

    }

}