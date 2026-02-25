<?php
    /* Template Name: Upcoming */ 
    get_header(); ?>
    <?php 
        $upcoming_work_query = new WP_Query( array(
            'post_type' => 'projects',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'tax_query' => array(
                array (
                    'taxonomy' => 'status',
                    'field' => 'slug',
                    'terms' => 'upcoming',
                )
            ),
        ) );
    ?>
    <div class="upcoming work-index">
        <?php while ( $upcoming_work_query->have_posts() ) : $upcoming_work_query->the_post();?>
            <div class="project-card">
                <div class="tooltip">
                    <div class="rollover imgwrap"><?php the_post_thumbnail('full');?></div>
                    <div class="project-card-title">
                        <div class="flex">
                            <div><?php the_field('project_number');?></div>
                            <h3><?php the_title();?></h3>
                        </div>     
                        <h4>
                            <?php
                                $categories = get_the_terms(get_the_ID(), 'project-category');
                                $category_names = array();
                                $seen_term_ids = array();

                                if ( $categories && ! is_wp_error($categories) ) {
                                    foreach ( $categories as $category ) {
                                        if ( $category->parent ) {
                                            $parent = get_term($category->parent, 'project-category');
                                            if ( $parent && ! is_wp_error($parent) && ! isset($seen_term_ids[$parent->term_id]) ) {
                                                $category_names[] = $parent->name;
                                                $seen_term_ids[$parent->term_id] = true;
                                            }
                                        }

                                        if ( ! isset($seen_term_ids[$category->term_id]) ) {
                                            $category_names[] = $category->name;
                                            $seen_term_ids[$category->term_id] = true;
                                        }
                                    }
                                }

                                echo esc_html(implode(', ', $category_names));
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
        <?php endwhile; 
        wp_reset_postdata();?>
    </div>
<?php get_footer(); ?>