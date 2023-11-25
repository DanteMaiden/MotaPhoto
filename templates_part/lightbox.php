<?php
    // Récupère les termes de la custom taxonomy Catégorie pour le post en cours
    $categories = get_the_terms(get_the_ID(), 'categorie');
?>

<div class="lightbox-overlay inactive" id="lightbox-overlay"></div>
<div class="lightbox-modale">
    <div id="lightbox" class="inactive">
        <div class="lightbox-previous"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-previous.png"></div>
        <div class="lightbox-image"><?php the_post_thumbnail('full'); ?></div>
        <div class="lightbox-next"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-next.png"></div>
    </div>
    <div class="lightbox-infos inactive" id="lightbox-infos">
        <p><?php echo(get_post_meta(get_the_ID(), 'reference', true)); ?></p>
        <p><?php foreach ($categories as $categorie) { echo($categorie->name); } ?></p>
    </div>
    <div class="lightbox-cross inactive" id="lightbox-cross">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/button-cross.png" alt="bouton de fermeture de modale"/>
    </div>
</div>