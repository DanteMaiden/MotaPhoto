<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MotaPhoto</title>
        <?php wp_head(); ?>
    </head>
<body>

<header>
    
    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.png" alt='logo MotaPhoto' id='logo'/></a>

    <div class="menu-desktop">
        <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-header'
            ));
        ?>
    </div>
    <div class="menu-mobile">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Menu.png" alt='bouton du menu' id='menuBtn' class="active"  />
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Croix.png" alt='bouton de fermeture du menu' id='menuCroix' class="inactive" />
    </div>
</header>
<div class="megamenu-mobile">
    <div class="megamenu inactive" id='megamenu'>
        <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-header'
            ));
        ?>
    </div>
</div>