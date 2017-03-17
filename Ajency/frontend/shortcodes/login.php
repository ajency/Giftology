<?php
function login()
{

    if(is_user_logged_in()) {

        wp_redirect('/');
    } else {
        $html = '<div class="login-container">
    <h1 class="login-title link-color">Please login to continue</h1>
    <div class="login-card">
        <div class="logo">
            <img src="'.get_template_directory_uri().'/img/logo.jpg" class="img-responsive center-block">
        </div>
        <p class="site-caption">Login to unbox surprises</p>
        <div class="social-acc">
            <button type="button" class="google btn btn-lg">
                <i class="fa fa-google-plus" aria-hidden="true"></i>
                Google+
            </button>
            <button  type="button" class="facebook btn btn-lg">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                Facebook
            </button>
        </div>
    </div>
</div>';

    }

    return $html.do_action( 'wordpress_social_login' );
}

?>