<?php
/**
 * Loop Layouts Config.
 *
 * Configuration for the theme's loop layouts.
 *
 * @package   Amicable
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2024 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/amicable
 */

return [
	'blog' => [
		'label'       => __( 'Blog', 'amicable' ),
		'image_sizes' => [
			'amicable-landscape-medium',
			'amicable-landscape-large',
			'amicable-landscape-extra-large',
		]
	],
	'grid' => [
		'label'            => __( 'Grid', 'amicable' ),
		'requires_image'   => true,
		'image_sizes'      => [
			'amicable-landscape-medium',
		]
	],
	'list' => [
		'label'       => __( 'List', 'amicable' ),
		'image_sizes' => []
	]
];