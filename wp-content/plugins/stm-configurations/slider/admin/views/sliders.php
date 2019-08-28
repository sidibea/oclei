<?php
global $stm_slider_admin;
$sliders = $stm_slider_admin->get_sliders();

?>

<div class="wrap">
    <h1 class="wp-heading-inline">All sliders</h1>
    <a class="button button-primary button-hero load-customize hide-if-no-customize stm_add_new_slider" href="#">Add new
        slider</a>


    <div class="stm-slider__table">
        <div class="stm-slider__table_head">
            <div class="stm-slider__table_row">
                <div class="stm-slider__table_cell"><?php esc_html_e('Name', 'stm_domain'); ?></div>
                <div class="stm-slider__table_cell"><?php esc_html_e('Preview', 'stm_domain'); ?></div>
                <div class="stm-slider__table_cell"><?php esc_html_e('Id', 'stm_domain'); ?></div>
                <div class="stm-slider__table_cell"><?php esc_html_e('Shortcode', 'stm_domain'); ?></div>
                <div class="stm-slider__table_cell"><?php esc_html_e('Actions', 'stm_domain'); ?></div>
            </div>
        </div>


		<?php if ($sliders) : ?>
            <div class="stm-slider__table_body">
				<?php foreach ($sliders as $slider):

					$slides = $stm_slider_admin->get_slider_slides($slider->ID);
					$slides_count = count($slides);
					?>
                    <div class="stm-slider__table_row">
                        <div class="stm-slider__table_cell">
                            <div class="stm-slider__slide_name">
                                <a href="<?php echo STM_SLIDER_PAGE_URL . '&action=edit&slider_id=' . $slider->ID ?>" title="<?php echo esc_attr($slider->post_title) ?>">
									<?php echo wp_kses_post($slider->post_title) ?>
                                </a>
                            </div>
                            <div class="stm-slider__slides-count"><?php echo intval($slides_count) . ' ' . esc_html('Slides', 'stm_domain'); ?></div>
                        </div>
                        <div class="stm-slider__table_cell">
                            <div class="stm-slider__slides">
								<?php
								$slides_i = 0;
								$slide_left_css_val = 0;
								$empty_width = 205 - 150; // stm-slider__slides width - slider__slide width
								if ($slides_count > 1) {
								    $slide_left_css_val = $empty_width / ($slides_count - 1) * $slides_i;
                                }
								foreach ($slides as $slide) {
									$image = get_the_post_thumbnail($slide->ID, 'thumbnail');
									if (function_exists('pearl_get_VC_post_img_safe')) {
										$image = pearl_get_VC_post_img_safe($slide->ID, '150x90', 'thumbnail');
									}
									?>
                                    <div class="stm-slider__slide"
                                         style="left: <?php echo intval($slide_left_css_val) ?>px; z-index: <?php echo intval(20 - $slides_i); ?>">
										<?php echo $image; ?>
                                    </div>
									<?php
									$slides_i += 1;
								}
								?>
                            </div>
                        </div>
                        <div class="stm-slider__table_cell">
                            <div class="stm-slider__slide-id">
								<?php echo $slider->ID ?>
                            </div>
                        </div>
                        <div class="stm-slider__table_cell">
                            <input class="stm-slider__slide_shortcode" type="text" disabled="disabled"
                                   value='[stm_slider id="<?php echo $slider->ID ?>"]'>
                        </div>
                        <div class="stm-slider__table_cell">
                            <div class="stm-slider__actions">

<!--                                <a href="--><?php //echo STM_SLIDER_PAGE_URL . '&action=export&slider_id=' . $slider->ID ?><!--">-->
<!--                                    <i class="fa fa-upload"></i>-->
<!--									--><?php //esc_html_e('Export', 'stm_domain'); ?>
<!--                                </a>-->

                                <a href="<?php echo STM_SLIDER_PAGE_URL . '&action=duplicate&slider_id=' . $slider->ID ?>">
                                    <i class="fa fa-copy"></i><?php echo esc_html('Duplicate', 'stm_domain'); ?>
                                </a>

                                <a href="<?php echo STM_SLIDER_PAGE_URL . '&action=delete&slider_id=' . $slider->ID ?>" class="stm_delete_slider">
                                    <i class="fa fa-trash-o"></i><?php esc_html_e('Delete', 'stm_domain'); ?>
                                </a>

                                <a href="<?php echo STM_SLIDER_PAGE_URL . '&action=edit&slider_id=' . $slider->ID ?>"
                                   class="stm_edit_slider button button-primary">
                                    <i class="fa fa-pencil-square-o"></i>
									<?php esc_html_e('Edit', 'stm_domain'); ?>
                                </a>

                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
		<?php endif; ?>
    </div>

</div>

