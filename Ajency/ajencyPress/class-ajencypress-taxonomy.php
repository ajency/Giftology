<?php


class Ajencypress_Taxonomy {

    //Required Variables
    private $custom_taxonomy_name;
    private $attach_to_post_type;
    private $l10n_domain;

    private $slug;
    private $singular_label;
    private $plural_label;

    //Optional Variables which are initialized in contruct with default
    private $is_heirarchal;

    public function __construct()
    {
        $this->is_heirarchal = true;
    }

    function create_taxonomy(){
        add_action('init', array( $this , 'create_taxonomy_action'));
    }


    function create_taxonomy_action() {

        if(!isset($this->singular_label)) {

            $this->singular_label = ucfirst($this->custom_taxonomy_name);
        }

        if(!isset($this->plural_label)) {

            $this->plural_label = ucfirst($this->custom_taxonomy_name.'s');
        }

        $labels = array(
            'name'                       => _x( $this->plural_label, 'taxonomy general name', $this->l10n_domain ),
            'singular_name'              => _x( $this->singular_label, 'taxonomy singular name', $this->l10n_domain ),
            'search_items'               => __( 'Search '.$this->plural_label, $this->l10n_domain ),
            'popular_items'              => __( 'Popular '.$this->plural_label, $this->l10n_domain ),
            'all_items'                  => __( 'All '.$this->plural_label, $this->l10n_domain ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __( 'Edit '.$this->singular_label, $this->l10n_domain ),
            'update_item'                => __( 'Update '.$this->singular_label, $this->l10n_domain ),
            'add_new_item'               => __( 'Add New '.$this->singular_label, $this->l10n_domain ),
            'new_item_name'              => __( 'New '.$this->singular_label.' Name', $this->l10n_domain ),
            'separate_items_with_commas' => __( 'Separate '.$this->plural_label.' with commas', $this->l10n_domain ),
            'add_or_remove_items'        => __( 'Add or remove '.$this->plural_label, $this->l10n_domain ),
            'choose_from_most_used'      => __( 'Choose from the most used '.$this->plural_label, $this->l10n_domain ),
            'not_found'                  => __( 'No '.$this->plural_label.' found.', $this->l10n_domain ),
            'menu_name'                  => __( $this->plural_label, $this->l10n_domain ),
        );

        $args = array(
            'hierarchical'          => $this->is_heirarchal,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite' 			  => array('slug' => $this->slug),
        );


        register_taxonomy( $this->custom_taxonomy_name, $this->attach_to_post_type, $args );

    }

    /**
     * @param mixed $custom_taxonomy_name
     */
    public function setCustomTaxonomyName($custom_taxonomy_name)
    {
        $this->custom_taxonomy_name = $custom_taxonomy_name;
    }

    /**
     * @param mixed $attach_to_post_type
     */
    public function setAttachToPostType($attach_to_post_type)
    {
        $this->attach_to_post_type = $attach_to_post_type;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @param mixed $singular_label
     */
    public function setSingularLabel($singular_label)
    {
        $this->singular_label = $singular_label;
    }

    /**
     * @param mixed $plural_label
     */
    public function setPluralLabel($plural_label)
    {
        $this->plural_label = $plural_label;
    }

    /**
     * @param mixed $l10n_domain
     */
    public function setL10nDomain($l10n_domain)
    {
        $this->l10n_domain = $l10n_domain;
    }

    /**
     * @param bool $is_heirarchal
     */
    public function setIsHeirarchal($is_heirarchal)
    {
        $this->is_heirarchal = $is_heirarchal;
    }


}