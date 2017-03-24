<?php
$bucket_2 = $bucket_3 = [];
$bucket_2_terms = get_the_terms( get_the_ID(), 'bucket-2' );
$bucket_3_terms = get_the_terms( get_the_ID(), 'bucket-3' );
if ( $bucket_2_terms && ! is_wp_error( $bucket_2_terms ) ) {

    $bucket_2 = array();
    foreach ( $bucket_2_terms as $term ) {
        $bucket_2[] = $term->name;
    }
}
if ( $bucket_3_terms && ! is_wp_error( $bucket_3_terms ) ) {

    $bucket_3 = array();
    foreach ( $bucket_3_terms as $term ) {
        $bucket_3[] = $term->name;
    }
}
$bucket_array = array_merge($bucket_2,$bucket_3);
$bucket_line = join( ", ", $bucket_array );
$amc = get_the_terms( get_the_ID(), 'amc')[0];
$fund_url = get_post_meta(get_the_ID(), '_fund_url')[0];
?>
<div class="cards">
    <div class="gray header">
        <div class="flex-col">
            <div class="funds-detail">
                <a href="<?php echo get_the_permalink(); ?>"><h2 class="fund-name"><?php echo get_the_title(); ?></h2></a>
                <div class="fund-subname">
                    <p class="title"><?php echo $amc->name; ?></p>
                    <a href="<?php echo $fund_url; ?>" class="fund-link underline"><?php echo $fund_url; ?></a>
                </div>
                <div class="box-divider"></div>
            </div>
            <a href="<?php echo get_the_permalink(); ?>">
                <div class="brand-box">
                    <?php if(get_post_meta(get_the_ID(),'_fund_featured')[0]) : ?>
                    <span class="medal"></span>
                    <?php endif; ?>
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-responsive center-block">
                </div>
            </a>
        </div>
        <div class="bucket-data">
            <div class="section">
                <p class="title">Age group</p><a href="#"><b><?php echo get_the_terms( get_the_ID(), 'bucket-1')[0]->name; ?></b></a>
            </div>
            <div class="section">
                <p class="title">Categories</p><a href="#"><b><?php echo $bucket_line; ?></b></a>
            </div>
        </div>
        <div class="fund-desc">
            <p class="read-more"><?php the_excerpt() ?></p>
        </div>
    </div>
    <div class="gray body">
        <div class="rating">
            <div class="stars">
                <?php for($i = 1; $i <= get_post_meta( get_the_ID(), '_fund_crisil_rating')[0]; $i++  ) : ?>
                    <i class="fa fa-star" aria-hidden="true"></i>
                <?php endfor; ?>
                <?php for($i = 5; $i > get_post_meta( get_the_ID(), '_fund_crisil_rating')[0]; $i--  ) : ?>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                <?php endfor; ?>
            </div>
            <p>Crisil MF Rank</p>
        </div>
        <div class="percent">
            <!-- <i class="fa fa-percent" aria-hidden="true"></i> -->
            <img src="<?php echo get_template_directory_uri(); ?>/img/returns.png" class="img-responsive" width="45">
            <div class="number">
                <h1 class="return-no"><?php echo get_post_meta(get_the_ID(),'_fund_returns')[0]; ?>%</h1>
                <p class="p-terms">Returns <i class="fa fa-exclamation-triangle" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Disclaimer: Mutual fund investments are subject to market risks. Please read the scheme information and other related documents before investing."></i></p>
            </div>
        </div>
    </div>
    <div class="footer hidden">
        <div class="actions">
            <button type="button" class="btn view-close">Close <i class="fa fa-angle-up" aria-hidden="true"></i></button>
            <a href="<?php echo get_the_permalink(); ?>" type="button" class="btn buy site-btn-2">Buy/gift</a>
        </div>
    </div>
    <!-- <div class="sub-footer">
        <p class="q-view">Quick view <i class="fa fa-angle-down" aria-hidden="true"></i></p>
    </div> -->
</div>