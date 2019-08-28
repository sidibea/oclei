<?php
$id = get_the_ID();
$participants = get_post_meta($id, 'cur_participants', true);
$max_participants = get_post_meta($id, 'participants_num', true);

if (empty($participants)) $participants = 0;

if ($participants < $max_participants):
    $btn = 'stm_single_event__' . $id;
    $stm_join_form_vars = array(
        'message' => esc_html__('You already joined the event', 'pearl'),
        'btn' => $btn
    );

    wp_localize_script('pearl_join_form', 'stm_join_form_vars', $stm_join_form_vars);
    wp_enqueue_script('pearl_join_form');
    ?>
    <div class="stm_single_event__form stm_event_<?php echo intval($id); ?>"
         id="stm_event_<?php echo intval($id); ?>">
        <form action="" method="post">
            <input type="hidden" value="<?php echo intval($id); ?>" name="id" />
            <h3><?php esc_html_e('Online Booking', 'pearl'); ?></h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text"
                               name="name"
                               placeholder="<?php esc_html_e('Your Name *', 'pearl') ?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="email"
                               name="email"
                               placeholder="<?php esc_html_e('Email address *', 'pearl') ?>"/>
                    </div>
                </div>
            </div>
            <div class="row stm_mgb_40">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text"
                               name="phone"
                               placeholder="<?php esc_html_e('Phone number', 'pearl') ?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text"
                               name="company"
                               placeholder="<?php esc_html_e('Company name', 'pearl') ?>"/>
                    </div>
                </div>
            </div>
            <div class="stm_flex stm_flex_center stm_flex_last form_actions">
                <label class="stm_mgb_0 agreement">
                    <input type="checkbox" name="agreement" value="1"/>
                    <?php esc_html_e('I agree with the all additional Terms and Conditions', 'pearl'); ?>
                </label>
                <a href="#"
                   data-id="<?php echo intval($id); ?>"
                   class="btn btn_primary btn_solid btn_loading <?php echo esc_attr($btn); ?>" disabled>
                    <span><?php esc_html_e('Book now', 'pearl'); ?></span>
                    <span class="preloader"></span>
                </a>
            </div>
            <div class="ajax_message"></div>
        </form>
    </div>
<?php endif;