<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package gridbox-theme
 */

get_header();
?>

        <div class="uk-section uk-section-large title-area uk-dark uk-background-muted">
            <div class="uk-container uk-container-large">
                <div class="uk-grid-medium uk-text-center" data-uk-grid>

                    <!-- Breadcrumb Headings -->
                    <div class="uk-width-1-1@m" data-uk-scrollspy="cls: uk-animation-slide-bottom-small;target: .animation-item; delay: 200">
                        <h5 class="animation-item">404</h5>
                        <h1 class="animation-item uk-margin-small-top"><?php esc_html_e( 'Page Not Found', 'gridbox' ); ?></h1>
                    </div>

                    <!-- Breadcrumb Nav -->
                    <div class="uk-width-1-1@m uk-margin-medium-top breadcrumb">
                        <ul class="uk-breadcrumb">
                            <li><a href="<?php echo home_url(); ?>">Home</a></li>
                            <li>404</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

   <div class="uk-section uk-section-large">
        <div class="uk-container uk-container-large">
            <div class="uk-child-width-1-2" data-uk-grid>
                <div>
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/error.svg" >
                </div>
                <div>
                    <h2><span>Sorry!</span></h2>
                    <p class="uk-margin-small-top"><?php esc_html_e( 'Page Not Found It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'gridbox' ); ?></p>
                    <div class="uk-border-rounded uk-margin-medium-top"><?php get_search_form(); ?></div>
                    <div class="widget widget_categories uk-margin-medium-top uk-margin-medium-bottom">
                        <ul>
                            <?php
                            wp_list_categories(
                                array(
                                    'orderby'    => 'count',
                                    'order'      => 'DESC',
                                    'show_count' => 1,
                                    'title_li'   => '',
                                    'number'     => 10,
                                )
                            );
                            ?>
                        </ul>
                    </div
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();
