<?php get_header(); ?>
<div class="row">
	<div class="small-12 columns">
<?php
	while (have_posts()) : the_post();
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('container-shadow-lev-1 card'); ?>>
			<header>
				<h5><?php p1_breadcrumbs(); ?></h5>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<h6><?php p1_meta(); ?></h6>
			</header>

			<div class="entry-content">

				<?php the_content(); ?>
				<h6><p class="icon-g-tag post-tags"><?php the_tags('',', ',''); ?></p></h6>
			</div>
			<footer>

				<?php p1_single_pagination(); ?>
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
