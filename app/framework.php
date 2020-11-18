<?php
/**
 * Amicable ( framework.php )
 *
 * This file is used to create a new framework instance and adds specific features to the theme.
 *
 * @package     Amicable
 * @copyright   Copyright (C) 2020. Benjamin Lu
 * @license     GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author      Benjamin Lu ( https://benjlu.com )
 */

/**
 * Create a new framework instance
 *
 * This will create an instance of the framework allowing you to initialize the theme.
 */
$amicable = Benlumia007\Backdrop\Framework::get_instance();

$amicable->menus = new Benlumia007\Backdrop\Menu\Menu(
	$args = [
		'primary' => esc_html__( 'Primary Navigation', 'amicable' ),
	]
);

$amicable->sidebars = new Benlumia007\Backdrop\Sidebar\Sidebar(
	$args = [
		'primary' => [
			'name' => esc_html__( 'Primary Sidebar', 'amicable' ),
			'desc' => esc_html__( 'Test', 'amicable' ),
		],
	]
);