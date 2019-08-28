<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_items_grid stm_items_grid_1');

$items = vc_param_group_parse_atts($atts['heading']);

pearl_add_element_style('stm_items_grid', 'style_1');
wp_enqueue_script('lazysizes');

if (!empty($items)): ?>
    <div class="<?php echo implode(' ', $classes); ?>">
		<?php foreach ($items as $item):

			if (empty($item)) continue;

			$has_link = (!empty($item['btn_text']) and !empty($item['btn_url'])) ? true : false;

			if ($has_link) {
				$open_tag = "<a target='_blank' class=\"stm_items_grid__single_link no_deco\" href=\"{$item['btn_url']}\">";
				$close_tag = "</a>";
			} else {
				$open_tag = "<div class=\"stm_items_grid__single_link\">";
				$close_tag = "</div>";
			}

			$single_class = (!empty($item['preview_text'])) ? 'has_preview_label' : '';
			?>
            <div class="stm_items_grid__single <?php echo esc_attr($single_class); ?>">
                <div class="stm_items_grid__single_inner">

					<?php echo wp_kses_post($open_tag); ?>

                    <div class="stm_items_grid__image">
                        <?php if(!empty($item['image'])):
							$img_size = '800x539';
							$item_padding = pearl_get_image_proportion($img_size); ?>
                            <div class="stm_projects_cards__image stm_lazyload_image"
                                 style="padding-bottom: <?php echo esc_attr($item_padding); ?>%;">
								<?php echo pearl_lazyload_image($item['image'], $img_size, true); ?>
                            </div>
                        <?php endif; ?>
						<?php if ($has_link): ?>
                            <div class="stm_items_grid__button">
                                <span class="btn btn_solid btn_primary btn_default"><?php echo $item['btn_text']; ?></span>
                            </div>
                        <?php elseif(!empty($item['preview_text'])): ?>
                            <div class="stm_items_grid__label h4">
                                <?php echo esc_attr($item['preview_text']); ?>
                            </div>
						<?php endif; ?>
                    </div>

					<?php echo wp_kses_post($close_tag); ?>

					<?php if (!empty($item['title'])): ?>
                        <h4 class="stm_items_grid__title">
							<?php echo $item['title']; ?>
                            <?php if(!empty($item['badge'])): ?>
                                <span class="stm_items_grid__badge mbc wtc">
                                    <?php echo wp_kses_post($item['badge']); ?>
                                </span>
                            <?php endif; ?>
                        </h4>
					<?php endif; ?>

					<?php if (!empty($item['description'])): ?>
                        <p class="stm_items_grid__description">
							<?php echo $item['description']; ?>
                        </p>
					<?php endif; ?>

					<?php if (!empty($item['features'])):
						$features = explode(',', $item['features']);
						if (!empty($features) and is_array($features)): ?>
                            <div class="stm_items_grid__features">
                                <?php if(!empty($item['features_title'])): ?>
                                    <h4 class="title"><?php echo esc_attr($item['features_title']); ?></h4>
                                <?php endif; ?>
                                <ul>
									<?php foreach ($features as $feature): ?>
                                        <li><?php echo wp_kses_post($feature); ?></li>
									<?php endforeach; ?>
                                </ul>
                            </div>
						<?php endif; ?>
					<?php endif; ?>

                </div>

            </div>
		<?php endforeach; ?>
    </div>
<?php endif;