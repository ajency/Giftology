<?php

foreach(glob('shortcodes/*.php') as $file) {
    include $file;
}

foreach(glob('custom_pages/*.php') as $file) {
    include $file;
}

include 'shortcodes/gift-invites.php';
include 'shortcodes/login.php';

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
            $gift_id = $wp->query_vars['gifts'];
            get_template_part( 'Ajency/frontend/custom_pages/gift', 'page' );
        }
        else if($wp->query_vars['queued-gift-invites'])
        {
            get_template_part( 'Ajency/frontend/modals/queue-gift-invites', 'modal' );
/*            echo do_shortcode( '[gift_invites show_delete=1 template=2 gift_id="1" status="0"]' );*/
        }
        else if($wp->query_vars['accept-gift-invite'])
        {
            get_template_part( 'Ajency/frontend/custom_pages/accept-invite', 'page' );
            /*            echo do_shortcode( '[gift_invites show_delete=1 template=2 gift_id="1" status="0"]' );*/
        }
    }

    function my_plugin_query_vars($vars) {
        $vars[] = 'gifts';
        $vars[] = 'queued-gift-invites';
        $vars[] = 'accept-gift-invite';
        return $vars;
    }
}