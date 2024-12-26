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

    <?php get_template_part( 'template-parts/layout/header', 'content' );?>


    <div id="app" class="bg-slate-200 text-black border">
      <?php the_content() ?>
    </div>

    
    <?php wp_footer(); ?>
  </body>
</html>