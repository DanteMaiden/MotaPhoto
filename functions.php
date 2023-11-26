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


// Charger plus de miniatures avec AJAX
function load_more_photos() {

    $page = $_POST['page'];
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
    $order = isset($_POST['order']) ? $_POST['order'] : 'DESC';
        // var_dump($page);
        // var_dump($format);
        // var_dump($categorie);
        // var_dump($order);

    if($categorie == 'all' && $format == 'all'){
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 12,
            'paged' => $page,
            'order' => $order,
        );
    }else if($categorie == 'all'){
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

    var_dump($args);

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            // Affichez vos miniatures ici
            echo get_the_post_thumbnail();
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No more photos found';
    endif;

    die();
}

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

// Enqueue le script JS et les styles nécessaires
function enqueue_custom_scripts_and_styles() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '', true);
    wp_localize_script('custom-script', 'ajax_obj', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts_and_styles');
    
