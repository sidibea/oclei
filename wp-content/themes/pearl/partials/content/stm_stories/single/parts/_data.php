<?php

$id = get_the_ID();

$details = get_post_meta($id, 'stm_info', true);

if(!empty($details)): ?>

    <table class="table table-striped">
        <?php foreach($details as $value) : ?>
            <?php if(!empty($value['label']) and !empty($value['name'])): ?>
                <tr>
                    <td><?php echo sanitize_text_field($value['label']); ?></td>
                    <td><?php echo sanitize_text_field($value['name']); ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>

<?php endif; ?>
