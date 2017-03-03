<?php


class Ajencypress_Admin_Errors {

    static function register_admin_notices() {

        if ( ! ( $errors = get_transient( 'amfg_errors' ) ) ) {
            return;
        }

        $message = '<div id="message" class="error below-h2"><p><ul>';
        $errors = array_column($errors,'message','setting');

        foreach ( $errors as $error ) {
            $message .= '<li>' . __($error,'fund') . '</li>';
        }
        $message .= '</ul></p></div><!-- #error -->';
        // Write them out to the screen
        echo $message;
        // Clear and the transient and unhook any other notices so we don't see duplicate messages
        delete_transient( 'amfg_errors' );
        remove_action( 'admin_notices', 'amfg_register_admin_notices' );
    }

    static function display_error($id,$message) {

        add_settings_error(
            $id,
            $id,
            __($message,'sdfsdf'),
            'error'
        );
        set_transient( 'amfg_errors', get_settings_errors(), 30 );
    }
}