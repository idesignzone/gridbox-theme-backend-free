<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gridbox-theme
 */

get_header();
?>
	<?php if ( have_posts() ) : ?>

    <div class="uk-section title-area breadcrumb uk-dark uk-background-muted">
        <div class="uk-container uk-container-large uk-margin-large-top">
            <div class="uk-grid-medium uk-flex-bottom uk-flex-between uk-text-left" data-uk-grid>

                <!-- Breadcrumb Headings -->
                <div class="uk-width-1-1@m" data-uk-scrollspy="cls: uk-animation-slide-bottom-small;target: .animation-item; delay: 200">
                    <h5 class="animation-item">BLOG</h5>
                    <h1 class="animation-item uk-margin-small-top"><?php the_archive_title(); ?></h1>
                    <?php if ( get_the_archive_description() ) : ?>
                        <hr class="animation-item uk-divider-small uk-text-primary">
                        <p class="animation-item uk-margin-small-top"><?php the_archive_description(); ?></p>
                    <?php endif; ?>

                </div>

                <!-- Breadcrumb Nav -->

                    <div class="uk-margin-medium-top breadcrumb">
                        <ul class="uk-breadcrumb">
                            <li><a href="<?php echo home_url(); ?>">Home</a></li>
                            <li><?php the_archive_title(); ?></li>
                        </ul>
                    </div>


            </div>
        </div>
    </div>

		<div class="uk-section uk-section-large">
			<div class="uk-container uk-container-large">
				<div class="uk-grid-medium" data-uk-grid>
					<div class="uk-width-expand@m">
						<div class="uk-child-width-1-2 uk-grid-medium" data-uk-grid>
						<?php
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
					</div>
					<div class="sidebar uk-width-1-3@m uk-border-rounded">
						<?php dynamic_sidebar( 'blog' ); ?>
					</div>
				</div>
			</div>
		</div>

<?php
get_footer();
