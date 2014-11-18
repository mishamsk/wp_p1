<?php
/**
 * The template for displaying the footer
 */
?>
	<?php
	/*
	*
	*	Header for all pages except front page
	*
	*/
		if (!is_front_page()) :
	?>
				</div><!-- .small-12 columns -->
			</div><!-- .row -->
		</section><!-- #main -->
		<footer id="page-footer" role="contentinfo" data-page-name="credits">
			<div class="row">
				<div class="small-12 large-6 columns text-center large-text-left">
					<p id="copyright"><?php printf( __( 'Copyright &copy; %s %s. All Rights Reserved.', 'perlovs' ), date( 'Y' ), ' <a href="' . home_url() . '">' . get_bloginfo( 'name' ) .'</a>' ); ?></p>
				</div>
				<div class="small-12 large-6 columns text-center large-text-right">
					<p id="credits"><?php printf( __( 'Credits and honors: %s', 'perlovs' ), ' <a href="' . home_url() . '/credits/">' . __( 'here' ) .'</a>' ); ?></p>
				</div>
			</div>
		</footer><!-- #page-footer -->
	</div> <!--#page-wrapper -->

	<?php
	/*
	*
	*	Header for the front page
	*
	*/
		else :
	?>
				<footer id="page-footer" role="contentinfo" data-page-name="credits">
					<div class="row">
						<div class="small-12 medium-6 columns">
							<p class="text-center"><?php _e( 'Share:', 'perlovs' ); ?></p><?php p1_social(); ?>
						</div>
						<div class="small-12 medium-6 columns">
							<p class="text-center"><?php _e( 'Search:', 'perlovs' ); ?></p>
							<div class="search-container"><?php get_search_form(); ?></div>
						</div><!-- .small-12 columns -->
					</div><!-- .row -->
					<div class="row">
						<div class="small-12 medium-6 columns">
							<span class="left"><small><?php printf( __( 'Copyright &copy; %s %s. All Rights Reserved.', 'perlovs' ), date( 'Y' ), ' <a href="' . home_url() . '">' . get_bloginfo( 'name' ) .'</a>' ); ?></small></span>
						</div><!-- .small-12 columns -->
						<div class="small-12 medium-6 columns">
							<span class="right"><small><?php printf( __( 'Credits and honors: %s.', 'perlovs' ), ' <a href="' . home_url() . '/credits/">' . __( 'here' ) .'</a>' ); ?></small></span>
						</div><!-- .small-12 columns -->
					</div><!-- .row -->
				</footer><!-- #page-footer -->
			</div><!-- .home-wrapper -->
		</section><!-- #main -->
	<?php endif; // end !is_front_page() check ?>

	<?php wp_footer(); ?>
</body>
</html>