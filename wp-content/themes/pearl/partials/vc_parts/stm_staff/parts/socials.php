<?php if( !empty($facebook) || !empty($twitter) || !empty($linkedin) || !empty($insta)){ ?>
	<ul class="list-unstyled stm_staff__socials">
		<?php if( !empty($facebook) ){ ?>
			<li>
				<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" class="stc ttc_h">
					<i class="fa fa-facebook"></i>
				</a>
			</li>
		<?php } ?>
		<?php if( !empty($twitter) ){ ?>
			<li>
				<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" class="stc ttc_h">
					<i class="fa fa-twitter"></i>
				</a>
			</li>
		<?php } ?>
		<?php if( !empty($linkedin) ){ ?>
			<li>
				<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" class="stc ttc_h">
					<i class="fa fa-linkedin"></i>
				</a>
			</li>
		<?php } ?>
		<?php if( !empty($insta) ){ ?>
			<li>
				<a href="<?php echo esc_url( $insta ); ?>" target="_blank" class="stc ttc_h">
					<i class="fa fa-instagram"></i>
				</a>
			</li>
		<?php } ?>
		<?php if( !empty($gplus) ){ ?>
			<li>
				<a href="<?php echo esc_url( $gplus ); ?>" target="_blank" class="stc ttc_h">
					<i class="fa fa-google-plus"></i>
				</a>
			</li>
		<?php } ?>
	</ul>
<?php } ?>