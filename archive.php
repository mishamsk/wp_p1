<?php get_header(); ?>
<div class="row">
	<div class="small-12 columns" role="main">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; // end have_posts() check ?>

	<?php p1_pagination(); ?>

	</div> <!-- columns -->
</div> <!-- row -->
<?php get_footer(); ?>
