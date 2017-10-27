<?php
/**
 * The template for displaying all single posts.
 *
 * @package islene
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'template-parts/content', 'single' ); ?>
    <?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
    <?php the_post_navigation( array( 'next_text' => __( '<span class="meta-nav">Next Post</span> %title', 'islene' ), 'prev_text' => __( '<span class="meta-nav">Previous Post</span> %title', 'islene' ) ) ); ?>
    <?php endwhile; // End of the loop. ?>
  </main>
  <!-- #main --> 
</div>
<!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>