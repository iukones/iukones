<?php
/**
 * Template part for displaying posts.
 *
 * @package islene
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="featured-image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'islene-home' ); ?></a>    
			</div>
<div class="entry-cat">
			&mdash; <?php the_category( ', ' ) ?> &mdash;
		</div><!-- .entry-cat -->
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	<div class="entry-datetop">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_time('l, F jS, Y') ?></a>
		</div><!-- .entry-datetop -->
		<?php if ( has_post_thumbnail() ) : ?>
			
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-excerpt --> 
    <a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'islene' ); ?></a>
<?php get_template_part( 'sharing' );  ?> 
</article><!-- #post-## -->
