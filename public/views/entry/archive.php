<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	$data = $data->get( 'data' );

	$timestamp   = get_the_date( 'U' );
	$post_year   = gmdate( 'Y', $timestamp );
	$post_month  = gmdate( 'm', $timestamp );
	$post_daynum = gmdate( 'd', $timestamp );

	if ( $data->current_year !== $post_year || $data->current_month !== $post_month ) {
		$data->current_year  = $post_year;
		$data->current_month = $post_month;
		$data->current_day   = '';

		echo '<h2 class="archives-site__heading">' . esc_html( gmdate( 'F Y', $timestamp ) ) . '</h2>';
	}

	$duplicate_day = $data->current_day && $data->current_day === $post_daynum ? ' day-duplicate' : '';
	$data->current_day = $post_daynum;

	echo sprintf(
		'<div class="archives-site__item %s"><span class="archives-site__day">%s:</span> <span class="archives-site__post"><a href="%s">%s</a></span></div>',
		esc_attr( $duplicate_day ),
		esc_html( $post_daynum ),
		esc_url( get_permalink() ),
		esc_html( get_the_title() )
	);
?>
</article>
