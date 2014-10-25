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
	<input type="text" class="search-field" placeholder="<?php _e( 'Type in and hit enter...', 'perlovs' )?>" value="" name="s" />
	<input type="hidden" value="post" name="post_type" id="post_type" />
	<input type="submit" class="search-submit" value="<?php __( 'Go!', 'perlovs' )?>" />
</form>
