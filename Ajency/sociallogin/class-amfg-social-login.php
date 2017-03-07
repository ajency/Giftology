<?php

require_once( get_template_directory() . '/Ajency/sociallogin/lib/hybridauth/hybridauth/Hybrid/Auth.php' );
require_once( get_template_directory() . '/Ajency/sociallogin/lib/hybridauth/vendor/autoload.php' );


class Ajency_MFG_Social_Login {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->sub_plugin_name = 'social-login';
        $this->load();
    }

    public function load() {

        add_action('parse_request', array($this, 'my_plugin_parse_request'));
        add_filter('query_vars', array($this,  'my_plugin_query_vars'));
    }

    function my_plugin_parse_request($wp) {

        print_r($wp->query_vars);

        if (array_key_exists($this->sub_plugin_name, $wp->query_vars) && $wp->query_vars[$this->sub_plugin_name] == 'index') {

            require_once( get_template_directory() . '/Ajency/sociallogin/lib/hybridauth/hybridauth/Hybrid/Endpoint.php' );
            require_once( get_template_directory() . '/Ajency/sociallogin/lib/hybridauth/vendor/autoload.php' );
            Hybrid_Endpoint::process();

        } else if (array_key_exists($this->sub_plugin_name, $wp->query_vars) && $wp->query_vars[$this->sub_plugin_name] == 'facebook') {



            $config = array(
                "base_url" => 'http://mfgiftology.dev' ."/?social-login=index",
                "providers" => array(
                    "Google" => array(
                        "enabled" => true,
                        "keys" => array("id" => "", "secret" => ""),
                    ),
                    "Facebook" => array(
                        "enabled" => true,
                        "keys" => array("id" => "1346339682071095", "secret" => "c38017e70683d65a7534d224be9accc2"),
                        "trustForwarded" => false
                    ),
                ),
                "debug_mode" => false,
                "debug_file" => "",
            );

            try{

                $hybridauth = new Hybrid_Auth( $config );
                $fb = $hybridauth->authenticate( "Facebook" );
                $user_profile = $fb->getUserProfile();
                $this->create_or_update_user($user_profile);

                if($GET['destination']) {
                    $url = home_url() . $GET['destination'];
                } else {
                    $url = home_url();
                }

                ob_clean();
                $url = get_home_url() . '/login';
                wp_redirect($url);
                exit();

                #http://mfgiftology.dev/wp-content/themes/mfgiftology/Ajency/sociallogin/login.php
            }
            catch( Exception $e ){
                echo "Ooophs, we got an error: " . $e->getMessage();
            }


        }
    }

    function my_plugin_query_vars($vars) {
        $vars[] = $this->sub_plugin_name;
        $vars[] = $this->sub_plugin_name.'-destination';
        return $vars;
    }

    function create_or_update_user(Hybrid_User_Profile $profile) {

        print "<pre>";
        print_r($profile);

        $userData = [];
        $userData['user_pass'] = wp_generate_password( 12, false );
        $userData['user_login'] = $profile->identifier;
        $userData['user_email'] =  isset($profile->emailVerified) ? $profile->emailVerified : $profile->email;
        $userData['display_name'] = $profile->displayName;
        $userData['nickname'] = $profile->displayName;
        $userData['first_name'] = $profile->firstName;
        $userData['last_name'] = $profile->lastName;

        if(
            user_meemail_exists($email) || username_exists($username)


        ) {

            $userData['user_pass'] = $password;
            wp_update_user($userData);
            echo 1;
        } else {
            $user_id = wp_insert_user($username,$password,$email);

            add_user_meta( $user_id, '_facebook_id', $profile->identifier, true );
            add_user_meta( $user_id, '_facebook_email', $email, true );

            echo 2;
            //TODO trigger email
        }
        $this->custom_login($username,$password);
        print_r(wp_get_current_user());
        die;


    }

    function custom_login($username, $password) {
        $creds = array();
        $creds['user_login'] = $username;
        $creds['user_password'] = $password;
        $creds['remember'] = true;
        $user = wp_signon( $creds, false );
        if ( is_wp_error($user) ){
            echo $user->get_error_message();
        }
    }

}