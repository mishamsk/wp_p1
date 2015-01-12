<?php
/*
	General template for date archive
*/

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

	get_header();

	$archive = '';
	$page_title = '';
	$archive_year  = get_the_time('Y');
	$archive_month = get_the_time('m');
	$archive_day   = get_the_time('d');

	if (is_year()) {
		$args = array(
			'type' => 'yearly', 'limit' => '',
			'format' => '', 'before' => '',
			'after' => '', 'show_post_count' => false,
			'echo' => 0, 'order' => 'ASC',
		);

		// Remove current year and add it as the last
		$archive .= '<h6 id="archive-yearspicker">' . __('Other years archives: ', 'perlovs') . preg_replace('/<a href=["\']' . preg_quote(get_year_link( $archive_year), '/') . '["\'].*>(.*)<\/a>/iU', ' ', wp_get_archives($args)) . '</h6>';

		$args = array(
			'type' => 'monthly', 'limit' => '',
			'format' => '', 'before' => '',
			'after' => '', 'show_post_count' => false,
			'echo' => 0, 'order' => 'ASC',
		);

		$archive .= '<h6 id="archive-monthpicker">' . sprintf(__('%s year by month: ', 'perlovs'), $archive_year) . preg_replace('/\s\d{4}/','',wp_get_archives($args)) . '</h6>';
		$page_title = sprintf(_x('All posts written in %s', 'year archive page title', 'perlovs'), get_the_date('Y'));
	}

	if (is_month()) {
		$args = array(
			'type' => 'monthly', 'limit' => '',
			'format' => '', 'before' => '',
			'after' => '', 'show_post_count' => false,
			'echo' => 0, 'order' => 'ASC',
		);

		// Remove current month
		$archive .= '<h6 id="archive-monthpicker">' . __('Other months archives: ', 'perlovs') . preg_replace('/<a href=["\']' . preg_quote(get_month_link( $archive_year, $archive_month), '/') . '["\'].*>(.*)<\/a>/iU', ' ', preg_replace('/\s\d{4}/','',wp_get_archives($args))) . '</h6>';
		$archive .= '<a id="archive-calender-reveal" href="#wp-calendar-container">' . __('Display calendar', 'perlovs') . '</a>';

		// Calendar must be echoed on higher than everything else for overlay to work
		echo '<a id="wp-calendar-container" href="#">' . get_calendar(true, false) . '</a>';

		$page_title = sprintf(_x('All posts written in %s %s', 'month archive page title', 'perlovs'), get_the_date('F'), get_the_date('Y'));
	}

	if (is_day()) {
		$archive .= '<a id="archive-calender-reveal" href="#wp-calendar-container">' . __('Display calendar', 'perlovs') . '</a>';
		// Calendar must be echoed on higher than everything else for overlay to work
		// Also need to higlight current day
		echo '<a id="wp-calendar-container" href="#">' . preg_replace('/(?:<td id="today">|<td>)\s*<a href="' . preg_quote(get_day_link( $archive_year, $archive_month, $archive_day), '/') . '".*>(.*)<\/a>\s*<\/td>/iU', '\<td class="current"><a href="#">\1</a></td>', get_calendar(true, false)) . '</a>';

		$page_title = sprintf(_x('All posts written on %s/%s/%s', 'day archive page title', 'perlovs'), get_the_date('d'), get_the_date('m'), get_the_date('Y'));
	}
?>
	<div class="row">
		<div class="small-12 columns">
			<header id="archive-header">
				<h5><?php perlovs_breadcrumbs(); ?></h5>
				<h1 class="page-title"><?php echo $page_title; ?></h1>
				<div id="archive-datepicker"><?php echo $archive; ?></div>
			</header>
		</div> <!-- .small-12 columns -->
	</div> <!-- .row-->
<?php
	get_template_part( 'blogroll');
	get_footer();
?>
