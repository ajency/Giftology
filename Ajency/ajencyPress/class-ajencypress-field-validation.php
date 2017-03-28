<?php
if( !defined( 'ABSPATH' ) ) exit;

class Ajencypress_Field_Validation_New {

    const FIELD_TYPE_CHECKBOX = 'checkbox';
    const FIELD_TYPE_LINK = 'link';
    const FIELD_TYPE_NUMBER = 'number';
    const FIELD_TYPE_TEXTAREA = 'textarea';
    const FIELD_TYPE_TEXT = 'text';
    const FIELD_TYPE_FEATURED_IMAGE = 'featured-image';
    const FIELD_TYPE_TAXONOMY = 'taxonomy';


    static function meta_validations($field, $value) {

        $validations = $field['validations'];

        if ($field['type'] == self::FIELD_TYPE_FEATURED_IMAGE && $value == -1) {

            $required_failed = true;

        } else if($field['type'] == self::FIELD_TYPE_TAXONOMY && count($value) == 1 && $value[0] == 0) {

            $required_failed = true;

        }
        else if(isset($validations['required']) && $validations['required']['required'] == true && empty($value))
        {
            $required_failed = true;
        }

        if($required_failed) {
            if($validations['required']['message']) {
                $message = $validations['required']['message'];
            } else {
                $message = $field['title'].' field is Required';
            }

            $errors[] = $message;

        }

       /* if(isset($validations['regex']) && (preg_match($validations['regex']['regex'], $value))) {
            self::add_validation_error_to_queue($field['id'].'_error',$validations['regex']['message']);
            $value = NULL;
        }*/

        //Additional default validations
        switch ($field['type']) {
            case self::FIELD_TYPE_LINK:

                if (!empty($value) && filter_var($value, FILTER_VALIDATE_URL) === FALSE) {

                    $errors[] = 'Please enter a valid url for '.$field['title'];
                }
                break;

            case self::FIELD_TYPE_NUMBER:

                if(!empty($value) && !is_numeric($value)){

                    $errors[] = 'Please enter a number for '.$field['title'];
                }

                //Validate Min Values
                if(isset($validations['min']['min']) && !empty($value) && is_numeric($value) && $value < $validations['min']['min']){
                    $message = isset($validations['min']['message']) ? $validations['min']['message']  : 'Please enter a number greater than '.$validations['min']['min'].' for '.$field['title'];
                    $errors[] = $message;
                }

                //Validate Max Values
                if(isset($validations['max']['max']) && !empty($value) && is_numeric($value) && $value > $validations['max']['max']){
                    $message = isset($validations['max']['message']) ? $validations['max']['message']  : 'Please enter a number less than '.$validations['max']['max'].' for '.$field['title'];
                    $errors[] = $message;
                }
                break;
            default:
        }

        return $errors;
    }
}