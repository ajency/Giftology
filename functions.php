<?php

add_action( 'wp_enqueue_scripts', 'register_api_calls_js' );
function register_api_calls_js() {
    //load script
    wp_enqueue_script( 'readmore', get_template_directory_uri() . '/js/readmore.min.js', '', '' , true );
    wp_enqueue_script( 'giftology-api', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '' , true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '' , true );
    wp_enqueue_script( 'bootstrap-tagsinput', get_template_directory_uri() . '/js/bootstrap-tagsinput.min.js', array( 'jquery' ), '' , true );


    //localize data for script
    wp_localize_script( 'giftology-api', 'giftology_api', array(
            'root' => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce( 'wp_rest' ),
            'current_user_id' => get_current_user_id(),
            'homeUrl' => esc_url(home_url())
        )
    );
}
include 'Ajency/class-amfg.php';
require_once('navwalker.php');


register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'mfgiftology' )
) );


add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    if (!is_admin()) {
        show_admin_bar(false);
    }
}

add_action( 'rest_api_init', 'giftology_api' );
function giftology_api() {

    register_rest_route(
        'giftology/v1',
        '/gifts/(?P<gift_id>\d+)/queue-invites',
        array(
            'methods' => 'POST',
            'callback' => 'giftology_queue_invites',
            'permission_callback' => function () {
                return is_user_logged_in();
            }

        )
    );

    register_rest_route(
        'giftology/v1',
        '/gifts/(?P<gift_id>\d+)/delete-invites',
        array(
            'methods' => 'POST',
            'callback' => 'wpshout_find_author_post_title',
            'permission_callback' => function () {
                return is_user_logged_in();
            }
        )
    );

    register_rest_route(
        'giftology/v1',
        '/gifts/(?P<gift_id>\d+)/send-invites',
        array(
            'methods' => 'POST',
            'callback' => 'giftology_send_invites',
            'permission_callback' => function () {
                return is_user_logged_in();
            }
        )
    );

    register_rest_route(
        'giftology/v1',
        '/gifts/(?P<gift_id>\d+)/delete-invite/(?P<invite_id>\d+)',
        array(
            'methods' => 'POST',
            'callback' => 'giftology_delete_invite',
            'permission_callback' => function () {
                return is_user_logged_in();
            }
        )
    );

    register_rest_route(
        'giftology/v1',
        '/gifts/(?P<gift_id>\d+)/delete-invite-by-email',
        array(
            'methods' => 'POST',
            'callback' => 'giftology_delete_invite_by_email',
            'permission_callback' => function () {
                return is_user_logged_in();
            }
        )
    );

    register_rest_route(
        'giftology/v1',
        '/gifts/(?P<gift_id>\d+)/change-settings',
        array(
            'methods' => 'POST',
            'callback' => 'giftology_change_gift_settings',
            'permission_callback' => function () {
                return is_user_logged_in();
            }
        )
    );
}


function giftology_delete_invite($request_data){

    $parameters = $request_data->get_params();
    $gift_id = $parameters['gift_id'];
    $invite_id = $parameters['invite_id'];
    $user_id = get_current_user_id();
    Ajency_MFG_Gift::delete_queued_invite($gift_id,$invite_id,$user_id);
}

function giftology_delete_invite_by_email($request_data){
    $parameters = $request_data->get_params();
    $gift_id = $parameters['gift_id'];
    $email = $parameters['email'];
    $user_id = get_current_user_id();
    Ajency_MFG_Gift::delete_queued_invite_by_email($gift_id,$email,$user_id);
}

function giftology_change_gift_settings($request_data)
{
    $parameters = $request_data->get_params();
    $user_id = get_current_user_id();
    $gift_id = $parameters['gift_id'];
    $new_contrib_setting = $_POST['contribSetting'];
    $gift = Ajency_MFG_Gift::get_gift_details($gift_id);
    $existing_contrib_setting = $gift->contrib_setting_id;


    if ($gift->created_by == $user_id) { //check if gift belongs to requesting user

        if ($new_contrib_setting != $existing_contrib_setting) { //check if user made a change or simply just pressed save
            Ajency_MFG_Gift::update_gift_contrib_settings($gift_id, $new_contrib_setting); //Update the setting in DB

            if ($new_contrib_setting == Ajency_MFG_Gift::SETTING_CONTRIB_ONLY_ME) { // Only me

                //Invalidate any unclaimed invites, claimed invites are taken care of by ACLS, leave those status as is. ie Claimed
                Ajency_MFG_Gift::invalidate_invite_code($gift_id);

                //Remove any existing ACLs for the gift, new invitaions would have to be sent
                Ajency_MFG_Gift::remove_acls_for_entity('gift', $gift_id, 'send-invites');
                Ajency_MFG_Gift::remove_acls_for_entity('gift', $gift_id, 'contribute');
                Ajency_MFG_Gift::remove_acls_for_entity('gift', $gift_id, 'view-invites');

                Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, NULL, 'send-invites', 0); //No One is allowed to send invites
                Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, NULL, 'view-invites', 1); //EveryOne is allowed to view invites

                Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, NULL, 'contribute', 0); //Only the gift contributor can contribute for now
                Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, $user_id, 'contribute', 1); //Only the gift contributor can contribute for now


            } else if ($new_contrib_setting == Ajency_MFG_Gift::SETTING_CONTRIB_SPECIFIC) {

                Ajency_MFG_Gift::update_global_acls_for_entity('gift', $gift_id, 'view-invites', 1); //EveryOne is allowed to view invites
                Ajency_MFG_Gift::update_global_acls_for_entity('gift', $gift_id, 'send-invites', 0); //No One is allowed to send invites
                Ajency_MFG_Gift::update_global_acls_for_entity('gift', $gift_id, 'contribute', 0); //Only the gift contributor can contribute for now

                Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, $user_id, 'send-invites', 1); //Only the gift contributor can contribute for now


            } else if ($new_contrib_setting == Ajency_MFG_Gift::SETTING_CONTRIB_EVERYONE) {

                Ajency_MFG_Gift::update_global_acls_for_entity('gift', $gift_id, 'view-invites', 1); //EveryOne is allowed to view invites
                Ajency_MFG_Gift::update_global_acls_for_entity('gift', $gift_id, 'send-invites', 1); //No One is allowed to send invites
                Ajency_MFG_Gift::update_global_acls_for_entity('gift', $gift_id, 'contribute', 1); //Only the gift contributor can contribute for now

            }
            return json_response(true, "Contribution Settings changes successfully");
        }
        return json_response(true, "No change made to settings");
   }
   return false;

}

function giftology_queue_invites($request_data) {

    $parameters = $request_data->get_params();
    $user_id = get_current_user_id();
    $gift_id = $parameters['gift_id'];

    //TODO change
    if (Ajency_MFG_Gift::get_acl_access_rule('gift',$gift_id,$user_id,'send-invites')) {

        $emails = explode(',', $parameters['email']);
        $message_id = Ajency_MFG_Gift::add_invitation_message($parameters['message']);

        $already_queued_emails = Ajency_MFG_Gift::check_if_invites_already_queued($gift_id, $emails, $user_id);

        $emails_to_add = array_diff($emails, $already_queued_emails);
        foreach ($emails_to_add as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Ajency_MFG_Gift::add_invitation($email, $gift_id, $user_id, Ajency_MFG_Gift::STATUS_INVITE_QUEUED, $message_id);
            }
        }
        return json_response(true, 'Emails added to Invite queue for Gift ID : ' . $gift_id, [$parameters['email'],$_POST['email'], $emails_to_add]);
    }
    return "Cannot";
}


function giftology_numeric_posts_nav($wp_query) {

    if( is_singular() )
        return;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /**	Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /**	Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }


    echo '<div class="navigation"><ul class="pagination">' . "\n";

    /**	Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

    /**	Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /**	Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /**	Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /**	Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}


function giftology_send_invites($request_data){

    $parameters = $request_data->get_params();
    $user_id = get_current_user_id();
    $gift_id = $parameters['gift_id'];
    $invite_group = $parameters['invite-group'];

    if (Ajency_MFG_Gift::get_acl_access_rule('gift',$gift_id,$user_id,'send-invites')) {
        $invites = Ajency_MFG_Gift::get_invitations($gift_id, Ajency_MFG_Gift::STATUS_INVITE_QUEUED,false,false,get_current_user_id());
        foreach ($invites as $invite) {
            if (filter_var($invite->email, FILTER_VALIDATE_EMAIL)) { //still check again - paracodeania

                //check if email is in db and belongs to a user, assume if display name is there, belongs to a user in db

                if ($invite->id) {
                    //mark status as 3 for user, also send link to user, if they use it status gets changes to 2
                    Ajency_MFG_Gift::mark_gift_code_as_used($invite->inv_id, $invite->invite_code, $invite->id, Ajency_MFG_Gift::STATUS_INVITE_TYPE_AUTO,$invite_group);

                    //make entry in acl table
                    Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, $invite->id, 'send-invites', 1);


                    //send gift url directly
/*                    $message = file_get_contents( get_template_directory() . '/Ajency/users/welcome-email-template.html');*/



                } else {

                 /*   $message = file_get_contents( get_template_directory() . '/Ajency/users/welcome-email-template.html');
                    $text = 'Welcome to Giftology';
                    $email_subject = "User invited you to contribute to a Gift on Giftology!";
                    $this->send_email($email_subject, $message, $text, $invite->email);*/

                    //send email with other email

                    //Mark the rest as sent
                    Ajency_MFG_Gift::mark_gift_code_as_sent($invite->invite_code,$invite_group);

                }
                $text = $message = 'Copy Paste the following link in browser : '.home_url().'/?accept-gift-invite='.$invite->invite_code;
                $email_subject = "A user has invited you to contribute to a Gift on Giftology!";
                Ajency_MFG_Users::send_email($email_subject, $message, $text, $invite->email, 'invite-email');

                //Trigger Email
            }
        }
        //TODO take care of errors in JS, check if for a gift and email already exists that is queued
        return json_response(true, 'Invitaions sent for ' . $gift_id, $invite_group);
    }
    return false;
}

function json_response($success, $message, $data = []) {
    return [
        'success' => $success,
        'message' => $message,
        'data' => $data,
    ];
}

function wpshout_find_author_post_title( $data ) {

    if($_POST){
        print_r($_POST);
    }
}

add_action('init', 'do_output_buffer');
function do_output_buffer() {
    ob_start();
}

function logout_redirect_home(){
    wp_safe_redirect(home_url());
    exit;
}
add_action('wp_logout', 'logout_redirect_home');

function add_custom_query_var( $vars ){
    $vars[] = "amc[]";
    $vars[] = "b1[]";
    $vars[] = "b2[]";
    $vars[] = "b3[]";
    return $vars;
}
add_filter( 'query_vars', 'add_custom_query_var' );

$run = new Ajency_MFG('mfgiftology','1.0.0');
$run->load();