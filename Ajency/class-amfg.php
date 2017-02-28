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
        new AMFG_Funds_Posttype($this->plugin_name,$this->version);

        include 'funds/class-amfg-funds-post-type-meta-boxes.php';
        new AMFG_Funds_Posttype_Metaboxes($this->plugin_name,$this->version);

        include 'funds/class-amfg-amc-taxonomy.php';
        new AMFG_AMCs_Taxonomy($this->plugin_name,$this->version);

        include 'funds/class-amfg-buckets-taxonomy.php';
        new AMFG_Buckets_Taxonomy($this->plugin_name,$this->version);

        if( is_admin() ) {

            include 'funds/class-amfg-buckets-taxonomy-options.php';
            new AMFG_Buckets_Taxonomy_Options($this->plugin_name,$this->version);

        }
    }
}