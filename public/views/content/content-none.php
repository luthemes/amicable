<?php
/**
 * Amicable ( content-none.php )
 *
 * @package     Amicable
 * @copyright   Copyright (C) 2020. Benjamin Lu
 * @license     GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author      Benjamin Lu ( https://benjlu.com )
 */

?>
<article id="post-0" <?php post_class( 'post' ); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<?php esc_html_e( 'Nothing Found', 'amicable' ); ?>
		</h1>
	</header>
	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p>
				<?php
					// Translators: 1 = admin url.
					printf( esc_html__( 'Ready to publish your first post? %s', 'amicable' ), '<a href="' . esc_url( admin_url( 'post-new.php' ) ) . '">' . esc_html__( 'Get Started', 'amicable' ) . '</a>' );
				?>
			</p>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'amicable' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</article>
