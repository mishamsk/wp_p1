<?php get_header(); ?>
<section id="home-greeting">
	<div class="row">
		<div class="small-12 small-centered columns">
			<div class="logo text-center"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
			<p class="text-center"><?php _e( 'We blog about travel, friends, family and everything', 'perlovs' ); ?></p>
		</div> <!-- columns -->
	</div> <!-- row -->
</section> <!-- section -->
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
	<div class="row">
		<div class="small-12 medium-6 columns">
			<p>Меня зовут Миша!</p>
		</div> <!-- columns -->
		<div class="small-12 medium-6 columns">
			<img src="<?php echo get_stylesheet_directory_uri() ?>/img/misha_avatar.jpg">
		</div> <!-- columns -->
	</div> <!-- row -->
</section> <!-- row -->
<section id="home-travel">
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
	<div class="row">
		<div class="small-12 medium-6 columns">
			<p>Меня зовут Миша!</p>
		</div> <!-- columns -->
		<div class="small-12 medium-6 columns">
			<img src="<?php echo get_stylesheet_directory_uri() ?>/img/misha_avatar.jpg">
		</div> <!-- columns -->
	</div> <!-- row -->
</section> <!-- row -->
<section id="home-search">
	<div class="row">
		<div class="small-12 columns">
			<div class="search-container"><?php get_search_form(); ?></div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
