<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; // end have_posts() check ?>

<?php perlovs_pagination(); ?>

<?php get_footer(); ?>
