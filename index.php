<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gridbox-theme
 */

get_header();
?>

	<main id="primary" class="site-main">

    <div class="uk-section uk-section-large">
        <div class="uk-container uk-container-large">
            <div class="uk-grid-medium" data-uk-grid>
                <div class="uk-width-expand@m">
                    <div class="uk-grid-medium uk-child-width-1-2@m" data-uk-grid="masonry: true">
                        <?php
                        if ( have_posts() ) :

                            if ( is_home() && ! is_front_page() ) :
                                ?>

                            <?php
                            endif;

                            /* Start the Loop */
                            while ( have_posts() ) :
                                the_post();

                                /*
                                    * Include the Post-Type-specific template for the content.
                                    * If you want to override this in a child theme, then include a file
                                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                    */
                                get_template_part( 'template-parts/content', get_post_type() );

                            endwhile;

                            the_posts_navigation();

                        else :

                            get_template_part( 'template-parts/content', 'none' );

                        endif;
                        ?>

                    </div>

                    <div class="uk-margin-medium-top">
                        <?php page_navi(); ?>
                    </div>

                </div>
                <div class="uk-width-1-3@m uk-border-rounded">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
