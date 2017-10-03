<?php
/**
 * The template for displaying search results pages.
 *
 * @package martial
 */

get_header();
?>
	<!-- maincontent Starts -->
	<div class="main_content">
		<div class="left_content">
			<?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'inc/partials/content', get_post_format() );

				endwhile;
				martial_pagination();

			else :
				get_template_part( 'inc/partials/content', 'none' );
			endif;
			?>
		</div>
		<div class="right_content">
			<?php get_sidebar(); ?>
		</div>
		<div class="clear"></div>
	</div>
	<!-- maincontent ends -->

<?php get_footer();
