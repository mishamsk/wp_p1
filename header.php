<?php
/**
 * The Header for our theme
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!--[if lt IE 9]>
	<div class="ie-support" style="width: 700px; height: 400px; margin: 0 auto; font-size: 40px;">
		Извините, но этот сайт не поддерживает ваш бразуер (IE 8 и младше).</br>
		Гораздо лучше и приятнее смотреть его в чем-то более современном!;)
	</div>
	<![endif]-->
	<?php
		// Front-page do not use navigation
		if (!is_front_page()) : ?>
	<div class="off-canvas-wrap" data-offcanvas>

		<header id="header" role="banner" class="fixed off-canvas-fixed">
			<nav class="tab-bar show-for-small-only">
				<section class="tab-bar-title">
					<!-- <h1 class="text-left title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> -->
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><div class="logo"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></a>
				</section>
				<section class="tab-bar-buttons">
					<a href="#" data-reveal-id="search-share-modal" class="icon-share"><span></span></a>
					<a id="tab-bar-search-toggle" href="#" data-reveal-id="search-share-modal" class="icon-magnifying-glass"><span></span></a>
				</section>
				<section class="right-small">
					<a class="right-off-canvas-toggle menu-icon" href="#"><span></span></a>
				</section>
				<div id="search-share-modal" class="reveal-modal large" data-reveal>
					<h1 class="text-center"><?php _e( 'Share if you care,', 'perlovs' ); ?></h1>
					<div class="row collapse"><div class="small-12 columns"><?php p1_social(); ?></div></div>
					<h1 class="text-center"><?php _e( 'or search for more...', 'perlovs' ); ?></h1>
					<div class="search-container"><?php get_search_form(); ?></div>
					<a class="close-reveal-modal">&#215;</a>
				</div>
			</nav>
			<aside class="right-off-canvas-menu" aria-hidden="true">
			    <?php menu_mobile_off_canvas(); ?>
			</aside>
			<div class="contain-to-grid">
				<nav class="top-bar show-for-medium-up" data-topbar role="navigation">
					<ul class="title-area">
						<!-- <li class="name">
							<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						</li>-->
 						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><div class="logo"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></a>
						<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
					</ul>

					<section class="top-bar-section">
						<!-- Right But Section -->
						<ul class="top-bar-menu right">
							<li class="divider"></li>
							<li class="has-dropdown">
								<a href="#" class="icon-share"></a>
								<ul class="dropdown">
									<li><?php p1_social(); ?></li>
								</ul>
							</li>
							<li class="divider"></li>
							<li class="has-dropdown search-toggle">
								<a href="#" class="icon-magnifying-glass"></a>
								<ul class="dropdown">
									<li>
										<div class="search-container">
											<?php get_search_form(); ?>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</section>
					<section class="top-bar-section">
						<!-- Right Nav Section -->
						<?php menu_top_bar_r(); ?>
					</section>
				</nav>
			</div>
			<a class="exit-off-canvas"></a>
		</header><!-- #header -->

		<div id="page" class="inner-wrap">
		<?php endif; // end !is_front_page() check ?>
			<section id="main" role="main">
