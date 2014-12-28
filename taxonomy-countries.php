<?php get_header(); ?>

<div class="row">
			<div class="small-12 columns">
			<div id="map-canvas" style="width:100%; height: 500px;"></div>
			</div></div>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="small-12 columns">
		<?php get_template_part( 'content', get_post_format() ); ?>
			</div>
		</div>
	<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; // end have_posts() check ?>

<?php p1_pagination(); ?>

<?php get_footer(); ?>
