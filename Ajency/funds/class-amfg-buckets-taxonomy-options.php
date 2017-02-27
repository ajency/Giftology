<?php

class MySettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    /**
     * Add options page
     */
    public function add_plugin_page()
    {

        add_submenu_page(
            'edit.php?post_type=' . 'fund',
            __('Bucket Settings', $this->plugin_name),
            __('Bucket Settings', $this->plugin_name),
            'manage_options',
            $this->plugin_name . '-settings',
            array($this, 'create_admin_page')
        );
/*        // This page will be under "Settings"
        add_options_page(
            'Settings Admin',
            'My Settings',
            'manage_options',
            'my-setting-admin',
            array( $this, 'create_admin_page' )
        );*/
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'my_option_name' );
        ?>
        <div class="wrap">
            <h1>My Settings</h1>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
                do_settings_sections( 'my-setting-admin' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'my_option_group', // Option group
            'my_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );


        add_settings_field(
            'fund_bucket_1_singular', // ID
            'Bucket 1 Singular', // Title
            array( $this, 'fund_bucket_add_settings_field_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' , // Section
            [1, 'singular']
        );


        add_settings_field(
            '_fund_bucket_1_plural', // ID
            'Bucket 1 Plural', // Title
            array( $this, 'fund_bucket_add_settings_field_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' , // Section
            [1, 'plural']
        );

        add_settings_field(
            'fund_bucket_2_singular', // ID
            'Bucket 2 Singular', // Title
            array( $this, 'fund_bucket_add_settings_field_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id', // Section
            [2, 'singular']
        );


        add_settings_field(
            '_fund_bucket_2_plural', // ID
            'Bucket 2 Plural', // Title
            array( $this, 'fund_bucket_add_settings_field_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' , // Section
            [2, 'plural']
        );

        add_settings_field(
            'fund_bucket_3_singular', // ID
            'Bucket 3 Singular', // Title
            array( $this, 'fund_bucket_add_settings_field_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id', // Section
            [3, 'singular']
        );


        add_settings_field(
            '_fund_bucket_3_plural', // ID
            'Bucket 3 Plural', // Title
            array( $this, 'fund_bucket_add_settings_field_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id', // Section
            [3, 'plural']
        );


    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function fund_bucket_add_settings_field_callback($args)
    {
        $id = '_fund_bucket_'.$args[0].'_'.$args[1];
        printf(
            '<input type="text" id="$id" name="$id" value="%s" />',
/*            isset( $this->options[$id] ) ? esc_attr( $this->options[$id]) : $id*/
            get_option($id)
        );
    }

}