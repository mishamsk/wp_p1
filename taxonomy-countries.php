<?php
/*
	Template for archive pages of countries taxonomy
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
				<h1 class="page-title"><?php printf(__('%s: all posts about this country', 'perlovs'), single_term_title("", false)) ?></h1>
<?php
				if (!have_posts()) echo '<h6 class="archive-description">' . __('Unfortunately we have never visited this country, but we certainly are going to do this in future. For now you can select a different country or search for other posts below!', 'perlovs') . '</h6>';
?>
				<div id="archive-countrypicker">
					<h6><?php _e('Other countries: ', 'perlovs'); perlovs_get_country_links(); ?></h6>
					<button href="#" class="gmaps-toggle"><?php _e('Show on map', 'perlovs') ?></button>
				</div>
			</header>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
<?php
	get_template_part( 'blogroll');
	get_footer();
?>
