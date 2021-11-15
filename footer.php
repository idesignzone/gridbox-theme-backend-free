<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gridbox-theme
 */

?>

<footer class="footer uk-background-cover">
    <!-- Start Middle Top -->
    <div class="footer-middle uk-section">
        <div class="uk-container uk-container-large">
            <div class="uk-flex uk-grid-medium uk-child-width-expand uk-border-rounded widgets">
                <!-- Single Widget -->
                <?php dynamic_sidebar( 'footer' ); ?>
                <!-- End Single Widget -->
            </div>
        </div>
    </div>
    <!--/ End Footer Middle -->
    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="uk-container uk-container-large">
            <div class="inner">
                <div class="uk-flex uk-flex-center copyright">
                    <p><?php echo comicpress_copyright(); ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Middle -->

</footer>

<!--Scroll To Top-->
<a href="#" id="scroll-to-top" class="uk-icon-button uk-text-primary" data-uk-totop data-uk-scroll></a>

<!-- Off-Canvas -->
<?php include get_template_directory() . '/template-parts/off-canvas.php'; ?>

<?php wp_footer(); ?>

</body>
</html>
