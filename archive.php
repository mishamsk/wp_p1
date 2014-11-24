<?php get_header(); ?>

<?php
if ( have_posts() ) :
	$count = 1;

	while ( have_posts() ) :
		the_post();
		if ($count % 2 == 1) :
			if ($count > 1)	:
?>
			</div> <!-- .row-->
<?php
			endif; // $count > 1
?>
			<div class="row">
<?php
		endif; // $count % 2 == 1
?>
				<div class="small-12 large-6 columns">
<?php
					get_template_part( 'content', get_post_format() );
?>
				</div> <!-- .small-12 large-6 columns -->
<?php
		$count += 1;
	endwhile;
?>
			</div> <!-- .row-->
<?php
else :
	get_template_part( 'content', 'none' );

endif; // end have_posts() check

p1_pagination();
?>

<?php get_footer(); ?>
