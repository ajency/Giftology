<?php

class Ajency_MFG_Users {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->load();
    }

    public function load() {

        add_filter( 'manage_users_columns', array($this, 'new_modify_user_table') );
        add_filter( 'manage_users_custom_column', array($this, 'new_modify_user_table_row'), 10, 3 );
        add_filter( 'manage_users_columns', array($this,'remove_users_columns'));
        add_action( 'user_register', array($this, 'set_first_login' ));
        add_action( 'wp_login', array($this,'set_last_login'), 10, 2);
    }

    function set_first_login($user_id) {
        update_user_meta($user_id, 'last_login', 0);
    }

    function set_last_login($user_login, $user) {


        //TODO update user for FB with email
        $user_id = $user->ID;
        $first_login = get_user_meta($user_id, 'last_login', true);
        if( $first_login == 0 || $first_login == '0' ) {

            $message = file_get_contents( get_template_directory() . '/Ajency/users/welcome-email-template.html');
            $text = 'Welcome to Giftology';
            $email_subject = "Welcome to Giftology!";
            $user_wsl = wsl_get_stored_hybridauth_user_profiles_by_user_id($user_id);
            $this->send_email($email_subject, $message, $text, $user_wsl[0]->email);

        }
        update_user_meta( $user->ID, 'last_login', current_time('mysql') );
    }

    function new_modify_user_table( $column ) {
        $column['last_logged_in'] = 'Last Login';
        $column['created_on'] = 'Created On';
        return $column;
    }

    function new_modify_user_table_row( $val, $column_name, $user_id ) {
        switch ($column_name) {
            case 'last_logged_in' :
                $last_login = $this->get_last_login($user_id);
                return empty($last_login) ? "Never" : $last_login;
                break;
            case 'created_on' :
                return get_the_author_meta('user_registered',$user_id);
                break;
            default:
        }
        return $val;
    }

    //function for getting the last login
    function get_last_login($user_id) {
        $last_login = get_user_meta($user_id, 'last_login', true);

        //picking up wordpress date time format
        $date_format = get_option('date_format') . ' ' . get_option('time_format');

        //converting the login time to wordpress format
        $the_last_login = mysql2date($date_format, $last_login, false);

        //finally return the value
        return $the_last_login;
    }

    function remove_users_columns($column_headers) {
        unset($column_headers['posts']);
        unset($column_headers['role']);
        return $column_headers;
    }

    static function send_email($subject,$html,$text,$to,$tag) {


        $url = 'https://api.sendgrid.com/';
        $user = 'antonio_ajency';
        $pass = 'Ajency#123'; //TODO use an api key


        $json_string = array(

            'to' => array(
                $to,
            ),
            'category' => $tag,
        );


        $params = array(
            'api_user'  => $user,
            'api_key'   => $pass,
            'x-smtpapi' => json_encode($json_string),
            'to'        => $to,
            'subject'   => $subject,
            'html'      => $html,
            'text'      => $text,
            'from'      => 'info@giftology.dev',
        );


        $request =  $url.'api/mail.send.json';
        $session = curl_init($request);
        curl_setopt ($session, CURLOPT_POST, true);
        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($session);
        curl_close($session);
        return $response;
    }
}