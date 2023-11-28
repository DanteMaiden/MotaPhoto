jQuery(function($) {
    var page = 2;
    var canLoadMore = true;

    // Charger plus de photos au clic sur le bouton "Charger plus"
    $('#load-more-photos').on('click', function() {
        if (canLoadMore) {
            var format = $('#format-select').val();
            var categorie = $('#categorie-select').val();
            var order = $('#order-select').val();

            $.ajax({
                url: ajax_obj.ajaxurl,
                type: 'POST',
                data: {
                    action: 'load_more_photos',
                    page: page,
                    format: format,
                    categorie: categorie,
                    order: order,
                    nonce: ajax_obj.load_more_photos_nonce,
                },
                success: function(response) {
                    $('#photos-container').append(response);
                    page++;
                }
            });
        }
    });

    // Filtrer les photos lorsqu'un filtre est changé
    $('#format-select, #categorie-select, #order-select').on('change', function() {
        // Réinitialiser la pagination
        page = 1;

        // Réinitialiser les photos affichées
        $('#photos-container').empty();

        // Charger les nouvelles photos avec les filtres actuels
        $('#load-more-photos').trigger('click');
    });
});