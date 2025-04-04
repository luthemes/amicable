<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	$data = $data->get( 'data' );

	$timestamp = get_the_date( 'U' );
	$year      = date( 'Y', $timestamp );
	$month     = date( 'm', $timestamp );
	$daynum    = date( 'd', $timestamp );

	if ( $data->current_year !== $year || $data->current_month !== $month ) {
		$data->current_year  = $year;
		$data->current_month = $month;
		$data->current_day   = '';

		echo '<h2 class="archives-site__heading">' . esc_html( date( 'F Y', $timestamp ) ) . '</h2>';
	}

	$duplicate_day = $data->current_day && $data->current_day === $daynum ? ' day-duplicate' : '';
	$data->current_day = $daynum;

	echo sprintf(
		'<div class="archives-site__item %s"><span class="archives-site__day">%s:</span> <span class="archives-site__post"><a href="%s">%s</a></span></div>',
		esc_attr( $duplicate_day ),
		esc_html( $daynum ),
		esc_url( get_permalink() ),
		esc_html( get_the_title() )
	);
?>
</article>
