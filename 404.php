<?php
/*
	Template for 404 page
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
				<div class="err-404">4<span class="icon-sad"></span>4</div>
				<h1 class="page-title"><?php _e('File Not Found', 'perlovs'); ?></h1>
				<h6 class="archive-description"><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. You can try to go <a href="javascript:history.back()">back</a> or use the search below.', 'perlovs'); ?></h6>
			</header>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
<?php
	get_template_part( 'blogroll');
	get_footer();
?>
