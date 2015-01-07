<?php
/*
	General template for archive pages, works for regular categories, tags
*/

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

	get_header();
?>
	<div class="row">
		<div class="small-12 columns">
			<header id="archive-header">
				<h5><?php perlovs_breadcrumbs(); ?></h5>
				<h1 class="page-title"><?php echo have_posts() ? __('Look what we\'ve found!', 'perlovs') : __('Good things come to those who wait!', 'perlovs') ?></h1>
<?php
				if (!have_posts()) echo '<h6 class="archive-description">' . __('Sorry, we have tried but could not find what you were looking for. Please try something different ;-)', 'perlovs') . '</h6>';
?>
			</header>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
<?php
	if (have_posts()) :
?>
	<div class="row">
		<div class="small-12 columns">
			<?php perlovs_searchform($form_classes = 'card', $id = 'search-page-search'); ?>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
<?php
	endif; // end have_posts() check

	get_template_part( 'blogroll');
	get_footer();
?>
