<?php


class Ajency_MFG_Routing {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->load();
    }

    public function load() {

        add_action('parse_request', array($this, 'my_plugin_parse_request'));
        add_filter('query_vars', array($this,  'my_plugin_query_vars'));
        add_action( 'user_register', array($this, 'send_email' ));
    }

    function my_plugin_parse_request($wp) {

        do_action( 'wordpress_social_login' );
        print_r($wp->query_vars);

    }

    function my_plugin_query_vars($vars) {
        $vars[] = 'page';
        return $vars;
    }

    function send_email($user_id) {

        $html =
        print_r($user_id);
    }
}