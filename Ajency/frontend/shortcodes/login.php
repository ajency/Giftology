<?php
function login()
{
    ?>
    <?php
    $dest = home_url();
    if (is_user_logged_in()) {
        $dest = home_url() . $_GET['destination'];
        wp_redirect($dest);
    } else {
        ?>
        <div class="login-container">
            <h1 class="login-title link-color">Please login to continue</h1>
            <div class="login-card">
                <div class="logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" class="img-responsive center-block">
                </div>
                <p class="site-caption">Login to unbox surprises</p>
                <div class="social-acc">

                    <?php echo do_action( 'wordpress_social_login' ); ?>
                </div>
            </div>
        </div>';

        <?php
    }
}
?>