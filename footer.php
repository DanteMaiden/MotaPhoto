        <footer>
        <?php get_template_part('./templates_part/modale'); ?>
        <?php get_template_part('./templates_part/lightbox'); ?>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-footer'
            ));
            ?>

            <?php wp_footer(); ?>
            
        </footer>
        
    </body>
</html>