<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Single Page
 */
?>

<div id="footer">
    <div class="container">
        <?php if ( get_theme_mod( 'themefurnace_footer_logo' ) ) : ?>
            <img class="footerlogo" src="<?php echo esc_url( get_theme_mod( 'themefurnace_footer_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        <?php else :
            if ( get_theme_mod( 'themefurnace_footer_logo' ) === false) : ?>
                <img class="footerlogo" src="<?php echo get_bloginfo('template_directory') . '/img/logo-footer.png';?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
            <?php endif; ?>
        <?php endif; ?>
        <p class="copy"><?php echo get_theme_mod( 'themefurnacefooter_footer_text' ); ?><br />
            <?php _e('&copy; Copyright', 'themefurnace') ?> <?php the_time('Y') ?> <?php bloginfo('name'); ?> - <?php printf( __( 'Theme: %1$s by %2$s.', 'themefurnace' ), 'Single Page', '<a href="http://themefurnace.com" rel="designer">ThemeFurnace</a>' ); ?></a></p>
    </div><!-- End Container -->
</div><!-- End Footer -->
<?php echo get_theme_mod( 'footer_scripts' ); ?>
<?php wp_footer(); ?>

<!--[if lt IE 9]>
<script src="inc/bower_components/es5-shim/es5-shim.js"></script>
<script src="inc/bower_components/json3/lib/json3.min.js"></script>
<![endif]-->

<!-- build:js scripts/vendor.js -->
<!-- bower:js -->
<script src="inc/bower_components/angular/angular.js"></script>
<script src="inc/bower_components/angular-ui-router/release/angular-ui-router.js"></script>
<!-- endbower -->
<!-- endbuild -->

<!-- build:js({.tmp,app}) scripts/scripts.js -->
<script src="inc/scripts/app.js"></script>
<script src="inc/scripts/controllers/widgets.js"></script>
<script src="inc/scripts/controllers/content.js"></script>

<!-- endbuild -->

</body>
</html>
