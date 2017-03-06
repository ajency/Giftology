<?php


class Ajencypress_Taxonomy_Fields {

    private $taxonomy_name;

    private $metaFieldConfig;

    /**
     * @param mixed $metaFieldConfig
     */
    public function setMetaFieldConfig($metaFieldConfig)
    {
        $this->metaFieldConfig = $metaFieldConfig;
    }

    /**
     * @param mixed $taxonomy_name
     */
    public function setTaxonomyName($taxonomy_name)
    {
        $this->taxonomy_name = $taxonomy_name;
    }


    function _wp_term_images_init() {
        new WP_Term_Images( __FILE__ );
    }

    function enable_featured_image() {
        if((isset($_GET['taxonomy']) && $_GET['taxonomy'] == $this->taxonomy_name) ||
            isset($_POST['taxonomy']) && $_POST['taxonomy'] == $this->taxonomy_name
        ) {

            include( get_template_directory() . '/Ajency/ajencyPress/wp-term-images/includes/class-wp-term-meta-ui.php' );
            include( get_template_directory() . '/Ajency/ajencyPress/wp-term-images/includes/class-wp-term-images.php' );
            add_action( 'init',  array($this,'_wp_term_images_init'), 88 );
        }
    }

    function add_metaboxes_to_taxonomy() {

        add_action($this->taxonomy_name.'_edit_form_fields',array( $this , 'metaboxes_amc_edit_form_fields'), 10, 2 );
        add_action($this->taxonomy_name.'_edit_form',array( $this ,  'metaboxes_amc_edit_form'), 10, 2 );
        add_action($this->taxonomy_name.'_add_form_fields',array( $this , 'metaboxes_amc_edit_form_fields'), 10, 2 );
        add_action($this->taxonomy_name.'_add_form',array( $this , 'metaboxes_amc_edit_form'), 10, 2 );
        add_action( 'edited_'.$this->taxonomy_name, array( $this , 'metaboxes_save_custom_fields'), 10, 2 );
        add_action( 'create_'.$this->taxonomy_name, array( $this , 'metaboxes_save_custom_fields'), 10, 2 );
    }

    function metaboxes_amc_edit_form() {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('#edittag').attr( "enctype", "multipart/form-data" ).attr( "encoding", "multipart/form-data" );
            });
        </script>
        <?php
    }


    function metaboxes_amc_add_form_fields ($tag) {

        foreach ($this->metaFieldConfig as $field)
        {
            $meta_value = get_term_meta( $tag->term_id,$field['id'],true);
        ?>
        <!--<tr class="form-field">
            <th valign="top" scope="row">
                <label for="term_meta[logo]"><?php /*_e('AMC Logo', ''); */?></label>
            </th>
            <td>
                <input type="file" id="term_meta[logo]" name="term_meta[logo]"/>
            </td>
        </tr>-->

        <div class="form-field term-<?php echo $field['id'] ?>-wrap">
            <label for="amc-url"><?php _e($field['title'], ''); ?></label>
            <?php Ajencypress_Field_Markup::generate_meta_box_field_markup($field,$meta_value) ?>
        </div>
        <?php
        }
    }


    function metaboxes_amc_edit_form_fields ($tag) {

        foreach ($this->metaFieldConfig as $field) {
            $meta_value = get_term_meta( $tag->term_id,$field['id'],true);

            ?>
            <tr class="form-field">
                <th valign="top" scope="row">
                    <label for="term_meta[<?php _e($field['id'], ''); ?>]"><?php _e($field['title'], ''); ?></label>
                </th>
                <td>
                    <?php echo Ajencypress_Field_Markup::generate_meta_box_field_markup($field,$meta_value) ?>
                </td>
            </tr>

            <!--        <div class="form-field term-amc-url-wrap">
            <label for="amc-url"><?php /*_e('AMC Url', ''); */
            ?></label>
            <input name="term_meta[url]" id="term_meta[url]" type="text" value="" size="40">
            <p>The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
        </div>-->
            <?php
        }
    }

    function metaboxes_save_custom_fields($term_id) {

            foreach ( $this->metaFieldConfig as $field ){
                $key = $field['id'];
                $value = Ajencypress_Field_Validation::meta_validations($field,$_POST[$field['id']]);
                $existing_value = get_term_meta( $term_id, $key, true );

                if(empty($value) && $existing_value) {
                    delete_term_meta( $term_id, $key );
                } else if ($existing_value && !empty($value)) {
                    update_term_meta( $term_id, $key, $value );
                } else if(!empty($value)) {
                    add_term_meta( $term_id, $key, $value );
                }
            }
    }




}