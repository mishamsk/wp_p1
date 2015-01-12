<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
*
*	Social partials
*
*/

if ( ! function_exists( 'perlovs_social' ) ) :
/**
 * Print out social buttons in horizontal icon bar
 */
	function perlovs_social($id = NULL)
	{
		$title = urlencode( get_the_title() );
		$url = urlencode( get_permalink() );
		?>

		<div <?php echo $id ? 'id="' . $id . '"' : ''; ?> class="social-sharing-bar">
		  <a class="social-facebook" rel="external nofollow" href="https://www.facebook.com/dialog/share?app_id=386141574823982&amp;display=popup&amp;href=<?php echo $url; ?>&amp;redirect_uri=<?php echo $url; ?>" target="_blank" title="Поделись в Facebook!">
		    <i class="icon-social-facebook"></i>
		  </a>
		  <a class="social-twitter" rel="external nofollow" href="http://twitter.com/intent/tweet/?url=<?php echo $url; ?>&amp;text=%22<?php echo $title; ?>%22 - это стоит прочесть %23perlovs" target="_blank" title="Поделись в Твиттере!">
		    <i class="icon-social-twitter"></i>
		  </a>
		  <a class="social-vk" rel="external nofollow" href="http://vk.com/share.php?url=<?php echo $url; ?>" target="_blank" title="Поделись во Вконтакте!">
		    <i class="icon-social-vk"></i>
		  </a>
		  <a class="social-google-plus" rel="external nofollow" href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" title="Поделись в G+!">
		    <i class="icon-social-google-plus"></i>
		  </a>
		  <a class="social-email" rel="external nofollow" href="mailto:?subject=Интересная статья на сайте perlovs.com&amp;body=Интересная статья: &lt;a href%25%22<?php echo $url; ?>%22&rt;<?php echo $title; ?>&lt;%2Fa&rt;" target="_blank" title="Отправь ссылку по почте">
		    <i class="icon-at-sign"></i>
		  </a>
		</div>

	<?php
	}
endif; // perlovs_social

?>