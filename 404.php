<?php get_header(); ?>

<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<header>
		<h1 class="entry-title"><?php _e('File Not Found', 'perlovs'); ?></h1>
	</header>
	<div class="entry-content">
		<div class="error">
			<p class="bottom"><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'perlovs'); ?></p>
		</div>
		<p><?php _e('Please try the following:', 'perlovs'); ?></p>
		<ul>
			<li><?php _e('Check your spelling', 'perlovs'); ?></li>
			<li><?php printf(__('Return to the <a href="%s">home page</a>', 'perlovs'), home_url()); ?></li>
			<li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'perlovs'); ?></li>
		</ul>
	</div>
</article>

<?php get_footer(); ?>
