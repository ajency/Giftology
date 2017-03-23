<?php get_header(); ?>
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
                        <h6 class="filter-title">Filter by amc</h6>
                        <ul class="selection">
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Show All</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Axis assets</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Tata asset management</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Baroda Pioneer asset management</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Birla sun life mutual fund</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">BOI AXA investment management</p></label></li>
                            <li class="showAll"><a href="" class="show-all underline">Show all</a></li>
                        </ul>
                    </div>
                    <div class="card body">
                        <h6 class="filter-title">Filter by age</h6>
                        <ul class="selection">
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Show All</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">25 - 30 years</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">31 - 40 years</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">41 - 50 years</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">51+ years</p></label></li>
                        </ul>
                    </div>
                    <div class="card body">
                        <h6 class="filter-title">Bucket</h6>
                        <ul class="selection">
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Show All</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Content 1</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Content 2</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Content 3</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Content 4</p></label></li>
                        </ul>
                    </div>
                    <div class="card body">
                        <h6 class="filter-title">Bucket</h6>
                        <ul class="selection">
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Show All</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Content 1</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Content 2</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Content 3</p></label></li>
                            <li><label><input type="checkbox" class="checkbox-inline"> <p class="label-name">Content 4</p></label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 c-style">
                <div class="card-holder">
                    <?php $loop = new WP_Query( array( 'post_type' => 'fund', 'paged' => $paged , 'status' => 'publish') ); ?>
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
