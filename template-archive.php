<?php
    /* Template Name: Archive */ 
    get_header(); ?>
    <?php 
        $current_work_query = new WP_Query( array(
            'post_type' => 'projects',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'tax_query' => array(
                array (
                    'taxonomy' => 'status',
                    'field' => 'slug',
                    'terms' => 'archive',
                )
            ),
        ) );
    ?>
    <div class="work-index archive">
        <?php while ( $current_work_query->have_posts() ) : $current_work_query->the_post();
           get_template_part('includes/project-card');           
        endwhile; 
        wp_reset_postdata();?>
    </div>
<?php get_footer(); ?>