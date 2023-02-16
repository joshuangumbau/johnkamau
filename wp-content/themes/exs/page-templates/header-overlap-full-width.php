<?php
/**
 * Template Name: Transparent fixed header, no title, full width
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package WordPress
 * @subpackage ExS
 * @since 2.1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$exs_show_title = ! exs_option( 'title_show_title', '' ) && get_the_title() && ! is_front_page();

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	the_content();

	wp_link_pages(
		exs_get_wp_link_pages_atts()
	);

endwhile;

get_footer();
