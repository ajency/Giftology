<?php


class Ajencypress_Admin_Errors {

    function __construct($text_domain)
    {
        $this->textdomain = $text_domain;
        add_action('admin_notices', array($this, 'register_admin_notices'), 1, 2);

    }

    function register_admin_notices() {

        if ( ! ( $errors = get_transient( 'amfg_errors' ) ) ) {
            return;
        }

      /*  add_filter( 'post_updated_messages', array($this, 'remove_post_published_message' ));*/

        $message = '<div id="message" class="error updated"><p><ul>';
        $errors = array_column($errors,'message','setting');

        foreach ( $errors as $error ) {
            $message .= '<li>' . __($error, $this->textdomain) . '</li>';
        }
        $message .= '</ul></p></div><!-- #error -->';
        // Write them out to the screen
        echo $message;
        // Clear and the transient and unhook any other notices so we don't see duplicate messages
        delete_transient( 'amfg_errors' );
        remove_action( 'admin_notices', array(self::class, 'register_admin_notices') );
    }


   /* function remove_post_published_message( $messages )
    {
            die;
            unset($messages[post][6]);
            return $messages;
     }*/

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