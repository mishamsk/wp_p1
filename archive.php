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
				<h5><?php p1_breadcrumbs(); ?></h5>
				<h1 class="page-title"><?php echo (is_tag() ? __('All posts tagged: ', 'perlovs') : __('All posts in category: ', 'perlovs')) . single_term_title("", false) ?></h1>
				<?php the_archive_description( '<h6 class="taxonomy-description">', '</h6>' ); ?>
			</header>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
<?php
	get_template_part( 'blogroll');
	get_footer();
?>
