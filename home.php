<?php get_header(); ?>
<div class="random-photo-block">
    <?php
    // Obtenez une image aléatoire des thumbnails des custom post types "photos"
    $random_photo_args = array(
        'post_type'      => 'photos', // Remplacez 'photos' par le nom de votre custom post type
        'posts_per_page' => 1,
        'orderby'        => 'rand',   // Obtenez une image aléatoire
    );

    $random_photo_query = new WP_Query($random_photo_args);

    if ($random_photo_query->have_posts()) :
        while ($random_photo_query->have_posts()) : $random_photo_query->the_post();
            // Affichez le thumbnail de votre custom post type
            if (has_post_thumbnail()) {
                the_post_thumbnail('full'); // Vous pouvez remplacer 'thumbnail' par la taille d'image que vous préférez
            }
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>
<div class="hero-title">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero.png" alt="photographe event"/>
</div>
<?php get_footer(); ?>