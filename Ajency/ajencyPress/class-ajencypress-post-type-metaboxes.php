<?php

class Ajencypress_Post_Type_Metaboxes {


    const FIELD_TYPE_CHECKBOX = 'checkbox';
    const FIELD_TYPE_LINK = 'link';
    const FIELD_TYPE_NUMBER = 'number';
    const FIELD_TYPE_TEXTAREA = 'textarea';
    const FIELD_TYPE_TEXT = 'text';

    private $metaFieldConfig;
    private $post_type;
    private $validation_success;
    private $post_status_if_validation_fails;

    public function __construct()
    {
        $this->post_type = 'post';
        $this->post_status_if_validation_fails = false;
    }

    /**
     * @param mixed $validation_failed
     */
    public function setValidationSuccess($validation_success)
    {
        $this->validation_success = $validation_success;
    }

    /**
     * @param bool $post_status_if_validation_fails
     */
    public function setPostStatusIfValidationFails($post_status_if_validation_fails)
    {
        $this->post_status_if_validation_fails = $post_status_if_validation_fails;
    }

    function remove_post_published_admin_message( $messages )
    {
        global $post, $post_ID;
        if($post->post_status == 'draft') {
            unset($messages[post][6]);
            return $messages;
        }
    }

    public function add_metaboxes_to_post_type() {

        add_action('add_meta_boxes', array( $this , 'register_metaboxes'));
        add_action('save_post', array( $this , 'save_meta'),1,2);

        //Reusable Admin Notices function
        add_action('admin_notices', array(Ajencypress_Admin_Errors::class, 'register_admin_notices'), 1, 2);
        add_filter( 'post_updated_messages', array( $this , 'remove_post_published_admin_message' ));
    }

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

        $fields = $this->metaFieldConfig;


        foreach ($fields as $field) {

            $key = $field['id'];
            $value = Ajencypress_Metabox_Validation::meta_validations($field,$_POST[$field['id']]);
            //Validation errors encountered, we set this to
            if($value == false) {
                $this->setValidationSuccess($value);
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

        remove_action( 'save_post',  array( $this, 'save_meta' ), 1, 2 );

        if(!$this->validation_success && $this->post_status_if_validation_fails) {
            wp_update_post( array( 'ID' => $post_id, 'post_status' => $this->post_status_if_validation_fails ));
        }

        add_action( 'save_post', array( $this, 'save_meta' ), 1, 2 );
    }

    function register_metaboxes() {

        foreach ($this->metaFieldConfig as $key => $field) {
            add_meta_box( $field['id'], $field['title'], array( Ajencypress_Metabox_Markup::class, 'display_meta_box_field_markup'), $this->post_type, 'side', 'default', $field );
        }
    }
}