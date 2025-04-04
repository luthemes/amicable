<section id="content" class="site-content">
	<main id="main" class="content-area">
		<?php if ( have_posts() ) : ?>
			<?php if ( ! is_front_page() ) : ?>
				<div class="archive-header">
					<h1 class="archive-header__title mb-2"><?php the_archive_title() ?></h1>
					<?php if ( ! is_paged() && get_the_archive_description() ) : ?>
						<div class="archive-header__description">
							<?php the_archive_description() ?>
						</div>
					<?php endif ?>
				</div>
			<?php endif ?>
			<?php $data = (object) [ 'current_year'  => '', 'current_month' => '', 'current_day'   => '' ]; ?>
			<?php while( have_posts() ) : the_post(); ?>
				<?php Backdrop\View\display( 'entry/archive', '', [ 'data' => $data ] ); ?>
			<?php endwhile; ?>
				<?php Backdrop\View\display( 'nav/pagination', 'posts' ); ?>
		<?php endif; ?>
	</main>
</section>
