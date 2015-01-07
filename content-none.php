<?php
/**
 * The template for displaying a "No posts found" message
 */

	if ( ! defined( 'ABSPATH' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit;
	}

?>

	<div class="row">
		<div class="small-12 columns">
			<?php perlovs_searchform($form_classes = 'card', $id = 'empty-page-search'); ?>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
	<div class="row">
		<div class="small-12 columns">
			<h1 class="secondary-title"><?php _e('Recent posts', 'perlovs'); ?></h1>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->

<?php
	$args = array( 'numberposts' => 5, 'post_status'=> 'publish');
	$recent_posts = wp_get_recent_posts( $args, OBJECT );

	foreach ( $recent_posts as $post ) : setup_postdata( $post ); ?>
		<div class="row">
			<div class="small-12 columns">
<?php
				get_template_part( 'content', get_post_format() );
?>
			</div> <!-- .small-12 columns -->
		</div> <!-- .row-->
<?php
	endforeach;

	wp_reset_postdata();
?>