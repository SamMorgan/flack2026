<div class="project-card allcaps">
    <?php
        $project_link = get_permalink();
        $current_term = get_queried_object();
        if ( $current_term instanceof WP_Term ) {
            $term_link = get_term_link($current_term);
            if ( ! is_wp_error($term_link) ) {
                $term_path = wp_parse_url($term_link, PHP_URL_PATH);
                $project_link = add_query_arg(
                    array('from' => $term_path),
                    $project_link
                );
            }
        }
    ?>
    <a href="<?php echo esc_url($project_link);?>">
    <div class="tooltip">        
        <?php
            $hover_images = array();
          
            $gallery = get_field('thumbnail_gallery');
            if ( $gallery ) {
                foreach ( $gallery as $image ) {
                    $hover_images[] = $image;
                    if ( count($hover_images) >= 4 ) {
                        break;
                    }
                }
            }
            
            if ( empty($hover_images) ) {
                if ( have_rows('project_gallery_scroll') ) {
                    while ( have_rows('project_gallery_scroll') ) {
                        the_row();
                        if ( get_row_layout() === 'single_image' ) {
                            $image = get_sub_field('image');
                            if ( $image ) {
                                $hover_images[] = $image;
                            }
                        } elseif ( get_row_layout() === 'portrait_images' ) {
                            $image_left = get_sub_field('image_left');
                            $image_right = get_sub_field('image_right');
                            if ( $image_left ) {
                                $hover_images[] = $image_left;
                            }
                            if ( $image_right ) {
                                $hover_images[] = $image_right;
                            }
                        }
                        if ( count($hover_images) >= 4 ) {
                            break;
                        }
                    }
                }
            }

            if ( ! empty($hover_images) && count($hover_images) > 1 ) {
                echo '<rollover-slider class="rollover imgwrap slide-show">';
                foreach ( $hover_images as $image ) {
                    echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '" loading="eager" decoding="sync">';
                }
                echo '</rollover-slider>';
            } else {
                echo '<div class="rollover imgwrap">';
                the_post_thumbnail('full');
                echo '</div>';
            }
        ?>
        <div class="project-card-title flex">
            <h3><?php the_title();?></h3>
            <span><?php the_field('year');?></span>
        </div>
    </div>
    </a>
</div>