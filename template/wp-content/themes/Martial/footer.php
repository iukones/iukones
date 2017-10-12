</div>
<!-- wrapper ends -->
<!-- footer starts -->
<footer>
<div id="footer">
	<div class="footer_in">
		<div class="footer_blocks">
			<ul>
				<?php
				global $wp_customize;
				if ( !empty( $wp_customize ) && $wp_customize->is_preview() && !get_theme_mod( 'martial_content_set', false ) ) {
					the_widget(
						'WP_Widget_Text', array(
							'title' => 'TEXT WIDGET',
							'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' ),
						array(
							'before_widget' => '<li class="footerwidget">',
							'after_widget'  => '</li>',
							'before_title'  => '<h4 class="footerwidgettitle">',
							'after_title'   => '</h4>',
						) );

					the_widget(
						'WP_Widget_Text', array(
							'title' => 'TEXT WIDGET',
							'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' ),
						array(
							'before_widget' => '<li class="footerwidget">',
							'after_widget'  => '</li>',
							'before_title'  => '<h4 class="footerwidgettitle">',
							'after_title'   => '</h4>',
						) );

					the_widget(
						'WP_Widget_Text', array(
							'title' => 'TEXT WIDGET',
							'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' ),
						array(
							'before_widget' => '<li class="footerwidget">',
							'after_widget'  => '</li>',
							'before_title'  => '<h4 class="footerwidgettitle">',
							'after_title'   => '</h4>',
						) );
				} else if ( is_active_sidebar( 'martial-footer' ) ) {
					dynamic_sidebar( 'martial-footer' );
				}
				?>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="footer_logo">
			<?php
			$martial_display_footer_logo = get_theme_mod( 'martial_footer_logo_show', 'no' );
			if ( $martial_display_footer_logo === 'yes' ) {
				echo '<a href="' . home_url() . '"><img src="' . esc_url( get_theme_mod( 'martial_footer_logo_image' ) ) . '" class="bottomlogo"></a>';
				echo '<span class="bottomlogo" style="display: none;">&nbsp;</span>';
			} else {
				echo '<a href="' . home_url() . '" style="display: none;"><img src="' . esc_url( get_theme_mod( 'martial_footer_logo_image' ) ) . '" class="bottomlogo"></a>';
				echo '<span class="bottomlogo">&nbsp;</span>';
			}
			?>
			<p><a rel="generator"
				  href="<?php echo esc_url( __( 'https://iukones.com/', 'martial' ) ); ?>"><?php printf( __( 'powered by %s', 'iukones' ), 'iukones' ); ?></a> <?php printf( __( 'Theme: %1$s by %2$s.', 'martial' ), 'Martial', '<a href="https://themefurnace.com" rel="designer">ThemeFurnace</a>' ); ?>
			</p>
		</div>
	</div>
</div>
</footer>
<!-- footer ends -->

<?php wp_footer(); ?>
</body>
</html>