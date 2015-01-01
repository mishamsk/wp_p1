<?php
	/*
		General template for archive pages, works for regular categories, tags
	*/
	get_header();
?>
	<div class="row">
		<div class="small-12 columns">
			<header id="category-header" class="card">
				<h5><?php p1_breadcrumbs(); ?></h5>
<?php
				the_archive_title( '<h1 class="page-title">' . __('All posts in ', 'perlovs'), '</h1>' );
				the_archive_description( '<h6 class="taxonomy-description">', '</h6>' );
?>
			</header>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
<?php
	get_template_part( 'blogroll');
	get_footer();
?>
