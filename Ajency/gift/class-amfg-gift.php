<?php

class Ajency_MFG_Gift {


    const STATUS_INVITE_QUEUED = 0; //For new people
    const STATUS_INVITE_SENT = 1; //For new people
    const STATUS_INVITE_USED = 2; //For new people who register
    const STATUS_INVITE_SENT_USED = 3; //For people already on site
    const STATUS_INVITE_INVALID = -1; //For invites that become in valid in time or by event or action

    const STATUS_GIFT_DRAFT = 0;
    const STATUS_GIFT_OPEN = 1;
    const STATUS_GIFT_SENT = 2;
    const STATUS_GIFT_CLAIM = 3;
    const STATUS_GIFT_CLAIMED = 4;
    const STATUS_GIFT_REFUND = -1;

    const SETTING_CONTRIB_ONLY_ME = 1;
    const SETTING_CONTRIB_SPECIFIC = 2;
    const SETTING_CONTRIB_EVERYONE = 3;

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public static function add_acl_rule($entity, $entity_id, $user_id, $action, $is_allowed) {

        global $wpdb; //removed $name and $description there is no need to assign them to a global variable
        $table_name = $wpdb->prefix . "giftology_acl"; //try not using Uppercase letters or blank spaces when naming db tables
        $wpdb->insert($table_name, array(
            'entity' => $entity, //replaced non-existing variables $lq_name, and $lq_descrip, with the ones we set to collect the data - $name and $description
            'entity_id' => $entity_id,
            'user_id' => $user_id,
            'action' => $action,
            'is_allowed' => $is_allowed,
            'created' => 'NOW()',
            'updated' => 'NOW()',
        ),array(
            '%s',
            '%d',
            '%d',
            '%s',
            '%d',
            '%s',
            '%s',
        ) //replaced %d with %s - I guess that your description field will hold strings not decimals
        );
    }

/*    public static function change_acl_rule($entity, $entity_id, $user_id, $action, $is_allowed) {

    }*/


    public static function get_invite_by_code($code, $status = Ajency_MFG_Gift::STATUS_INVITE_SENT) {
        global $wpdb;
        $query = "SELECT * from wp_giftology_invites where invite_code = '".$code."' and status = '".$status."'";
        $result =  $wpdb->get_results($query)[0];
        return $result;
    }


    public static function get_acl_access_rule($entity, $entity_id, $user_id, $action) {
        global $wpdb;
        $query = "SELECT is_allowed from wp_giftology_acl where entity = '".$entity."' and entity_id = $entity_id and (user_id = $user_id || user_id IS NULL) and action = '".$action."' and is_allowed = 1";
        $results =  $wpdb->get_results($query)[0];
        print_r($results);
        return $results->is_allowed;
    }

    public static function remove_acls_for_entity($entity, $entity_id, $action) {

        //TODO make action optional, can be dangerous though
        global $wpdb;
        $wpdb->query(
            'DELETE  FROM '.$wpdb->prefix.'giftology_acl
               WHERE entity_id = "'.$entity_id.'" AND entity = "' . $entity . '" AND action = "' . $action . '"'
        );
    }

    public static function get_invitations($gift_id, $status = [Ajency_MFG_Gift::STATUS_INVITE_QUEUED], $limit = false, $inv_group = false) {

        //TODO make action optional, can be dangerous though
        global $wpdb;
        $query = "select inv.status as inv_status, u.id, inv.invite_code, meta.meta_value as pic,u.display_name,inv.email,u.user_email from wp_giftology_invites inv left join wp_users u on inv.email = u.user_email left join wp_usermeta meta on u.id = meta.user_id and meta.meta_key = 'wsl_current_user_image' where inv.gift_id = '".$gift_id."'";
        $query .= " and (";
        $last = count($status) - 1;
        for ($i = 0 ; $i < $last; $i++) {
            $query .= "inv.status = '".$status[$i]."' OR ";
        }
        $query .= "inv.status = '".$status[$last]."')";

        if($inv_group) {
            $query = " AND inv.invite_group = ".$inv_group;
        }


        if($limit) {
            $query .=  " LIMIT 0,".$limit;
        }
        return  $wpdb->get_results($query);
    }


    public static function check_if_invites_already_queued($gift_id, $emails) {

        //TODO make action optional, can be dangerous though
        global $wpdb;
        $results = [];
        $query = "select email from wp_giftology_invites where status = 0 and gift_id = '".$gift_id."'";
        $query .= " and (";
        $last = count($emails) - 1;
        for ($i = 0 ; $i < $last; $i++) {
            $query .= "email = '".$emails[$i]."' OR ";
        }
        $query .= "email = '".$emails[$last]."')";
        foreach($wpdb->get_results($query,ARRAY_A) as $email){
            $results[] = $email['email'];
        }
        return $results;
    }


    public static function add_invitation_message($message) {

        global $wpdb;
        $table_name = $wpdb->prefix . "giftology_invites_message";
        $wpdb->insert($table_name, array(
            'message' => $message
        ),array(
            '%s',
        ) //replaced %d with %s - I guess that your description field will hold strings not decimals
        );

        return $wpdb->insert_id; //TODO return an id
    }


    public static function add_invitation($email, $gift_id, $status, $message_id) {

        global $wpdb;
        $table_name = $wpdb->prefix . "giftology_invites";
        $wpdb->insert($table_name, array(
            'email' => $email,
            'gift_id' => $gift_id,
            'invite_code' => uniqid(),
            'message_id' => $message_id,
            'status' => $status,
        ),array(
            '%s',
            '%d',
            '%s',
            '%d',
            '%d',
        ) //replaced %d with %s - I guess that your description field will hold strings not decimals
        );

        return $wpdb->print_error();
    }

    public static function invalidate_invite_code($gift_id) {

        global $wpdb;
        $status = self::STATUS_INVITE_INVALID;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_invites SET status='$status' WHERE gift_id=$gift_id"));
    }

    public static function update_gift_contrib_settings($gift_id, $contrib_settings) {
        global $wpdb;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_gifts SET contrib_setting_id='%d' WHERE id='%d'", $contrib_settings, $gift_id));
    }

    public static function update_gift_status($gift_id, $status) {
        global $wpdb;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_gifts SET status='%d' WHERE id='%d'", $status, $gift_id));
    }

    public static function mark_gift_code_as_used($code, $user_id) {
        $status = self::STATUS_INVITE_USED;
        global $wpdb;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_invites SET accepted_on = '%d', status='%d',user_id='%d' WHERE invite_code='%s'", time(), $status, $user_id, $code));
    }


    public static function mark_gift_code_as_sent($code, $invite_group) {
        global $wpdb;
        $status = self::STATUS_INVITE_SENT;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_invites SET sent_on='%d', invite_group='%s',status ='%d' WHERE invite_code='%s' and status = 0", time(), $invite_group, $status, $code));
    }

    public static function mark_gift_code_as_sent_used($code, $invite_group, $user_id) {
        global $wpdb;
        $status = self::STATUS_INVITE_SENT_USED;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_invites SET sent_on='%d', invite_group='%s',status='%d',user_id='%d' WHERE invite_code='%s' and status = 0", time(), $invite_group, $status, $user_id, $code));
    }


    public static function get_gift_details($gift_id, $include_fund = false) {
        global $wpdb;
        $gift_query = "SELECT * from wp_giftology_gifts where id = $gift_id";

        $gift = $wpdb->get_results($gift_query)[0];

        if(!$gift) {
            return false;
        }

        if($include_fund) {
/*            $args = array('p' => $gift->fund_id, 'post_type' => 'fund', 'nopaging' => true);
            $fund_query = 'select * ';
            $fund = new WP_Query($args);*/
            $gift->fund = self::get_gift_fund($gift->fund_id);
        }
        return $gift;
    }


    public function get_gift_fund($gift_id) {

        global $wpdb;
        $pt = 'fund';

        $meta_keys = [
            '_fund_url',
            '_fund_bse_id',
            '_fund_min_investment'
        ];
        $ord = 'p.post_name ASC';

        $sql = "SELECT p.*";

        for ($i = 0; $i < count($meta_keys); $i++) {
            $sql .= ', pm'.$i.'.meta_value as '.$meta_keys[$i];
        }

        $sql .= " FROM {$wpdb->posts} p";

        for ($i = 0; $i < count($meta_keys); $i++) {
            $mk = $meta_keys[$i];
            $sql .= " LEFT JOIN {$wpdb->postmeta} pm".$i." ON pm".$i.".post_id = p.ID AND pm".$i.".meta_key = '{$mk}'";
        }

        $sql .= "WHERE p.post_type = '{$pt}'
            AND p.ID = '{$gift_id}'
            AND p.post_status NOT IN ('draft','auto-draft')
            ORDER BY {$ord}
        ";

        $fund = $wpdb->get_results( $wpdb->prepare( $sql , []), OBJECT );
        return $fund[0];

    }
}

#Close current modal open new
#http://codepen.io/elmahdim/details/azVNbN/