<?php
if( !defined( 'ABSPATH' ) ) exit;

function login()
{
    ?>
    <?php
    if (is_user_logged_in()) {
        $dest = home_url() . $_GET['destination'];
        wp_redirect($dest);
    } else {

        Ajency_MFG_Users::popup_login_form();
    }
}
?>