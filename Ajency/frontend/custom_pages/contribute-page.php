<?php
if( !defined( 'ABSPATH' ) ) exit;
$g = Ajency_MFG_Gift::get_gift_details($_GET['contribute']);
?>
<?php get_header(); ?>
    <a class="btn btn-default" href="/gifts/<?php echo $g->slug; ?>">Skip</a>
<?php get_footer(); ?>