<?php
/**
 * The Header for our theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link rel="icon" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/favicon.ico" type="image/x-icon">
	<link rel="icon" sizes="192x122" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/perlovs-icon-192x192.png">
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/perlovs-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/perlovs-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/perlovs-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri() ; ?>/img/icons/perlovs-icon-152x152.png">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<!--[if lt IE 9]>
	<div class="ie-support" style="width: 700px; height: 100%; margin: 0 auto; font-size: 40px;">
		Извините, но этот сайт не поддерживает ваш бразуер (IE 8 и младше).</br>
		Гораздо лучше и приятнее смотреть его в чем-то более современном!;)
	</div>
	<![endif]-->
	<div id="page-wrapper">
		<aside id="off-canvas-menu" aria-hidden="true">
			<?php menu_mobile_off_canvas(); ?>
			<a class="exit-off-canvas"></a>
		</aside>
		<header id="page-header" role="banner" data-page-name="home">
			<div class="tab-bar row">
				<a href="#" class="off-canvas-toggle icon-g-menu"></a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title" rel="home"><?php bloginfo( 'name' ); ?></a>
				<?php $description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
				<?php endif; ?>
			</div>
			<nav id="float-nav" role="navigation">
				<a href="#" class="off-canvas-toggle icon-g-menu"></a>
				<div class="social-container">
					<a href="#" class="share-toggle icon-g-share nav-toggle"></a>
					<?php perlovs_social($id = 'float-nav-social-share'); ?>
				</div>
				<div class="search-container">
					<a href="#" class="search-toggle icon-g-search nav-toggle"></a>
					<div class="search-form-container nav-toggle"><?php perlovs_searchform($form_classes = 'card', $id = 'float-nav-search'); ?></div>
				</div>
				<?php if (is_single() && ( have_comments() || 'open' == $post->comment_status )) { ?><a href="#" class="comment-toggle icon-g-comment"></a><?php } ?>
			</nav>
		</header><!-- #page-header -->
		<section id="main" role="main">
