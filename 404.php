<?php
/**
 * Amicable ( 404.php )
 *
 * @package     Amicable
 * @copyright   Copyright (C) 2020. Benjamin Lu
 * @license     GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author      Benjamin Lu ( https://benjlu.com )
 */
?>

<?php get_header(); ?>
<section id="content" class="site-content">
	<div id="global-layout" class="<?php echo esc_attr(get_theme_mod('global_layout', 'left-sidebar')); ?>">
		<main id="main" class="content-area">
			<?php Backdrop\Template\get_template_part('content/content', '404'); ?>
		</main>
		<?php Backdrop\View\display('sidebar', ['primary']); ?>
	</div>
</section>
<?php get_footer(); ?>
