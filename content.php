<?php
/**
 * The default template for displaying content. Used for index/archive/search.
 */

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

global $post;

$article_bg_image = '';
$use_bg_image = (in_category( PERLOVS_FF_CATEGORY_SLUG ) || in_category( PERLOVS_TRAVEL_CATEGORY_SLUG ) || has_term('', 'travel') || has_term('', 'countries') || get_post_meta( get_the_ID(), 'featured_bg', true ));

if ( has_post_thumbnail() && $use_bg_image && get_the_post_thumbnail( $post->ID, 'full' )) {
	$article_bg_image = get_the_post_thumbnail( $post->ID, 'full' );
	$preg_ar = array();
	preg_match('/src="([^"]*)"/i', $article_bg_image, $preg_ar);
	$article_bg_image = 'background-image: url(' . $preg_ar[1] . ');';
}

$use_bg_image = $use_bg_image && $article_bg_image != '';

?>

<article id="post-<?php the_ID(); ?>" <?php $use_bg_image ? post_class('card archive-article archive-article-bg-image') : post_class('card archive-article'); if ($article_bg_image != '') echo 'style="' . $article_bg_image . '"'?>>
	<div class="row">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="small-12 medium-6 columns">
			<?php if ( !$use_bg_image) : ?>
				<a id="feature-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('medium'); ?>
				</a>
			<?php else : ?>
				<div class="archive-article-placeholder"></div>
			<?php endif; // has_post_thumbnail() && !(is_category( PERLOVS_FF_CATEGORY_SLUG ) || is_category( PERLOVS_TRAVEL_CATEGORY_SLUG ) || is_tax('travel') || is_tax('countries') ?>
		</div> <!-- .small-12 medium-4 xlarge-6 columns -->
		<div class="small-12 medium-6 columns">
	<?php else : ?>
		<div class="small-12 columns">
	<?php endif; // has_post_thumbnail() ?>
			<div id="content-<?php the_ID(); ?>" class="archive-article-content <?php if ($use_bg_image) echo 'card'; ?>">
				<header id="header-<?php the_ID(); ?>">
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<h6><?php perlovs_meta(); ?></h6>
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
				<footer class="archive-article-footer">
					<a class="more-link button" id="more-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('Continue reading...', 'perlovs'); ?></a>
				</footer>
			</div>
		</div> <!-- .small-12 medium-8 xlarge-6 columns -->
	</div> <!-- .row -->
</article>
