<?php
/**
 * The default template for displaying blog roll (assumes that wp_query is set). Used for index/archive/search.
 */

	if ( ! defined( 'ABSPATH' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit;
	}

?>

<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
?>
			<div class="row">
				<div class="small-12 columns">
<?php
					get_template_part( 'content', get_post_format() );
?>
				</div> <!-- .small-12 columns -->
			</div> <!-- .row-->
<?php
		endwhile;

		perlovs_pagination();
	else :
		get_template_part( 'content', 'none' );
	endif; // end have_posts() check
?>
