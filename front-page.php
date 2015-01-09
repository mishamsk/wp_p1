<?php get_header();

// Get latest travel and friends & family post thumbnails
$args = array( 'numberposts' => 1, 'post_status' => 'publish', 'category_name' => PERLOVS_TRAVEL_CATEGORY_SLUG);
$recent_posts = wp_get_recent_posts( $args, OBJECT );
$travel_post_id = $recent_posts[0]->ID;
$travel_bg_image = '';

if ( get_the_post_thumbnail( $travel_post_id, 'full' )) {
	$travel_bg_image = get_the_post_thumbnail( $travel_post_id, 'full' );
	$preg_ar = array();
	preg_match('/src="([^"]*)"/i', $travel_bg_image, $preg_ar);
	$travel_bg_image = 'background-image: url(' . $preg_ar[1] . ');';
}

$args = array( 'numberposts' => 1, 'post_status' => 'publish', 'category_name' => PERLOVS_FF_CATEGORY_SLUG);
$recent_posts = wp_get_recent_posts( $args, OBJECT );
$ff_post_id = $recent_posts[0]->ID;
$ff_bg_image = '';

if ( get_the_post_thumbnail( $ff_post_id, 'full' )) {
	$ff_bg_image = get_the_post_thumbnail( $ff_post_id, 'full' );
	$preg_ar = array();
	preg_match('/src="([^"]*)"/i', $ff_bg_image, $preg_ar);
	$ff_bg_image = 'background-image: url(' . $preg_ar[1] . ');';
}

?>
	<div class="row">
		<div class="small-12 columns">
			<div class="first-section-header">
				<h1>Здесь можно почитать</h1>
			</div>
		</div> <!-- columns -->
	</div> <!-- row -->
	<div class="row">
		<div class="small-12 medium-6 columns">
			<section id="travel" data-page-name="travel" class="card section-bg-image" <?php if ($travel_bg_image != '') echo 'style="' . $travel_bg_image . '"'?>>
				<div class="home-section-title card"><h1><a href="<?php echo esc_url( home_url( '/' ) ) . 'travel'; ?>">О наших путешествиях</a></h1></div>
			</section> <!-- #travel -->
		</div> <!-- columns -->
		<div class="small-12 medium-6 columns">
			<section id="friends-family" data-page-name="friends-family" class="card section-bg-image" <?php if ($ff_bg_image != '') echo 'style="' . $ff_bg_image . '"'?>>
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
			<section id="authors" data-page-name="authors">
				<div class="row">
					<div class="small-12 medium-6 columns">
						<div id="author-masha" class="card author-card">
							<a href="<?php echo get_author_posts_url(get_user_by( 'login', 'masha' )->ID); ?>"><img class="author-avatar" src="<?php echo get_stylesheet_directory_uri() ?>/img/masha-avatar.jpg"></a>
							<h1 class="author-name"><a href="<?php echo get_author_posts_url(get_user_by( 'login', 'masha' )->ID); ?>">Маша</a></h1>
							<p class="author-answer" data-question="Снимаю на">Зенит</p>
						</div>
					</div> <!-- columns -->
					<div class="small-12 medium-6 columns">
						<div id="author-misha" class="card author-card">
							<a href="<?php echo get_author_posts_url(get_user_by( 'login', 'misha' )->ID); ?>"><img class="author-avatar" src="<?php echo get_stylesheet_directory_uri() ?>/img/misha-avatar.jpg"></a>
							<h1 class="author-name"><a href="<?php echo get_author_posts_url(get_user_by( 'login', 'misha' )->ID); ?>">Миша</a></h1>
							<p class="author-answer" data-question="Снимаю на">Nikon D700</p>
						</div>
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
