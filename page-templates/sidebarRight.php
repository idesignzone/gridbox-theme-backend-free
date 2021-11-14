<?php /* Template Name: RightSidebar */

get_header();
?>

    <main class="sidebar-right">

        <!-- Title Area -->
        <?php include get_template_directory() . '/template-parts/title-area.php'; ?>

        <div class="uk-section uk-section-large">
            <div class="uk-container uk-container-large">
                <div class="uk-grid-medium" data-uk-grid>
                    <div class="uk-width-expand@m">

                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content', 'page' );

                        endwhile; // End of the loop.
                        ?>

                    </div>
                    <div class="uk-width-1-3@m">
                        <?php get_sidebar(); ?>
                        </aside>
                    </div>
                </div>
            </div>
    </main>

<?php
get_footer();
