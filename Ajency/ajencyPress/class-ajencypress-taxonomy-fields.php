<?php
if( !defined( 'ABSPATH' ) ) exit;

class Ajencypress_Taxonomy_Fields {

    private $taxonomy_name;

    private $metaFieldConfig;

    function prevent_add_term( $term, $taxonomy )
    {
        if($taxonomy == $this->taxonomy_name) {
            foreach ($this->metaFieldConfig as $field) {

                if($field['id'] == 'name') {
                    $field['id']  = 'tag-name'; //I know, horrible, absolutely horrible TODO
                }

                $errors[$field['id']] = Ajencypress_Field_Validation_New::meta_validations($field,$_POST[$field['id']]);
                if(is_array($errors[$field['id']])) {

                } else {
                    unset($errors[$field['id']]);
                }
            }
            if(!empty($errors)) {
                foreach ($errors as $key => $error) {
                    $final_errors[] = implode(" ,", $error);
                }
                $term = new WP_Error('invalid_term', __(implode(', ', $final_errors), 'textdomain'));
            }
        }
        return $term;
    }

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
        add_action( 'create_'.$this->taxonomy_name, array( $this , 'metaboxes_save_custom_fields_no_validation'), 10, 2 );
        add_filter( 'pre_insert_term', array($this, 'prevent_add_term'), 20, 2 );
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
            if($field['is_custom_field']) {
                $meta_value = get_term_meta( $tag->term_id,$field['id'],true);
                ?>

                <div class="form-field term-<?php echo $field['id'] ?>-wrap">
                    <label for="amc-url"><?php _e($field['title'], ''); ?></label>
                    <?php Ajencypress_Field_Markup::generate_meta_box_field_markup($field,$meta_value) ?>
                </div>
                <?php
            }
        }
    }


    function metaboxes_amc_edit_form_fields ($tag) {

        foreach ($this->metaFieldConfig as $field) {

            if($field['is_custom_field']) {
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

                <?php
            }

        }
    }

    function metaboxes_save_custom_fields_no_validation($term_id) {

        foreach ( $this->metaFieldConfig as $field ) {

            $key = $field['id'];
            $value = $_POST[$field['id']];
            if($field['is_custom_field']) {
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

    function metaboxes_save_custom_fields($term_id) {

        foreach ( $this->metaFieldConfig as $field ) {


            $key = $field['id'];
            $value = $_POST[$field['id']];

            $errors[$key] = Ajencypress_Field_Validation_New::meta_validations($field,$value);
            if(is_array($errors[$key])) {
                $value = false;
            } else {
                unset($errors[$key]);

            }

            if($field['is_custom_field']) {
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

        if(!empty($errors)) {

            foreach ($errors as $key => $error) {
                Ajencypress_Admin_Errors::add_validation_error_to_queue($key, implode(" ,",$error));
            }
            return;
        }
    }
}