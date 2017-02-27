<?php

class AMFG_Buckets_Taxonomy {
    
    private $plugin_name;
    
    private $version;
    
    public function __construct($plugin_name, $version)
    {
        add_action('init', array( $this , 'amfg_create_taxonomy'));
        
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }


    function amfg_create_taxonomy() {

        for($i = 1; $i <=3; $i++ ){

            $bucket_singular = get_option('_fund_bucket_'.$i.'_singular','Bucket '.$i.' Value');
            $bucket_plural = get_option('_fund_bucket_'.$i.'_plural','Bucket '.$i.' Values');

            $bucket_labels = array(
                'name'                       => _x( $bucket_plural, 'taxonomy general name', $this->plugin_name ),
                'singular_name'              => _x( $bucket_singular, 'taxonomy singular name', $this->plugin_name ),
                'search_items'               => __( 'Search '.$bucket_plural, $this->plugin_name ),
                'popular_items'              => __( 'Popular '.$bucket_plural, $this->plugin_name ),
                'all_items'                  => __( 'All '.$bucket_plural, $this->plugin_name ),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __( 'Edit '.$bucket_singular, $this->plugin_name ),
                'update_item'                => __( 'Update '.$bucket_singular, $this->plugin_name ),
                'add_new_item'               => __( 'Add New '.$bucket_singular, $this->plugin_name ),
                'new_item_name'              => __( 'New AMC Name', $this->plugin_name ),
                'separate_items_with_commas' => __( 'Separate AMCs with commas', $this->plugin_name ),
                'add_or_remove_items'        => __( 'Add or remove '.$bucket_plural, $this->plugin_name ),
                'choose_from_most_used'      => __( 'Choose from the most used '.$bucket_plural, $this->plugin_name ),
                'not_found'                  => __( 'No AMCs found.', $this->plugin_name ),
                'menu_name'                  => __( $bucket_plural, $this->plugin_name ),
            );

            $bucket_args = array(
                'hierarchical'          => true,
                'labels'                => $bucket_labels,
                'show_ui'               => true,
                'show_admin_column'     => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var'             => true,
                'rewrite'               => array( 'slug' => 'event-types' ),
            );


            register_taxonomy( 'bucket-'.$i, 'fund', $bucket_args );
            
        }
    }

}