<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( ! function_exists( 'p1_social' ) ) :
/**
 * Print out social buttons in horizontal icon bar
 */
	function p1_social(  )
	{
		$title = urlencode( get_the_title() );
		$url = urlencode( get_permalink() );
		?>

		<div class="social-bar icon-bar five-up">
		  <a rel="external nofollow" class="item has-tip" href="http://twitter.com/intent/tweet/?url=<?php echo $url; ?>&text=%22<?php echo $title; ?>%22 - это стоит прочесть %23perlovs" target="_blank">
		    <i class="icon-social-twitter"></i>
		  </a>
		</div>
	<?php
	/*
	<a rel="external nofollow" class="ss-facebook" href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo $url; ?>&p[title]=<?php echo $title; ?>" target="_blank" ><span class="ss-icon-facebook"></span><?php echo $facebook_text; ?></a> <?php

        			<a rel="external nofollow" class="ss-googleplus" href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" ><span class="ss-icon-googleplus"></span><?php echo $googleplus_text; ?></a> <?php
		  <a class="item">
		    <i class="fi-bookmark"></i>
		  </a>
		  <a class="item">
		    <i class="fi-info"></i>
		  </a>
		  <a class="item">
		    <i class="fi-mail"></i>
		  </a>
		  <a class="item">
		    <i class="fi-like"></i>
		  </a>
	*/
	}
endif; // p1_social

?>