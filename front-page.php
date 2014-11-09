<?php get_header(); ?>
	<section id="home-greeting" data-page-name="home">
		<div class="row">
			<div class="small-12 columns">
				<div class="logo"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
				<p class="text-center"><?php _e( 'We blog about Life, the Universe, and Everything', 'perlovs' ); ?></p>
			</div> <!-- columns -->
		</div> <!-- row -->
	</section> <!-- #home-greeting -->
	<section id="home-blog" data-page-name="blog">
		<?php
		$qblog = new WP_Query(array(
			    'posts_per_page'   => 3,
			    'post_type' => 'post',
			    'meta_key' => '_thumbnail_id'
			));

		if ( $qblog->have_posts() ) : ?>
			<div class="row">
				<div class="small-12 medium-6 columns">
					<?php $qblog->the_post(); ?>
					<div class="article-wrapper">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header>
								<?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<?php // FoundationPress_entry_meta(); ?>
							</header>
							<div class="entry-content">
								<?php
									global $more;    // Declare global $more (before the loop).
									$more = 0;
									the_content(__('Continue reading...', 'perlovs')); ?>
							</div>
						</article>
					</div> <!-- .article-wrapper -->
				</div> <!-- columns -->
				<div class="small-12 medium-6 columns">
					<div class="row">
						<div class="small-12 columns">
							<?php if ( $qblog->have_posts() ) :
									$qblog->the_post(); ?>
								<div class="article-wrapper">
									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<header>
											<?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
											<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<?php // prelovs_entry_meta(); ?>
										</header>
										<div class="entry-content">
											<?php
												global $more;    // Declare global $more (before the loop).
												$more = 0;
												the_content(__('Continue reading...', 'perlovs')); ?>
										</div>
									</article>
								</div>
							<?php else : ?>
								<article class="empty">
									<?php _e( 'That is all for now. We have to write more...', 'perlovs' ); ?>
								</article>
							<?php endif; ?>
						</div> <!-- columns -->
						<div class="small-12 columns">
							<?php if ( $qblog->have_posts() ) :
									$qblog->the_post(); ?>
								<div class="article-wrapper">
									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<header>
											<?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?>
											<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<?php // prelovs_entry_meta(); ?>
										</header>
										<div class="entry-content">
											<?php
												global $more;    // Declare global $more (before the loop).
												$more = 0;
												the_content(__('Continue reading...', 'perlovs')); ?>
										</div>
									</article>
								</div>
							<?php else : ?>
								<article class="empty">
									<?php _e( 'That is all for now. We have to write more...', 'perlovs' ); ?>
								</article>
							<?php endif; ?>
						</div> <!-- columns -->
					</div> <!-- row -->
				</div> <!-- columns -->
			</div> <!-- row -->
		<?php else : ?>
			<div class="row">
				<div class="small-8 small-centered columns">
					<h1 class="text-center"><?php _e( 'Oops, nothing have been posted in here yet...', 'perlovs' ); ?></h1>
				</div> <!-- columns -->
			</div> <!-- row -->
		<?php
		endif; // if ( $qblog->have_posts() ) :

		wp_reset_postdata();  ?>
	</section> <!-- #home-blog -->
	<section id="home-travel" data-page-name="travel">
		<div class="row">
			<div class="small-12 small-centered columns">

			</div> <!-- columns -->
		</div> <!-- row -->
	</section> <!-- #home-travel -->
	<section id="home-authors" data-page-name="authors">
		<div class="row">
			<div class="small-12 medium-6 columns">
				<img src="<?php echo get_stylesheet_directory_uri() ?>/img/masha-avatar.jpg">
			</div> <!-- columns -->
			<div class="small-12 medium-6 columns">
				<p>
					Меня зовут Маша!
				</p>
			</div> <!-- columns -->
		</div> <!-- row -->
	</section> <!-- #home-authors -->
<?php get_footer(); ?>
