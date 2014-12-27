<?php
/**
 * The default template for displaying content. Used for index/archive/search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="feature-image">
		<?php the_post_thumbnail(); ?>
	</div>
	<?php endif; // has_post_thumbnail() ?>
	<div>
		<header>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php // FoundationPress_entry_meta(); ?>
		</header>
		<div class="entry-content">
			<?php the_content(__('Continue reading...', 'perlovs')); ?>
		</div>
	</div>
</article>
