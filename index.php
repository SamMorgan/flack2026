<?php get_header(); ?>
    
    <div class="news-posts">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article class="news-wrap"> 
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="feat-img imgwrap"><?php the_post_thumbnail();?></div>
                <?php } ?>            
                <h1 class="title"><?php the_title();?></h1>
            
                <div>
                    <?php the_content(); ?>
                </div>
                
            </article>
            
        <?php endwhile; endif; ?>
    </div>    
    
    <?php 
        global $wp_query;

        $big = 999999999; // need an unlikely integer

        $pagination = paginate_links( array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var('paged') ),
            'total'     => $wp_query->max_num_pages,
            'prev_next' => false
        ) );

        if($pagination){
            echo '<div class="footer-buttons news-pagination pagination">'.$pagination.'</div>';
        }
    ?>
        
<?php get_footer(); ?>