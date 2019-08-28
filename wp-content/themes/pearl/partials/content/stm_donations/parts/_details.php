<?php
wp_enqueue_script( 'jquery.countdown' );

/**
 * @var $donation STM_Donation
 */
$donation = STM_Donation::instance( get_the_ID() );

$target_amount   = get_post_meta( get_the_ID(), 'target_amount', true );
$raised_amount   = get_post_meta( get_the_ID(), 'raised_amount', true );
$currency_symbol = pearl_get_option( 'currency_symbol', 'a' );

$donated_percent = ( $raised_amount / $target_amount ) * 100;

$end_date    = get_post_meta( get_the_ID(), 'date_end', true );
$today       = time();
$time_to_end = $end_date - $today;
$days_to_end = $donation->get_days_to_end();


?>

<div class="stm_single_donation__details-wrapper">
	<div
			class="stm_single_donation__details stm_flex stm_flex_row stm_flex_justify_space_between stm_flex_nowrap stm_flex_align_items_center">
		<div class="stm_single_donation__info stm_flex stm_flex_col">
			<div class="stm_flex stm_flex_row stm_flex_justify_space_between">
				<div class="stm_single_donation__donated">
					<?php echo esc_html( $donation->get_donated_info() ) ?>
				</div>
				<div class="stm_single_donation__end">
					<?php $donation->the_ending_date_descr(true) ?>
				</div>
			</div>
			<div class="stm_flex_row">
				<div class="stm_single_donation__progress-bar">
					<?php echo html_entity_decode( $donation->get_donation_progress_bar() ); ?>
				</div>
			</div>
		</div>
		<div class="stm_single_donation__action stm_flex_col">
			<?php
			echo wp_kses( $donation->get_donate_button(),
				array(
					'a' => array(
						'href'        => array(),
						'class'       => array(),
						'data-toggle' => array(),
						'data-target' => array(),
						'disabled'    => array()
					),
				)
			)
			?>
		</div>


	</div>
</div>

