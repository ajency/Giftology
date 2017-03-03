<?php


class Ajencypress_Metabox_Validation {

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

            Ajencypress_Admin_Errors::display_error($field['id'].'_error', $message);
            $value = false;
        }

       /* if(isset($validations['regex']) && (preg_match($validations['regex']['regex'], $value))) {
            Ajencypress_Admin_Errors::display_error($field['id'].'_error',$validations['regex']['message']);
            $value = NULL;
        }*/

        //Additional default validations
        switch ($field['type']) {
            case self::FIELD_TYPE_LINK:

                if (!empty($value) && filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                    Ajencypress_Admin_Errors::display_error($field['id'].'_error','Please enter a valid url for '.$field['title']);
                    $value = false;
                }

                break;

            case self::FIELD_TYPE_NUMBER:

                if(!empty($value) && !is_numeric($value)){
                    Ajencypress_Admin_Errors::display_error($field['id'].'_error','Please enter a number for '.$field['title']);
                    $value = false;
                }
                break;

            default:
        }

        return $value;
    }
}