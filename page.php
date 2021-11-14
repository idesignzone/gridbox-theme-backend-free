<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gridbox-theme
 */

// Page Options
$page_header = get_field('page_header');
$header_theme = $page_header['header_theme'];
$transparent_header = $page_header['transparent_header'];
$custom_css = get_field('custom_css');

get_header();
?>

	<main id="primary" class="site-main">

	<div class="uk-section uk-section-large">
		<div class="uk-container uk-container-large">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</div>
	</div>

	</main><!-- #main -->

    <!-- Page Header Styles -->
    <style>

        <?php echo $custom_css; ?>

        /*Page Header Theme*/
        <?php if ( $header_theme == "uk-dark" ): ?>
        header,
        header .uk-navbar-nav>li>a,
        header .uk-logo,
        header .uk-icon {
            color: #000 !important;
        }
        <?php endif; ?>

        <?php if ( $header_theme == "uk-light" ): ?>
        header,
        header .uk-navbar-nav>li>a,
        header .uk-logo,
        header .uk-button,
        header .uk-icon {
            color: #fff !important;
        }
        .uk-navbar-sticky .uk-navbar-container {
            background-color: <?php echo $colors['dark_color']; ?>;
        }
        <?php endif; ?>

        /*Page Transparent Header*/
        <?php if ( $transparent_header == "true" ): ?>
        header {
            background-color: transparent !important;
        }
        <?php endif; ?>

        .site-main .title-area {
            background-color: <?php echo $color; ?> !important;
            background-image: url("<?php echo $image; ?>");
        }
        <?php if ( $content_alignment == "uk-text-center" ): ?>
        .site-main .breadcrumb {
            margin: 0 auto;
        }
        <?php endif; ?>
        <?php if ( $content_alignment == "uk-text-right" ): ?>
        .site-main .breadcrumb {
            margin: 0 0 0 auto;
        }
        <?php endif; ?>

    </style>


<?php
get_footer();
