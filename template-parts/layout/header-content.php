<header>
    <nav>
        <div>
            <?php do_action('km_header_menu_action_start'); ?>
            <?php
                wp_nav_menu(
                    [
                        'theme_location' => 'primary',
                        'menu_class'	 => 'nav-menu',
                        'menu_id'        => 'primary-menu',
                        'walker' 		 =>  new TailwindNavWalker(),
                    ]
                );
            ?>
            <?php do_action('km_header_menu_action_end'); ?>

            <?php if ( is_active_sidebar( 'sidebar-menu' ) ) : ?>
                <div class="<?php esc_attr_e( 'default-menu-sidebar', '_km' ); ?>">
                    <?php dynamic_sidebar( 'sidebar-menu' ); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php do_action('km_header_action_end'); ?>

    </nav>
</header>