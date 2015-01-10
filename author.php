<?php
/*
	Template for author blog archive
*/

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

	get_header();

	$author_login = get_queried_object()->user_login;
?>
	<div class="row">
		<div class="small-12 columns">
			<header id="archive-header">
				<h5><?php perlovs_breadcrumbs(); ?></h5>
				<?php perlovs_get_author_card( $author_login ); ?>
				<h1 class="page-title"><?php _e('This is my blog', 'perlovs'); ?></h1>
<?php
				if (!have_posts()) echo '<h6 class="archive-description">' . __('I have not written anything yet  ;-( But you can search for something different', 'perlovs') . '</h6>';
?>
			</header>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
<?php
	get_template_part( 'blogroll');
	get_footer();
?>
