<?php get_header(); ?>

<?php

if(is_user_logged_in()){

    print "The complete gift form will come here, User Logged in";
    //TODO show form for complete gift
} else {

    print "The complete gift form will come here, User Logged out";

    Ajency_MFG_Users::popup_login_form();
}

?>

<?php get_footer(); ?>