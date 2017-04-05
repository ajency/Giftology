<?php
if( !defined( 'ABSPATH' ) ) exit;
?>
<?php
class Ajency_MFG_Kyc {

    private $plugin_name;
    private $version;

    const KYC_STATUS_REQUIRED = 0; //We detect using API KYC is not done
    const KYC_STATUS_DONE = 1; //We detect from API KYC is done
    const KYC_STATUS_PENDING = -1; //User Uploads docs and KYC is pending to be done

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->load();
    }

    public function load() {

        //For a user we mark them with a KYC status based on API
        //Attach docs to the user
        //On done make API call again
        //usermeta fields of name, age, email from db, additional emails, phone no, pancard

        //Is claim a table? - Yes
        //gift_id, who claimed, folio no, claim status = 0 , initiated, 1 = done, -1 refund

    }
}