<?php get_header(); ?>
	<div class="row">
		<div class="small-12 columns">
			<div class="first-section-header">
				<h1>Здесь можно почитать</h1>
			</div>
		</div> <!-- columns -->
	</div> <!-- row -->
	<div class="row">
		<div class="small-12 medium-6 columns">
			<section id="travel" data-page-name="travel" class="card section-bg-image" <?php perlovs_get_bg_image_style(PERLOVS_TRAVEL_CATEGORY_SLUG) ?>>
				<div class="home-section-title card"><h1><a href="<?php echo esc_url( home_url( '/' ) ) . 'travel'; ?>">О наших путешествиях</a></h1></div>
			</section> <!-- #travel -->
		</div> <!-- columns -->
		<div class="small-12 medium-6 columns">
			<section id="friends-family" data-page-name="friends-family" class="card section-bg-image" <?php perlovs_get_bg_image_style(PERLOVS_FF_CATEGORY_SLUG) ?>>
				<div class="home-section-title card"><h1><a href="<?php echo get_term_link( PERLOVS_FF_CATEGORY_SLUG, 'category' ); ?>">О нашей семье и друзьях</a></h1></div>
			</section> <!-- #friends-family -->
		</div> <!-- columns -->
	</div> <!-- row -->
	<div class="row">
		<div class="small-12 columns">
			<div class="home-section-header">
				<h1>Можно поискать что-нибудь</h1>
			</div>
		</div> <!-- columns -->
	</div> <!-- row -->
	<div class="row">
		<div class="small-12 columns">
			<section id="search" data-page-name="search" class="card">
				<?php perlovs_searchform($form_classes = '', $id = 'home-search-form'); ?>
			</section> <!-- #search-share -->
		</div> <!-- columns -->
	</div> <!-- row -->
	<div class="row">
		<div class="small-12 columns">
			<div class="home-section-header">
				<h1>О нас</h1>
			</div>
		</div> <!-- columns -->
	</div> <!-- row -->
	<div class="row">
		<div class="small-12 columns">
			<section id="about" data-page-name="about" class="card">
				<p>Нас зовут Миша и Маша. Наша семья появилась в Москве в то самое лето, когда температура била все рекорды, а от пожаров город был окутан смогом. С тех пор мы немного подросли и воспитываем двух дочек. Мы оба любим маленькие путешествия, красивые фотографии и, <del>когда найдется время</del>, писать об этом здесь!</p>
			</section>
		</div> <!-- columns -->
	</div> <!-- row -->
	<div class="row">
		<div class="small-12 columns">
			<section id="authors" data-page-name="authors">
				<div class="row">
					<div class="small-12 medium-6 columns">
						<?php perlovs_get_author_card( 'masha' ); ?>
					</div> <!-- columns -->
					<div class="small-12 medium-6 columns">
						<?php perlovs_get_author_card( 'misha' ); ?>
					</div> <!-- columns -->
				</div> <!-- row -->
			</section> <!-- #authors -->
		</div> <!-- columns -->
	</div> <!-- row -->
	<div class="row">
		<div class="small-12 columns">
			<div class="home-section-header">
				<h1>Понравилось? Расскажи друзьям</h1>
			</div>
		</div> <!-- columns -->
	</div> <!-- row -->
	<div class="row">
		<div class="small-12 columns">
			<section id="share" data-page-name="share" class="card">
				<?php perlovs_social($id = 'home-social-share-bar'); ?>
			</section> <!-- #search-share -->
		</div> <!-- columns -->
	</div> <!-- row -->
<?php get_footer(); ?>
