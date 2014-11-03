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
		  <a id="social-facebook" rel="external nofollow" class="item has-tip" href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo $url; ?>&p[title]=<?php echo $title; ?>" target="_blank" data-tooltip data-options="disable_for_touch:true; show_on:large" aria-haspopup="true" title="Поделись в Facebook!">
		    <i class="icon-social-facebook"></i>
		  </a>
		  <a id="social-twitter" rel="external nofollow" class="item has-tip" href="http://twitter.com/intent/tweet/?url=<?php echo $url; ?>&text=%22<?php echo $title; ?>%22 - это стоит прочесть %23perlovs" target="_blank" data-tooltip data-options="disable_for_touch:true; show_on:large" aria-haspopup="true" title="Поделись в Твиттере!">
		    <i class="icon-social-twitter"></i>
		  </a>
		  <a id="social-vk" rel="external nofollow" class="item has-tip" href="http://vk.com/share.php?url=<?php echo $url; ?>" target="_blank" data-tooltip data-options="disable_for_touch:true; show_on:large" aria-haspopup="true" title="Поделись во Вконтакте!">
		    <i class="icon-social-vk"></i>
		  </a>
		  <a id="social-google-plus" rel="external nofollow" class="item has-tip" href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" data-tooltip data-options="disable_for_touch:true; show_on:large" aria-haspopup="true" title="Поделись в G+!">
		    <i class="icon-social-google-plus"></i>
		  </a>
		  <a id="social-email" rel="external nofollow" class="item has-tip" href="mailto:?subject=Интересная статья на сайте perlovs.com&body=Интересная статья: &lt;a href%25%22<?php echo $url; ?>%22&rt;<?php echo $title; ?>&lt;%2Fa&rt;" target="_blank" data-tooltip data-options="disable_for_touch:true; show_on:large" aria-haspopup="true" title="Отправь ссылку по почте">
		    <i class="icon-at-sign"></i>
		  </a>
		</div>

	<?php
	}
endif; // p1_social

?>