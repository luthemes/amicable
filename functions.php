<?php
/**
 * Initiator ( functions.php )
 *
 * This (functions.php) template file should only do two jobs, one is to check the compatibility if the site meets
 * the miminum requirements before the theme proceeds to activate. The second job is to autoload the backdrop core
 * famework.
 *
 * @package     Initiator
 * @copyright   Copyright (C) 2019. Benjamin Lu
 * @license     GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author      Benjamin Lu ( https://benjlu.com )
 */

/**
 * Table of Content
 *
 * 1.0 - Backdrop Core
 */

/**
 * 1.0 - Backdrop Core
 */
if ( file_exists( get_parent_theme_file_path( '/vendor/autoload.php' ) ) ) {
	require_once get_parent_theme_file_path( '/vendor/autoload.php' );
}
