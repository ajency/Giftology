<?php


class Ajencypress_Taxonomy_Metaboxes {

    private $taxonomy_name;

    /**
     * @param mixed $taxonomy_name
     */
    public function setTaxonomyName($taxonomy_name)
    {
        $this->taxonomy_name = $taxonomy_name;
    }

    function add_metaboxes_to_taxonomy() {

        add_action($this->taxonomy_name.'_edit_form_fields',array( $this , 'metaboxes_amc_edit_form_fields'));
        add_action($this->taxonomy_name.'_edit_form',array( $this ,  'metaboxes_amc_edit_form'));
        add_action($this->taxonomy_name.'_add_form_fields',array( $this , 'metaboxes_amc_edit_form_fields'));
        add_action($this->taxonomy_name.'_add_form',array( $this , 'metaboxes_amc_edit_form'));
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


    function metaboxes_amc_add_form_fields () {
        ?>
        <!--<tr class="form-field">
            <th valign="top" scope="row">
                <label for="term_meta[logo]"><?php /*_e('AMC Logo', ''); */?></label>
            </th>
            <td>
                <input type="file" id="term_meta[logo]" name="term_meta[logo]"/>
            </td>
        </tr>-->

        <div class="form-field term-amc-url-wrap">
            <label for="amc-url"><?php _e('AMC Url', ''); ?></label>
            <input name="term_meta[url]" id="term_meta[url]" type="text" value="" size="40">
            <p>The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
        </div>
        <?php
    }


    function metaboxes_amc_edit_form_fields () {
        $meta_value = get_term_meta( 8,'url',true);
        ?>
        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="term_meta[url]"><?php _e('AMC Url', ''); ?></label>
            </th>
            <td>
                <input type="text" id="term_meta[url]" name="term_meta[url]" value="<?php echo $meta_value; ?>"/>
            </td>
        </tr>

<!--        <div class="form-field term-amc-url-wrap">
            <label for="amc-url"><?php /*_e('AMC Url', ''); */?></label>
            <input name="term_meta[url]" id="term_meta[url]" type="text" value="" size="40">
            <p>The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
        </div>-->
        <?php
    }

    function metaboxes_save_custom_fields($term_id) {

        if ( isset( $_POST['term_meta'] ) ) {
            $t_id = $term_id;
            foreach ( $_POST['term_meta'] as $key => $value ){
                add_term_meta( $t_id, $key, $value );
            }
            //save the option array
        }
    }


}