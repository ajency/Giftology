<?php

class AMFG_AMCs_Taxonomy {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        add_action('init', array( $this , 'amfg_create_taxonomy'));
        add_action('amc_edit_form_fields',array( $this , 'amfg_amc_edit_form_fields'));
        add_action('amc_edit_form',array( $this ,  'amfg_amc_edit_form'));
        add_action('amc_add_form_fields',array( $this , 'amfg_amc_edit_form_fields'));
        add_action('amc_add_form',array( $this , 'amfg_amc_edit_form'));
        add_action( 'edited_amc', array( $this , 'amfg_save_custom_fields'), 10, 2 );
        add_action( 'create_amc', array( $this , 'amfg_save_custom_fields'), 10, 2 );

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }


    function amfg_create_taxonomy() {

        $amc_labels = array(
            'name'                       => _x( 'AMCs', 'taxonomy general name', $this->plugin_name ),
            'singular_name'              => _x( 'AMC', 'taxonomy singular name', $this->plugin_name ),
            'search_items'               => __( 'Search AMCs', $this->plugin_name ),
            'popular_items'              => __( 'Popular AMCs', $this->plugin_name ),
            'all_items'                  => __( 'All AMCs', $this->plugin_name ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __( 'Edit AMC', $this->plugin_name ),
            'update_item'                => __( 'Update AMC', $this->plugin_name ),
            'add_new_item'               => __( 'Add New AMC', $this->plugin_name ),
            'new_item_name'              => __( 'New AMC Name', $this->plugin_name ),
            'separate_items_with_commas' => __( 'Separate AMCs with commas', $this->plugin_name ),
            'add_or_remove_items'        => __( 'Add or remove AMCs', $this->plugin_name ),
            'choose_from_most_used'      => __( 'Choose from the most used AMCs', $this->plugin_name ),
            'not_found'                  => __( 'No AMCs found.', $this->plugin_name ),
            'menu_name'                  => __( 'AMCs', $this->plugin_name ),
        );

        $amc_args = array(
            'hierarchical'          => true,
            'labels'                => $amc_labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'event-types' ),
        );

        register_taxonomy( 'amc', 'fund', $amc_args );
    }

    function amfg_amc_edit_form() {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('#edittag').attr( "enctype", "multipart/form-data" ).attr( "encoding", "multipart/form-data" );
            });
        </script>
        <?php
    }

    function amfg_amc_edit_form_fields () {
        ?>
        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="term_meta[logo]"><?php _e('AMC Logo', ''); ?></label>
            </th>
            <td>
                <input type="file" id="term_meta[logo]" name="term_meta[logo]"/>
            </td>
        </tr>
        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="term_meta[url]"><?php _e('AMC Url', ''); ?></label>
            </th>
            <td>
                <input type="text" id="term_meta[url]" name="term_meta[url]"/>
            </td>
        </tr>
        <?php
    }

    function amfg_save_custom_fields($term_id) {
/*            print_r($_POST);
            die;*/

            if ( isset( $_POST['term_meta'] ) ) {
                $t_id = $term_id;
                $term_meta = get_option( "taxonomy_term_$t_id" );
                $cat_keys = array_keys( $_POST['term_meta'] );
                foreach ( $cat_keys as $key ){
                    if ( isset( $_POST['term_meta'][$key] ) ){
                        $term_meta[$key] = $_POST['term_meta'][$key];
                    }
                }
                //save the option array
                update_option( "taxonomy_term_$t_id", $term_meta );
            }
    }

}