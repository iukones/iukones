<?php
/**
 * @Theme: Martial
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
	<!--[if lt IE 9]>
	<script type="text/javascript">
		document.createElement("header");
		document.createElement("nav");
		document.createElement("section");
		document.createElement("article");
		document.createElement("aside");
		document.createElement("footer");
	</script>
	<![endif]-->
</head>
<body <?php body_class(); ?>>
<!-- wrapper starts -->
<div class="wrapper">

	<!-- Header Starts -->
	<header>
		<div class="header_in">
			<div class="logo">
				<a href="<?php echo esc_url( home_url() ); ?>" rel="home">
					<?php
					$martial_display_header_logo = get_theme_mod( 'martial_header_logo_show', 'text' );
					if ( $martial_display_header_logo === 'logo' ) {
						echo '<img src="' . esc_url( get_theme_mod( 'martial_header_logo_image' ) ) . '" alt="logo">';
						echo '<h1 class="header-logo" style="display: none;">' . esc_html( get_theme_mod( 'martial_header_logo_text' ) ) . '</h1>';
					} else {
						$martial_site_title = esc_html( get_theme_mod( 'blogname', get_bloginfo( 'name' ) ) );
						$martial_tagline = esc_html( get_theme_mod( 'blogdescription', get_bloginfo( 'description' ) ) );
						echo '<img style="display: none;" src="' . esc_url( get_theme_mod( 'martial_header_logo_image' ) ) . '" />';
						echo '<h1 class="header-logo"><span id="site-title">' . $martial_site_title . '</span>' . ( $martial_tagline ? ' ' . '<br /><span id="tagline">' . $martial_tagline . '</span>' : '' ) . '</h1>';
					}
					?>

				</a>
			</div>
			<nav>
				<div id="cssmenu">
					<div class="menu_icon"><a><img
								src="<?php echo get_template_directory_uri(); ?>/images/menu_icon.png" width="30"
								height="30" alt="menu_icon"></a></div>
					<?php
					global $wp_customize;
					if ( !empty( $wp_customize ) && $wp_customize->is_preview() && !get_theme_mod( 'martial_content_set', false ) ) {
						?>
						<ul>
							<li id="menu-item-16"
								class="menu-item">
								<a href="#">Home</a></li>
							<li id="menu-item-17"
								class="menu-item">
								<a href="#">Pricing</a></li>
							<li id="menu-item-21"
								class="menu-item">
								<a href="#">Blog</a></li>
							<li id="menu-item-22"
								class="menu-item">
								<a href="#">Contact</a></li>
							<li id="menu-item-23"
								class="menu-item">
								<a href="#">Members</a></li>
							<li id="menu-item-24"
								class="menu-item">
								<a href="#">Signup</a></li>
						</ul>
					<?php
					} else {
						wp_nav_menu( array(
								'theme_location' => 'primary',
								'container'      => false,
								'items_wrap'     => '<ul>%3$s</ul>',
								'depth'          => 0,
								'fallback_cb'    => 'martial_fallback_menu',
							)
						);
					}
					?>
				</div>
			</nav>
		</div>
		<div class="clear"></div>
	</div>
</header>
<!-- Header ends -->
<?php
$martial_banner_class = '';
if ( !is_front_page() ) {
	$martial_hero_hide_on_inner_pages = get_theme_mod( 'martial_hero_hide_on_inner_pages', 'yes' );
	if ( $martial_hero_hide_on_inner_pages === 'yes' ) {
		$martial_banner_class = 'strip-50';
	}
}
?>
<div class="banner <?php echo $martial_banner_class; ?>">
	<div class="banner-bg"></div>
	<?php
	$martial_hero_overlay_enabled = get_theme_mod( 'martial_hero_overlay_enabled', 'no' );
	$hidden = '';
	if ( $martial_hero_overlay_enabled === 'no' ) {
		$hidden = 'hidden';
	}
	echo '<div class="banner-bg-overlay ' . $hidden . '"></div>';
	?>

	<section class="banner_in">
		<div class="banner_left">

			<?php get_template_part( 'inc/partials/content', 'header-hero' ); ?>
			<?php get_template_part( 'inc/partials/content', 'header-social' ); ?>

			<div class="clear"></div>
		</div>

	</section>
</div>