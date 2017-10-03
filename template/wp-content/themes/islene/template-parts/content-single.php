<?php
/**
 * Template part for displaying single posts.
 *
 * @package islene
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( is_single() || is_page() && has_post_thumbnail() ) : ?>
		<div class="featured-header-image">
				<?php the_post_thumbnail( 'islene-home' ); ?>
		</div><!-- .featured-header-image -->
	<?php endif; ?>
<div class="entry-cat">
			&mdash; <?php the_category( ', ' ) ?> &mdash;
		</div><!-- .entry-cat -->
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <div class="entry-datetop">
			<?php the_time('l, F jS, Y') ?>
		</div><!-- .entry-datetop -->
	</header><!-- .entry-header -->
    
    

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'islene' ),
				'after'  => '</div>',
			) );
		?>
       
	</div><!-- .entry-content -->
  <?php get_template_part( 'sharing' );  ?>
	<footer class="entry-footer clear">
		<?php islene_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

