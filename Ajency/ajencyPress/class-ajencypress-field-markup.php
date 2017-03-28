<?php
if( !defined( 'ABSPATH' ) ) exit;

class Ajencypress_Field_Markup {

    const FIELD_TYPE_CHECKBOX = 'checkbox';
    const FIELD_TYPE_LINK = 'link';
    const FIELD_TYPE_NUMBER = 'number';
    const FIELD_TYPE_TEXTAREA = 'textarea';
    const FIELD_TYPE_TEXT = 'text';
    const FIELD_TYPE_MEDIA_IMAGE = 'image';
    const FIELD_TYPE_TAXONOMY = 'taxonomy';


    static function generate_meta_box_field_markup($field,$meta_data) {

        switch ($field['type']) {
            case self::FIELD_TYPE_LINK:

                $meta_box_content = '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta_data.'" />';
                break;

            case self::FIELD_TYPE_NUMBER:

                $meta_box_content = '<input type="number" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta_data.'" />';
                break;

            case self::FIELD_TYPE_TEXT:

                echo '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta_data.'" />';
                break;

            case self::FIELD_TYPE_CHECKBOX:

                $checked = isset($meta_data) && $meta_data == 1 ? 'checked' : 0;

                $meta_box_content = '<input type="checkbox" name="'.$field['id'].'" value="1" '.$checked.' />';
                break;

            case self::FIELD_TYPE_TEXTAREA:

                $meta_box_content = '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta_data.'" />';
                break;

            case self::FIELD_TYPE_MEDIA_IMAGE:

                //TODO
                $meta_box_content = '';
                break;

            default:
        }
        if($field['message']) {
            $meta_box_content = $meta_box_content.'<p>'.$field['message'].'</p>';
        }
        return $meta_box_content;
    }


    function display_meta_box_field_markup($post, $callback_args) {
        global $post;
        $field = $callback_args['args'];
        wp_nonce_field( 'amfg_nonce', 'amfg_nonce' );
        $meta_data = get_post_meta($post->ID,$field['id'],true);
        echo self::generate_meta_box_field_markup($field,$meta_data);
    }
}