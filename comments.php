<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gridbox-theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="uk-container uk-container-medium">
    <div class="uk-flex-center uk-grid-medium" uk-grid>
        <div class="uk-width-2-3@m">
            <div class="uk-width-1-1">
                <div class="post-comments">
                    <?php
                    // You can start editing here -- including this comment!
                    if ( have_comments() ) :
                    ?>
                    <h3 class="comments-title">
                    <?php
                    $gridbox_comment_count = get_comments_number();
                    if ( '1' === $gridbox_comment_count ) {
                        printf(
                        /* translators: 1: title. */
                            esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'gridbox' ),
                            '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                        );
                    } else {
                        printf(
                        /* translators: 1: comment count number, 2: title. */
                            esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $gridbox_comment_count, 'comments title', 'gridbox' ) ),
                            number_format_i18n( $gridbox_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                        );
                    }
                    ?>
                    </h3><!-- .comments-title -->

                    <?php the_comments_navigation(); ?>


                    <ul class="comments-list">
                        <?php
                        wp_list_comments(
                            array(
                                'style'      => 'ul',
                                'format'      => 'html5',
                                'short_ping' => true,
                            )
                        );
                        ?>
                        <?php
                        the_comments_navigation();

                        // If comments are closed and there are comments, let's leave a little note, shall we?
                        if ( ! comments_open() ) :
                            ?>
                            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'gridbox' ); ?></p>
                        <?php
                        endif;

                        endif; // Check for have_comments().

                        comment_form($args);
                        $args = array( 'class_textarea' => 'uk-textarea' );
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="uk-width-1-3@m"></div>
    </div>
</div>

