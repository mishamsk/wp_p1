<?php
/*
Template Name: Travel index
*/
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

	get_header(); ?>

	<div class="row">
		<div class="small-12 columns">
			<header id="archive-header">
				<h5><?php perlovs_breadcrumbs(); ?></h5>
				<h1>Все наши путешествия</h1>
			</header>
		</div> <!-- columns -->
	</div> <!-- row -->
<?php
	$args = array( 'hide_empty' => '1');
	$terms = get_terms( 'travel', $args );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
	    foreach ( $terms as $term ) {
?>
			<div class="row">
				<div class="small-12 columns">
					<article id="travel-<?php echo $term->term_id; ?>" class="card archive-article archive-article-bg-image" <?php perlovs_get_tax_bg_image_style('travel', $term->slug); ?>>
						<div class="row">
							<div class="small-12 medium-6 columns">
								<div class="archive-article-placeholder"></div>
							</div> <!-- .small-12 medium-6 columns -->
							<div class="small-12 medium-6 columns">
								<div id="content-<?php echo $term->term_id; ?>" class="archive-article-content card">
									<header id="header-<?php echo $term->term_id; ?>">
										<h1><a href="<?php echo get_term_link( $term ); ?>" title="<?php echo sprintf( _x( 'View all post from %s', 'countries list', 'perlovs' ), $term->name ); ?>"><?php echo $term->name; ?></a></h1>
									</header>
									<div class="entry-content">
										<?php
											echo $term->description;
										?>
									</div>
								</div>
							</div> <!-- .small-12 medium-6 columns -->
						</div> <!-- .row -->
					</article>
				</div> <!-- .small-12 columns -->
			</div> <!-- .row -->
<?php
	    }
	}
?>
	<div class="row">
		<div class="small-12 columns">
			<div class="secondary-title"><h1>Страны</h1></div>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
	<div class="row">
<?php
	$args = array( 'hide_empty' => '1');
	$terms = get_terms( 'countries', $args );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
	    foreach ( $terms as $term ) {
?>
		<article class="archive-travel-country" style="background-image: url(http://www.geonames.org/flags/x/<?php echo $term->description; ?>.gif);">
			<a href="<?php echo get_term_link( $term ); ?>" title="<?php echo sprintf( _x( 'View all post from %s', 'countries list', 'perlovs' ), $term->name ); ?>"><?php echo $term->name; ?></a>
		</article>
<?php
	    }
	}
?>
	</div> <!-- row -->
	<div class="row">
		<div class="small-12 columns">
			<div id="archive-travel-map">
				<button href="#" class="gmaps-toggle"><?php _e('Show on map', 'perlovs') ?></button>
			</div>
		</div> <!-- columns -->
	</div> <!-- row -->

<?php get_footer(); ?>
