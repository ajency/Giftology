<?php
if( !defined( 'ABSPATH' ) ) exit;
?>

<?php get_header();  ?>
<section class="gift-card single-bg">

    <div class="container">
        <!-- breadcrums -->
        <div class="row breadcrums">
            <div class="col-sm-12">
                <ul class="steps">
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li><a href="/funds/">All Funds</a></li>
                    <li>/</li>
                    <li><a href=""><?php echo get_queried_object()->name; ?></a></li>
                </ul>
            </div>
        </div>
        <!-- Fund heading -->
        <?php include locate_template('template-parts/funds/funds-heading.php', false, false); ?>

        <!-- List view cards and filter -->
        <?php
        $current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $parsed = parse_url($current_url);
        $query = $parsed['query'];
        parse_str($query, $params);
        $path = '/'.explode('/',$parsed['path'])[1].'/'.explode('/',$parsed['path'])[2].'/';

        if(empty($params)) {
            $params['b2'][] = get_queried_object()->slug;
        }

        ?>
        <div class="row list-data">
            <div class="col-sm-4 filter">
                <?php
                $filter_params_input = $params;
                include locate_template('template-parts/funds/filter-section.php', false, false);
                ?>
            </div>
            <div class="col-sm-8 c-style">
                <?php
                $content_params_input = $params;
                include locate_template('template-parts/funds/card-holder.php', false, false);
                ?>
            </div>
        </div>
    </div>
    <div class="card-overlay"></div>
</section>
<?php get_footer();  ?>
