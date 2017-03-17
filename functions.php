<?php

/*add_action( 'init', function() {

    //load script
    wp_enqueue_script( 'my-post-submitter', plugin_dir_url( __FILE__ ) . 'post-submitter.js', array( 'jquery' ) );

    //localize data for script
    wp_localize_script( 'my-post-submitter', 'POST_SUBMITTER', array(
            'root' => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce( 'wp_rest' ),
            'success' => __( 'Thanks for your submission!', 'your-text-domain' ),
            'failure' => __( 'Your submission could not be processed.', 'your-text-domain' ),
            'current_user_id' => get_current_user_id()
        )
    );

});*/

add_action( 'wp_enqueue_scripts', 'my_script_holder' );

function my_script_holder() {
    print "Hey";
    die;

    wp_register_script( 'svejo_script', 'http://svejo.net/javascripts/svejo-button.js', array() ); //put any dependencies (including jQuery) into the array
    wp_enqueue_script( 'svejo_script' );
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

add_action( 'rest_api_init', 'wpshout_register_routes' );
function wpshout_register_routes() {

    register_rest_route(
        'giftology/v1',
        '/gifts/(?P<id>\d+)/queue-invites',
        array(
            'methods' => 'POST',
            'callback' => 'giftology_queue_invites',

        )
    );

    register_rest_route(
        'giftology/v1',
        '/gifts/(?P<id>\d+)/delete-invites',
        array(
            'methods' => 'POST',
            'callback' => 'wpshout_find_author_post_title',
        )
    );

    register_rest_route(
        'giftology/v1',
        '/gifts/(?P<id>\d+)/send-invites',
        array(
            'methods' => 'POST',
            'callback' => 'giftology_send_invites',
        )
    );

    register_rest_route(
        'giftology/v1',
        '/gifts/(?P<id>\d+)/change-settings',
        array(
            'methods' => 'POST',
            'callback' => 'giftology_gifts_change_settings',
            /*'permission_callback' => function () {
                return true;
            }*/
        )
    );
}



function giftology_gifts_change_settings(){

    //TODO check if settings same as past setting, then do nothing
    $gift_id = 1;
    $contrib_setting = $_POST['contribSetting'];

    $existing_setting = Ajency_MFG_Gift::get_gift_details($gift_id);

    if($contrib_setting != $existing_setting->contrib_setting_id) {
        Ajency_MFG_Gift::update_gift_contrib_settings($gift_id,$contrib_setting); //Update the setting in DB

        //Remove any existing ACLs for the gift, new invitaions would have to be sent
        Ajency_MFG_Gift::remove_acls_for_entity('gift',$gift_id,'send-invites');
        Ajency_MFG_Gift::remove_acls_for_entity('gift',$gift_id,'contribute');
        Ajency_MFG_Gift::remove_acls_for_entity('gift',$gift_id,'view-invites');

        //Invalidate any unclaimed invites, claimed invites are taken care of by ACLS, leave those status as is. ie Claimed
        Ajency_MFG_Gift::invalidate_invite_code($gift_id);

        $user_id = 39; //TODO remove hardcode

        if($contrib_setting == Ajency_MFG_Gift::SETTING_CONTRIB_ONLY_ME) { // Only me

            Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, NULL, 'send-invites', 0); //No One is allowed to send invites

            Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, $user_id, 'contribute', 1); //Only the gift creator can contribute

        } else if($contrib_setting  == Ajency_MFG_Gift::SETTING_CONTRIB_SPECIFIC) {

            Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, NULL, 'send-invites', 0); //No One is allowed to send invites
            Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, $user_id, 'send-invites', 1); //Except the gift creator for now
            //And invited people but that logic has a flow on actual invite popup and using invite link

            Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, $user_id, 'contribute', 1); //Only the gift contributor can contribute for now

        } else if($contrib_setting  == Ajency_MFG_Gift::SETTING_CONTRIB_EVERYONE) {

            Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, NULL, 'send-invites', 1); //Everyone is allowed
            Ajency_MFG_Gift::add_acl_rule('gift', $gift_id, NULL, 'contribute', 1); //Everyone is allowed to contribute also

        }
        return json_response(true, "Contribution Settings changes successfully");
    }
    return json_response(false, "No change made to settings");
}

function giftology_queue_invites() {

    $emails = explode(',',$_POST['email']);
    $message_id = Ajency_MFG_Gift::add_invitation_message($_POST['message']);
    $gift_id = 1;
    $already_queued_emails = Ajency_MFG_Gift::check_if_invites_already_queued($gift_id,$emails);
    $emails_to_add = array_diff($emails,$already_queued_emails);
    foreach ($emails_to_add as $email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Ajency_MFG_Gift::add_invitation($email,$gift_id,Ajency_MFG_Gift::STATUS_INVITE_QUEUED,$message_id);
        }
    }
    return json_response(true,'Emails added to Invite queue for Gift'.$gift_id,$emails_to_add);
}


function giftology_send_invites(){

    $gift_id = 1;
    $emails = Ajency_MFG_Gift::get_invitations($gift_id);
    foreach ($emails as $email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //still check again - paracodeania

            //check if email is in db and belongs to a user, assume if display name is there, belongs to a user in db

            if($email->id) {
                //make entry in acl table
                Ajency_MFG_Gift::add_acl_rule('gift',$gift_id,$email->id,'send-invites',1);
                //mark status as 3 for user, also send link to user, if they use it status gets changes to 2
                Ajency_MFG_Gift::mark_gift_code_as_used($email->invite_code,$email->id, Ajency_MFG_Gift::STATUS_INVITE_SENT_USED);
                //send gift url directly
            } else {
                //send email with other format
            }
        }
    }
    //TODO take care of errors in JS, check if for a gift and email already exists that is queued
    return json_response(true,'Invitaions sent for '.$gift_id, $emails);

}

function json_response($success, $message, $data) {
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

$run = new Ajency_MFG('mfgiftology','1.0.0');
$run->load();