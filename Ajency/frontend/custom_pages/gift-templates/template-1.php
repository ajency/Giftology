<?php
if( !defined( 'ABSPATH' ) ) exit;
?>
<div class="row fund-gift">
    <div class="col-sm-7">
        <div class="data-banner">
            <h1 class="banner-title"><?php  echo $gift->title; ?>
                <a href="" class="banner-link">Edit gift details</a>
            </h1>
            <div class="banner-img">
                <img src="<?php  echo $gift->img; ?>" class="img-responsive">
            </div>
            <div class="voucher">
                <div class="col voucher-name">
                    <i class="fa fa-smile-o" aria-hidden="true"></i>
                    <span>
								<p>This gift is for</p>
								<h5><?php  echo $gift->receiver_name; ?></h5>
							</span>
                </div>
                <div class="col occasion">
                    <p>On the happy occasion of</p>
                    <h5>Wedding Anniversary</h5>
                </div>
                <div class="col share">
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="data-card dc">
            <p class="dc-head">Gift fund details</p>
            <div class="dc-subtitle">
                <h3><?php  echo $fund->post_title; ?>
                    <a href="#" class="site-link"><?php  echo $fund->_fund_url; ?></a>
                </h3>
                <div><img src="<?php echo get_template_directory_uri(); ?>/img/axis.jpg" class="img-reponsive" width="40"></div>
            </div>
            <div class="dc-body">
                <div class="age">
                    <span>Age group</span>
                    <h4>25 - 40 years</h4>
                </div>
                <div class="cat">
                    <span>Categories</span>
                    <h4>Bucket 1, Bucket 2</h4>
                </div>
            </div>
            <div class="dc-footer">
                <p><?php  echo $fund->post_content; ?></p>
            </div>
        </div>
        <div class="data-card dc-gift">

        </div>
        <div class="data-card dc-days">

        </div>
    </div>
</div>

<div class="row testimonial">
    <div class="col-sm-7"><?php  echo $gift->receiver_message; ?></div>
    <div class="col-sm-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui voluptatum totam, est voluptates, quis voluptate praesentium accusantium harum labore facilis esse nobis. Dolor eos eum minima harum placeat sunt explicabo.</div>
</div>