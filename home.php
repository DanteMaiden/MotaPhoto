<?php get_header(); ?>
<div class="random-photo-block">
    <?php
    // fonction pour l'image aléatoire du hero
    $random_photo_args = array(
        'post_type'      => 'photos', 
        'posts_per_page' => 1,
        'orderby'        => 'rand',   // random
    );

    $random_photo_query = new WP_Query($random_photo_args);

    if ($random_photo_query->have_posts()) :
        while ($random_photo_query->have_posts()) : $random_photo_query->the_post();
            // affiche l'image random
            if (has_post_thumbnail()) {
                the_post_thumbnail('full'); 
            }
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>
<div class="hero-title">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero.png" alt="photographe event"/>
</div>

<!-- Affichage du moteur de recherche d'images -->
<!-- Dans votre fichier de template de page d'accueil -->

<!-- Sélecteurs de filtres -->
<div>
    <label for="format-select">Format:</label>
    <select id="format-select">
        <!-- Remplacez 'format_1', 'format_2', etc., par vos termes de taxonomie réels -->
        <option value="all">Tout</option>
        <option value="portrait">Portrait</option>
        <option value="paysage">Paysage</option>
        <!-- Ajoutez d'autres options selon vos besoins -->
    </select>

    <label for="categorie-select">Catégorie:</label>
    <select id="categorie-select">
        <!-- Remplacez 'category_1', 'category_2', etc., par vos termes de taxonomie réels -->
        <option value="all">Tout</option>
        <option value="mariage">Mariage</option>
        <option value="concert">Concert</option>
        <!-- Ajoutez d'autres options selon vos besoins -->
    </select>

    <label for="order-select">Ordre:</label>
    <select id="order-select">
        <option value="ASC">Croissant</option>
        <option value="DESC">Décroissant</option>
    </select>
</div>

<!-- Conteneur pour les miniatures -->
<div id="photos-container">
    <?php
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 12,
        'paged' => 1,
        'order' => 'ASC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            // Affichez vos miniatures ici
            echo get_the_post_thumbnail();
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No photos found';
    endif;
    ?>
</div>

<!-- Bouton "Charger plus" -->
<button id="load-more-photos">Charger plus</button>




<?php get_footer(); ?>