<?php
/**
 * The template part for displaying a hero banner on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package martial
 */

$martial_display_hero_banner = get_theme_mod( 'martial_hero_show', 'yes' );
$martial_display_hero_button1 = get_theme_mod( 'martial_hero_button1_show', 'yes' );
$martial_display_hero_button2 = get_theme_mod( 'martial_hero_button2_show', 'yes' );

if ( $martial_display_hero_banner === 'yes' ) :
	?>

	<h1><?php echo esc_html( get_theme_mod( 'martial_hero_title' ) ); ?></h1>
	<div class="text">
		<?php
		echo martial_esc_html( get_theme_mod( 'martial_hero_text' ) );
		if ( $martial_display_hero_button1 === 'yes' ) {
			echo '<a href="' . esc_url( get_theme_mod( 'martial_hero_button1_link', '#' ) ) . '" class="about">' . esc_html( get_theme_mod( 'martial_hero_button1_text' ) ) . '</a>';
		}
		if ( $martial_display_hero_button2 === 'yes' ) {
			echo '<a href="' . esc_url( get_theme_mod( 'martial_hero_button2_link', '#' ) ) . '" class="about contact">' . esc_html( get_theme_mod( 'martial_hero_button2_text' ) ) . '</a>';
		}
		?>
	</div>
    
	<div class="clear"></div>

<?php endif;