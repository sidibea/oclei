<?php if ( comments_open() || get_comments_number() ) { ?>
	<div class="stm_post_comments">
		<?php comments_template(); ?>
	</div>
<?php } ?>