<?php
/**
 * The default template for displaying content. Used for index/archive/search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
	<div class="row">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="small-12 medium-4 large-6 columns">
			<a id="feature-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div> <!-- .small-12 medium-4 xlarge-6 columns -->
		<div class="small-12 medium-8 large-6 columns">
	<?php else : ?>
		<div class="small-12 columns">
	<?php endif; // has_post_thumbnail() ?>
			<div id="content-<?php the_ID(); ?>" class="blogroll-content">
				<header id="header-<?php the_ID(); ?>">
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<h6><?php p1_meta(); ?></h6>
				</header>
				<div class="entry-content">
					<?php
						if( strpos( $post->post_content, '<!--more-->' ) ) {
					        the_content();
					    }
					    else {
					        the_excerpt();
					    }
					?>
				</div>
			</div>
		</div> <!-- .small-12 medium-8 xlarge-6 columns -->
	</div> <!-- .row -->
</article>
