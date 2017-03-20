<?php


class Ajency_MFG_Testing {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->load();
    }

    public function load() {

        add_action('parse_request', array($this, 'my_plugin_parse_request'));
        add_filter('query_vars', array($this,  'my_plugin_query_vars'));

    }

    function my_plugin_parse_request($wp) {

        if($wp->query_vars['page'] == 'test-anom')
        {
            print "Any user Can See This Message";
            do_action( 'wordpress_social_login' );

        } else if ($wp->query_vars['page'] == 'login-via-auth') {
            do_action( 'wordpress_social_login' );

        } else if ($wp->query_vars['page'] == 'test-auth') {

            if(is_user_logged_in()) {
                print "Logged in user Can See This Message";
            } else {
                print "Logged out user Can See This Message";
                do_action( 'wordpress_social_login' );
            }
        } else if($wp->query_vars['page'] == 'test-email') {

            $message = '<div id=":ip" class="a3s aXjCH m15aad5625759aea3"><div dir="ltr"><span id="m_1253407356548364078gmail-docs-internal-guid-47132279-ad55-3f75-1a17-e003a5f242cd"><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Subject: Welcome to MFgiftology!</span></p><br><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Body:</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">*Logo*</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Hi *Name*,</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Welcome to MFgiftology! You have just taken the first step towards becoming an integral part of our gifting community. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap"><br></span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Get Started</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Browse Funds &nbsp;&nbsp;</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Browse through and select a fund to be gifted.</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Create a Gift</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Create a gift by adding the gift details and invite people to contribute.</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Send a Gift</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Contribute and send the gift to the recipient.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap"><br></span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Cheers,</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">The MFgiftology team</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Footer:</span><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap"><br class="m_1253407356548364078gmail-kix-line-break"><br class="m_1253407356548364078gmail-kix-line-break"></span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Connect </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Facebook &nbsp;Twitter &nbsp;YouTube Instagram &nbsp;</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">FAQ &nbsp;&nbsp;&nbsp;BLOG &nbsp;&nbsp;&nbsp;CONTACT US &nbsp;&nbsp;&nbsp;ABOUT US &nbsp;&nbsp;&nbsp;PRIVACY POLICY</span></p><div><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap"><br></span></div><div><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap"><br></span></div></span><div><div class="m_1253407356548364078gmail_signature"><div dir="ltr"><div><div dir="ltr">------------------------------<wbr>---</div><div dir="ltr">Regards,<div>Valenie Lourenco</div></div></div></div></div></div><div class="yj6qo"></div><div class="adL">
        </div></div><div class="adL">
    </div></div>';


            if (function_exists('wp_mail')) {
                $email_to = 'antonio@ajency.in';
                $email_subject = "Welcome to Giftology!";

                $headers[] = 'From: Giftology <info@giftology.dev>';

                add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
                if(wp_mail($email_to,$email_subject,$message, $headers)) {

                    echo json_encode(array("result"=>"complete"));

                } else {
                    echo json_encode(array("result" => "mail_error"));
                    var_dump($GLOBALS['phpmailer']->ErrorInfo);
                }
            } else {
                print "Invalid";
            }

        } else if($wp->query_vars['page'] == 'test-send-grid'){

            $url = 'https://api.sendgrid.com/';
            $user = 'antonio_ajency';
            $pass = 'Anuj123$';


            $message = '<div id=":ip" class="a3s aXjCH m15aad5625759aea3"><div dir="ltr"><span id="m_1253407356548364078gmail-docs-internal-guid-47132279-ad55-3f75-1a17-e003a5f242cd"><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Subject: Welcome to MFgiftology!</span></p><br><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Body:</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">*Logo*</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Hi *Name*,</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Welcome to MFgiftology! You have just taken the first step towards becoming an integral part of our gifting community. </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap"><br></span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Get Started</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Browse Funds &nbsp;&nbsp;</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Browse through and select a fund to be gifted.</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Create a Gift</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Create a gift by adding the gift details and invite people to contribute.</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Send a Gift</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Contribute and send the gift to the recipient.</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap"><br></span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">Cheers,</span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">The MFgiftology team</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Footer:</span><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap"><br class="m_1253407356548364078gmail-kix-line-break"><br class="m_1253407356548364078gmail-kix-line-break"></span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Connect </span></p><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;font-weight:700;vertical-align:baseline;white-space:pre-wrap">Facebook &nbsp;Twitter &nbsp;YouTube Instagram &nbsp;</span></p><br><p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align:center"><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap">FAQ &nbsp;&nbsp;&nbsp;BLOG &nbsp;&nbsp;&nbsp;CONTACT US &nbsp;&nbsp;&nbsp;ABOUT US &nbsp;&nbsp;&nbsp;PRIVACY POLICY</span></p><div><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap"><br></span></div><div><span style="font-size:11pt;font-family:arial;color:rgb(0,0,0);background-color:transparent;vertical-align:baseline;white-space:pre-wrap"><br></span></div></span><div><div class="m_1253407356548364078gmail_signature"><div dir="ltr"><div><div dir="ltr">------------------------------<wbr>---</div><div dir="ltr">Regards,<div>Valenie Lourenco</div></div></div></div></div></div><div class="yj6qo"></div><div class="adL">
        </div></div><div class="adL">
    </div></div>';

            $text = 'asdfasdasd';

            $email_subject = "Welcome to Giftology!";


            $json_string = array(

                'to' => array(
                    'antonio@ajency.in',
                ),
                'category' => 'welcome_email'
            );


            $params = array(
                'api_user'  => $user,
                'api_key'   => $pass,
                'x-smtpapi' => json_encode($json_string),
                'to'        => 'antonio@ajency.in',
                'subject'   => $email_subject,
                'html'      => $message,
                'text'      => $text,
                'from'      => 'info@giftology.dev',
            );


            $request =  $url.'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell curl to use HTTP POST
            curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
            curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
            $response = curl_exec($session);
            curl_close($session);

// print everything out
            print_r($response);


        } else if($wp->query_vars['db'] == 'db') {
/*
            global $wpdb;
             $table_name = $wpdb->prefix . "giftology_gifts";
             $charset_collate = $wpdb->get_charset_collate();
             $sql = "CREATE TABLE $table_name (
   id int(10) NOT NULL AUTO_INCREMENT,
   title varchar(55) NOT NULL,
   contributors_note text DEFAULT '' NOT NULL,
   receiver_id int(10) DEFAULT NULL,
   receiver_name varchar(255) NOT NULL,
   receiver_email varchar(55) NOT NULL,
   receiver_mobile varchar(55) DEFAULT '' NOT NULL,
   receiver_message text NOT NULL,
   created_by int(10) DEFAULT NULL,
   img varchar(55) DEFAULT NULL,
   contrib_setting_id tinyint DEFAULT 1 NOT NULL,
   template_id tinyint DEFAULT 1 NOT NULL,
   fund_id int(10) NOT NULL,
   claim_id int(10) DEFAULT NULL,
   send_type tinyint DEFAULT 1 NOT NULL,
   send_on datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   email_sent_on datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   status tinyint  DEFAULT 1 NOT NULL,
   created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   updated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   PRIMARY KEY  (id)
 ) $charset_collate;";
             require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
             dbDelta( $sql );



            global $wpdb;
            $table_name = $wpdb->prefix . "giftology_acl";
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name (
  id int(10) NOT NULL AUTO_INCREMENT,
  entity varchar(55) NOT NULL,
  entity_id int(10) NOT NULL,
  action varchar(55) NOT NULL,
  user_id int(10) DEFAULT NULL,
  is_allowed tinyint NOT NULL,
  created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  updated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY pkey (entity,entity_id,action,user_id)
) $charset_collate;";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );*/


            global $wpdb;
            $table_name = $wpdb->prefix . "giftology_invites";
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name (
  id int(10) NOT NULL AUTO_INCREMENT,
  email varchar(55) NOT NULL,
  gift_id int(10) NOT NULL,
  invited_by int(10) DEFAULT NULL,
  message_id int(10) NOT NULL,
  invite_code varchar(100) NOT NULL,
  invite_group varchar(100) DEFAULT '' NOT NULL,
  status tinyint NOT NULL,
  sent_on datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  updated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );


            global $wpdb;
            $table_name = $wpdb->prefix . "giftology_invites_usage";
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name (
  id int(10) NOT NULL AUTO_INCREMENT,
  used_by int(10) NOT NULL,
  invite_id int(10) NOT NULL,
  invite_code varchar(100)  NOT NULL,
  used_on datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  type tinyint NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );



            /*
                        global $wpdb;
                        $table_name = $wpdb->prefix . "giftology_invites_message";
                        $charset_collate = $wpdb->get_charset_collate();
                        $sql = "CREATE TABLE $table_name (
              id int(10) NOT NULL AUTO_INCREMENT,
              message text NOT NULL,
              PRIMARY KEY  (id)
            ) $charset_collate;";
                        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                        dbDelta( $sql );
            */

        }
    }

    function my_plugin_query_vars($vars) {
        $vars[] = 'page';
        $vars[] = 'invite';
        $vars[] = 'db';
        return $vars;
    }
}