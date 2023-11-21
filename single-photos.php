<?php get_header(); ?>

<article class="photo-article">
<p class="get_id"><?php $postID = the_ID(); ?></p>
    <div class="photo-infos">
        <!-- titre -->
        <div class="photo-mobile"><?php the_post_thumbnail(); ?></div>
        <h1 class="entry-title"><?php the_title(); ?></h1>

        <?php
        // Récupère la valeur du champ Référence
        $ref = get_post_meta(get_the_ID(), 'reference', true);

        // Vérifie si le champ a une valeur
        if ($ref) {
            echo '<div class="custom-field">Référence : ' . esc_html($ref) . '</div>';
        }
        ?>

        <script>
            //on passe la variable ref php en javascript pour la préécrire dans le formulaire
            let ref = <?php echo json_encode($ref); ?>;
        </script>

        <?php
        // Récupère les termes de la custom taxonomy Catégorie pour le post en cours
        $categories = get_the_terms(get_the_ID(), 'categorie');

        // Vérifie si des termes ont été trouvés
        if ($categories && !is_wp_error($categories)) {
            echo '<div class="custom-taxonomy">';
            foreach ($categories as $categorie) {
                echo '<span class="taxonomy-categorie">Catégorie : ' . esc_html($categorie->name) . '</span>';
            }
            echo '</div>';
        }
        ?>

        <?php
        // Récupère les termes de la custom taxonomy Format pour le post en cours
        $formats = get_the_terms(get_the_ID(), 'format');

        // Vérifie si des termes ont été trouvés
        if ($formats && !is_wp_error($formats)) {
            echo '<div class="custom-taxonomy">';
            foreach ($formats as $format) {
                echo '<span class="taxonomy-format">Format : ' . esc_html($format->name) . '</span>';
            }
            echo '</div>';
        }
        ?>

        <?php
        // Récupère la valeur du champ Type
        $type = get_post_meta(get_the_ID(), 'type', true);

        // Vérifie si le champ a une valeur
        if ($type) {
            echo '<div class="custom-field">Type : ' . esc_html($type) . '</div>';
        }
        ?>

        <!-- année -->
        <div class="entry-year">Année : <?php the_time('Y'); ?></div>

        <div class="photo-contact">
            <p>Cette photo vous intéresse ?</p>
            <a class="contact" id="photo-btn-contact">Contact</a>
        </div>

    </div>
    <div class="photo-img">
        <!-- image à la une -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('full'); ?>
            </div>
        <?php endif; ?>

        <div class="photo-navigation">
                    <?php 
                    $prev_custom_post = get_previous_post($postID);
                    $next_custom_post = get_next_post($postID);
                    // Récupérer la miniature du post précédent
                    $next_post_thumbnail = get_the_post_thumbnail($next_custom_post, 'thumbnail');

                    // Afficher la miniature
                    echo $next_post_thumbnail;
                    ?>
                      <div class="photo-arrows">
                        <?php

                        if ($prev_custom_post) {
                            $prev_custom_post_link = get_permalink($prev_custom_post);
                            echo '<a href="' . esc_url($prev_custom_post_link) . '"><img src="/Motaphoto/wp-content/themes/motaphoto/assets/images/left-arrow.png" alt="voir la photo précédente" class="photo-left"/></a>';
                        }

                        if ($next_custom_post) {
                            $next_custom_post_link = get_permalink($next_custom_post);
                            echo '<a href="' . esc_url($next_custom_post_link) . '"><img src="/Motaphoto/wp-content/themes/motaphoto/assets/images/right-arrow.png" alt="voir la photo suivante" class="photo-right"/></a>';
                        }
                        ?>

                      </div>
                    </div>
    </div>
</article>
<div class="photo-related">
                    <h3 class="photo-subtitle">Vous aimerez aussi</h3>
                    <div class="photos-deux-related">
                      <?php 
                        $args = array(
                          'post_type' => 'photos', // Le type de publication personnalisé
                          'posts_per_page' => 2, // Récupère tous les articles de cette taxonomie
                          'tax_query' => array(
                              array(
                                  'taxonomy' => 'categorie', // Le nom de la taxonomie (dans ce cas, "catégorie").
                                  'field' => 'id', // Vous pouvez utiliser 'term_id', 'slug' ou 'name' en fonction de ce que vous avez.
                                  'terms' => get_term_by('name', $categorie->name, 'categorie')->term_id, // Remplacez 'Nom de la catégorie' par le nom de la catégorie que vous recherchez.
                              ),
                          ),
                      );
                      
                      $query = new WP_Query($args);
                      
                      if ($query->have_posts()) {
                          while ($query->have_posts()) {
                            $query->the_post();
                            $urlrelated = get_the_permalink();
                            echo("<a href='".$urlrelated."'><div class='photos-deux-flex'>");
                              $query->the_post_thumbnail();
                              the_post_thumbnail(); 
                              // Le contenu de chaque article ici.
                            echo("</div></a>");
                          }
                          wp_reset_postdata(); // Réinitialise la requête WP_Query.
                      }
                      ?>
                    </div>
                    <div class="photo-btn-box">
                      <a class="photo-btn-related">Toutes les photos</a>
                    </div>
                </div>
<?php get_footer(); ?>