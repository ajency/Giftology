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

        if($wp->query_vars['page'] == 'test-anom')
        {
            print "Any user Can See This Message";
            do_action( 'wordpress_social_login' );

        } else if ($wp->query_vars['page'] == 'test-auth') {

            if(is_user_logged_in()) {
                print "Logged in user Can See This Message";
            } else {
                print "Logged out user Can See This Message";
                do_action( 'wordpress_social_login' );
            }
        }
    }

    function my_plugin_query_vars($vars) {
        $vars[] = 'page';
        return $vars;
    }

    function send_email($user_id) {

        $user = get_userdata($user_id);
        $email_to = $user->user_email;
        $email_subject = "Welcome, $user->first_name";
        $message = 'Message';

        $headers[] = 'From: Me Myself <me@example.net>';

        if(wp_mail($email_to,$email_subject,$message, $headers)) {
            echo json_encode(array("result"=>"complete"));
        } else {
            echo json_encode(array("result" => "mail_error"));
            var_dump($GLOBALS['phpmailer']->ErrorInfo);
        }
    }
}