<?php get_header(); ?>
    <!-- Gift card section -->

    <section class="gift-card single-bg">

        <div class="container">
            <!-- breadcrums -->
            <div class="row breadcrums">
                <div class="col-sm-7">
                    <ul class="steps">
                        <li><a href="/">Home</a></li>
                        <li>/</li>
                        <li><a href="/funds">All Funds</a></li>
                        <li>/</li>
                        <li><a href=""><?php echo get_the_title(); ?></a></li>
                    </ul>
                </div>
            </div>

            <!-- Fund heading -->

            <div class="row m-t-1">
                <div class="col-sm-10">
                    <div class="fund">
                        <h1 class="fund__heading"><?php echo get_the_title(); ?></h1>
                        <div class="fund__type">
                            <?php
                            $buckets = (get_option('_amfg_bucket_settings'));
                            $amc = get_the_terms( get_the_ID(), 'amc')[0];

                            //Never delete code, always comment coz life changes
                            /* $amc_image_id = get_term_meta($amc->term_id,'image');
                            if($amc_image_id) {
                                $amc_url = wp_get_attachment_thumb_url( $amc_image_id[0] );
                            } else {
                                $amc_url = get_template_directory_uri().'/img/dummy.png';
                            }*/

                            $amc_url = get_the_post_thumbnail();
                            ?>
                            <span>AMC - <?php echo $amc->name; ?></span>
                            <span><?php echo $buckets['_amfg_bucket_1_singular']; ?> <b><?php echo get_the_terms( get_the_ID(), 'bucket-1')[0]->name; ?></b></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row fund-detail">

                <div class="col-sm-4 col-sm-push-8">
                    <div class="fund-card">
                        <div class="c-obj fund-card__header">
                            <div class="occ-img">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/fireworks.png" class="img-reponsive center-block" width="60">
                            </div>
                            <div class="occ-data">

                                <?php
                                $bucket_2_terms = get_the_terms( get_the_ID(), 'bucket-2' );
                                $bucket_3_terms = get_the_terms( get_the_ID(), 'bucket-3' );
                                if ( $bucket_2_terms && ! is_wp_error( $bucket_2_terms ) ) {

                                    $bucket_2 = array();
                                    foreach ( $bucket_2_terms as $term ) {
                                        $bucket_2[] = $term->name;
                                    }

                                    $bucket_2s = join( ", ", $bucket_2 );
                                }
                                if ( $bucket_3_terms && ! is_wp_error( $bucket_3_terms ) ) {

                                    $bucket_3 = array();
                                    foreach ( $bucket_3_terms as $term ) {
                                        $bucket_3[] = $term->name;
                                    }

                                    $bucket_3s = join( ", ", $bucket_3 );
                                }
                                ?>
                                <p class="occ-title"><?php echo $buckets['_amfg_bucket_2_plural']; ?></p>
                                <b class="occ-name"><?php echo $bucket_2s; ?></b>
                            </div>
                        </div>
                        <div class="c-obj fund-card__body">
                            <div class="rank">
                                <div class="percent">
                                    <i class="fa fa-percent" aria-hidden="true"></i>
                                    <div class="number">
                                        <h1 class="return-no"><?php echo get_post_meta(get_the_ID(),'_fund_returns')[0]; ?>%</h1>
                                        <p class="p-terms">Returns <i class="fa fa-exclamation-triangle" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Disclaimer: Mutual fund investments are subject to market risks. Please read the scheme information and other related documents before investing."></i></p>
                                    </div>
                                </div>
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
                            </div>
                            <div class="investment">
                                <p class="data min">Minimum investment <b>Rs. <?php echo get_post_meta(get_the_ID(),'_fund_min_investment')[0]; ?></b></p>
                                <p class="data mult">in multiples of <b>Rs. <?php echo get_post_meta(get_the_ID(),'_fund_min_increment')[0]; ?></b> thereafter</p>
                            </div>
                            <button type="button" class="btn btn-lg site-btn-2 buy-fund" data-toggle="modal" data-target="#fund-modal">Buy/Gift this fund</button>
                            <p class="why-buy">Find out <a href="#" class="underline">why gifting mutual fund is a good idea.</a></p>
                        </div>
                    </div>
                    <div class="fund-risk m-t-2">
                        <?php
                        $content = get_post_meta(get_the_ID(), '_fund_sidebar_content' , true );
                        echo  $content = htmlspecialchars_decode($content);
                        ?>

                    </div>
                </div>
                <div class="col-sm-8 col-sm-pull-4">
                    <div class="brand-data">
                        <div class="brand-box">
                            <span class="medal"></span>
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-responsive center-block" width="50">
                        </div>
                        <div class="bucket">
                            <p class="bucket__name"><?php echo $buckets['_amfg_bucket_3_singular']; ?></p>
                            <b class="bucket__value"><?php echo $bucket_3s; ?></b>
                        </div>
                    </div>

                    <div class="fund-stats m-t-2">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>


        </div>



        <!-- Fund modal -->

        <div class="fund-modal modal fade" id="fund-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="brand-box">
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-responsive center-block" width="50">
                        </div>
                        <div class="fund-head">
                            <h4 class="modal-title" id="myModalLabel"><?php echo get_the_title(); ?></h4>
                            <div class="caption">
                                <span>AMC - <?php echo $amc->name; ?></span>
                                <span><?php echo $buckets['_amfg_bucket_1_singular']; ?> <b><?php echo get_the_terms( get_the_ID(), 'bucket-1')[0]->name; ?></b></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="fund-stats">
                            <p class="fund-name">Crisil MF Rank <span class="stars">
                                        <?php for($i = 1; $i <= get_post_meta( get_the_ID(), '_fund_crisil_rating')[0]; $i++  ) : ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php endfor; ?>
                            <?php for($i = 5; $i > get_post_meta( get_the_ID(), '_fund_crisil_rating')[0]; $i--  ) : ?>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            <?php endfor; ?>
                                </span>
                            </p>
                            <div class="occasion">
                                <div class="occasion__type">

                                    <p class="first"><?php echo $buckets['_amfg_bucket_2_plural']; ?> <b><?php echo $bucket_2s; ?></b></p>
                                    <p class="bucket"><?php echo $buckets['_amfg_bucket_3_plural']; ?> <b><?php echo $bucket_3s; ?></b></p>
                                </div>
                                <div class="percent">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/returns.png" class="img-reponsive" width="45">
                                    <div class="number">
                                        <h1 class="return-no"><?php echo get_post_meta(get_the_ID(),'_fund_returns')[0]; ?>%</h1>
                                        <p class="p-terms">Returns <i class="fa fa-exclamation-triangle" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Disclaimer: Mutual fund investments are subject to market risks. Please read the scheme information and other related documents before investing."></i></p>
                                    </div>
                                </div>
                            </div>
                            <div class="gift-note">
                                <p class="data">Mimimum investment <b>Rs. <?php echo get_post_meta(get_the_ID(),'_fund_min_investment')[0]; ?></b></p>
                                <p class="data">In multiples of <b>Rs. <?php echo get_post_meta(get_the_ID(),'_fund_min_increment')[0]; ?></b> thereafter</p>
                            </div>
                        </div>
                        <div class="recepient-details">
                            <label class="input-label">Please give us some basic details about the gift recipient</label>
                            <div id="contribution_amount_error"></div>
                            <form id="create-gift">
                                <input type="hidden" value="<?php echo get_the_ID(); ?>" name="fund_id" >
                            <div class="data-box">
                                <label class="input-label required">Who is the gift for?</label>
                                <input name="receiver_name" type="text" class="input-box" placeholder="The recepient's name">
                            </div>
                            <div class="data-box cols">
                                <div class="fields occasion">
                                    <label class="input-label required">What is the occasion?</label>
                                    <select name="receiver_occasion" class="input-box select-box">
                                        <option>-- Please select --</option>
                                        <option>Birthday</option>
                                        <option>Anniversary</option>
                                    </select>
                                </div>
                                <div class="fields contribute">
                                    <label class="input-label required">Amount you wish to contribute</label>
                                    <input min="<?php echo get_post_meta(get_the_ID(),'_fund_min_investment')[0]; ?>" name="contribution_amount" type="number" class="input-box" placeholder="The amount">
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
                        <button id="create-gift-minimal" type="submit" class="btn btn-primary site-btn-2">Create gift</button>
                    </div>
                </div>
            </div>
        </div>






    </section>
<?php get_footer(); ?>