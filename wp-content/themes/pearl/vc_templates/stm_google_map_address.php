<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

?>

<div class="item stm_owl__glitches"
     itemscope itemtype="http://schema.org/Organization"
     data-lat="<?php echo esc_attr( $lat ); ?>"
     data-lng="<?php echo esc_attr( $lng ); ?>"
     data-title="<?php echo esc_attr( $title ); ?>">
	<?php if( ! empty( $title ) ): ?>
		<div class="title h6 no_line" itemprop="name"><?php echo esc_html( $title ); ?></div>
	<?php endif; ?>
	<ul>
		<?php if( ! empty( $address ) ): ?>
			<li>
				<div class="icon">
					<i class="stmicon-location-2"></i>
				</div>
				<div class="text"
                     data-title="<?php esc_html_e('Office', 'pearl'); ?>">
					<p itemprop="address"><?php echo wp_kses( $address, array( 'br' => array() ) ); ?></p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( ! empty( $phone ) ): ?>
			<li>
				<div class="icon">
					<i class="stmicon-iphone"></i>
				</div>
				<div class="text" data-title="<?php esc_html_e('Phone', 'pearl'); ?>">
					<p itemprop="telephone"><?php echo wp_kses( $phone, array( 'br' => array() ) ); ?></p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( ! empty( $email ) ): ?>
			<li>
				<div class="icon">
					<i class="stmicon-email"></i>
				</div>
				<div class="text" data-title="<?php esc_html_e('Email', 'pearl'); ?>">
					<a itemprop="email"
                       href="mailto:<?php echo wp_kses_post( $email ); ?>">
                        <?php echo wp_kses_post( $email ); ?>
                    </a>
				</div>
			</li>
		<?php endif; ?>
        <?php if( ! empty( $open_hours ) ): ?>
            <li>
                <div class="icon">
                    <i class="stmicon-med_time"></i>
                </div>
                <div class="text" data-title="<?php esc_html_e('Open Hours', 'pearl'); ?>">
                    <p><?php echo wp_kses( $open_hours, array( 'br' => array() ) ); ?></p>
                </div>
            </li>
        <?php endif; ?>
	</ul>
</div>