<?php

class List_Of_Gifts
{
    /**
     * Constructor will create the menu item
     */
    public function __construct()
    {
        add_action( 'admin_menu', array($this, 'add_menu_gifts_list_table_page' ));
    }
    /**
     * Menu item will allow us to load the page to display the table
     */
    public function add_menu_gifts_list_table_page()
    {
        add_menu_page( 'Gifts', 'Gifts', 'manage_options', 'gifts', array($this, 'list_table_page') );
    }
    /**
     * Display the list table page
     *
     * @return Void
     */
    public function list_table_page()
    {
        $giftListTable = new Gifts_List_Table();
        $giftListTable->prepare_items();
        ?>
        <div class="wrap">
            <div id="icon-users" class="icon32"></div>
            <h2>List of Gifts</h2>
            <?php $giftListTable->display(); ?>
        </div>
        <?php
    }
}
// WP_List_Table is not loaded automatically so we need to load it in our application
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
/**
 * Create a new table class that will extend the WP_List_Table
 */
class Gifts_List_Table extends WP_List_Table
{

    const RESULTS_PER_PAGE = 10;
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $paged = $this->get_pagenum() ? $this->get_pagenum() : 1;
        $order_by = $_GET['orderby'] ? $_GET['orderby'] : 'updated';
        $order = $_GET['order'] ? $_GET['order'] : 'asc';
        $limit = self::RESULTS_PER_PAGE;
        $offset = ($paged - 1) * $limit;
        $data = Ajency_MFG_Gift::get_gifts($limit,$offset,$order_by,$order);

        $perPage = self::RESULTS_PER_PAGE;
        $totalItems = Ajency_MFG_Gift::get_gifts_count();
        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }
    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id'          => 'ID',
            'title'       => 'Title',
            'receiver_name' => 'Recepient Name',
            'receiver_email'        => 'Recepient Email',
            'receiver_mobile'    => 'Recepient Mobile',
            'contribution_amount'      => 'Amount',
            'amc'      => 'AMC',
            'fund_name'      => 'Fund',
            'send_type'      => 'Send Settings',
            'send_on'      => 'Send On',
            'email_sent_on'      => 'Sent On',
            'status'      => 'Status',
            'updated'      => 'Last Updated',
        );
        return $columns;
    }
    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }
    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array(
            'title' => array('title', false),
            'id' => array('id', false),
            'receiver_name' => array('receiver_name', false),
            'receiver_email' => array('receiver_email', false),
            'receiver_mobile' => array('receiver_mobile', false),
            'contribution_amount' => array('contribution_amount', false),
            'amc' => array('amc', false),
            'fund_name' => array('fund_name', false),
            'send_type' => array('send_type', false),
            'send_on' => array('send_on', false),
            'email_sent_on' => array('email_sent_on', false),
            'status' => array('status', false),
        );
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        $statuses = [
            0 => 'Draft',
            1 => 'Open to contribute',
            2 => 'Sent',
            3 => 'Claim Initiated',
            4 => 'Claimed',
            -1 => 'Refund'
        ];

        switch( $column_name ) {
            case 'id':
            case 'title':
            case 'receiver_name':
            case 'receiver_email':
            case 'receiver_mobile':
            case 'contribution_amount':
            case 'fund_name':
            case 'amc':
            case 'updated':
                return $item[ $column_name ];
            case 'status':
                return $statuses[$item[ $column_name ]];
            case 'send_type':
                return ($item[ $column_name ] == 1) ? 'Send Now' : 'Schedule';
            case 'email_sent_on':
                return ($item[ $column_name ] == '0000-00-00 00:00:00') ? 'NA' : $item[ $column_name ];
            case 'send_on':
                return ($item[ $column_name ] == '0000-00-00 00:00:00') ? 'NA' : $item[ $column_name ];
            default:
                return print_r( $item, true ) ;
        }
    }
}