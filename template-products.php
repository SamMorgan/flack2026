<?php
    /* Template Name: Products */ 
    get_header(); ?>
    <?php $products = get_field('products');
    if( $products ): ?>
    <div class="product-index">
    <?php foreach( $products as $post ): ?>
        <div class="product-card allcaps">
        <a href="<?php the_permalink();?>" class="tooltip">
            <div class="imgwrap"><?php the_post_thumbnail('full');?></div>
            <h3><?php the_title();?></h3>
            <span><?php the_field('year');?></span>
        </a>
        </div>          
    <?php endforeach; ?>
    </div>
    <?php wp_reset_postdata();
    endif;?>
<?php get_footer(); ?>