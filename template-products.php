<?php
    /* Template Name: Products */ 
    get_header(); ?>
    <?php $products = get_field('products');
    if( $products ): ?>
    <div class="work-index archive">
    <?php foreach( $products as $post ): 
        get_template_part('includes/project-card');           
    endforeach; ?>
    </div>
    <?php wp_reset_postdata();
    endif;?>
<?php get_footer(); ?>