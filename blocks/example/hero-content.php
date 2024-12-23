<div <?= get_block_wrapper_attributes(); ?>>
    <?= esc_html( $attributes['title'] ); ?>

    <img src="<?= $attributes['image']['full_url'] ?>">
    
    <p><?= $attributes['content'] ?></p>
</div>