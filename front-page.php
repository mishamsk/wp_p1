<?php get_header(); ?>
<div class="home-wrapper">
	<section id="home-greeting">
		<div class="row">
			<div class="small-12 small-centered columns">
				<div class="logo"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
				<p class="text-center"><?php _e( 'We blog about Life, the Universe, and Everything', 'perlovs' ); ?></p>
			</div> <!-- columns -->
		</div> <!-- row -->
	</section> <!-- #home-greeting -->
	<section id="home-blog">
		<div class="row">
			<div class="small-12 small-centered columns">

			</div> <!-- columns -->
		</div> <!-- row -->
	</section> <!-- #home-blog -->
	<section id="home-travel">
		<div class="row">
			<div class="small-12 small-centered columns">

			</div> <!-- columns -->
		</div> <!-- row -->
	</section> <!-- #home-travel -->
	<section id="home-authors">
		<div class="row">
			<div class="small-12 medium-6 columns">
				<img src="<?php echo get_stylesheet_directory_uri() ?>/img/masha_avatar.jpg">
			</div> <!-- columns -->
			<div class="small-12 medium-6 columns">
				<p>
					Меня зовут Маша!
				</p>
			</div> <!-- columns -->
		</div> <!-- row -->
	</section> <!-- #home-authors -->
	<section id="home-search">
		<div class="row">
			<div class="small-12 small-centered columns">
				<div class="search-container"><?php get_search_form(); ?></div>
			</div> <!-- columns -->
		</div> <!-- row -->
	</section> <!-- #home-search -->
</div>
<?php get_footer(); ?>
