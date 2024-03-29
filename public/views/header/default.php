<?php
/**
 * Default header template
 *
 * @package   Amicable
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/amicable
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="profile" href="https://gmpg.org/xfn/11"/>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="container" class="site-container">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'amicable') ?></a>
	<header id="header" class="site-header">
		<div class="site-branding">
			<?php Backdrop\Theme\Site\display_site_title(); ?>
			<?php Backdrop\Theme\Site\display_site_description(); ?>
		</div>
	</header>
	<?php Backdrop\View\display('menu', 'primary', ['location' => 'primary']); ?>
