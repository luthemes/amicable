<?php
if ( post_password_required() ) {
	return;
}
?>

<?php if ( comments_open() ) { ?>
	<section id="comments-area" class="comments-area">
		<?php if ( have_comments() ) { ?>
			<h3 class="comments-title">
				<?php 
					$count = get_comments_number(); 
					$title = get_the_title();
				?>
				<?php
					if ( 1 === absint( $count ) ) {
							printf(
								esc_html__( 'One thought on “%s”', 'amicable' ),
								esc_html( $title )
							);
						} else {
							printf(
								_nx(
									'%1$s thought on “%2$s”',
									'%1$s thoughts on “%2$s”',
									$count,
									'comments title',
									'amicable'
								),
								absint( number_format_i18n( $count ) ),
								esc_html( $title )
							);
						}
				?>
			</h3>
		<?php } ?>
		<ol class="comment-list">
			<?php
			wp_list_comments( [
				'avatar_size' => 60,
				'callback'    => function( $comment, $args, $depth ) {
					Backdrop\View\display( 'comment', Backdrop\Comment\hierarchy(), compact( 'comment', 'args', 'depth' ) );
				}
			] );
			?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<div class="comment-previous"><?php previous_comments_link( '<i class="fa fa-arrow-circle-o-left"></i> ' . esc_html__( 'Older Comments', 'amicable' ) ); ?></div>
				<div class="comment-next"><?php next_comments_link( '<i class="fa fa-arrow-circle-o-right"></i> ' . esc_html__( 'Newer Comments', 'amicable' ) ); ?></div>
			</nav>
		<?php } ?>
		<?php comment_form(); ?>
	</section>
<?php } ?>
