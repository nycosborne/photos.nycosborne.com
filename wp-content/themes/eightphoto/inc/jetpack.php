<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package eightphoto
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function eightphoto_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'eightphoto_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function eightphoto_jetpack_setup
add_action( 'after_setup_theme', 'eightphoto_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function eightphoto_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function eightphoto_infinite_scroll_render
