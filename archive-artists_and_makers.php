<?php 
    get_header(); ?>    
    
    <div class="artists-and-makers-wrap">   
        <?php 
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

            $am_args = array(
                //'posts_per_page' => -1,
                'post_type'      => 'artists_and_makers',
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'paged'          => $paged
            );

            $am_query = new WP_Query( $am_args );

            if( $am_query->have_posts() ) while( $am_query->have_posts() ) : $am_query->the_post(); 
            //if( have_posts() ) while( have_posts() ) : the_post(); 

                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
                ?><div class="artists-and-makers-card">
                    <div class="wrap">
                        <a href="<?php the_permalink();?>">
                            <div class="thumbnail">
                                <lazy-img class="img-wrap imgwrap">
                                    <?php echo '<img class="static" src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';?>
                                </lazy-img>
                            </div>
                            <h2 class="xs-text"><?php the_title();?></h2>
                        </a>
                    </div>          
                </div><?php 
                                             
            endwhile;

 
            //global $wp_query;

            $big = 999999999; // need an unlikely integer

            $pagination = paginate_links( array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '?paged=%#%',
                'current'   => max( 1, get_query_var('paged') ),
                'total'     => $am_query->max_num_pages,
                'prev_next' => false
            ) );
        
            if($pagination){
                echo '<div class="footer-buttons pagination">'.$pagination.'</div>';
            }
            
            wp_reset_query();?>
    </div>

<?php get_footer(); ?>  