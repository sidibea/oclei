<?php
//charity - grid


/**
 * @var $donation STM_Donation
 */
$donation = STM_Donation::instance(get_the_ID());


?>
<div class="col-md-4 stm_donation__wrapper">

	<div class="stm_donation__image tbc">
		<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
			<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large'); ?>
		</a>
	</div>

	<div class="stm_donation__details-wrapper">
		<div class="stm_donation__details">
			<div class="stm_donation__title">
				<h5 class="ttc"><?php echo wp_kses($donation->get_title(true), array('a' => array('href' => array(), 'title' => array()))) ?></h5>
			</div>
			<div class="stm_donation__donated-info">
				<?php echo esc_html($donation->get_donated_info()) ?>
			</div>
			<div class="stm_donation__progress-bar-wrapper">
				<?php echo wp_kses($donation->get_donation_progress_bar(), array('span' => array('style' => array(), 'class' => array()))) ?>
			</div>
			<div class="stm_donation__end">
				<?php $donation->the_ending_date_descr() ?>
			</div>
			<a class="btn btn_solid btn_primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo esc_html__('Donate now', 'pearl'); ?></a>
		</div>
	</div>
</div>

