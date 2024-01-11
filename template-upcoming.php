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
                    <div><?php the_field('project_number');?></div>
                    <h3><?php the_title();?></h3>
                    <span><?php the_field('year');?></span>
                </div>    
            </div>
        <?php endwhile; 
        wp_reset_postdata();?>
    </div>
<?php get_footer(); ?>