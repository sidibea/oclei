<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_contact');
$classes[] = 'stm_contact_' . $style;
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
$classes[] = (empty($name)) ? 'stm_contact_noname' : '';
pearl_add_element_style('contact', $style);

$image = pearl_get_VC_img($image, $image_size);
$classes[] = (empty($name)) ? 'nameless' : 'named';
?>

<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
    <?php if( ! empty( $image ) ){ ?>
        <div class="stm_contact__image">
            <?php echo wp_kses_post( $image); ?>
        </div>
    <?php } ?>
    <div class="stm_contact__info">
        <h5 class="no_line stm_mgb_5"><?php echo sanitize_text_field( $name ); ?></h5>
        <?php if( $job ){ ?>
            <div class="stm_contact__job"><?php echo sanitize_text_field( $job ); ?></div>
        <?php } ?>
        <?php if( $phone ){ ?>
            <div class="stm_contact__row stm_contact__row_phone">
                <span><?php _e( 'Phone: ', 'pearl' ); ?></span><strong><?php echo sanitize_text_field( $phone ); ?></strong>
            </div>
        <?php } ?>
        <?php if( $email ){ ?>
            <div class="stm_contact__row stm_contact__row_email">
                <span><?php _e( 'Email: ', 'pearl' ); ?></span>
                <a href="mailto:<?php echo sanitize_text_field( $email ); ?>">
                    <?php echo sanitize_text_field( $email ); ?>
                </a>
            </div>
        <?php } ?>
        <?php if( $skype ){ ?>
            <div class="stm_contact__row stm_contact__row_skype">
                <span><?php _e( 'Skype: ', 'pearl' ); ?></span><?php echo sanitize_text_field( $skype ); ?>
            </div>
        <?php } ?>
    </div>
</div>
