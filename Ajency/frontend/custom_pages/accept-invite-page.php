<?php get_header(); ?>

<?php
$code = $_GET['accept-gift-invite'];
$user_id = get_current_user_id();
?>

<?php if(is_user_logged_in())
{
    $user_id = get_current_user_id();
    $invite = Ajency_MFG_Gift::get_invite_by_code($code);
    $gift_id = $invite->gift_id;
    $dest = home_url().'/?gifts='.$gift_id;
    if($invite) {
        //TODO check if Gift contrib status is only_me the fail it
        Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, $user_id, 'send-invites', 1);
        Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, $user_id, 'contribute', 1);
        Ajency_MFG_Gift::mark_gift_code_usage($user_id, $code , $invite->id);
    } else {
        $dest = home_url()."/?invite=invalid";

    }
    header("Location: ".$dest);
    exit;
}
?>


<?php if(!is_user_logged_in())
{
    Ajency_MFG_Users::popup_login_form($message);
}
?>

<?php get_footer(); ?>