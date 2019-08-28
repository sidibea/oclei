<?php
$button_text = pearl_get_option('stm_vacancies_button_text');
$button_url = pearl_get_option('stm_vacancies_button_url');

if(!empty($button_text) and !empty($button_url)): ?>
    <a class="btn btn_primary btn_solid"
       href="<?php echo esc_url($button_url); ?>"
       title="<?php printf(esc_html__( '%s', 'pearl' ), $button_text); ?>">
        <?php printf(esc_html__( '%s', 'pearl' ), $button_text); ?>
        <i class="fa fa-angle-right __icon icon_18px stm_mgl_5 stm_pt_1"></i>
    </a>
<?php endif; ?>