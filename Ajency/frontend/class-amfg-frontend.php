<?php
include 'shortcodes/gift-invites.php';
include 'shortcodes/login.php';

/*include 'modals/queued-gift-invites-modal.php';
include 'custom_pages/accept-invite-page.php';
include 'custom_pages/gift-page.php';*/

class Ajency_MFG_Frontend
{


    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->register_shortcodes();
        $this->register_custom_pages();
    }

    public function register_shortcodes()
    {
        $shortcodes = [
            'gift_invites',
            'login',
        ];

        foreach ($shortcodes as $shortcode) {
            add_shortcode($shortcode, $shortcode);
        }
    }


    public function register_custom_pages() {

        add_action('parse_request', array($this, 'my_plugin_parse_request'));
        add_filter('query_vars', array($this,  'my_plugin_query_vars'));

    }

    function my_plugin_parse_request($wp) {

        if($wp->query_vars['gifts'])
        {
            //Custom Page
            $gift_id = $wp->query_vars['gifts'];
            get_template_part( 'Ajency/frontend/custom_pages/gift', 'page' );
        }
        else if($wp->query_vars['gift-invites-step-0'])
        {
            echo '<form id="invite">
                            <div class="form-group email-address">
                                <label for="email" class="control-label">Enter the email addresses seperated by comma</label>
                                <p class="label-msg">You can invite any number of people</p>
                                <input name="email" class="form-control" id="email-tags" placeholder="Email address" required>
                            </div>
                            <div class="form-group email-msg">
                                <p class="label-msg">A message to the contributors</p>
                                <textarea class="form-control" placeholder="Message" name="message" id="message" rows="5" required>Hi! Its Sarvesh\'s anniversary, Lets give him a gift that\'ll be really helpful for him in the future!</textarea>
                            </div>
                    </form>';
        }
        else if($wp->query_vars['gift-invites-step-1'])
        {
            echo do_shortcode( '[gift_invites show_op_icon=1 template=2 gift_id='.$wp->query_vars['gift-invites-step-1'].' status=0]' );
        }
        else if($wp->query_vars['gift-invites-step-2'])
        {
            echo do_shortcode( '[gift_invites inv_group="'.$wp->query_vars['invite-group'].'" show_op_icon=1 template=2 gift_id='.$wp->query_vars['gift-invites-step-2'].' status=1]' );
        }
        else if($wp->query_vars['login'])
        {
            echo do_shortcode( '[login]' );
        }
        else if($wp->query_vars['accept-gift-invite']) //Step 3
        {
            //Page to accept invitaions and login
            get_template_part( 'Ajency/frontend/custom_pages/accept-invite', 'page' );
            /*            echo do_shortcode( '[gift_invites show_delete=1 template=2 gift_id="1" status="0"]' );*/
        }
    }

    function my_plugin_query_vars($vars) {
        $vars[] = 'gifts';
        $vars[] = 'gift-invites-step-0';
        $vars[] = 'gift-invites-step-1';
        $vars[] = 'gift-invites-step-2';
        $vars[] = 'accept-gift-invite';
        $vars[] = 'invite-group';
        $vars[] = 'modal';
        $vars[] = 'login';
        return $vars;
    }
}