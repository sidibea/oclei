<?php
$id = get_the_ID();
$date_start = get_post_meta($id, 'date_start', true);
$address = get_post_meta($id, 'address', true);
$subtitle = get_post_meta($id, 'desc', true);


$link = get_post_meta($id, 'link', true);
$link_text = get_post_meta($id, 'link_text', true);

$link_text = (!empty($link_text)) ? $link_text : esc_html__('View more', 'pearl');
$link_url = (!empty($link)) ? $link : get_permalink();
$target = (!empty($link)) ? '_blank' : '';
$before_title = $after_title = '';


if (pearl_custom_post_single_enabled('events')) {
    $before_title = '<a class="wtc" href="'. get_the_permalink() .'">';
    $after_title = '</a>';
}

?>

<div
   <?php  post_class('stm_event_single_list no_deco'); ?>>

	<?php if(!empty($date_start)): ?>
		<div class="stm_event_single_list__alone hasDate ttc heading_font">
			<span class="top_date"><?php echo sanitize_text_field(pearl_get_formatted_date($date_start, 'l')); ?></span>
			<span class="middle_date"><?php echo sanitize_text_field(pearl_get_formatted_date($date_start, 'j')); ?></span>
			<span class="bottom_date"><?php echo sanitize_text_field(pearl_get_formatted_date($date_start, 'M/Y')); ?></span>
		</div>
	<?php endif; ?>

    <div class="stm_event_single_list__alone hasTitle">

            <h3 class="ttc">
                <?php the_title($before_title, $after_title); ?>
            </h3>
		<?php if(!empty($subtitle)): ?>
			<div class="stm_event_single_list__subtitle heading_font"><?php echo sanitize_text_field($subtitle); ?></div>
		<?php endif; ?>
    </div>
    <div class="stm_event_single_list__alone hasAddress ttc">
        <i class="__icon icon_25px mtc stmicon-pin"></i>
        <?php echo sanitize_text_field($address); ?>
    </div>
    <div class="stm_event_single_list__alone hasButton">
        <a class="btn btn_outline btn_primary" href="<?php echo esc_url($link_url); ?>"
           title="<?php the_title(); ?>"
           target="<?php echo sanitize_text_field($target); ?>">
            <?php echo sanitize_text_field($link_text); ?>
        </a>
    </div>
</div>