<?php

class AMFG_Funds_Posttype {


    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        add_action('init', array( $this , 'amfg_create_post_type'));
        add_theme_support( 'post-thumbnails', array('post', 'fund', 'page'));
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    function amfg_create_post_type() {
        $labels = array(
            'name'                => _x( 'Funds', 'Funds', $this->plugin_name ),
            'singular_name'       => _x( 'Fund', 'Fund', $this->plugin_name ),
            'menu_name'           => __( 'Funds', $this->plugin_name ),
            'parent_item_colon'   => __( 'Parent Fund', $this->plugin_name ),
            'all_items'           => __( 'All Funds', $this->plugin_name ),
            'view_item'           => __( 'View Fund', $this->plugin_name ),
            'add_new_item'        => __( 'Add New Fund', $this->plugin_name ),
            'add_new'             => __( 'Add New', $this->plugin_name ),
            'edit_item'           => __( 'Edit Fund', $this->plugin_name ),
            'update_item'         => __( 'Update Fund', $this->plugin_name ),
            'search_items'        => __( 'Search Fund', $this->plugin_name ),
            'not_found'           => __( 'Not Found', $this->plugin_name ),
            'not_found_in_trash'  => __( 'Not found in Trash', $this->plugin_name ),
        );

        $args = array (
            'label'               => __( 'Fund', $this->plugin_name ),
            'description'         => __( 'Funds', $this->plugin_name ),
            'labels'              => $labels,
            'supports'            => array( 'title',
                'editor',
                'excerpt',
                'thumbnail',
                'author',
                'revisions',
                'custom-fields', ),
            /*  'taxonomies'          => array( 'post_tag' ),*/
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-calendar-alt',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            /*            'rewrite' 			  => array('slug' => 'Funds'),*/
            'capability_type'     => 'post',
        );

        register_post_type( 'fund', $args );
    }


}