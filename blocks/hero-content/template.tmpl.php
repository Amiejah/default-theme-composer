<?php echo esc_html( $fields['heading'] ); ?>

<p><?php echo $fields['content'] ?></p>
<?= wp_get_attachment_image($fields['image'], 'full'); ?>
