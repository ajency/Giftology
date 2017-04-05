<?php
if( !defined( 'ABSPATH' ) ) exit;
?>
<?php

class Ajency_MFG_Email_Template
{
    public static function get_template($file)
    {return
        file_get_contents( get_template_directory() . '/Ajency/email-templates-common/header.html').
        file_get_contents( get_template_directory() . $file).
        file_get_contents( get_template_directory() . '/Ajency/email-templates-common/footer.html');
    }
}