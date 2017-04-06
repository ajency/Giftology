<?php
if( !defined( 'ABSPATH' ) ) exit;
?>
<?php
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-post-type.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-taxonomy.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-post-type-metaboxes.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-taxonomy-fields.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-field-markup.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-field-validation.php' );
include( get_template_directory() . '/Ajency/ajencyPress/class-ajencypress-admin-errors.php' );

class Ajency_MFG {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function load() {
        //Initialize the fund module
        include 'funds/class-amfg-funds.php';
        new Ajency_MFG_Funds($this->plugin_name,$this->version);

        include 'testing/class-amfg-testing.php';
        new Ajency_MFG_Testing($this->plugin_name,$this->version);

        include 'users/class-amfg-users.php';
        new Ajency_MFG_Users($this->plugin_name,$this->version);


        include 'frontend/class-amfg-frontend.php';
        new Ajency_MFG_Frontend($this->plugin_name,$this->version);

        include 'gift/class-amfg-gift.php';

        include 'email-templates-common/class-amfg-email-termplates.php';

        if(is_admin())
        {
            include 'gift/class-gifts-list.php';
            new List_Of_Gifts();
        }

        include 'kyc/class-amfg-kyc.php';
        new Ajency_MFG_Kyc($this->plugin_name,$this->version);

    }

}