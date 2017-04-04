<?php
if( !defined( 'ABSPATH' ) ) exit;
?>
<?php
class AMFG_Buckets_Taxonomy_Options
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ));
        add_action( 'admin_init', array( $this, 'settings_init' ));

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    function add_admin_menu(  ) {

        add_submenu_page( 'edit.php?post_type=' . 'fund', 'Bucket Settings', 'Bucket Settings', 'manage_options', 'bucket-settings', array($this, 'options_page' ));

    }


    function settings_init(  ) {

        register_setting( 'pluginPage', '_amfg_bucket_settings' );

        add_settings_section(
            'pluginPage_section',
            __( 'Lables for Buckets', 'giftology' ),
            array($this,'settings_section_callback'),
            'pluginPage'
        );

        for($i = 1; $i < 4; $i++) {

            add_settings_field(
                '_amfg_bucket_'.$i.'_singular',
                __( 'Bucket '.$i.' Singular Label', 'giftology' ),
                array($this,'text_field_render'),
                'pluginPage',
                'pluginPage_section',
                [$i,'singular']
            );

            add_settings_field(
                '_amfg_bucket_'.$i.'_plural',
                __( 'Bucket '.$i.' Plural Label', 'giftology' ),
                array($this,'text_field_render'),
                'pluginPage',
                'pluginPage_section',
                [$i,'plural']
            );

        }



    }


    function text_field_render( $args ) {

        $id = '_amfg_bucket_'.$args[0].'_'.$args[1] ;
        $options = get_option( '_amfg_bucket_settings');
        ?>
        <input type='text' name="_amfg_bucket_settings[<?php echo $id; ?>]" value='<?php echo $options[$id]; ?>'>
        <?php

    }


    function settings_section_callback(  ) {

        echo __( 'This section description', 'giftology' );

    }


    function options_page() {

        ?>
        <form action='options.php' method='post'>

            <h2>giftology</h2>

            <?php
            settings_fields( 'pluginPage' );
            do_settings_sections( 'pluginPage' );
            submit_button();
            ?>

        </form>
        <?php

    }
}