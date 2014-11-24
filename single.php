<?php get_header(); ?>
<div class="row">
	<div class="small-12 columns">
<?php
	while (have_posts()) : the_post();
?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content">

				<?php the_content(); ?>

			</div>
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'perlovs'), 'after' => '</p></nav>' )); ?>
				<p><?php the_tags(); ?></p>
				<div class="entry-comments">
					<?php if (is_single() && ( have_comments() || 'open' == $post->comment_status )) { ?>
						<button href="#" class="expand radius comment-toggle">
							<?php _e('Leave a thought!', 'perlovs'); ?>
						</button>
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
