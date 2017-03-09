<?php

include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-post-type.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-taxonomy.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-post-type-metaboxes.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-taxonomy-fields.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-field-markup.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-field-validation.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-admin-errors.php' );


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

#        add_action( 'init',  array($this,'_wp_term_images_init'), 88 );
/*
        function enable_featured_image() {
            if(isset($_GET['taxonomy']) && $_GET['taxonomy'] == $this->taxonomy_name) {
            }
        }*/


        new Ajencypress_Admin_Errors( $this->plugin_name);

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
        $bucket_names = get_option('_amfg_bucket_settings');
        $bucket_1_taxonomy = new Ajencypress_Taxonomy();
        $bucket_1_taxonomy->setCustomTaxonomyName('bucket-1');
        $bucket_1_taxonomy->setSingularLabel($bucket_names['_amfg_bucket_1_singular']);
        $bucket_1_taxonomy->setPluralLabel($bucket_names['_amfg_bucket_1_plural']);
        $bucket_1_taxonomy->setAttachToPostType('fund');
        $bucket_1_taxonomy->setL10nDomain($this->plugin_name);
        $bucket_1_taxonomy->create_taxonomy();

        $bucket_2_taxonomy = new Ajencypress_Taxonomy();
        $bucket_2_taxonomy->setCustomTaxonomyName('bucket-2');
        $bucket_2_taxonomy->setSingularLabel($bucket_names['_amfg_bucket_2_singular']);
        $bucket_2_taxonomy->setPluralLabel($bucket_names['_amfg_bucket_2_plural']);
        $bucket_2_taxonomy->setAttachToPostType('fund');
        $bucket_2_taxonomy->setL10nDomain($this->plugin_name);
        $bucket_2_taxonomy->create_taxonomy();

        $bucket_3_taxonomy = new Ajencypress_Taxonomy();
        $bucket_3_taxonomy->setCustomTaxonomyName('bucket-3');
        $bucket_3_taxonomy->setSingularLabel($bucket_names['_amfg_bucket_3_singular']);
        $bucket_3_taxonomy->setPluralLabel($bucket_names['_amfg_bucket_3_plural']);
        $bucket_3_taxonomy->setAttachToPostType('fund');
        $bucket_3_taxonomy->setL10nDomain($this->plugin_name);
        $bucket_3_taxonomy->create_taxonomy();

        //Add meta boxes to Fund
        $fields_fund = [
            [
                'id' => '_fund_featured' , 'title' => 'Feature this Fund','type' => 'checkbox',
                'is_custom_field' => true,
                'message' => 'Feature this fund to make it appear',
            ],
            [
                'id' => 'amc' ,  'title' => 'AMC','type' => Ajencypress_Field_Validation_New::FIELD_TYPE_TAXONOMY,
                'validations' => [ 'required' => ['required' => true ]]
            ],
            [
                'id' => 'bucket-1' ,  'title' => $bucket_1_taxonomy->getSingularLabel(),'type' => Ajencypress_Field_Validation_New::FIELD_TYPE_TAXONOMY,
                'validations' => [ 'required' => ['required' => true ]]
            ],
            [
                'id' => '_thumbnail_id' ,  'title' => 'Featured Image','type' => Ajencypress_Field_Validation_New::FIELD_TYPE_FEATURED_IMAGE,
                'validations' => [ 'required' => ['required' => true ]]
            ],
            [
                'id' => 'bucket-2' ,  'title' => $bucket_2_taxonomy->getSingularLabel(),'type' => Ajencypress_Field_Validation_New::FIELD_TYPE_TAXONOMY,
                'validations' => [ 'required' => ['required' => true ]]
            ],
            [
                'id' => 'bucket-3' ,  'title' => $bucket_3_taxonomy->getSingularLabel(),'type' => Ajencypress_Field_Validation_New::FIELD_TYPE_TAXONOMY,
                'validations' => [ 'required' => ['required' => true ]]
            ],
            [
                'id' => 'content' ,  'title' => 'Fund Description','type' => NULL,
                'validations' => [ 'required' => ['required' => true ]]
            ],
            [
                'id' => '_fund_url' ,  'title' => 'Fund Url','type' => 'link',
                'validations' => [ 'required' => ['required' => true ]],
                'is_custom_field' => true
            ],
            [
                'id' => '_fund_bse_id' ,'title' => 'BSE ID','type' => 'text',
                'validations' => [ 'required' => ['required' => true ]],
                'is_custom_field' => true
            ],
            [
                'id' => '_fund_nse_id' ,'title' => 'NSE ID','type' => 'text',
                'validations' => [ 'required' => ['required' => true ]],
                'is_custom_field' => true
            ],
            [
                'id' => '_fund_returns' ,'title' => 'Fund Returns(%)', 'type' => 'number',
                'validations' => [
                    'required' => ['required' => true ],
                    'min' => ['min' => 0 , 'message' => 'Fund Returns has to be a percentage' ],
                    'max' => ['max' => 100 , 'message' => 'Fund Returns has to be a percentage' ]
                ],
                'is_custom_field' => true
            ],
            [
                'id' => '_fund_min_investment' ,'title' => 'Fund Min Investment','type' => 'number',
                'validations' => [ 'required' => ['required' => true ]],
                'is_custom_field' => true
            ]
        ];
        $meta_boxes = new Ajencypress_Post_Type_Metaboxes();
        $meta_boxes->setPostType('fund');
        $meta_boxes->setMetaFieldConfig($fields_fund);
        $meta_boxes->setPostStatusIfValidationFails('draft');
        $meta_boxes->add_metaboxes_to_post_type();

        $taxonomy_fields = new Ajencypress_Taxonomy_Fields();
        $taxonomy_fields->setTaxonomyName('amc');
        $fields_amc = [
            [
                'id' => '_url' , 'title' => 'AMC Url','type' => 'link',
                'validations' => [ 'required' => ['required' => true ]],
                'message' => 'A link for url',
                'is_custom_field' => true
            ],
            [
                'id' => 'description' ,'type' => NULL,
                'validations' => [ 'required' => ['required' => true  , 'message' => 'AMC Description field is required']],

            ],
            [
                'id' => 'term-image' ,'type' => NULL,
                'validations' => [ 'required' => ['required' => true , 'message' => 'AMC Image field is required']],

            ],
            [
                'id' => 'name' ,'type' => NULL,
                'validations' => [ 'required' => ['required' => true , 'message' => 'AMC Name field is required']],
            ]
        ];
        $taxonomy_fields->setMetaFieldConfig($fields_amc);
        $taxonomy_fields->add_metaboxes_to_taxonomy();
        $taxonomy_fields->enable_featured_image();

        $fields_b = [
            [
                'id' => 'description' ,'type' => NULL,
                'validations' => [ 'required' => ['required' => true  , 'message' => 'Bucket Description field is required']],

            ]
        ];

        $taxonomy_fields_b1 = new Ajencypress_Taxonomy_Fields();
        $taxonomy_fields_b1->setTaxonomyName('bucket-1');
        $taxonomy_fields_b1->setMetaFieldConfig($fields_b);
        $taxonomy_fields_b1->add_metaboxes_to_taxonomy();

        $taxonomy_fields_b2 = new Ajencypress_Taxonomy_Fields();
        $taxonomy_fields_b2->setTaxonomyName('bucket-2');
        $taxonomy_fields_b2->setMetaFieldConfig($fields_b);
        $taxonomy_fields_b2->add_metaboxes_to_taxonomy();

        $taxonomy_fields_b3 = new Ajencypress_Taxonomy_Fields();
        $taxonomy_fields_b3->setTaxonomyName('bucket-3');
        $taxonomy_fields_b3->setMetaFieldConfig($fields_b);
        $taxonomy_fields_b3->add_metaboxes_to_taxonomy();


        //Add theme options for buckets
        if( is_admin() ) {

            include 'class-amfg-buckets-taxonomy-options.php';
            new AMFG_Buckets_Taxonomy_Options($this->plugin_name,$this->version);

        }

    }
}