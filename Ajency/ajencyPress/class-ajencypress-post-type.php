<?php


class Ajencypress_Post_Type {

    //Required Variables
    private $custom_post_type_name;
    private $l10n_domain;

    //Assumed variables
    private $slug;
    private $singular_label;
    private $plural_label;

    //Variables with defaults
    private $declared_in_theme;
    private $supports_tags;
    private $supports_categories;
    private $supports_editor;
    private $supports_excerpt;
    private $supports_custom_fields;
    private $supports_revisions;
    private $supports_author;
    private $supports_thumbnail;
    private $menu_icon;
    private $capability_type;
    private $is_hierarchical;
    private $is_public;
    private $is_show_ui;
    private $is_show_in_menu;
    private $is_show_in_nav_menus;
    private $is_show_in_admin_bar;
    private $menu_position;
    private $is_can_export;
    private $is_has_archive;
    private $is_exclude_from_search;
    private $is_publicly_queryable;

    function __construct()
    {
        $this->declared_in_theme = true;
        $this->supports_tags = false; //Be default we will not add tags
        $this->supports_categories = false; //Be default we will not add categories
        $this->supports_title = true;
        $this->supports_editor = true;
        $this->supports_excerpt = true;
        $this->supports_thumbnail = true;
        $this->supports_author = true;
        $this->supports_revisions = true;
        $this->supports_custom_fields = true;
        $this->menu_icon = 'dashicons-smiley';
        $this->capability_type = 'post';
        $this->is_hierarchical        = false;
        $this->is_public              = true;
        $this->is_show_ui             = true;
        $this->is_show_in_menu        = true;
        $this->is_show_in_nav_menus   = true;
        $this->is_show_in_admin_bar   = true;
        $this->menu_position       = 5;
        $this->is_can_export          = true;
        $this->is_has_archive         = true;
        $this->is_exclude_from_search = false;
        $this->is_publicly_queryable  = true;
    }


    function create_post_type() {

        if(!isset($this->custom_post_type_name)) {

            return "Please set Custom Post Type Name";
        }

        if(!isset($this->singular_label)) {

            $this->singular_label = ucfirst($this->custom_post_type_name);
        }

        if(!isset($this->plural_label)) {

            $this->plural_label = ucfirst($this->custom_post_type_name.'s');
        }

        if(!isset($this->slug)) {

            $this->slug = $this->custom_post_type_name.'s';
        }

        add_action('init', array( $this , '_create_post_type_action'));

    }

    function _create_post_type_action() {

        $labels = array(
            'name'                => _x( $this->plural_label, $this->plural_label, $this->l10n_domain ),
            'singular_name'       => _x( $this->singular_label, $this->singular_label, $this->l10n_domain ),
            'menu_name'           => __( $this->plural_label, $this->l10n_domain ),
            'parent_item_colon'   => __( 'Parent '.$this->singular_label, $this->l10n_domain ),
            'all_items'           => __( 'All '.$this->plural_label, $this->l10n_domain ),
            'view_item'           => __( 'View '.$this->singular_label, $this->l10n_domain ),
            'add_new_item'        => __( 'Add New '.$this->singular_label, $this->l10n_domain ),
            'add_new'             => __( 'Add New', $this->l10n_domain ),
            'edit_item'           => __( 'Edit '.$this->singular_label, $this->l10n_domain ),
            'update_item'         => __( 'Update '.$this->singular_label, $this->l10n_domain ),
            'search_items'        => __( 'Search '.$this->singular_label, $this->l10n_domain ),
            'not_found'           => __( 'Not Found', $this->l10n_domain ),
            'not_found_in_trash'  => __( 'Not found in Trash', $this->l10n_domain ),
        );

        $supports = [];
        $taxonomies = [];

        if($this->supports_title) {

            $supports[] = 'title';
        }

        if($this->supports_editor) {

            $supports[] = 'editor';
        }

        if($this->supports_excerpt) {

            $supports[] = 'excerpt';
        }


        if($this->supports_thumbnail) {

            $supports[] = 'thumbnail';
            if($this->declared_in_theme){
                add_theme_support( 'post-thumbnails', array($this->custom_post_type_name));
            }
        }

        if($this->supports_author) {

            $supports[] = 'author';
        }

        if($this->supports_revisions) {

            $supports[] = 'revisions';
        }

        if($this->supports_custom_fields) {

            $supports[] = 'custom-fields';
        }

        if($this->supports_tags) {

            $taxonomies[] = 'post_tag';
        }

        if($this->supports_categories) {
            $taxonomies[] = 'category';
        }


        $args = array (
            'label'               => __( $this->singular_label, $this->l10n_domain ),
            'description'         => __( $this->plural_label, $this->l10n_domain ),
            'labels'              => $labels,
            'supports'            => $supports,
            'taxonomies'          => $taxonomies,
            'menu_icon'           => $this->menu_icon,
            'hierarchical'        => $this->is_hierarchical,
            'public'              => $this->is_public,
            'show_ui'             => $this->is_show_ui,
            'show_in_menu'        => $this->is_show_in_menu,
            'show_in_nav_menus'   => $this->is_show_in_nav_menus,
            'show_in_admin_bar'   => $this->is_show_in_admin_bar,
            'menu_position'       => $this->menu_position,
            'can_export'          => $this->is_can_export,
            'has_archive'         => $this->is_has_archive,
            'exclude_from_search' => $this->is_exclude_from_search,
            'publicly_queryable'  => $this->is_publicly_queryable,
            'rewrite' 			  => array('slug' => $this->slug),
            'capability_type'     => $this->capability_type,
        );

        register_post_type( $this->custom_post_type_name, $args );
    }

    /**
     * @param bool $supports_title
     */
    public function setSupportsTitle($supports_title)
    {
        $this->supports_title = $supports_title;
    }

    /**
     * @param mixed $custom_post_type_name
     */
    public function setCustomPostTypeName($custom_post_type_name)
    {
        $this->custom_post_type_name = $custom_post_type_name;
    }

    /**
     * @param mixed $l10n_domain
     */
    public function setL10nDomain($l10n_domain)
    {
        $this->l10n_domain = $l10n_domain;
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
     * @param bool $declared_in_theme
     */
    public function setDeclaredInTheme($declared_in_theme)
    {
        $this->declared_in_theme = $declared_in_theme;
    }

    /**
     * @param bool $supports_tags
     */
    public function setSupportsTags($supports_tags)
    {
        $this->supports_tags = $supports_tags;
    }

    /**
     * @param bool $supports_categories
     */
    public function setSupportsCategories($supports_categories)
    {
        $this->supports_categories = $supports_categories;
    }

    /**
     * @param bool $supports_editor
     */
    public function setSupportsEditor($supports_editor)
    {
        $this->supports_editor = $supports_editor;
    }

    /**
     * @param bool $supports_excerpt
     */
    public function setSupportsExcerpt($supports_excerpt)
    {
        $this->supports_excerpt = $supports_excerpt;
    }

    /**
     * @param bool $supports_custom_fields
     */
    public function setSupportsCustomFields($supports_custom_fields)
    {
        $this->supports_custom_fields = $supports_custom_fields;
    }

    /**
     * @param bool $supports_revisions
     */
    public function setSupportsRevisions($supports_revisions)
    {
        $this->supports_revisions = $supports_revisions;
    }

    /**
     * @param bool $supports_author
     */
    public function setSupportsAuthor($supports_author)
    {
        $this->supports_author = $supports_author;
    }

    /**
     * @param bool $supports_thumbnail
     */
    public function setSupportsThumbnail($supports_thumbnail)
    {
        $this->supports_thumbnail = $supports_thumbnail;
    }

    /**
     * @param string $menu_icon
     */
    public function setMenuIcon($menu_icon)
    {
        $this->menu_icon = $menu_icon;
    }

    /**
     * @param string $capability_type
     */
    public function setCapabilityType($capability_type)
    {
        $this->capability_type = $capability_type;
    }

    /**
     * @param bool $is_hierarchical
     */
    public function setIsHierarchical($is_hierarchical)
    {
        $this->is_hierarchical = $is_hierarchical;
    }

    /**
     * @param bool $is_public
     */
    public function setIsPublic($is_public)
    {
        $this->is_public = $is_public;
    }

    /**
     * @param bool $is_show_ui
     */
    public function setIsShowUi($is_show_ui)
    {
        $this->is_show_ui = $is_show_ui;
    }

    /**
     * @param bool $is_show_in_menu
     */
    public function setIsShowInMenu($is_show_in_menu)
    {
        $this->is_show_in_menu = $is_show_in_menu;
    }

    /**
     * @param bool $is_show_in_nav_menus
     */
    public function setIsShowInNavMenus($is_show_in_nav_menus)
    {
        $this->is_show_in_nav_menus = $is_show_in_nav_menus;
    }

    /**
     * @param bool $is_show_in_admin_bar
     */
    public function setIsShowInAdminBar($is_show_in_admin_bar)
    {
        $this->is_show_in_admin_bar = $is_show_in_admin_bar;
    }

    /**
     * @param int $menu_position
     */
    public function setMenuPosition($menu_position)
    {
        $this->menu_position = $menu_position;
    }

    /**
     * @param bool $is_can_export
     */
    public function setIsCanExport($is_can_export)
    {
        $this->is_can_export = $is_can_export;
    }

    /**
     * @param bool $is_has_archive
     */
    public function setIsHasArchive($is_has_archive)
    {
        $this->is_has_archive = $is_has_archive;
    }

    /**
     * @param bool $is_exclude_from_search
     */
    public function setIsExcludeFromSearch($is_exclude_from_search)
    {
        $this->is_exclude_from_search = $is_exclude_from_search;
    }

    /**
     * @param bool $is_publicly_queryable
     */
    public function setIsPubliclyQueryable($is_publicly_queryable)
    {
        $this->is_publicly_queryable = $is_publicly_queryable;
    }



}