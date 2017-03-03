<?php

include '/var/www/mfgift/wp-content/themes/mfgiftology/Ajency/ajencyPress/class-ajencypress-post-type.php';
include '/var/www/mfgift/wp-content/themes/mfgiftology/Ajency/ajencyPress/class-ajencypress-taxonomy.php';
include '/var/www/mfgift/wp-content/themes/mfgiftology/Ajency/ajencyPress/class-ajencypress-post-type-metaboxes.php';
include '/var/www/mfgift/wp-content/themes/mfgiftology/Ajency/ajencyPress/class-ajencypress-taxonomy-metaboxes.php';
include '/var/www/mfgift/wp-content/themes/mfgiftology/Ajency/ajencyPress/class-ajencypress-metaboxes-validation.php';
include '/var/www/mfgift/wp-content/themes/mfgiftology/Ajency/ajencyPress/class-ajencypress-metaboxes-markup.php';
include '/var/www/mfgift/wp-content/themes/mfgiftology/Ajency/ajencyPress/class-ajencypress-admin-errors.php';

class Ajency_MFG_Funds {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->load();
    }

    public function load() {

        //Create Custom post type for fund
        $funds_post_type = new Ajencypress_Post_Type();
        $funds_post_type->setCustomPostTypeName('fund');
        $funds_post_type->setL10nDomain($this->plugin_name);
        $funds_post_type->create_post_type();


        //Create AMC taxonomy
        $amc_taxonomy = new Ajencypress_Taxonomy();
        $amc_taxonomy->setCustomTaxonomyName('amc');
        $amc_taxonomy->setAttachToPostType(array('fund')); //this can be array if needs to be added to multiple post types
        $amc_taxonomy->setL10nDomain($this->plugin_name);
        $amc_taxonomy->create_taxonomy();

        //Create 3 bucket AMCs
        $bucket_1_taxonomy = new Ajencypress_Taxonomy();
        $bucket_1_taxonomy->setCustomTaxonomyName('bucket-1');
        $bucket_1_taxonomy->setAttachToPostType('fund');
        $bucket_1_taxonomy->setL10nDomain($this->plugin_name);
        $bucket_1_taxonomy->create_taxonomy();

        $bucket_2_taxonomy = new Ajencypress_Taxonomy();
        $bucket_2_taxonomy->setCustomTaxonomyName('bucket-2');
        $bucket_2_taxonomy->setAttachToPostType('fund');
        $bucket_2_taxonomy->setL10nDomain($this->plugin_name);
        $bucket_2_taxonomy->create_taxonomy();

        $bucket_3_taxonomy = new Ajencypress_Taxonomy();
        $bucket_3_taxonomy->setCustomTaxonomyName('bucket-3');
        $bucket_3_taxonomy->setAttachToPostType('fund');
        $bucket_3_taxonomy->setL10nDomain($this->plugin_name);
        $bucket_3_taxonomy->create_taxonomy();

        //Add meta boxes to Fund
        $fields = [
            [
                'id' => '_fund_featured' , 'title' => 'Feature this Fund','type' => 'checkbox',
                'validations' => [ 'required' => ['required' => true ], 'regex' => ['regex' => false, 'message' => 'sdfsdf' ]],
                'message' => 'Feature this fund to make it appear'
            ],
            [
                'id' => '_fund_url' ,  'title' => 'Fund Url','type' => 'link',
                'validations' => [ 'required' => ['required' => true ]]
            ],
            [
                'id' => '_fund_bse_id' ,'title' => 'BSE ID','type' => 'text',
                'validations' => [ 'required' => ['required' => true ]]
            ],
            [
                'id' => '_fund_nse_id' ,'title' => 'NSE ID','type' => 'text',
                'validations' => [ 'required' => ['required' => true ]]
            ],
            [
                'id' => '_fund_returns' ,'title' => 'Fund Returns','type' => 'number',
                'validations' => [ 'required' => ['required' => true ]]
            ],
            [
                'id' => '_fund_min_investment' ,'title' => 'Fund Min Investment','type' => 'number',
                'validations' => [ 'required' => ['required' => true ]]
            ]
        ];
        $meta_boxes = new Ajencypress_Post_Type_Metaboxes();
        $meta_boxes->setPostType('fund');
        $meta_boxes->setMetaFieldConfig($fields);
        $meta_boxes->setPostStatusIfValidationFails('draft');
        $meta_boxes->add_metaboxes_to_post_type();


        $taxonomy_meta_boxes = new Ajencypress_Taxonomy_Metaboxes();
        $taxonomy_meta_boxes->setTaxonomyName('amc');
        $taxonomy_meta_boxes->add_metaboxes_to_taxonomy();


        //Other custom stuff like option settings. Can we make this generic also? - NO
        if( is_admin() ) {

            include 'class-amfg-buckets-taxonomy-options.php';
            new AMFG_Buckets_Taxonomy_Options($this->plugin_name,$this->version);

        }

    }
}