<?php
$stm_event_lesson_title = '';
$heading = '';
$date_format = (!empty($atts['stm_date_format'])) ? $atts['stm_date_format'] : 'Y-m-d';
$time_format = (!empty($atts['stm_time_format'])) ? $atts['stm_time_format'] : 'H:i';

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$heading = vc_param_group_parse_atts($atts['heading']);
$stm_event_lesson_date = strtotime($datepicker);
$id = rand(0, 999999);


?>


<?php if (!empty($stm_event_lesson_title)) : ?>
    <div class="event_lesson_tabs">
        <a href="#<?php echo esc_html($id); ?>" class="ttc self_scroll">
            <dfn class="stm_mf"><?php echo sanitize_text_field($stm_event_lesson_title); ?></dfn>
            <span><?php echo date_i18n($date_format, $stm_event_lesson_date); ?></span>
        </a>
    </div>
<?php endif; ?>

<?php if (!empty($heading)) : ?>
    <ul id="<?php echo esc_html($id) ?>" class="event_lesson_info">
        <?php foreach ($heading as $heading_item) : ?>
            <?php if (!empty($heading_item['timepicker_start']) && !empty($heading_item['timepicker_end'])) : ?>
                <?php $stm_event_lesson_time_start = strtotime($heading_item['timepicker_start']); ?>
                <?php $stm_event_lesson_time_end = strtotime($heading_item['timepicker_end']); ?>
            <?php endif; ?>
            <?php if (!empty($heading_item['timepicker_start']) || !empty($heading_item['timepicker_end']) || !empty($heading_item['location']) || !empty($heading_item['title']) || !empty($heading_item['description'])) : ?>
                <li>
                    <div class="event_lesson_info_time_loc">
                        <div class="event_lesson_info_times">
                            <i class="__icon icon_27px mtc stmicon-time_b"></i>
                            <?php if ($heading_item['timepicker_start'] == $heading_item['timepicker_end']) : ?>
                                <?php echo date_i18n($time_format, $stm_event_lesson_time_start); ?>
                            <?php else: ?>
                                <?php if (!empty($heading_item['timepicker_start'])) : ?><?php echo date_i18n($time_format, $stm_event_lesson_time_start); ?><?php endif; ?>
                                <?php if (!empty($heading_item['timepicker_start']) && !empty($heading_item['timepicker_end'])) : ?>&#8212;<?php endif; ?>
                                <?php if (!empty($heading_item['timepicker_end'])) : ?><?php echo date_i18n($time_format, $stm_event_lesson_time_end); ?><?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($heading_item['location'])) : ?>
                            <div class="event_lesson_info_location">
                                <i class="__icon icon_27px mtc stmicon-pin_b"></i>
                                <?php echo esc_html($heading_item['location']); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="event_lesson_info_content_wrap">
                        <div class="event_lesson_info_content">
                            <?php if (!empty($heading_item['title'])) : ?>
                                <div class="event_lesson_info_title stm_mf"><?php echo esc_html($heading_item['title']); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($heading_item['description'])) : ?>
                                <div class="event_lesson_info_description"><?php echo esc_html($heading_item['description']); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($heading_item['lesson_speakers'])) : ?>
                                <?php $stm_event_speakers = explode(',', $heading_item['lesson_speakers']); ?>
                                <ul class="event_lesson_speakers">
                                    <?php foreach ($stm_event_speakers as $stm_event_speaker) : ?>
                                        <li>
                                            <?php
                                            $post_thumnail = '';
                                            if(has_post_thumbnail($stm_event_speaker)) {
                                                $img_size = '40x40';
                                                $post_image_id = get_post_thumbnail_id($stm_event_speaker);
                                                $post_thumbnail = pearl_get_VC_img($post_image_id, $img_size);
                                            }
                                            ?>
                                            <?php if(has_post_thumbnail($stm_event_speaker)): ?>
                                                <div class="event_speaker_thumbnail"><?php echo html_entity_decode($post_thumbnail); ?></div>
                                            <?php endif; ?>
                                            <div class="event_speaker_content">
                                                <div class="event_speaker_name">
                                                    <?php echo get_the_title($stm_event_speaker); ?>
                                                </div>
                                                <?php if ($stm_event_venues = get_post_meta($stm_event_speaker, 'position', true)) : ?>
                                                    <div class="event_speaker_description"><?php echo esc_html($stm_event_venues); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>