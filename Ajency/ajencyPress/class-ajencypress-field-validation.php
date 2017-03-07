<?php


class Ajencypress_Field_Validation {

    const FIELD_TYPE_CHECKBOX = 'checkbox';
    const FIELD_TYPE_LINK = 'link';
    const FIELD_TYPE_NUMBER = 'number';
    const FIELD_TYPE_TEXTAREA = 'textarea';
    const FIELD_TYPE_TEXT = 'text';


    static function meta_validations($field, $value) {

        $validations = $field['validations'];

        if(isset($validations['required']) && $validations['required']['required'] == true && empty($value))
        {

            if($validations['required']['message']) {
                $message = $validations['required']['message'];
            } else {
                $message = $field['title'].' field is Required';
            }

            self::add_validation_error_to_queue($field['id'].'_error', $message);
            $value = false;
        }

       /* if(isset($validations['regex']) && (preg_match($validations['regex']['regex'], $value))) {
            self::add_validation_error_to_queue($field['id'].'_error',$validations['regex']['message']);
            $value = NULL;
        }*/

        //Additional default validations
        switch ($field['type']) {
            case self::FIELD_TYPE_LINK:

                if (!empty($value) && filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                    self::add_validation_error_to_queue($field['id'].'_error','Please enter a valid url for '.$field['title']);
                    $value = false;
                }
                break;

            case self::FIELD_TYPE_NUMBER:

                if(!empty($value) && !is_numeric($value)){
                    self::add_validation_error_to_queue($field['id'].'_error','Please enter a number for '.$field['title']);
                    $value = false;
                }

                //Validate Min Values
                if(isset($validations['min']['min']) && !empty($value) && is_numeric($value) && $value < $validations['min']['min']){
                    $message = isset($validations['min']['message']) ? $validations['min']['message']  : 'Please enter a number greater than '.$validations['min']['min'].' for '.$field['title'];
                    self::add_validation_error_to_queue($field['id'].'_error',$message);
                    $value = false;
                }

                //Validate Max Values
                if(isset($validations['max']['max']) && !empty($value) && is_numeric($value) && $value > $validations['max']['max']){
                    $message = isset($validations['max']['message']) ? $validations['max']['message']  : 'Please enter a number less than '.$validations['max']['max'].' for '.$field['title'];
                    self::add_validation_error_to_queue($field['id'].'_error',$message);
                    $value = false;
                }
                break;
            default:
        }

        return $value;
    }



    static function add_validation_error_to_queue($id,$message) {

        add_settings_error(
            $id,
            $id,
            __($message,'sdfsdf'), //TODO
            'error'
        );
        set_transient( 'amfg_errors', get_settings_errors(), 30 );
    }
}