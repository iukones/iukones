<?php
/**
 * The page template file.
 *
 * @package martial
 */

get_header();
?>
	<!-- maincontent Starts -->
	<div class="main_content">
		<div class="left_content">
        <div class="block_cont">
	<div class="block_cont_in">
			<?php woocommerce_content(); ?>
            </div></div>
		</div>
		<div class="right_content">
			<?php get_sidebar(); ?>
		</div>
		<div class="clear"></div>
	</div>
	<!-- maincontent ends -->

<?php get_footer();