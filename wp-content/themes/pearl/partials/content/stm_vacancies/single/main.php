<?php

$layout = pearl_get_option('stm_vacancies_layout_single', 'layout_1');
pearl_load_element_style('post_types', 'vacancies', 'style_' . $layout);

get_template_part('partials/content/stm_vacancies/single/layouts/layout_'. $layout);