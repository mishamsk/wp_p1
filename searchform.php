<?php
/**
*	Serach form template
*/
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<p class="search-label"><?php _e( 'Search', 'perlovs' )?></p>
	<input type="text" class="search-field" placeholder="<?php if(is_front_page()) {
				_e( 'Looking for something? Just search...', 'perlovs' );
			}
			else {
				_e( 'Type in and hit enter...', 'perlovs' );
			}?>" value="" name="s" />
	<input type="hidden" value="post" name="post_type" id="post_type" />
	<input type="submit" class="search-submit" value="<?php _e( 'Go!', 'perlovs' )?>" />
</form>