<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package gridbox-theme
 */

get_header();
?>

	<main id="primary" class="site-main">

  <div class="uk-section title-area breadcrumb uk-dark uk-background-muted">
            <div class="uk-container uk-container-large uk-margin-large-top">
                <div class="uk-grid-medium uk-flex-bottom uk-flex-between" data-uk-grid>

                    <!-- Breadcrumb Headings -->
                    <div class="uk-width-1-1@m" data-uk-scrollspy="cls: uk-animation-slide-bottom-small;target: .animation-item; delay: 200">
                        <h5 class="animation-item">SEARCH</h5>
                        <h1 class="animation-item uk-margin-small-top">
                            <?php
                            /* translators: %s: search query. */
                            printf( esc_html__( 'Search Results for: %s', 'gridbox' ), '<span class="uk-text-primary">' . get_search_query() . '</span>' );
                            ?>
                        </h1>
                        <hr class="animation-item uk-divider-small uk-text-primary">
                    </div>

                    <!-- Breadcrumb Nav -->
             
                    <div class="uk-margin-medium-top breadcrumb">
                        <ul class="uk-breadcrumb">
                            <li><a href="<?php echo home_url(); ?>">Home</a></li>
                            <li>
                                <?php
                                /* translators: %s: search query. */
                                printf( esc_html__( '%s', 'gridbox' ), '<span>' . get_search_query() . '</span>' );
                                ?>
                            </li>
                        </ul>
                    </div>
         

            </div>
        </div>
    </div>

    <div class="uk-section uk-section-large">
        <div class="uk-container uk-container-large">

                <div class="uk-grid-medium" data-uk-grid>
                    <div class="uk-width-expand@m">
                        <div class="uk-child-width-1-2@s uk-grid-medium" data-uk-grid>

                            <?php if ( have_posts() ) : ?>

                                <?php
                                /* Start the Loop */
                                while ( have_posts() ) :
                                    the_post();

                                    // Remove pages from search result
                                    if (is_search() && ($post->post_type=='page')) continue;

                                    /**
                                     * Run the loop for the search to output the results.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-search.php and that will be used instead.
                                     */
                                    get_template_part( 'template-parts/content', 'search' );

                                endwhile;

                                the_posts_navigation();

                            else :

                                get_template_part( 'template-parts/content', 'none' );

                            endif;
                            ?>

                        </div>
                    </div>
                    <div class="uk-width-1-3@m <?php echo $button_border; ?>">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
     
        </div>
    </div>

	</main><!-- #main -->

<?php
get_footer();
