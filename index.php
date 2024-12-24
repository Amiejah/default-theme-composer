<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php do_action('get_header'); ?>

    <?php
							wp_nav_menu(
								[
									'theme_location' => 'primary',
									'menu_class'	 => 'nav-menu',
									'menu_id'        => 'primary-menu',
									'walker' 		 =>  new TailwindNavWalker(),
									// 'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
								]
							);
						?>

    <div id="app" class="bg-slate-200 text-black border">
      <?php the_content() ?>
    </div>

    <?php do_action('get_footer'); ?>
    <?php wp_footer(); ?>
  </body>
</html>