<?php
include 'shortcodes/gift-invites.php';
include 'shortcodes/login.php';

/*include 'modals/queued-gift-invites-modal.php';
include 'custom_pages/accept-invite-page.php';
include 'custom_pages/gift-page.php';*/

class Ajency_MFG_Frontend
{


    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->register_shortcodes();
        $this->register_custom_pages();
    }

    public function register_shortcodes()
    {
        $shortcodes = [
            'gift_invites',
            'login',
        ];

        foreach ($shortcodes as $shortcode) {
            add_shortcode($shortcode, $shortcode);
        }
    }

    function custom_rewrite_basic() {
        // Remember to flush the rules once manually after you added this code!
        add_rewrite_rule(
        // The regex to match the incoming URL
            'gifts/([^/]+)?',
            // The resulting internal URL: `index.php` because we still use WordPress
            // `pagename` because we use this WordPress page
            // `designer_slug` because we assign the first captured regex part to this variable
            'index.php?gifts=$matches[1]',
            // This is a rather specific URL, so we add it to the top of the list
            // Otherwise, the "catch-all" rules at the bottom (for pages and attachments) will "win"
            'top' );
    }

    public function register_custom_pages() {

        add_action('parse_request', array($this, 'my_plugin_parse_request'));
        add_filter('query_vars', array($this,  'my_plugin_query_vars'));
        add_action('init', array($this, 'custom_rewrite_basic'));

    }

    function my_plugin_parse_request($wp) {

        if($wp->query_vars['gifts'])
        {
            $gift_id = $wp->query_vars['gifts'];
            if(is_numeric($gift_id)) {
                $gift = Ajency_MFG_Gift::get_gift_details($gift_id, true);
            } else {
                $gift = Ajency_MFG_Gift::get_gift_details($gift_id, true, $by_field = 'slug');
            }
            $gift_id = $gift->id;
            $fund = $gift->fund;
            $user_id = get_current_user_id();
            include locate_template('Ajency/frontend/custom_pages/gift-page.php', false, false);
        }
        else if($wp->query_vars['gift-invites-step-0'])
        {
            $gift_id = $wp->query_vars['gift-invites-step-0'];
            include locate_template('Ajency/frontend/modals/gift-invite-form.php', false, false);
        }
        else if($wp->query_vars['gift-invites-step-1'])
        {
            echo do_shortcode( '[gift_invites show_op_icon=1 template=2 gift_id='.$wp->query_vars['gift-invites-step-1'].' status=0]' );
        }
        else if($wp->query_vars['gift-invites-step-2'])
        {
            echo do_shortcode( '[gift_invites inv_group="'.$wp->query_vars['invite-group'].'" show_op_icon=1 template=2 gift_id='.$wp->query_vars['gift-invites-step-2'].' status=1]' );
        }
        else if($wp->query_vars['gift-invites-view-all'])
        {
            echo do_shortcode( '[gift_invites show_op_icon=1 template=2 gift_id='.$wp->query_vars['gift-invites-view-all'].' status=1]' );
        }
        else if($wp->query_vars['login'])
        {
            echo do_shortcode( '[login]' );
        }
        else if($wp->query_vars['accept-gift-invite']) //Step 3
        {
            //Page to accept invitaions and login
            get_template_part( 'Ajency/frontend/custom_pages/accept-invite', 'page' );
            /*            echo do_shortcode( '[gift_invites show_delete=1 template=2 gift_id="1" status="0"]' );*/
        }
    }

    function my_plugin_query_vars($vars) {
        $vars[] = 'gifts';
        $vars[] = 'gift-invites-step-0';
        $vars[] = 'gift-invites-step-1';
        $vars[] = 'gift-invites-step-2';
        $vars[] = 'accept-gift-invite';
        $vars[] = 'invite-group';
        $vars[] = 'modal';
        $vars[] = 'login';
        $vars[] = 'gift-invites-view-all';
        return $vars;
    }
}