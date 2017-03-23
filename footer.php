<footer class="gift-footer">

    <div class="login modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="login-container">
                        <div class="login-card">
                            <div class="logo">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" class="img-responsive center-block">
                            </div>
                            <p class="site-caption">Login to unbox surprises</p>
                            <div class="social-acc">
                                <?php echo do_action( 'wordpress_social_login' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <div class="content contact">
                    <div class="logo">
                        <a href="#" class="inline"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-dark.png" class="img-responsive"></a>
                    </div>
                    <div class="number">
                        <p>Get in touch</p>
                        <ul>
                            <li><a href="mailto:giveagift@giftology.com">giveagift@giftology.com</a></li>
                            <li class="dot">.</li>
                            <li><a href="callto:022-890765445">022-890765445</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="content social">
                    <p>We are social</p>
                    <ul>
                        <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sub-footer/Copyright -->

    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="copyright">
                        <p>&copy; Copyright 2017, all right reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
<?php do_action('wp_enqueue_scripts') ?>
<!--<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()."/js/readmore.min.js" ?>"></script>

<!--<script type="text/javascript" src="<?php /*echo get_template_directory_uri() */?>/js/custom.js"></script>-->