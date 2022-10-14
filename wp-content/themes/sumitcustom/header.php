<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('&laquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a href="#" class="navbar-brand">
            <?php bloginfo('name'); ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php
        wp_nav_menu([
            'menu' => 'primary',
            'theme_location' => 'menu-1',
            'container' => 'div',
            'cotainer_id' => 'navbarCollapse',
            'container_class' => 'collapse navbar-collapse',
            'menu_id' => false,
            'menu_class' => 'navbar-nav mr-auto',
            'depth' => 0,
        ]);
    ?>
  </nav>
