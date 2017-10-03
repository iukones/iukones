<?php
/**
 * The single post template file.
 *
 * @package martial
 */

get_header();
?>
	<!-- maincontent Starts -->
	<div class="main_content">
		<div class="left_content">
			<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'inc/partials/content', 'single' );
				endwhile;
			?>
		</div>
		<div class="right_content">
			<?php get_sidebar(); ?>
		</div>
		<div class="clear"></div>
	</div>
	<!-- maincontent ends -->

<?php get_footer();