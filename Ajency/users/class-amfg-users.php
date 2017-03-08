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
        add_action( 'wp_login', array($this,'set_last_login'));
        add_filter( 'manage_users_columns', array($this,'remove_users_columns'));


    }
//function for setting the last login
    function set_last_login($login) {
        $user = get_userdatabylogin($login);

        //add or update the last login value for logged in user
        update_usermeta( $user->ID, 'last_login', current_time('mysql') );
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
}