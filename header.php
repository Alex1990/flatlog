<?php
/**
 * @package WordPress
 * @subpackage Flatlog
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"><!--<![endif]-->
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="renderer" content="webkit">
        <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
        <meta charset="utf-8">
        <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
        <meta name="description" content="<?php bloginfo('description') ?>">
        <meta name="author" content="<?php bloginfo('admin_email') ?>">
        <meta name="viewport" content="width=device-width, user-scalable=no">

        <link rel="shortcut icon" type="image/x-icon" href="favicon/favicon.ico">
        <link rel="apple-touch-icon" href="favicon/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-touch-icon-152x152.png">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="favicon/win-8-icon-152x152.png">
        <meta http-equiv="imagetoolbar" content="no">
        
        <?php versioned_stylesheet($GLOBALS["TEMPLATE_RELATIVE_URL"] . "style.css") ?>

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <?php wp_head(); ?>
        
        <!--[if lt IE 9]>
        <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"] . "js/html5shiv.min.js") ?>
        <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"] . "js/respond.min.js") ?>
        <![endif]-->
        <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"] . "js/modernizr.min.js") ?>
        <!--[if gt IE 8]><!-->
        <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"] . "js/highlight.pack.js") ?>
        <script>hljs.initHighlightingOnLoad();</script>
        <!--<![endif]-->
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 7]>
            <p class="modern-browser">你正在使用低性能、过时的浏览器，使用<a href="http://browserhappy.com">现代浏览器</a>体验此网站更佳。</p>
        <![endif]-->

        <div id="page" class="page">
            <header id="header" class="header" role="header">
                <div class="wrap cf">
                    <h1 class="logo fl"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name') ?></a></h1>

                    <?php
                        $args = array(
                            'theme_location' => 'header-menu',
                            'container' => false,
                            'items_wrap' => '<ul class="cf">%3$s</ul>',
                            'depth' => '2'
                        );
                    ?>
                    <div class="nav-wrapper fl">
                        <span class="pullnav-toggle">导航</span>
                        <nav class="nav">
                            <?php wp_nav_menu($args); ?>
                        </nav>
                    </div>
                    
                    <?php get_search_form(); ?>
                    
                </div>
            </header>