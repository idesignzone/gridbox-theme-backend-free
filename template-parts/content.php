<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gridbox-theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- News Item -->
    <div class="single-news">

        <!-- News Image -->
        <div class="uk-card uk-card-default uk-card-small uk-border-rounded">
            <div class="uk-card-media-top news-image uk-inline uk-transition-toggle">
                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                    <img class="uk-transition-scale-up uk-transition-opaque" src="<?php echo $image[0]; ?>" alt="news" data-uk-img>
                    <div class="news-date uk-position-small uk-position-top-left uk-padding-small uk-overlay-default uk-text-center">
                        <h2>
                            <?php echo get_the_time( 'd' ); ?>
                        </h2>
                        <p>
                            <?php echo get_the_time( 'M' ); ?>
                        </p>
                    </div>
                <?php endif; ?>
                <div class="meta-details">
                    <?php echo get_avatar( get_the_author_meta( 'ID' )); ?>
                    <span>by <?php the_author(); ?></span>
                </div>
            </div>

            <!-- News Meta -->
            <div class="uk-card-body uk-text-left">

                <!--  Categories-->
                <?php
                $categories = get_the_category(get_the_ID());
                $category_names = array();
                foreach ($categories as $category)
                {
                    $category_names[] = $category->cat_name;
                }
                echo '<a class="uk-link-text" href="' . get_category_link($category->cat_ID) . '">' . implode(', ', $category_names) . '</a>';
                ?>

                <h2 class="uk-text-bold uk-margin-small-top"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                <span class="uk-margin">
                    <?php
                    $post_content = apply_filters( 'the_content', get_the_content() );
                    $post_content = wp_strip_all_tags($post_content);
                    echo wp_trim_words( $post_content, 30);
                    ?>
                </span>

            </div>
            <div class="uk-card-footer uk-flex uk-flex-between">
                <a href="<?php the_permalink(); ?>" class="uk-button uk-button-text">Read more</a>
                <div class="uk-text-small uk-text-meta">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="18">
                        <path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm32 352c0 17.6-14.4 32-32 32H293.3l-8.5 6.4L192 460v-76H64c-17.6 0-32-14.4-32-32V64c0-17.6 14.4-32 32-32h384c17.6 0 32 14.4 32 32v288zM128 184c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24z"/>
                    </svg>
                    <span><?php echo get_comments_number( ); ?> comments</span>
                </div>
            </div>

        </div>

    </div>
</article>