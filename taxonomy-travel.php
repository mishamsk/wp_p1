<?php
/*
	Template for archive pages of travel taxonomy
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
				<h1 class="page-title"><?php printf(__('Table of contents for the "%s" trip', 'perlovs'), single_term_title("", false)) ?></h1>
<?php
				the_archive_description( '<h6 class="archive-description">', '</h6>' );
				if (!have_posts()) echo '<h6 class="archive-description">' . __('This trip is empty for now. Come back later!', 'perlovs') . '</h6>';
?>
			</header>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
<?php
	get_template_part( 'blogroll');
	get_footer();
?>
