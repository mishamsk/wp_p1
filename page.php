<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

get_header(); ?>
<div class="row">
	<div class="small-12 columns">
<?php
	while (have_posts()) :
		the_post();
		global $multipage;
?>
		<article id="page-<?php the_ID(); ?>" <?php post_class('card single-article'); ?>>
			<header id="single-header">
				<h5><?php perlovs_breadcrumbs(); ?></h5>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content">

				<?php the_content(); ?>

			</div>
<?php
		if ($multipage) :
?>
			<footer id="single-footer">

				<?php perlovs_single_pagination($prev_next = FALSE); ?>

			</footer>
<?php
		endif;
?>
		</article>
<?php
	endwhile;
?>
	</div> <!-- .small-12 columns -->
</div> <!-- .row-->
<?php get_footer(); ?>
