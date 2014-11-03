<?php
/**
 * The template for displaying the footer
 */
?>

			</section><!-- #main -->

			<footer id="footer" role="contentinfo">
				<div id="footer-content" class="row">
					<div class="small-12 columns">
						<span class="left"><small><?php printf( __( 'Copyright &copy; %s %s. All Rights Reserved.', 'perlovs' ), date( 'Y' ), ' <a href="' . home_url() . '">' . get_bloginfo( 'name' ) .'</a>' ); ?></small></span>
					</div><!-- .small-12 columns -->
				</div><!-- #ooter-content .row -->
			</footer><!-- #footer -->

	<?php
		// Front-page do not use navigation
		if (!is_front_page()) : ?>
			<a class="exit-off-canvas"></a>
		</div><!-- #page -->
	</div><!-- .off-canvas-wrap -->
	<?php endif; // end !is_front_page() check ?>

	<?php wp_footer(); ?>
</body>
</html>