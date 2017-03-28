<?php
if( !defined( 'ABSPATH' ) ) exit;
?>

<?php if($_GET['modal']) : ?>
<?php get_header('modal'); ?>
<?php else : ?>
    <?php get_header(); ?>
<?php endif; ?>

<?php if($_GET['modal']) : ?>
    <?php get_footer('modal'); ?>

<?php else : ?>
    <?php get_footer(); ?>

<?php endif; ?>
