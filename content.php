<?php
/**
 * The default template for displaying content. Used for index/archive/search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="small-12 medium-6 large-8 column">
			<?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
		</div>
		<div class="small-12 medium-6 large-4 column">
			<header>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php // FoundationPress_entry_meta(); ?>
			</header>
			<div class="entry-content">
				<?php the_content(__('Continue reading...', 'perlovs')); ?>
			</div>
		</div>
	</div> <!-- .row -->
</article>
