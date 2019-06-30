<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<section class="site" id="page">
    <section id="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="nobullets">
                        <li class="email"><a href="mailto:<?=get_option('email')?>"><span class="fa fa-envelope"></span><?=get_option('email')?></a></li>
                        <li class="ph"><a href="tel:<?=formatPhoneNumber(get_option('phone'))?>"><span class="fa fa-phone"></span><?=get_option('phone')?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="header">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 nopadding">
                    <div class="inner-wrapper">
                        <div class="logo-wrapper">
                            <?=the_custom_logo()?>
                        </div>
                        <div id="bhb-menu-wrapper">
                            <div class="main-nav wrapper-fluid wrapper-navbar" id="wrapper-navbar">
                                <nav class="site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                                    <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'primary',
                                            'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                                            'menu_class' => 'nav navbar-nav',
                                            'fallback_cb' => '',
                                            'menu_id' => 'main-menu'
                                        )
                                    );
                                    ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
