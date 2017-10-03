<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package martial
 */
?>

<div id="sidebar">
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ):
		dynamic_sidebar( 'sidebar-1' );
	endif;
	?>
</div>
