<?php
include 'Ajency/class-amfg.php';
$run = new Ajency_MFG('mfgiftology','1.0.0');
$run->load();

/*add_filter( 'pre_insert_term', 'prevent_add_term', 20, 2 );

function prevent_add_term( $term, $taxonomy ) {

    if(empty($_POST['description'])) {
        $term = new WP_Error( 'invalid_term', 'AMC Description is Required' );
    }
    return $term;
/*    print_r($_POST);
    print_r($taxonomy);
    print_r($term);
    die;
    if ( $term === 'i-am-a-bad-term' ) {
        $term = new WP_Error( 'invalid_term', 'Term you tried to add sucks' );
    }
    return $term;*/
