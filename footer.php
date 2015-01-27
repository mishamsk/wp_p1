<?php
/**
 * The template for displaying the footer
 */

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

?>
		</section><!-- #main -->
		<footer id="page-footer" role="contentinfo" data-page-name="credits">
			<div class="row">
				<div class="small-12 large-6 columns">
					<p class="small-text-left medium-text-center large-text-left" id="copyright"><?php printf( __( 'Copyright &copy; %s %s. All Rights Reserved.', 'perlovs' ), date( 'Y' ), ' <a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) .'</a>' ); ?></p>
				</div>
				<div class="small-12 large-6 columns">
					<p class="small-text-left medium-text-center large-text-right" id="credits"><?php printf( __( 'Credits and honors: %s', 'perlovs' ), ' <a href="' . esc_url( home_url( '/credits/' )) . '">' . __( 'here', 'perlovs' ) .'</a>' ); ?></p>
				</div>
			</div>
		</footer><!-- #page-footer -->
	</div> <!--#page-wrapper -->

	<?php wp_footer(); ?>
</body>
</html>