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

        <div class="row m-t-1">
            <div class="col-sm-9">
                <div class="fund-list">
                    <h1 class="fund-list__heading">All Funds <div class="search"><input type="search" class="input-search"><span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span></div></h1>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="popular">
                    <p class="sort">Sort by : </p>
                    <div class="dropdown">
                        <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Popularity
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li>
                                <a href="">High</a>
                            </li>
                            <li>
                                <a href="">Low</a>
                            </li>
                            <li>
                                <a href="">High</a>
                            </li>
                            <li>
                                <a href="">High</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- List view cards and filter -->

        <div class="row list-data">
            <div class="col-sm-4 filter">
                <div class="filter-bar">
                    <div class="card header">
                        <p class="filter-name"><i class="fa fa-filter" aria-hidden="true"></i> <b>Filters</b></p>
                        <a href="#" class="reset underline">Reset</a>
                    </div>
                    <div class="card body">
                        <?php
                        $show_all_link = true;
                        $filter_title = 'Filter by AMC';
                        $filter = 'amc';
                        include locate_template('template-parts/funds/filters.php', false, false);
                        ?>
                    </div>
                    <div class="card body">
                        <?php
                        $show_all_link = false;
                        $filter_title = 'Filter by Bucket 1';
                        $filter = 'bucket-1';
                        include locate_template('template-parts/funds/filters.php', false, false);
                        ?>
                    </div>
                    <div class="card body">
                        <?php
                        $show_all_link = false;
                        $filter_title = 'Filter by Bucket 2';
                        $filter = 'bucket-2';
                        include locate_template('template-parts/funds/filters.php', false, false);
                        ?>
                    </div>
                    <div class="card body">
                        <?php
                        $show_all_link = false;
                        $filter_title = 'Filter by Bucket 3';
                        $filter = 'bucket-3';
                        include locate_template('template-parts/funds/filters.php', false, false);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 c-style">
                <div class="card-holder">
                    <?php
                    $params = $_GET;
                    $filters = ['amc','bucket-1','bucket-2','bucket-3'];
                    foreach($filters as $filter) {
                        if(isset($params[$filter]) && !empty($params[$filter]))
                        {
                            //TODO - can also check if the term exists for the respective category
                            $q[] = [ 'taxonomy' => $filter, 'field' => 'slug', 'terms' => $params[$filter] ];
                        }
                    }

                    $tax_query = array(
                        'relation' => 'AND',
                        $q
                    );

                    $query = array(
                        'post_type' => 'fund',
                        'paged' => $paged ,
                        'status' => 'publish',
                        'tax_query' => $tax_query/*
                        'orderby'     => 'title',
                        'order'       => 'ASC'*/
                    );

                    if($params['search']) {
                        $query['s'] = $params['search'];
                    }

                    $loop = new WP_Query( $query );

                    ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); // standard WordPress loop. ?>
                        <?php get_template_part( 'template-parts/funds/fund', 'card' ); ?>
                        <!-- 2nd -->

                    <?php endwhile; // end of the loop. ?>

                </div>

                <!-- View all -->

                <div class="view-all">
                    <a href="" class="underline">View More</a>
                </div>

            </div>
        </div>

    </div>

    <!-- Overlay for larger card view -->

    <div class="card-overlay"></div>


</section>

<script>
    jQuery(document).ready(function() {
        jQuery('.sub-footer').click(function () {
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
        });

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
