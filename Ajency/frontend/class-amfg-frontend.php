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


    public function register_custom_pages() {

        add_action('parse_request', array($this, 'my_plugin_parse_request'));
        add_filter('query_vars', array($this,  'my_plugin_query_vars'));

    }

    function my_plugin_parse_request($wp) {

        if($wp->query_vars['gifts'])
        {
            //Custom Page
            $gift_id = $wp->query_vars['gifts'];
            get_template_part( 'Ajency/frontend/custom_pages/gift', 'page' );
        }
        else if($wp->query_vars['gift-invites-step-1'])
        {
            echo do_shortcode( '[gift_invites show_op_icon=1 template=2 gift_id='.$wp->query_vars['gift-invites-step-1'].' status=0]' );
        }
        else if($wp->query_vars['gift-invites-step-2'])
        {
            echo do_shortcode( '[gift_invites inv_group="'.$wp->query_vars['invite-group'].'" show_op_icon=1 template=2 gift_id='.$wp->query_vars['gift-invites-step-2'].' status=1,3]' );
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
        $vars[] = 'gift-invites-step-1';
        $vars[] = 'gift-invites-step-2';
        $vars[] = 'accept-gift-invite';
        $vars[] = 'invite-group';
        $vars[] = 'modal';
        return $vars;
    }
}