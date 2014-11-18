<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<header>
			<?php p1_breadcrumbs(); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">

			<?php the_content(); ?>

		</div>
		<footer>
			<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'perlovs'), 'after' => '</p></nav>' )); ?>
			<p><?php the_tags(); ?></p>
			<div class="entry-comments"><?php comments_template(); ?></div>
		</footer>
	</article>
<?php endwhile;?>

<?php get_footer(); ?>
