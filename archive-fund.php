<?php get_header();  ?>
<section class="gift-card single-bg">

    <div class="container">
        <!-- breadcrums -->
        <div class="row breadcrums">
            <div class="col-sm-12">
                <ul class="steps">
                    <li><a href="">Home</a></li>
                    <li>/</li>
                    <li><a href="">All Funds</a></li>
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
        $path = '/'.explode('/',$parsed['path'])[1].'/';
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

<script>
    jQuery(document).ready(function() {

/*        jQuery('.sub-footer').click(function () {
            jQuery(this).parent().addClass('full-view');
            jQuery(this).closest('.cards').find('.footer').removeClass('hidden');
            jQuery(this).addClass('hidden');
            jQuery('.card-overlay').addClass('active');
        });

        jQuery('.view-close').click(function () {
            jQuery(this).parent().parents('.cards').removeClass('full-view');
            jQuery(this).closest('.cards').find('.footer').addClass('hidden');
            jQuery(this).closest('.cards').find('.sub-footer').removeClass('hidden');
            jQuery('.card-overlay').removeClass('active');
        });*/

        // Search functionality

        jQuery(".input-search").on('focus', function () {
            console.log('test');
            jQuery('.search').addClass('active');
        });

        jQuery(".input-search").on('blur', function () {
            if (jQuery('.input-search').val().length == 0)
                jQuery('.search').removeClass('active');
        });

    });

</script>
<?php get_footer(); ?>
