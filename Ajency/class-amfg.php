<?php

class Ajency_MFG {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function load() {

        include 'funds/class-amfg-funds-post-type.php';
        $fund_post_type = new AMFG_Funds_Posttype($this->plugin_name,$this->version);

        include 'funds/class-amfg-funds-post-type-meta-boxes.php';
        $fund_post_type_metaboxes = new AMFG_Funds_Posttype_Metaboxes($this->plugin_name,$this->version);

        include 'funds/class-amfg-amc-taxonomy.php';
        $taxonomy_amc = new AMFG_AMCs_Taxonomy($this->plugin_name,$this->version);

        include 'funds/class-amfg-buckets-taxonomy.php';
        $taxonomy_buckets = new AMFG_Buckets_Taxonomy($this->plugin_name,$this->version);

        if( is_admin() ) {

            include 'funds/class-amfg-buckets-taxonomy-options.php';
            $my_settings_page = new MySettingsPage($this->plugin_name,$this->version);

        }
    }
}