<?php

if (!class_exists('STM_Donation')) {
	class STM_Donation
	{

		public $form_fields = array();
		public $donation_id;

		protected function __construct($donation_id)
		{
			$this->donation_id = $donation_id;
		}

		public static function instance($id)
		{

			if (empty($instances[$id])) {
				$instances[$id] = new Self($id);
			}
			return $instances[$id];

		}

		public function process_payment($data)
		{


			if (empty($data['amount'])) {
				$data['amount'] = 10;
			}


			/*Create donor post*/
			$donor_data['post_title'] = $data['first_name'] . ' ' . $data['last_name'];
			$donor_data['post_type'] = 'stm_donors';
			$donor_id = wp_insert_post($donor_data);


			update_post_meta($donor_id, 'donor_email', $data['email']);
			update_post_meta($donor_id, 'donor_phone', $data['phone']);
			update_post_meta($donor_id, 'donor_address', $data['address']);
			update_post_meta($donor_id, 'donor_note', $data['notes']);
			update_post_meta($donor_id, 'donor_amount', $data['amount']);

			update_post_meta($donor_id, 'donor_donation', get_the_title($data['donation_id']));
			$items['item_name'] = html_entity_decode(get_the_title($this->donation_id));

			$items['item_number'] = $this->donation_id;
			$items['amount'] = $data['amount'];

			$return_url = get_permalink($this->donation_id);

			$paypal = new STM_PayPal($data['amount'], $donor_id, $items, $return_url);


			$url = $paypal->generate_payment_url();

			return $url;
		}

		public function print_form_modal()
		{

			$donationOptions = get_theme_mod('donation_options');

			$donations_amounts = array(
				pearl_get_option('stm_donations_amount_1', 10), pearl_get_option('stm_donations_amount_2', 20), pearl_get_option('stm_donations_amount_3', 30)
			);

			$currency_code = pearl_get_option('paypal_currency_code', 'USD');
			$currency_symbol = pearl_get_option('currency_symbol', '$');
			$currency_symbol_position = pearl_get_option('currency_symbol_position', 'right');

			wp_enqueue_script('stm_donation_form_handler');


			$this->form_fields = array(
				array(
					'type'           => 'radio',
					'wrapper_class'  => array('col-md-6', 'amounts_wrapper'),
					'name'           => 'donor[amount]',
					'value'          => $donations_amounts,
					'label'          => array(
						pearl_get_formatted_price(pearl_get_option('stm_donations_amount_1', 10)),
						pearl_get_formatted_price(pearl_get_option('stm_donations_amount_2', 20)),
						pearl_get_formatted_price(pearl_get_option('stm_donations_amount_3', 30))
					),
					'label_position' => 'after'
				),
				array(
					'type'          => 'number',
					'wrapper_class' => array('col-md-6'),
					'class'         => array('custom-amount', 'form-control'),
					'name'          => 'donor[custom_amount]',
					'placeholder'   => sprintf(esc_html__('Your amount (%s)', 'stm-configurations'), $currency_symbol),
				),
				array(
					'type'          => 'text',
					'wrapper_class' => array('col-md-6'),
					'class'         => array(''),
					'name'          => 'donor[first_name]',
					'label'         => esc_html__('Name *'),
					'required'      => true
				),
				array(
					'type'          => 'text',
					'wrapper_class' => array('col-md-6'),
					'class'         => array(''),
					'name'          => 'donor[last_name]',
					'label'         => esc_html__('Last name *'),
					'required'      => true
				),
				array(
					'type'          => 'email',
					'wrapper_class' => array('col-md-6'),
					'class'         => array(''),
					'name'          => 'donor[email]',
					'label'         => esc_html__('E-mail *'),
					'required'      => true
				),
				array(
					'type'          => 'tel',
					'wrapper_class' => array('col-md-6'),
					'class'         => array(''),
					'name'          => 'donor[phone]',
					'label'         => esc_html__('Phone *'),
					'required'      => true
				),
				array(
					'type'          => 'textarea',
					'wrapper_class' => array('col-md-6'),
					'class'         => array(''),
					'name'          => 'donor[address]',
					'label'         => esc_html__('Address *', 'stm-configurations'),
				),
				array(
					'type'          => 'textarea',
					'wrapper_class' => array('col-md-6'),
					'class'         => array(''),
					'name'          => 'donor[notes]',
					'label'         => esc_html__('Additional Note', 'stm-configurations'),
				),
				array(
					'type'          => 'submit',
					'wrapper_class' => array('col-md-12'),
					'class'         => array('btn', 'btn_primary', 'btn_solid', 'btn_loading'),
					'value'         => esc_html__('Donate', 'stm-configurations')
				)
			);

			$this->form_fields = apply_filters('stm_donation_form_fields', $this->form_fields);


			?>
            <div class="modal fade stm_donation_popup" id="donation_<?php echo esc_attr($this->donation_id) ?>_form"
                 tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="popup_title">
							<?php _e('You are donating to:', 'stm-configurations'); ?>
                            <h4><?php the_title(); ?></h4>
                            <div class="close_popup" data-dismiss="modal"><i class="fa fa-times"></i></div>
                        </div>
                        <div class="popup_content">
                            <form method="post" action="<?php echo esc_url(home_url()); ?>"
                                  data-donation-id="<?php echo esc_attr($this->donation_id) ?>"
                                  class="stm_donation_popup__form">
                                <div class="row">
									<?php stm_conf_build_form($this->form_fields); ?>
                                    <span class="preloader"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			<?php
		}

		public function get_target_amount()
		{
			$amount = get_post_meta($this->donation_id, 'target_amount', true);

			return $amount;
		}

		public function get_raised_amount()
		{

			$amount = get_post_meta($this->donation_id, 'raised_amount', true);

			return $amount;
		}

		public function get_donated_percent()
		{
			$target_amount = $this->get_target_amount();
			$raised_amount = $this->get_raised_amount();

			$percent = intval(($raised_amount / $target_amount) * 100);

			return $percent;
		}

		/**
		 * @return string|bool false if date not set
		 */
		public function get_end_date_timestamp()
		{
			$date = get_post_meta($this->donation_id, 'date_end', true);

			return $date;
		}

		public function get_title($as_link = false)
		{
			$post_title = get_the_title($this->donation_id);

			$title = '';
			if ($as_link) {
				$title .= '<a href="' . get_the_permalink($this->donation_id) . '" title="' . $post_title . '">';
				$title .= $post_title;
				$title .= '</a>';
			} else {
				$title .= $post_title;
			}

			return $title;
		}

		public function get_donate_button()
		{
			$today = time();
			$date_end = $this->get_end_date_timestamp();
			$state = '';
			$completed = $this->get_donated_percent() >= 100;

			$button_text = apply_filters('stm_donation_button_text', esc_html__('Donate now', 'stm-configurations'));

			$button_classes = array(
				'btn', 'btn_solid', 'btn_primary', 'stm_donation__action-button'
			);

			$button_classes = apply_filters('stm_donation_button_classes', $button_classes);

			if ($date_end && $today > $date_end) {
				$button_classes[] = 'disabled';
				$state = 'disabled="disabled"';
				if ($completed) {
					$button_text = esc_html__('Completed', 'stm-configurations');
				} else {
					$button_text = esc_html__('Ended', 'stm-configurations');
				}
			}

			$button = "<a href='#' data-toggle='modal' data-target='#donation_" . esc_attr($this->donation_id) . "_form:not(.disabled)' class='" . implode(' ', $button_classes) . "' {$state}>" . $button_text . "</a>";

			return $button;
		}

		public function get_donated_info()
		{
			$percent = $this->get_donated_percent();
			$text = apply_filters('stm_donation_donated_info_text', esc_html__('donated of', 'stm-configurations'));
			$amount = pearl_get_formatted_price($this->get_target_amount());

			$info = $percent . '% ' . $text . ' ' . $amount;

			return $info;
		}

		/**
		 * @return bool|int false if date not set
		 */
		public function get_days_to_end()
		{
			$today = time();
			$end_date = $this->get_end_date_timestamp();


			if ($end_date !== false) {
				if ($today > $end_date) {
					return 0;
				}

				$days = ($end_date - $today) / 60 / 60 / 24;

				return ceil($days);
			}

			return false;
		}

		public function the_ending_date_descr($js_timer = false)
		{
			wp_enqueue_script('jquery.countdown');

			$days_to_end = $this->get_days_to_end();
			$text = esc_html__('days left to achieve target', 'stm-configurations');

			if (!$js_timer && $days_to_end) {
                $text = sprintf(_n('%d day left to achieve target', '%d days left to achieve target', $days_to_end, 'pearl'), $days_to_end);
			}

			$donated_percent = $this->get_donated_percent();
			$end_date = $this->get_end_date_timestamp();
			$ended = time() > $end_date;
			$classes = array(
				'stm_donation__end-timer'
			);


			if ($ended) {
				$classes[] = 'ended';
				if ($donated_percent < 100) {
					$text = esc_html__('No days left to achieve target', 'stm-configurations');
				} elseif ($donated_percent > 100) {
					$text = esc_html__('Thank you!', 'stm-configurations');
				}
			}

			if ($end_date !== '') :
				?>

                <div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
					<?php if ($ended || !$js_timer) echo esc_html($text) ?>
                </div>
				<?php if ($js_timer): ?>

                <script>
                    (function ($) {
                        var dateEnd = '<?php echo esc_js(date('Y/m/d', $end_date)); ?>';
                        $(document).ready(function () {
                            $('.stm_donation__end-timer').countdown(dateEnd, function (e) {
                                if ($(this).hasClass('ended')) {
                                    return;
                                }
                                var days_plural = '%-D %!D:<?php esc_html_e('day, days', 'stm-configurations'); ?>;';
                                var hours_plural = '%-H %!H:<?php esc_html_e('hour, hours', 'stm-configurations'); ?>;';
								<?php if ($days_to_end < 1) : ?>
                                var str = hours_plural + ' <?php esc_html_e('left to achieve target', 'stm-configurations') ?>';
								<?php else : ?>
                                var str = days_plural + ' <?php esc_html_e('left to achieve target', 'stm-configurations') ?>'
								<?php endif; ?>
                                $(this).text(e.strftime(str));
                            })
                        });
                    })(jQuery)
                </script>
				<?php
			endif;
			endif;
		}

		public function get_donation_progress_bar()
		{
			$output = '';
			$classes = array('stm_donation__progress-bar', 'sbc');
			$donated_percent = $this->get_donated_percent();
			$bar_width = $donated_percent > 100 ? 100 : $donated_percent;


			if ($bar_width === 100) {
				$classes[] = 'stm_donation__progress-bar-full';
			}

			$classes = apply_filters('stm_donation_progress_bar_classes', $classes);

			$output .= '<span class=" ' . implode(' ', $classes) . ' " style="width: ' . intval($bar_width) . '%"></span>';

			return $output;
		}
	}
}