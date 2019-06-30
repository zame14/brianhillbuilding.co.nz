<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <h3>Services</h3>
                <?php wp_nav_menu(
                    array(
                        'theme_location'  => 'footer-menu',
                        'container_class' => 'footer-menu-wrapper',
                        'container_id'    => '',
                        'menu_class'      => '',
                        'fallback_cb'     => '',
                        'menu_id'         => 'footer-menu',
                    )

                ); ?>
            </div>
            <div class="col-12 col-sm-6 col-md-4 contact-dets-col">
                <h3>Contact</h3>
                <ul class="contact-details nobullets">
                    <li><a href="tel:<?=formatPhoneNumber(get_option('phone'))?>">Office: <?=get_option('phone')?></a></li>
                    <li><a href="tel:<?=formatPhoneNumber(get_option('phone1'))?>">Jono Hill: <?=get_option('phone1')?></a></li>
                    <li><a href="tel:<?=formatPhoneNumber(get_option('phone2'))?>">Brian Hill: <?=get_option('phone2')?></a></li>
                    <li><a href="mailto:<?=get_option('email')?>"><?=get_option('email')?></a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-md-4">
                <h3>Registered Members of</h3>
                <?php
                if(is_active_sidebar('footerwidget')){
                    dynamic_sidebar('footerwidget');
                }
                ?>
            </div>

        </div>
    </div>
</section>
<section id="copyright">
    <div class="container">
        <div class="col-12">
            <p>Copyright <?=get_bloginfo('name')?>. <span>Website by <a href="https://www.designgarage.co.nz/" target="_blank">Design Garage</a></span></p>
        </div>
    </div>
</section>
<?php wp_footer(); ?>
</body>
</html>

