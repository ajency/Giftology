<?php

class AMFG_Funds_Posttype_Metaboxes {

    const FIELD_FUND_FEATURED = '_fund_featured';
    const FIELD_FUND_URL = '_fund_url';
    const FIELD_FUND_BSE_ID = '_fund_bse_id';
    const FIELD_FUND_NSE_ID = '_fund_nse_id';
    const FIELD_FUND_RETURNS = '_fund_returns';
    const FIELD_FUND_MIN_INVESTMENT = '_fund_min_investment';

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        add_action('add_meta_boxes', array( $this , 'amfg_register_metaboxes'));
        add_action('save_post', array( $this , 'amfg_save_meta'),1,2);
        add_action('admin_notices', array($this, 'amfg_register_admin_notices'), 1, 2);

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public static function getConstants($class, $prefix = null, $assoc = false, $exclude = [])
    {
        $reflector = new ReflectionClass($class);
        $constants = $reflector->getConstants();
        $values = [];

        foreach($constants as $constant => $value) {
            if(($prefix && strpos($constant, $prefix) !==false) || $prefix === null) {
                if(in_array($value, $exclude)) {
                    continue;
                }
                if($assoc) {
                    $values[$constant] = $value;
                } else {
                    $values[] = $value;
                }
            }
        }

        return $values;
    }

    function amfg_register_metaboxes() {
        add_meta_box( 'amfg_register_metabox_fund_url', 'Url', array( &$this,'amfg_register_metabox_fund_url'), 'fund', 'side', 'default', array('id'=>'_end') );
        add_meta_box( 'amfg_register_metabox_featured_fund', 'Featured Fund', array( &$this,'amfg_register_metabox_featured_fund'), 'fund', 'side', 'default', array('id'=>'_3132') );
        add_meta_box( 'amfg_register_metabox_bse_id', 'BSE ID', array( &$this,'amfg_register_metabox_bse_id'), 'fund', 'side', 'default', array('id'=>'_3132') );
        add_meta_box( 'amfg_register_metabox_nse_id', 'NSE ID', array( &$this,'amfg_register_metabox_nse_id'), 'fund', 'side', 'default', array('id'=>'_3132') );
        add_meta_box( 'amfg_register_metabox_returns', 'Returns(%)', array( &$this,'amfg_register_metabox_returns'), 'fund', 'side', 'default', array('id'=>'_3132') );
        add_meta_box( 'amfg_register_metabox_min_investment', 'Minimum Investment', array( &$this,'amfg_register_metabox_min_investment'), 'fund', 'side', 'default', array('id'=>'_3132') );
     }


    function amfg_register_admin_notices() {

        if ( ! ( $errors = get_transient( 'amfg_errors' ) ) ) {
            return;
        }

        $message = '<div id="message" class="error below-h2"><p><ul>';
        $errors = array_column($errors,'message','setting');

        foreach ( $errors as $error ) {
            $message .= '<li>' . __($error,'fund') . '</li>';
        }
        $message .= '</ul></p></div><!-- #error -->';
        // Write them out to the screen
        echo $message;
        // Clear and the transient and unhook any other notices so we don't see duplicate messages
        delete_transient( 'amfg_errors' );
        remove_action( 'admin_notices', 'amfg_register_admin_notices' );
    }

    function amfg_display_error($id,$message){

        add_settings_error(
            $id,
            $id,
            __($message,$this->plugin_name),
            'error'
        );
        set_transient( 'amfg_errors', get_settings_errors(), 30 );
    }

    function amfg_register_metabox_featured_fund($post, $args) {

        global $post;

        wp_nonce_field( plugin_basename( __FILE__ ), 'amfg_nonce' );

        $fund_featured = get_post_meta( $post->ID, $this::FIELD_FUND_FEATURED, true );

        echo '<label for="_fund_featured">Feature This Event : </label>';

        $checked = isset($fund_featured) && $fund_featured == 1 ? 'checked' : 0;

        echo '<input type="checkbox" name="_fund_featured" value="1" '.$checked.' />
        <p>
        If this event needs to be showcased at the top of any event lists, check this bo
        </p>
        ';

    }

    function amfg_register_metabox_fund_url() {

        global $post;
        wp_nonce_field( plugin_basename( __FILE__ ), 'amfg_nonce' );

        $meta_data = get_post_meta( $post->ID, $this::FIELD_FUND_URL, true );
        echo '<input id="_fund_url" name="_fund_url" value="'.$meta_data.'" />';
    }


    function amfg_register_metabox_bse_id() {

        global $post;
        wp_nonce_field( plugin_basename( __FILE__ ), 'amfg_nonce' );

        $meta_data = get_post_meta( $post->ID,$this::FIELD_FUND_BSE_ID, true );
        echo '<input id="_fund_bse_id" name="_fund_bse_id" value="'.$meta_data.'" />';
    }


    function amfg_register_metabox_nse_id() {

        global $post;
        wp_nonce_field( plugin_basename( __FILE__ ), 'amfg_nonce' );

        $meta_data = get_post_meta( $post->ID, $this::FIELD_FUND_NSE_ID, true );
        echo '<input id="_fund_nse_id" name="_fund_nse_id" value="'.$meta_data.'" />';
    }


    function amfg_register_metabox_min_investment() {

        global $post;
        wp_nonce_field( plugin_basename( __FILE__ ), 'amfg_nonce' );

        $meta_data = get_post_meta( $post->ID, $this::FIELD_FUND_MIN_INVESTMENT, true );
        echo '<input id="_fund_min_investment" name="_fund_min_investment" value="'.$meta_data.'" />';
    }


    function amfg_register_metabox_returns() {

        global $post;
        wp_nonce_field( plugin_basename( __FILE__ ), 'amfg_nonce' );

        $meta_data = get_post_meta( $post->ID, $this::FIELD_FUND_RETURNS, true );
        echo '<input id="_fund_returns" name="_fund_returns" value="'.$meta_data.'" />';
    }

    function amfg_save_meta( $post_id, $post )  {

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
        if ( !isset( $_POST['amfg_nonce'] ) )
            return;
        if ( !wp_verify_nonce( $_POST['amfg_nonce'], plugin_basename( __FILE__ ) ) )
            return;
        // Is the user allowed to edit the post or page?
        if ( !current_user_can( 'edit_post', $post->ID ) )
            return;

        $metabox_ids = $this::getConstants($this,'FIELD');

        if(true) {
            self::amfg_display_error('missing','Something is weird');
        }

        foreach ($metabox_ids as $key) {

            print $key."<br>";
            $value = $_POST[$key];
            print $value."<br>";
            $existing_value = get_post_meta( $post->ID, $key, true );
            print $existing_value."<br>";

            if(empty($value) && $existing_value){
                print "1<br>";
                delete_post_meta( $post->ID, $key );
            } else if ($existing_value && !empty($value)) {
                print "2<br>";
                update_post_meta( $post->ID, $key, $value );
            } else if(!empty($value)) {
                print "3<br>";
                add_post_meta( $post->ID, $key, $value );
            }
        }

    }


}