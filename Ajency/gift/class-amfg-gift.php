<?php
if( !defined( 'ABSPATH' ) ) exit;

class Ajency_MFG_Gift {


    const STATUS_INVITE_QUEUED = 0; //For new people
    const STATUS_INVITE_SENT = 1; //For new people
#    const STATUS_INVITE_USED = 2; //For new people who register
#    const STATUS_INVITE_SENT_USED = 3; //For people already on site
    const STATUS_INVITE_INVALID = -1; //For invites that become in valid in time or by event or action

    const STATUS_INVITE_TYPE_AUTO = 2; //For invites that become in valid in time or by event or action
    const STATUS_INVITE_TYPE_MANUAL = 1; //For invites that become in valid in time or by event or action

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

    public static function check_acl_rule($entity, $entity_id, $user_id, $action) {
        global $wpdb;
        $query = "SELECT id from wp_giftology_acl where entity = '".$entity."' and entity_id = $entity_id and user_id = '".$user_id."' and action = '".$action."'";
        $result =  $wpdb->get_results($query)[0];
        return $result;
    }

    public static function add_acl_rule($entity, $entity_id, $user_id, $action, $is_allowed) {

        global $wpdb; //removed $name and $description there is no need to assign them to a global variable
        $table_name = $wpdb->prefix . "giftology_acl"; //try not using Uppercase letters or blank spaces when naming db tables

        if(empty(self::check_acl_rule($entity, $entity_id, $user_id, $action))) {

            $wpdb->insert($table_name, array(
                'entity' => $entity, //replaced non-existing variables $lq_name, and $lq_descrip, with the ones we set to collect the data - $name and $description
                'entity_id' => $entity_id,
                'user_id' => $user_id,
                'action' => $action,
                'is_allowed' => $is_allowed,
                'created' => current_time( 'mysql' ),
                'updated' => current_time( 'mysql' ),
            ));

        }
    }

    /*    public static function change_acl_rule($entity, $entity_id, $user_id, $action, $is_allowed) {

        }*/


    public static function get_invite_by_id($gift_id,$invite_id) {
        global $wpdb;
        $query = "SELECT inv.*,g.* from wp_giftology_invites inv INNER JOIN wp_giftology_gifts g on inv.gift_id = g.id  where inv.status = 1 and inv.id = '".$invite_id."' and g.id = '".$gift_id."'";
        $result =  $wpdb->get_results($query)[0];
        return $result;
    }

    public static function get_invite_by_code($code,$status = [Ajency_MFG_Gift::STATUS_INVITE_SENT]) {
        global $wpdb;
        $query = "SELECT inv.*,g.slug from wp_giftology_invites inv INNER JOIN wp_giftology_gifts g on inv.gift_id = g.id  where inv.invite_code = '".$code."'";
        $query .= " and (";
        $last = count($status) - 1;
        for ($i = 0 ; $i < $last; $i++) {
            $query .= "inv.status = '".$status[$i]."' OR ";
        }
        $query .= "inv.status = '".$status[$last]."')";
        $result =  $wpdb->get_results($query)[0];
        return $result;
    }


    public static function get_acl_access_rule($entity, $entity_id, $user_id, $action, $check_if_logged_in = true) {

        if($check_if_logged_in && !is_user_logged_in()) {
            return false;
        }

        global $wpdb;
        $query = "SELECT is_allowed from wp_giftology_acl where entity = '".$entity."' and entity_id = $entity_id and (user_id = $user_id || user_id IS NULL) and action = '".$action."' and is_allowed = 1";
        $results =  $wpdb->get_results($query)[0];
        return $results->is_allowed;

    }

    public static function update_global_acls_for_entity($entity, $entity_id, $action, $is_allowed) {

        //TODO make action optional, can be dangerous though
        global $wpdb;
        $query = 'Update '.$wpdb->prefix.'giftology_acl set is_allowed = "'.$is_allowed.'" where entity_id = "' . $entity_id . '" AND entity = "' . $entity . '" AND action = "' . $action . '" AND user_id IS NULL';
        $wpdb->query($query);
    }

    public static function remove_acls_for_entity($entity, $entity_id, $action) {

        //TODO make action optional, can be dangerous though
        global $wpdb;
        $wpdb->query(
            'DELETE  FROM '.$wpdb->prefix.'giftology_acl
               WHERE entity_id = "'.$entity_id.'" AND entity = "' . $entity . '" AND action = "' . $action . '"'
        );
    }

    public static function delete_queued_invite_by_email($gift_id,$email,$user_id) {
        global $wpdb;
        $wpdb->query(
            'DELETE  FROM '.$wpdb->prefix.'giftology_invites WHERE gift_id = "'.$gift_id.'" AND email = "' . $email . '" AND invited_by = "' . $user_id . '"'
        );
    }

    public static function delete_queued_invite($gift_id,$invite_id,$user_id) {
        global $wpdb;
        $wpdb->query(
            'DELETE  FROM '.$wpdb->prefix.'giftology_invites WHERE gift_id = "'.$gift_id.'" AND id = "' . $invite_id . '" AND invited_by = "' . $user_id . '"'
        );

    }

    public static function get_invitations($gift_id, $status = Ajency_MFG_Gift::STATUS_INVITE_QUEUED, $limit = false, $inv_group = false, $user_id = false) {

/*        if($user_id == false) {
            $user_id = get_current_user_id();
        }*/
        //TODO make action optional, can be dangerous though
        global $wpdb;
        $query = "select inv.id as inv_id, inv.email,inv.status as inv_status, u.id, inv.invite_code, meta.meta_value as pic,u.display_name,u.user_email from wp_giftology_invites inv left join wp_users u on inv.email = u.user_email left join wp_usermeta meta on u.id = meta.user_id and meta.meta_key = 'wsl_current_user_image' where inv.gift_id = '".$gift_id."'";

        if($user_id){
            $query .= " and inv.invited_by = '".$user_id."'";
        }
        if(is_array($status)) {
            $query .= " and (";
            $last = count($status) - 1;
            for ($i = 0 ; $i < $last; $i++) {
                $query .= "inv.status = '".$status[$i]."' OR ";
            }
            $query .= "inv.status = '".$status[$last]."')";
        } else {
            $query .= " and inv.status = '".$status."'";
        }
        if($inv_group) {
            $query .= " AND inv.invite_group = '".$inv_group."'";
        }

        $query .= " GROUP BY inv.email";

        if($limit) {
            $query .=  " LIMIT 0,".$limit;
        }
        return  $wpdb->get_results($query);
    }


    public static function check_if_invites_already_queued($gift_id, $emails, $invited_by) {

        //TODO make action optional, can be dangerous though
        global $wpdb;
        $results = [];
        $query = "select email from wp_giftology_invites where status = 0 and invited_by = '".$invited_by."' and gift_id = '".$gift_id."'";
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
        ));

        return $wpdb->insert_id; //TODO return an id
    }


    public static function add_invitation_usage($used_by,$invite_code_used) {

        global $wpdb;
        $table_name = $wpdb->prefix . "giftology_invites_usage";
        $wpdb->insert($table_name, array(
            'invite_code_used' => $invite_code_used,
            'used_by' => $used_by,
            'created' => current_time( 'mysql' ),
            'updated' => current_time( 'mysql' ),
        ));

        return $wpdb->print_error();
    }


    public static function add_invitation($email, $gift_id, $invited_by, $status, $message_id) {

        global $wpdb;
        $table_name = $wpdb->prefix . "giftology_invites";
        $wpdb->insert($table_name, array(
                'email' => $email,
                'gift_id' => $gift_id,
                'invite_code' => uniqid(),
                'message_id' => $message_id,
                'invited_by' => $invited_by,
                'status' => $status,
                'created' => current_time( 'mysql' ),
                'updated' => current_time( 'mysql' ),
                'invite_group' => '',
            )
        );

        return $wpdb->last_error;
    }

    public static function invalidate_invite_code($gift_id) {

        global $wpdb;
        $status = self::STATUS_INVITE_INVALID;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_invites SET status='%d' WHERE gift_id='%d'",$status,$gift_id));
    }

    public static function update_gift_contrib_settings($gift_id, $contrib_settings) {
        global $wpdb;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_gifts SET contrib_setting_id='%d' WHERE id='%d'", $contrib_settings, $gift_id));
    }

    public static function update_gift_status($gift_id, $status) {
        global $wpdb;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_gifts SET status='%d' WHERE id='%d'", $status, $gift_id));
    }

    public static function mark_gift_code_as_used($invite_id, $code, $user_id , $type = Ajency_MFG_Gift::STATUS_INVITE_TYPE_MANUAL,$invite_group) {

        global $wpdb;

        $status = self::STATUS_INVITE_SENT;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_invites SET sent_on='%s', updated='%s' ,invite_group='%s',status ='%d' WHERE invite_code='%s' and status = 0", current_time( 'mysql' ), current_time( 'mysql' ), $invite_group, $status, $code));
        //Add to usage tables also
        self::mark_gift_code_usage($user_id, $code , $invite_id, $type);
    }


    public static function mark_gift_code_usage($user_id, $code , $invite_id, $type = Ajency_MFG_Gift::STATUS_INVITE_TYPE_MANUAL)
    {
        global $wpdb;
        //Add to usage tables also
        $table_name = $wpdb->prefix . "giftology_invites_usage";
        $wpdb->insert($table_name, array(
            'used_by' => $user_id,
            'invite_code' => $code,
            'invite_id' => $invite_id,
            'used_on' => current_time( 'mysql' ),
            'type' => $type,
        ));
    }


    public static function mark_gift_code_as_sent($code, $invite_group) {
        global $wpdb;
        $status = self::STATUS_INVITE_SENT;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_invites SET sent_on='%s', updated='%s' ,invite_group='%s',status ='%d' WHERE invite_code='%s' and status = 0", current_time( 'mysql' ), current_time( 'mysql' ), $invite_group, $status, $code));
    }

    /*public static function mark_gift_code_as_sent_used($code, $invite_group, $user_id) {
        global $wpdb;
        $status = self::STATUS_INVITE_SENT_USED;
        $wpdb->query($wpdb->prepare("UPDATE wp_giftology_invites SET sent_on='%d', updated='%d' , invite_group='%s',status='%d',user_id='%d' WHERE invite_code='%s' and status = 0", current_time( 'mysql' ), current_time( 'mysql' ) , $invite_group, $status, $user_id, $code));
    }*/


    public static function get_gift_details($gift_id, $include_fund = false, $by_field = 'id') {
        global $wpdb;

/*        $gift_query = "SELECT * from wp_giftology_gifts where slug = '".$gift_id."'";*/

        $gift_query = "select * from wp_giftology_gifts where ".$by_field." = '".$gift_id."'";

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

    public static function update_gift($data) {

        $gift_id = $data['gift_id'];

    }

    public static function create_gift_minimal($user_id, $fund_id, $recepient_name, $occasion, $contribution_amount) {

        global $wpdb;
        $table_name = $wpdb->prefix . "giftology_gifts";
        $wpdb->insert($table_name, array(
            'receiver_name' => $recepient_name,
            'created_by' => $user_id,
            'fund_id' => $fund_id,
            'contribution_amount' => $contribution_amount,
            'receiver_occasion' => $occasion,
            'created' => current_time( 'mysql' ),
            'updated' => current_time( 'mysql' ),
        ));
        return $wpdb->insert_id;
    }
}

#Close current modal open new
#http://codepen.io/elmahdim/details/azVNbN/