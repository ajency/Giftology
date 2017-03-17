<?php get_header(); ?>
<?php if(!is_user_logged_in()) {
        do_action('wordpress_social_login');
    }
?>

<?php if(is_user_logged_in())
{
    $user_id = get_current_user_id();
    $code = $_GET['accept-gift-invite'];
    $invite = Ajency_MFG_Gift::get_invite_by_code($code);

    //Get Gift id based on code
    $gift_id = $invite->gift_id;

    //Add acl rule for user
    Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, $user_id, 'send-invites', 1);

    //Update gift invite status to used, assign user to the code
    Ajency_MFG_Gift::mark_gift_code_as_used($code,$user_id);

}
?>

<?php get_footer(); ?>