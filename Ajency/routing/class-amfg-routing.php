<?php


class Ajency_MFG_Routing {

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
        add_action( 'user_register', array($this, 'send_email' ));
    }

    function my_plugin_parse_request($wp) {

        if($wp->query_vars['page'] == 'test-anom')
        {
            print "Any user Can See This Message";
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


            $email_to = 'antonio@ajency.in';
            $email_subject = "Welcome, Antonio";

            $headers[] = 'From: Me Myself <me@example.net>';

            if(wp_mail($email_to,$email_subject,$message, $headers)) {
                echo json_encode(array("result"=>"complete"));
            } else {
                echo json_encode(array("result" => "mail_error"));
                var_dump($GLOBALS['phpmailer']->ErrorInfo);
            }
        }
    }

    function my_plugin_query_vars($vars) {
        $vars[] = 'page';
        return $vars;
    }

    function send_email($user_id) {

       /* $user = get_userdata($user_id);
        $email_to = $user->user_email;
        $email_subject = "Welcome, $user->first_name";
        $message = 'Message';

        $headers[] = 'From: Me Myself <me@example.net>';

        if(wp_mail($email_to,$email_subject,$message, $headers)) {
            echo json_encode(array("result"=>"complete"));
        } else {
            echo json_encode(array("result" => "mail_error"));
            var_dump($GLOBALS['phpmailer']->ErrorInfo);
        }*/
    }
}