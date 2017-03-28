<?php
$bucket_1 = $bucket_2 = $bucket_3 = [];
$bucket_1_terms = get_the_terms( get_the_ID(), 'bucket-1' );
$bucket_2_terms = get_the_terms( get_the_ID(), 'bucket-2' );
$bucket_3_terms = get_the_terms( get_the_ID(), 'bucket-3' );
if ( $bucket_1_terms && ! is_wp_error( $bucket_1_terms ) ) {

    $bucket_1 = array();
    foreach ( $bucket_1_terms as $term ) {
        $params1 = [];
        $params1['b1'][] = $term->slug;
        $add_url_params = http_build_query($params1);
        $add_url = $parsed['scheme'].'://'.$parsed['host'].$path.'?'.$add_url_params;
        $term_name = $term->name;
        $bucket_1[] = '<b><a href='.$add_url.'>'.$term_name.'</a></b>';
    }
}

if ( $bucket_2_terms && ! is_wp_error( $bucket_2_terms ) ) {
    $bucket_2 = array();
    foreach ( $bucket_2_terms as $term ) {
        $params1 = [];
        if($term->parent > 0) {
            $params1['b2'][] = $term->slug;
            $add_url_params = http_build_query($params1);
            $add_url = $parsed['scheme'].'://'.$parsed['host'].$path.'?'.$add_url_params;
            $parent = get_term($term->parent);
            $term_name = $parent->name.' > '.$term->name;
            $bucket_2[] = '<b><a href='.$add_url.'>'.$term_name.'</a></b>';
        }
    }
}
if ( $bucket_3_terms && ! is_wp_error( $bucket_3_terms ) ) {

    $bucket_3 = array();
    foreach ( $bucket_3_terms as $term ) {
        $params1 = [];
        $params1['b3'][] = $term->slug;
        $add_url_params = http_build_query($params1);
        $add_url = $parsed['scheme'].'://'.$parsed['host'].$path.'?'.$add_url_params;
        $bucket_3[] = '<b><a href='.$add_url.'>'.$term->name.'</a></b>';
    }
}
$bucket_1s = join( ", ", $bucket_1 );
$bucket_2s = join( ", ", $bucket_2 );
$bucket_3s = join( ", ", $bucket_3 );
$amc = get_the_terms( get_the_ID(), 'amc')[0];
$fund_url = get_post_meta(get_the_ID(), '_fund_url')[0];
?>
<div class="cards">
    <div class="gray header">
        <div class="read-more">
            <div class="flex-col">
                <div class="funds-detail">
                    <a href="<?php echo get_the_permalink(); ?>"><h2 class="fund-name" title="<?php echo get_the_title(); ?>"><?php echo  strlen(get_the_title()) > 50 ? substr(get_the_title(),0,50)."..." : get_the_title();  ?></h2></a>
                    <div class="fund-subname">
                        <p class="title"><a href="<?php

                            $params1 = [];
                            $params1['a'][] = $amc->slug;
                            $add_url_params = http_build_query($params1);
                            $add_url = '/funds?'.$add_url_params;
                            echo $add_url;

                            ?>"><?php echo $amc->name; ?></a></p>
                        <a href="<?php echo $fund_url; ?>" class="fund-link underline" title="<?php echo $fund_url; ?>"><?php echo $fund_url; ?></a>
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
            </div>
            <div class="bucket-data">
                <div class="section">
                    <p class="title"><?php echo $buckets['_amfg_bucket_1_singular']; ?></p><span><?php echo $bucket_1s; ?></span>
                </div>
                <div class="section">
                    <p class="title"><?php echo $buckets['_amfg_bucket_2_singular']; ?></p><span><?php echo $bucket_2s; ?></span>
                </div>
                <div class="section">
                    <p class="title"><?php echo $buckets['_amfg_bucket_3_singular']; ?></p><span><?php echo $bucket_3s; ?></span>
                </div>
            </div>
            <div class="fund-desc">
                <p><?php echo get_the_excerpt() ?></p>
            </div>
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
                <p class="p-terms">Returns <i class="fa fa-info" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Disclaimer: Mutual fund investments are subject to market risks. Please read the scheme information and other related documents before investing."></i></p>
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