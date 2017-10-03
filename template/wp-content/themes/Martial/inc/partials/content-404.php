<?php
/**
 * @package martial
 */
?>
<div class="block_cont">
	<div class="block_cont_in">
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'martial' ); ?></p>
		<hr>
		<?php get_search_form(); ?>
		<br/>

		<?php if ( martial_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>

			<h2><?php esc_html_e( 'Most Used Categories', 'martial' ); ?></h2>
			<ul>
				<?php
				wp_list_categories( array(
					'orderby'    => 'count',
					'order'      => 'DESC',
					'show_count' => 1,
					'title_li'   => '',
					'number'     => 10,
				) );
				?>
			</ul>

		<?php endif; ?>

		<?php
		/* translators: %1$s: smiley */
		$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'martial' ), convert_smilies( ':)' ) ) . '</p>';
		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
		?>

		<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

	</div>
</div>

