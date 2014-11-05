<?php get_header(); ?>
<section id="home-greeting">
	<div class="row">
		<div class="small-12 small-centered columns">
			<div class="logo"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
			<p class="text-center"><?php _e( 'We blog about Life, the Universe, and Everything', 'perlovs' ); ?></p>
		</div> <!-- columns -->
	</div> <!-- row -->
	<a href="#authors"><div class="arrow bounce"></div></a>
</section> <!-- section -->
<section id="home-authors">
	<a name="authors"></a>
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
</section> <!-- row -->
<section id="home-travel">

</section> <!-- row -->
<section id="home-search">
	<div class="row">
		<div class="small-12 columns">
			<div class="search-container"><?php get_search_form(); ?></div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
