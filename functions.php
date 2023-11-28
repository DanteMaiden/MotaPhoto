<?php

//enqueue css//
function motaphoto_enqueue_normalize() {
    wp_enqueue_style( 'normalize-style',
        get_stylesheet_directory_uri() . '/normalize.css',
        wp_get_theme()->get('1.0.0')
    );
  }
  add_action( 'wp_enqueue_scripts', 'motaphoto_enqueue_normalize' );

function motaphoto_enqueue_styles() {
    wp_enqueue_style( 'theme-style',
        get_stylesheet_directory_uri() . '/style.css',
        wp_get_theme()->get('1.0.0')
    );
  }
  add_action( 'wp_enqueue_scripts', 'motaphoto_enqueue_styles' );


//création des emplacements de menu//
function register_custom_menu_locations() {
    register_nav_menus(
        array(
            'menu-footer' => __('Menu du Footer'),
            'menu-header' => __('Menu du Header'),
        )
    );
}
add_action('after_setup_theme', 'register_custom_menu_locations');

//enqueue script.js
function motaphoto_enqueue_scripts() {
    wp_enqueue_script('mon-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'motaphoto_enqueue_scripts');

//enqueue le fichier lightbox.js
function motaphoto_enqueue_lightbox() {
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'motaphoto_enqueue_lightbox');


// Charger plus de photos sur la home avec ajax
function load_more_photos() {

    //superglobale post
    $page = $_POST['page'];

    //On récupère les valeurs des 3 filtres
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
    $order = isset($_POST['order']) ? $_POST['order'] : 'DESC';
        // var_dump($page);
        // var_dump($format);
        // var_dump($categorie);
        // var_dump($order);

    //On vérifie si le contenu doit être filtré
    if($categorie == 'all' && $format == 'all'){
        //si on veut tout sans filtre
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 12,
            'paged' => $page,
            'order' => $order,
        );
    }else if($categorie == 'all'){
        //si on seulement toutes les catégories, on filtre uniquement sur le format
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 12,
            'paged' => $page,
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $format,
                ),
            ),
            'order' => $order,
        );
    }else if($format== 'all'){
        //si on veut seulement tous les formats, on filtre uniquement sur les catégories
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 12,
            'paged' => $page,
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $categorie,
                ),
            ),
            'order' => $order,
        );
    }else{
        //sinon c'est que l'on filtre à la fois les formats et les catégories
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 12,
            'paged' => $page,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $format,
                ),
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $categorie,
                ),
            ),
            'order' => $order,
        );
    }

    //var_dump($args);

    $query = new WP_Query($args); //on envoie la requette avec les arguments

    if ($query->have_posts()) : //si la requette retourne des résultats
        while ($query->have_posts()) : $query->the_post();
            $urlrelated = get_the_permalink();
            echo '<div class="photos-container-image survol-photo">'; //on affiche les résultats dans la div
            echo("<a href='".$urlrelated."'>");
            echo get_the_post_thumbnail();
            echo '</a>';
            echo '</div>';
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Pas de photos trouvées<br/>'; //sinon message d'erreur
    endif;

    die();
}

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

// Enqueue le fichier custom-script.js pour gérer la détection des changements de filtre sur la homepage
function enqueue_custom_scripts_and_styles() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '', true);
    wp_localize_script('custom-script', 'ajax_obj', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts_and_styles');
    
