<?php

class Ajencypress_Post_Type_Metaboxes {


    const FIELD_TYPE_CHECKBOX = 'checkbox';
    const FIELD_TYPE_LINK = 'link';
    const FIELD_TYPE_NUMBER = 'number';
    const FIELD_TYPE_TEXTAREA = 'textarea';
    const FIELD_TYPE_TEXT = 'text';

    private $metaFieldConfig;
    private $post_type;
    private $post_status_if_validation_fails;

    public function __construct()
    {
        $this->post_type = 'post';
        $this->post_status_if_validation_fails = false;
    }

    /**
     * @param bool $post_status_if_validation_fails
     */
    public function setPostStatusIfValidationFails($post_status_if_validation_fails)
    {
        $this->post_status_if_validation_fails = $post_status_if_validation_fails;
    }

    public function add_metaboxes_to_post_type() {

        add_action('add_meta_boxes', array( $this , 'register_metaboxes'));
        add_action('save_post', array( $this , 'save_meta'),1,2);

        //Reusable Admin Notices function
        # add_filter( 'post_updated_messages', array( $this , 'remove_post_published_admin_message' ));

        /*        add_action('transition_post_status', array($this, 'post_status_transition'), 1, 3);*/
    }

    function remove_post_published_admin_message( $messages )
    {
        unset($messages[post][6]);
        return $messages;
    }

    /*function post_status_transition( $new_status, $old_status, $post ) {

        if ($_POST && $new_status === 'publish' && true) {
       #     $this->ajf_get_warning_message();
        }
    }*/

    /**
     * @param mixed $metaFieldConfig
     */
    public function setMetaFieldConfig($metaFieldConfig)
    {
        $this->metaFieldConfig = $metaFieldConfig;
    }

    /**
     * @param string $post_type
     */
    public function setPostType($post_type)
    {
        $this->post_type = $post_type;
    }

    public function save_meta( $post_id, $post) {


        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
        if ( !isset( $_POST['amfg_nonce'] ) )
            return;
        if ( !wp_verify_nonce( $_POST['amfg_nonce'], 'amfg_nonce' ) )
            return;
        // Is the user allowed to edit the post or page?
        if ( !current_user_can( 'edit_post', $post->ID ) )
            return;

        foreach ($this->metaFieldConfig as $field) {


            $key = $field['id'];
            $value = $_POST[$key];
            $errors[$key] = Ajencypress_Field_Validation_New::meta_validations($field,$value);
            if(is_array($errors[$key])) {
                $value = false;
            } else {
                unset($errors[$key]);
            }

            $existing_value = get_post_meta( $post->ID, $field['id'], true );

            if(empty($value) && $existing_value) {
                delete_post_meta( $post->ID, $key );
            } else if ($existing_value && !empty($value)) {
                update_post_meta( $post->ID, $key, $value );
            } else if(!empty($value)) {
                add_post_meta( $post->ID, $key, $value );
            }
        }

        if(!empty($errors)) {
            foreach ($errors as $key => $error) {
                Ajencypress_Admin_Errors::add_validation_error_to_queue($key, implode(" ,",$error));
            }
            remove_action( 'save_post',  array( $this, 'save_meta' ), 1, 2 );

            if($this->post_status_if_validation_fails) {
                wp_update_post( array( 'ID' => $post_id, 'post_status' => $this->post_status_if_validation_fails ));
            }
            add_action( 'save_post', array( $this, 'save_meta' ), 1, 2 );
        }

    }


    function register_metaboxes() {

        foreach ($this->metaFieldConfig as $key => $field) {
            add_meta_box( $field['id'], $field['title'], array( Ajencypress_Field_Markup::class, 'display_meta_box_field_markup'), $this->post_type, 'side', 'default', $field );
        }
    }
}