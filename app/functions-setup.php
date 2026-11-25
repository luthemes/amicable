<?php
/**
 * Theme setup functions.
 *
 * This file holds basic theme setup functions executed on appropriate hooks
 * with some opinionated priorities based on theme dev, particularly working
 * with child theme devs/users, over the years. I've also decided to use
 * anonymous functions to keep these from being easily unhooked. WordPress has
 * an appropriate API for unregistering, removing, or modifying all of the
 * things in this file. Those APIs should be used instead of attempting to use
 * `remove_action()`.
 *
 * @package   Amicable
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2024 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/amicable
 */

namespace Amicable;

use function Backdrop\Theme\is_classicpress;
use Amicable\Tools\Config;

/**
 * Set up theme support.  This is where calls to `add_theme_support()` happen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	// Set the theme content width.
	$GLOBALS['content_width'] = 640;

	// Load theme translations.
	load_theme_textdomain( 'amicable', get_parent_theme_file_path( 'public/lang' ) );

	// Automatically add the `<title>` tag.
	add_theme_support( 'title-tag' );

	// Automatically add feed links to `<head>`.
	add_theme_support( 'automatic-feed-links' );

	// Adds featured image support.
	add_theme_support( 'post-thumbnails' );

	$images = Config::get( 'image-sizes' );

	foreach ( $images as $name => $size ) {
		add_image_size( $name, $size['width'], $size['height'] );
	}

	if ( ! is_classicpress() ) {

		// Outputs HTML5 markup for core features.
		add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );
	}
}, 5 );

/**
 * Register menus.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_nav_menus/
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'init', function() {

	register_nav_menus( [
		'primary'	=> esc_html__( 'Primary Navigation', 'amicable' ),
		'social' => esc_html__( 'Social Navigation', 'amicable' )
	] );

}, 5 );

/**
 * Replace the default menu item classes with the theme's BEM classes.
 *
 * The theme's navigation styles and scripts target `.menu__item`,
 * `.has-children` and `.menu__item--current`. The framework used to
 * supply these classes; with the framework no longer handling menus,
 * the theme maps them itself from WordPress's default classes.
 *
 * @since  1.0.0
 * @access public
 * @param  array   $classes  The CSS classes applied to the menu item.
 * @param  object  $item     The menu item object.
 * @param  object  $args     The `wp_nav_menu()` arguments.
 * @param  integer $depth    The menu item depth.
 * @return array
 */
add_filter( 'nav_menu_css_class', function( $classes, $item, $args, $depth ) {

	$original = $classes;
	$classes  = [ 'menu__item' ];

	if ( in_array( 'menu-item-has-children', $original, true ) ) {
		$classes[] = 'has-children';
	}

	if ( in_array( 'current-menu-item', $original, true ) || in_array( 'current_page_item', $original, true ) ) {
		$classes[] = 'menu__item--current';
	}

	return $classes;

}, 10, 4 );

/**
 * Registers custom templates with ClassicPress.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $templates
 * @return void
 */
add_action( 'backdrop/templates/register', function( $templates ) {

	$templates->add( 'template-home.php', [
		'label' => esc_html__( 'Home Template', 'amicable' )
	] );
} );