<?php

$page_title_area = get_field('page_title_area');
$show_title_area = $page_title_area['show_title_area'];

$headings = $page_title_area['headings'];
$title = $headings['title'];
$subtitle = $headings['subtitle'];
$description = $headings['description'];

$layout = $page_title_area['layout'];
$theme = $layout['theme'];
$height = $layout['height'];
$content_grid = $layout['content_grid'];
$content_alignment = $layout['content_alignment'];

$background = $page_title_area['background'];
$color = $background['color'];
$overlay = $background['overlay'];
$image = $background['image'];

$page_header = get_field('page_header');
$header_theme = $page_header['header_theme'];
$transparent_header = $page_header['transparent_header'];

?>

<!-- Title Area -->
<?php if ( $show_title_area ): ?>
    <div class="title-area uk-inline uk-flex uk-background-cover uk-section <?php echo $height; ?> <?php echo $theme; ?>" 
    style="background-color:<?php echo $color; ?>; background-image: url('<?php echo $image; ?>');" >

        <?php if ( $overlay ): ?>
            <div class="<?php echo $overlay; ?> uk-position-cover"></div> 
        <?php endif; ?>

        <div class="uk-width-1-1">
            <div class="uk-container uk-container-large uk-margin-large-top">
                <div class="uk-grid-medium uk-flex-bottom uk-flex-between <?php echo $content_alignment; ?>" data-uk-grid>

                    <!-- Title Area Headings -->
                    <div class="uk-width-1-<?php echo $content_grid; ?>@m" data-uk-scrollspy="cls: uk-animation-slide-bottom-small;target: .animation-item; delay: 200">
                        <?php if ( $subtitle ): ?>
                            <h5 class="animation-item"><?php echo $subtitle; ?></h5>
                        <?php endif; ?>
                        <div>
                            <?php
                            if ( $title ) {
                                echo '<h1 class="animation-item uk-margin-small-top">' . $title . '</h1>';
                            } else {
                                single_post_title('<h1 class="animation-item uk-margin-small-top">', '</h1>');
                            }
                            ?>
                        </div>
                        <?php if ( $description ): ?>
                            <hr class="animation-item uk-divider-small uk-text-primary">
                            <p class="animation-item uk-margin-small-top uk-margin-small-bottom"><?php echo $description; ?></p>
                        <?php endif; ?>

                    </div>

                    <!-- Breadcrumb Nav -->
                    <?php if ( $page_title_area['show_breadcrumb'] ): ?>
                        <div class="uk-margin-small-top breadcrumb uk-position-z-index">
                            <ul class="uk-breadcrumb uk-margin-medium-bottom">
                                <?php the_breadcrumb(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
<?php endif; ?>
