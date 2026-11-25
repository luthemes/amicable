/**
 * Copy buttons for code blocks.
 *
 * Adds a Copy button to `pre` blocks in post content, and announces the result
 * to screen readers. Pairs with the `.code-copy` styles in
 * `resources/scss/04.elements/01.code`.
 *
 * Without the clipboard API (plain `http://` pages, where it is undefined),
 * it falls back to a temporary textarea and `execCommand`, so the button
 * still works there.
 *
 * @package   Amicable
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2024 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/amicable
 */

( function() {
	'use strict';

	var strings = window.amicableCodeCopy || {};

	var copyLabel       = strings.copy || 'Copy';
	var copiedLabel     = strings.copied || 'Copied';
	var copyFailedLabel = strings.copyFailed || 'Copy failed';
	var copyCodeLabel   = strings.copyCode || 'Copy code';

	/**
	 * Copies text. Uses the clipboard API when there is one; otherwise a
	 * temporary textarea with `execCommand`, for pages without a secure context.
	 */
	async function copyText( text ) {
		if ( navigator.clipboard ) {
			await navigator.clipboard.writeText( text );
			return;
		}

		if ( ! document.execCommand ) {
			throw new Error( 'copy unavailable' );
		}

		var area = document.createElement( 'textarea' );

		area.value = text;
		area.setAttribute( 'readonly', '' );
		area.style.position = 'absolute';
		area.style.left = '-9999px';
		document.body.append( area );
		area.select();

		try {
			if ( ! document.execCommand( 'copy' ) ) {
				throw new Error( 'copy failed' );
			}
		} finally {
			area.remove();
		}
	}

	/**
	 * Announces the result to screen readers through one shared live region,
	 * instead of putting `aria-live` on the button itself.
	 */
	var liveRegion;

	function announce( message ) {
		if ( ! liveRegion ) {
			liveRegion = document.createElement( 'div' );
			liveRegion.className = 'screen-reader-text';
			liveRegion.setAttribute( 'aria-live', 'polite' );
			document.body.append( liveRegion );
		}

		liveRegion.textContent = message;
	}

	/**
	 * Adds a Copy button to each `pre` block in the entry content.
	 */
	function codeCopy( root ) {
		root.querySelectorAll( '.entry-content pre' ).forEach( function( block ) {
			if ( block.dataset.codeCopy ) {
				return;
			}

			block.dataset.codeCopy = 'ready';

			// Read the text now, so it doesn't include the button's label.
			var text = ( block.querySelector( 'code' ) || block ).textContent;

			var button = document.createElement( 'button' );

			button.type = 'button';
			button.className = 'code-copy';
			button.textContent = copyLabel;
			button.setAttribute( 'aria-label', copyCodeLabel );

			var resetTimer;

			button.addEventListener( 'click', async function() {
				clearTimeout( resetTimer );

				try {
					await copyText( text );
					button.textContent = copiedLabel;
					announce( copiedLabel );
				} catch ( e ) {
					button.textContent = copyFailedLabel;
					announce( copyFailedLabel );
				}

				resetTimer = setTimeout( function() {
					button.textContent = copyLabel;
					announce( '' );
				}, 2000 );
			} );

			// First in the block, so the sticky button sits at the top of it.
			block.prepend( button );
		} );
	}

	if ( document.readyState !== 'loading' ) {
		codeCopy( document );
	} else {
		document.addEventListener( 'DOMContentLoaded', function() {
			codeCopy( document );
		} );
	}
} )();
