<?php

?>

<div class="uk-section title-area uk-dark uk-background-muted">
    <div class="uk-container uk-container-large uk-margin-large-top">
        <div class="uk-grid-medium uk-flex-bottom uk-flex-between uk-text-center" data-uk-grid>

            <!-- Breadcrumb Headings -->
            <div class="uk-width-1-1@m" data-uk-scrollspy="cls: uk-animation-slide-bottom-small;target: .animation-item; delay: 200">
                <h5 class="animation-item">BLOG</h5>
                <h1 class="animation-item uk-margin-small-top"><?php single_post_title(); ?></h1>
                <hr class="animation-item uk-divider-small uk-text-primary">
                <p class="animation-item uk-margin-small-top">
                    <?php
                    $post_content = apply_filters( 'the_excerpt', get_the_excerpt() );
                    $post_content = wp_strip_all_tags($post_content);
                    echo wp_trim_words( $post_content, 30);
                    ?>
                </p>
            </div>

            <!-- Breadcrumb Nav -->
            <div class="uk-width-1-1@m  uk-margin-medium-top breadcrumb">
                <ul class="uk-breadcrumb">
                    <?php the_breadcrumb(); ?>
                </ul>
            </div>

        </div>

    </div>
</div>
<div class="uk-section uk-section-large">
    <div class="uk-container uk-container-medium">
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="uk-flex-center">
                <div class="uk-width-expand">
                    <div class="uk-inline news-image">
                        <?php gridbox_theme_post_thumbnail(); ?>
                        <div class="news-date uk-position-small uk-position-top-left uk-padding-small uk-overlay-default uk-text-center">
                            <h2>
                                <?php echo get_the_time( 'd' ); ?>
                            </h2>
                            <p>
                                <?php echo get_the_time( 'M' ); ?>
                            </p>
                        </div>
                    </div>
                    <div>
                        <div>

                            <?php
                            if ( is_singular() ) :
                                the_title( '<h1 class="uk-margin-medium-top">', '</h1>' );
                            else :
                                the_title( '<h1 class="uk-margin-medium-top"><a href="' . esc_url( get_permalink() ) . '">', '</a></h1>' );
                            endif;

                            if ( 'post' === get_post_type() ) : ?>
                                <ul class="uk-margin-small-top uk-flex">
                                    <li class="uk-margin-medium-right">
                                        <i class="far fa-lg fa-calendar-alt"></i>
                                        <?php
                                        $time_string = sprintf(
                                            esc_html( get_the_date() )
                                        );
                                        $posted_on = sprintf(
                                        /* translators: %s: post date. */
                                            esc_html_x( 'Posted on  %s ', 'post date' ),
                                            '<a href="' . get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')) . '" rel="bookmark">'  . $time_string . '</a>'
                                        );
                                        ?>
                                        <?php echo $posted_on; ?>
                                    </li>

                                    <li>
                                        <i class="far fa-lg fa-eye"></i>
                                        55 Views   fix me
                                    </li>
                                </ul>
                            <?php endif; ?>

                            <p class="uk-margin-medium-top"><?php the_content(); ?></p>

                            <?php $tags = get_tags(); ?>
                            <div class="uk-margin-medium-top">
                                <div class="uk-flex uk-flex-middle uk-flex-wrap">
                                    <h5 class="uk-margin-medium-right uk-margin-small-top uk-margin-remove-bottom">Related Tags</h5>
                                    <div class="uk-margin-small-top">
                                        <?php foreach ( $tags as $tag ) { ?>
                                            <a class="uk-button uk-button-default uk-button-small uk-border-rounded uk-margin-small-bottom" href="<?php echo get_tag_link( $tag->term_id ); ?>"><?php echo $tag->name; ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Author Info -->
                        <div class="uk-card uk-card-default uk-card-body uk-margin-medium-top uk-border-rounded">
                            <div class="uk-flex uk-flex-middle director">
                                <div>
                                    <?php echo get_avatar( get_the_author_meta( 'ID' )); ?>
                                </div>
                                <div>
                                    <h4 class="uk-margin-small-bottom uk-text-bold"><?php esc_html_e( 'Written by', 'text_domain' ); ?> <?php the_author_posts_link(); ?></h4>
                                    <p class="uk-margin-small-bottom uk-text-italic uk-inline"><?php the_author_description(); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Posts Navigation -->
                        <div class="recent-nav">
                            <div class="uk-flex uk-flex-between">
                                <?php
                                $prev_post = get_previous_post();

                                echo      '<div class="uk-width-2-4">';

                                if($prev_post) {
                                    $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
                                    echo "\t" . '<div class="prev-project"><a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '" class="nav-link"><span><i class="uk-visible@s fas fa-arrow-left"></i>'. $prev_title . '</span></a></div>' . "\n";
                                }

                                echo '</div>';

                                echo '<div class="uk-width-1-4">';
                                echo    '<div class="middle-grid">';
                                echo        '<a href="';
                                echo  get_permalink( get_option( 'page_for_posts' ) );
                                echo        '" data-uk-icon="icon: grid"></a>';
                                echo    '</div>';
                                echo '</div>';

                                $next_post = get_next_post();

                                echo      '<div class="uk-width-2-4">';

                                if($next_post) {
                                    $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
                                    echo "\t" . '<div class="next-project"><a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" class="nav-link"><span>'. $next_title . '<i class="uk-visible@s fas fa-arrow-right"></i></span></a></div>' . "\n";
                                }

                                echo '</div>';

                                ?>
                            </div>
                        </div>

                    </div>

                    <!-- Related Posts carousel-->
                    <div data-uk-slider class="uk-position-relative uk-margin-medium-top">

                        <!-- News -->
                        <div class="uk-slider-container" tabindex="-1">
                            <ul class="uk-slider-items uk-grid-medium uk-grid-match uk-child-width-1-2@m" data-uk-grid="masonry: true" data-uk-scrollspy="cls: uk-animation-fade; target: .single-news; delay: 300">
                                <?php
                                //for use in the loop, list 5 post titles related to first tag on current post
                                $tags = wp_get_post_tags($post->ID);
                                if ($tags) {
                                    $first_tag = $tags[0]->term_id;
                                    $args=array(
                                        'tag__in' => array($first_tag),
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page'=>5,
                                        'caller_get_posts'=>1
                                    );
                                    $my_query = new WP_Query($args);
                                    if( $my_query->have_posts() ) {
                                        while ($my_query->have_posts()) : $my_query->the_post(); ?>

                                            <!-- News Item -->
                                            <li class="single-news">
                                                <div class="uk-card uk-border-rounded uk-background-muted">
                                                    <div class="uk-card-media-top news-image uk-inline uk-transition-toggle">
                                                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                                                            <img class="uk-transition-scale-up uk-transition-opaque" src="<?php echo $image[0]; ?>" alt="news" data-uk-img>
                                                            <div class="news-date uk-position-small uk-position-top-left uk-padding-small uk-overlay-default uk-text-center">
                                                                <h2 class="uk-h2 uk-margin-remove-bottom">
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
                                                    <div class="uk-card-body uk-text-left">

                                                        <!--  Categories-->
                                                        <?php
                                                        $categories = get_the_category(get_the_ID());
                                                        $category_names = array();
                                                        foreach ($categories as $category)
                                                        {
                                                            $category_names[] = $category->cat_name;
                                                        }
                                                        echo implode(', ', $category_names);
                                                        ?>

                                                        <h3 class="uk-text-bold uk-margin-small-top"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                                        <span>
                                                <?php
                                                $post_content = apply_filters( 'the_content', get_the_content() );
                                                $post_content = wp_strip_all_tags($post_content);
                                                echo wp_trim_words( $post_content, 30);
                                                ?>
                                            </span>
                                                    </div>
                                                    <div class="uk-card-footer uk-flex uk-flex-between">
                                                        <a href="<?php the_permalink(); ?>" class="uk-button uk-button-text">Read more</a>
                                                        <div>
                                                            <i class="far fa-lg	fa-comments"></i>
                                                            <span><?php echo get_comments_number( ); ?></span>
                                                            <span class="uk-text-small uk-text-meta">Comments</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>


                                        <?php
                                        endwhile;
                                    }
                                    wp_reset_query();
                                }
                                ?>
                        </div>
                        </ul>

                        <!-- News Carousel Controls -->
                        <div class="uk-visible@s">
                            <a class="uk-position-center-left-out uk-position-small" href="#" data-uk-slidenav-previous data-uk-slider-item="previous"></a>
                            <a class="uk-position-center-right-out uk-position-small" href="#" data-uk-slidenav-next data-uk-slider-item="next"></a>
                        </div>

                        <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
                    </div>

                </div>
            </div>
<!--            <div id="comments"></div>-->
        </div>
    </div>
</div>

<!-- Single Post Styles -->
