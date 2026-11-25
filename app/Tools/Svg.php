<?php
/**
 * SVG helper.
 *
 * Inline icons from the Backdrop icons package (Iconoir). The brand icons that Iconoir
 * doesn't have are SVG files in `public/svg/social-icons`, which are added to the package.
 *
 * @package   Amicable
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2024 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/amicable
 */

namespace Amicable\Tools;

use function Backdrop\Icons\icon;
use function Backdrop\Icons\icons;

/**
 * SVG class.
 *
 * @since  1.0.0
 * @access public
 */
class Svg {

	/**
	 * Returns an inline icon, with the theme's `icon` class. Returns an empty string for an
	 * unknown icon.
	 *
	 * The filtered output is sanitized with `wp_kses()` before it is returned, so
	 * anything hooked to the `amicable/svg/{name}` filter cannot inject
	 * markup outside the SVG allowlist. `wp_kses()` lowercases tag and attribute
	 * names in its output, and on this install it appears to strip `viewBox`
	 * entirely. The `viewBox` value and any `<clipPath>` block are
	 * therefore captured before sanitizing and restored afterwards (see below),
	 * so the icon always comes back with its real `viewBox`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $args  Arguments for `Backdrop\Icons\icon()`.
	 * @return string
	 */
	public static function render( $name, array $args = [] ) {

		static $path_added = false;

		if ( ! $path_added ) {
			icons()->addPath( static::path() );
			$path_added = true;
		}

		$svg = icon( (string) $name, array_merge( [ 'class' => 'icon' ], $args ) );

		$svg = (string) apply_filters( "amicable/svg/{$name}", $svg );

		// Capture the `viewBox` value and any `<clipPath>` block BEFORE
		// `wp_kses()` runs. Without the captured values there would be
		// nothing left to restore if `wp_kses()` strips them. The value is
		// never hardcoded: Iconoir icons carry `0 0 24 24`, the theme's own
		// brand icons carry their own (e.g. `0 0 512 512` for WordPress).
		$viewbox = '';
		if ( preg_match( '/\bviewBox="([^"]*)"/', $svg, $matches ) ) {
			$viewbox = $matches[1];
		}

		$clippath = '';
		if ( preg_match( '/<clipPath\b[^>]*>.*?<\/clipPath>/s', $svg, $matches ) ) {
			$clippath = $matches[0];
		}

		$svg = wp_kses( $svg, static::allowedTags() );

		// `wp_kses()` lowercases tag and attribute names, so `viewBox="0 0 24 24"`
		// comes back as `viewbox="0 0 24 24"` and `<clipPath>` as `<clippath>`.
		// Without a working `viewBox`, the browser renders the icon's artwork
		// at 1:1 inside the icon box, clipping the right-hand side. Restore
		// the correct casing. These replacements only touch tag and attribute
		// names: in the sanitized output `viewbox=` can only occur as an
		// attribute name, and `<clippath` / `</clippath>` only as tags.
		// (`clipPath` is used by the icons package's `git` and
		// `rhombus-arrow-right` icons; the theme's own icons do not use it.)
		$svg = str_replace( ' viewbox=', ' viewBox=', $svg );
		$svg = str_replace( '<clippath', '<clipPath', $svg );
		$svg = str_replace( '</clippath>', '</clipPath>', $svg );

		// If `wp_kses()` stripped `viewBox` outright instead of lowercasing
		// it, the casing restore above is a no-op — put the captured value
		// back on the opening `<svg>` tag. (The value was captured before
		// sanitizing, from the icons package's own output, so it is the
		// icon's real `viewBox`, not a guess.)
		if ( '' !== $viewbox && ! preg_match( '/\bviewBox="/i', $svg ) ) {
			$pos = stripos( $svg, '<svg' );
			$end = false !== $pos ? strpos( $svg, '>', $pos ) : false;

			if ( false !== $end ) {
				$svg = substr_replace( $svg, ' viewBox="' . esc_attr( $viewbox ) . '"', $end, 0 );
			}
		}

		// Same for a stripped `<clipPath>` block: put the captured block back
		// inside `<defs>` (or right after the opening `<svg>` tag when there
		// is no `<defs>`). The block is the icons package's own output, and
		// its `id` still matches the `url(#…)` reference on the `<g>` — the
		// reference survives `wp_kses()` because `clip-path` is an allowed
		// attribute. Any stray copy of the block's inner shape left behind
		// by the strip sits inside `<defs>`, where it is never rendered, so
		// restoring the block cannot draw a duplicate shape.
		if ( '' !== $clippath && false === stripos( $svg, '<clippath' ) && false === stripos( $svg, '<clipPath' ) ) {
			$defs_pos = stripos( $svg, '<defs>' );

			if ( false !== $defs_pos ) {
				$svg = substr_replace( $svg, $clippath, $defs_pos + strlen( '<defs>' ), 0 );
			} else {
				$pos = stripos( $svg, '<svg' );
				$end = false !== $pos ? strpos( $svg, '>', $pos ) : false;

				if ( false !== $end ) {
					$svg = substr_replace( $svg, $clippath, $end + 1, 0 );
				}
			}
		}

		return $svg;
	}

	/**
	 * Returns the allowed SVG tags and attributes for sanitizing icon output.
	 *
	 * Covers the elements and attributes the theme's own icons and the Iconoir
	 * icons shipped by the Backdrop icons package actually use. No `script`
	 * elements, event-handler attributes, or `href`/`xlink:href` attributes
	 * are allowed — no icon uses them.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public static function allowedTags() {

		// Attributes on the `<svg>` element itself: those from the icon
		// files, plus the ones the icons package sets when rendering
		// (`width`, `height`, `class`, `aria-hidden`/`role`/`aria-label`,
		// `focusable`). The theme's Font Awesome brand icons also carry
		// `data-prefix` and `data-icon`. `viewBox` is listed lowercase
		// (`viewbox`): `wp_kses()` compares lowercased attribute names, so
		// the camelCase key never matched and the attribute was stripped.
		$svg_atts = [
			'xmlns'        => true,
			'viewbox'      => true,
			'width'        => true,
			'height'       => true,
			'class'        => true,
			'role'         => true,
			'aria-hidden'  => true,
			'aria-label'   => true,
			'focusable'    => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
			'data-prefix'  => true,
			'data-icon'    => true
		];

		// Attributes shared by the shape elements (`path`, `circle`, `rect`).
		$shape_atts = [
			'd'                => true,
			'fill'             => true,
			'stroke'           => true,
			'stroke-width'     => true,
			'stroke-linecap'   => true,
			'stroke-linejoin'  => true,
			'stroke-miterlimit'  => true,
			'stroke-dasharray'   => true,
			'fill-rule'        => true,
			'clip-rule'        => true,
			'transform'        => true,
			'class'            => true
		];

		return [
			'svg'      => $svg_atts,
			'path'     => $shape_atts,
			'circle'   => array_merge( $shape_atts, [
				'cx' => true,
				'cy' => true,
				'r'  => true
			] ),
			'rect'     => array_merge( $shape_atts, [
				'x'      => true,
				'y'      => true,
				'width'  => true,
				'height' => true,
				'rx'     => true
			] ),
			'g'        => array_merge( $shape_atts, [
				'clip-path' => true
			] ),
			'defs'     => [],
			'clipPath' => [
				'id' => true
			]
		];
	}

	/**
	 * Prints an inline icon.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $args
	 * @return void
	 */
	public static function display( $name, array $args = [] ) {

		echo static::render( $name, $args ); // phpcs:ignore
	}

	/**
	 * Returns the path to the theme's own icons.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $file
	 * @return string
	 */
	public static function path( $file = '' ) {

		$file = trim( $file, '/' );

		return get_theme_file_path( $file ? "public/svg/social-icons/{$file}" : 'public/svg/social-icons' );
	}
}
