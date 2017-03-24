<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,500i,600,600i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/css/style.css">

    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<nav class="gift-header navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" class="img-responsive">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


        <?php
        wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'ul',
                'container_class'        => 'nav navbar-nav',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker())
        );
        ?>


        <ul class="nav navbar-nav navbar-right">
            <?php if(!is_user_logged_in()) : ?>
            <li><button class="btn btn-default invest-btn" type="button">Gift an investment</button></li>
            <li><a href="#" class="login" data-toggle="modal" data-target="#login">Login</a></li>
            <?php else : ?>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle option-profile" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo wsl_get_user_custom_avatar(get_current_user_id()) ?>" class="img-responsive option-pic" width="40"> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu right">
                    <li class="username"></li>
                    <li><a href="#">My Gifts</a></li>
                    <li><a href="#">My Account</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo wp_logout_url() ?>">Log Out</a></li>
                </ul>
            </li>
            <?php endif; ?>

        </ul>
        </div>
        <?php
/*        wp_nav_menu( array(
                'menu'              => 'user',
                'theme_location'    => 'user',
                'depth'             => 2,
                'container'         => 'div',
                'container'         => 'ul',
                'container_class'        => 'nav navbar-nav navbar-right',
                'menu_class'        => 'nav navbar-nav navbar-right',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker())
        );
        */?>


    </div>
</nav>