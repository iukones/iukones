<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package mediaphase
 */
get_header();
?>
	<!-- maincontent Starts -->
	<div class="main_content">
		<div class="left_content">
			<?php
			get_template_part( 'inc/partials/content', '404' );
			?>
		</div>
		<div class="right_content">
			<?php get_sidebar(); ?>
		</div>
		<div class="clear"></div>
	</div>
	<!-- maincontent ends -->
<?php get_footer();

