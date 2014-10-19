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
	<div class="off-canvas-wrap" data-offcanvas>

		<header id="topbar" role="banner" class="fixed off-canvas-fixed">
			<nav class="tab-bar show-for-small-only">
				<section class="left-small">
					<a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
				</section>
				<section class="middle tab-bar-section">
					<h1 class="title"><?php bloginfo( 'name' ); ?></h1>
				</section>
				<section class="right-small">
					<a href="#" class="icon-share"></a>
					<a href="#" class="icon-magnifying-glass"></a>
				</section>
			</nav>
			<aside class="left-off-canvas-menu" aria-hidden="true">
			    <?php menu_mobile_off_canvas(); ?>
			</aside>
			<div class="contain-to-grid">
				<nav class="top-bar show-for-medium-up" data-topbar role="navigation">
					<ul class="title-area">
						<li class="name">
							<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						</li>

						<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
					</ul>

					<section class="top-bar-section">
						<!-- Right But Section -->
						<ul id="menu-nav-but" class="top-bar-menu right">
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
									<li><?php get_search_form(); ?></li>
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
		</header><!-- #topbar -->

		<div id="page" class="inner-wrap">
			<section id="main" role="main">
