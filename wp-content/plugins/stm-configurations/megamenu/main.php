<?php
if(is_admin()) {
    require_once(STM_CONFIGURATIONS_PATH . '/megamenu/admin/includes/xteam/xteam.php');
    require_once(STM_CONFIGURATIONS_PATH . '/megamenu/admin/includes/config.php');
    require_once(STM_CONFIGURATIONS_PATH . '/megamenu/admin/includes/enqueue.php');
} else {
    require_once(STM_CONFIGURATIONS_PATH . '/megamenu/includes/walker.php');
    require_once(STM_CONFIGURATIONS_PATH . '/megamenu/includes/enqueue.php');
}