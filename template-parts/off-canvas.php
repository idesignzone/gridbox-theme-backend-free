<?php

?>

<div id="offcanvas" data-uk-offcanvas="mode: nav; overlay: true; flip: false" >
    <div class="uk-offcanvas-bar">

        <button class="uk-offcanvas-close uk-margin-small-top uk-hidden@s" type="button" data-uk-close></button>

        <div class="uk-hidden@s">
            <?php get_search_form(); ?>
        </div>

        <!-- Off-canvas Navigation MEnu-->
        <div class="uk-margin-small-top">
            <?php
            wp_nav_menu(
                array(
                    'theme_location'       => 'offcanvas-menu',
                    'container'            => 'ul',
                    'container_class'      => '',
                    'container_id'         => '',
                    'menu_class'           => 'uk-nav-default uk-nav-parent-icon',
                    'menu_id'              => '',
                    'items_wrap'           => '<ul data-uk-nav id="%1$s" class="%2$s">%3$s</ul>',
                    'walker'          => new My_Walker_Nav_Menu(),
                )
            );
            ?>
        </div>

        <!-- Off-canvas Content -->
        <hr class="uk-divider-small uk-hidden@s">
        <div class="uk-margin-small-top ">

        </div>

    </div>
</div>
