<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<picture class="post-thumbnail">
			<source media="(max-width: 768px)" srcset="<?php the_post_thumbnail_url( 'amicable-landscape-medium' ); ?>">
			<?php the_post_thumbnail( 'amicable-landscape-extra-large' ); ?>
		</picture>
	<?php } ?>
	<header class="entry-header">
		<?php Backdrop\Post\display_title(); ?>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>
