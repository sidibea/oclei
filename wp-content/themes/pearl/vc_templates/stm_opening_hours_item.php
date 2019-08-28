<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$days          = array(
	'sunday'    => esc_html__( 'Sunday', 'pearl' ),
	'monday'    => esc_html__( 'Monday', 'pearl' ),
	'tuesday'   => esc_html__( 'Tuesday', 'pearl' ),
	'wednesday' => esc_html__( 'Wednesday', 'pearl' ),
	'thursday'  => esc_html__( 'Thursday', 'pearl' ),
	'friday'    => esc_html__( 'Friday', 'pearl' ),
	'saturday'  => esc_html__( 'Saturday', 'pearl' )
);
$css_class     = '';
$now           = current_time( 'timestamp' );
$time_to_close = strtotime( $closing_time ) - $now;
$time_to_open = strtotime( $opening_time ) - $now;

/*Opened now*/
if ( strtolower( date( 'l' ) ) == $day && $now < strtotime( $closing_time ) && $now > strtotime( $opening_time ) ) {
	$css_class .= ' today';
}

/*Opens in*/
if(strtolower( date( 'l' ) ) == $day && $now < strtotime( $opening_time )) {
    $css_class .= 'opens';
}

if ( $output ) {
	$css_class .= ' output';
}
?>

<div class="day stm_animated <?php echo esc_attr( $css_class ); ?>">
	<div class="icon">
		<i class="stmicon-calendar stc"></i>
	</div>
	<div class="day_title">
		<strong><?php echo esc_html( $days[ $day ] ); ?></strong>
	</div>
	<div class="working_time">
		<?php if ( ! $output ): ?>
			<?php echo date( $time_format, strtotime( $opening_time ) ); ?> - <?php echo date( $time_format, strtotime( $closing_time ) ); ?>
		<?php else: ?>
			<?php echo esc_html( $text_1 ); ?>
		<?php endif; ?>
	</div>
	<div class="lunch_time">
		<?php if ( ! $output ): ?>
			<?php echo esc_html__( 'Lunch:', 'pearl' ); ?>
			<?php echo date( $time_format, strtotime( $start_lunch ) ); ?> - <?php echo date( $time_format, strtotime( $end_lunch ) ); ?>
		<?php else: ?>
			<?php echo esc_html( $text_2 ); ?>
		<?php endif; ?>
	</div>
	<div class="time_to_closing wtc">
        <?php if(strpos($css_class, 'today') !== false) {
            echo sprintf(wp_kses_post(__('<strong class="wtc">%d h. %d min.</strong><br/>to closing', 'pearl')), date('H', $time_to_close), date('i', $time_to_close));
        } elseif(strpos($css_class, 'opens') !== false) {
            echo sprintf(wp_kses_post(__('<strong class="wtc">Opens in %d h. %d min.</strong><br/>', 'pearl')), date('H', $time_to_open), date('i', $time_to_open));
        } ?>
	</div>
</div>