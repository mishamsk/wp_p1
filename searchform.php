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
	<div class="row">
		<div class="small-12 columns">
			<input id="search-field" type="text" class="search-field" placeholder="<?php _e( 'Search for...', 'perlovs' )?>" value="" name="s" />
			<input type="hidden" value="post" name="post_type" id="post_type" />
			<input type="submit" class="search-submit" value="<?php __( 'Go!', 'perlovs' )?>" />
		</div>
	</div>
</form>