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
	<div id="page">
		<header id="topbar" role="banner" class="contain-to-grid fixed">
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
					<li class="name">
						<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><small id="topbar-blog-desc" class="show-for-medium-up"><?php bloginfo( 'description' ); ?></small></h1>
					</li>

					<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
				</ul>

				<section class="top-bar-section">
					<!-- Right Nav Section -->
					<ul class="right">
						<li class="active"><a href="#">Right Button Active</a></li>
						<li class="has-dropdown">
							<a href="#">Right Button Dropdown</a>
							<ul class="dropdown">
								<li><a href="#">First link in dropdown</a></li>
								<li class="active"><a href="#">Active link in dropdown</a></li>
							</ul>
						</li>
					</ul>

					<!-- Left Nav Section -->
					<ul class="left">
						<li><a href="#">Left Nav Button</a></li>
					</ul>
				</section>
			</nav>
		</header><!-- #topbar -->

		<section id="main" role="main">
