<li class="stm_history__item">
	<div class="stm_history__year"><?php echo sanitize_text_field( $year ); ?></div>
	<h4 class="stm_history__title no_line"><?php echo sanitize_text_field( $title ); ?></h4>
	<div class="stm_history__body">
		<?php echo wpb_js_remove_wpautop($description, true); ?>
	</div>
</li>