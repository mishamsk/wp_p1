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
	while (have_posts()) : the_post();
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('card single-article'); ?>>
			<header id="single-header">
				<h5><?php perlovs_breadcrumbs(); ?></h5>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<h6><?php perlovs_meta(); ?></h6>
			</header>

			<div class="entry-content">

				<?php the_content(); ?>
				<?php 	$posttags = get_the_tags();
						if ($posttags) : ?>
					<h6><p class="icon-g-tag post-tags"><?php the_tags('',', ',''); ?></p></h6>
				<?php 	endif; ?>
			</div>
			<footer id="single-footer">

				<?php perlovs_single_pagination(); ?>
				<div class="entry-comments">
					<?php if (is_single() && ( have_comments() || 'open' == $post->comment_status )) { ?>
						<div href="#" class="comment-toggle">
							<?php _e('Leave a thought!', 'perlovs'); ?>
						</div>
					<?php } ?>
					<?php comments_template(); ?>
				</div>
			</footer>
		</article>
<?php
	endwhile;
?>
	</div> <!-- .small-12 columns -->
</div> <!-- .row-->
<?php get_footer(); ?>
