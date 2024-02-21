<?php get_header(); ?>
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <sticky-image class="page page-wrap"> 
            
            <div class="thumb"><?php 
                if ( has_post_thumbnail() ) {
                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
                    echo '<lazy-img style="aspect-ratio:'.$thumb[1].'/'.$thumb[2].'"><img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></lazy-img>';
                }    
            ?></div>
            <div class="desc">
                <div class="med-text"><?php the_content(); ?></div>
                <?php 
                    $cta = get_field('call_to_action');
                    $wwf = get_field('working_with_flack');

                    if($cta){
                        echo '<div class="sml-sans cta">'.$cta.'</div>';
                    }
                    if($wwf){
                        echo '<div class="wwf">'.$wwf.'</div>';
                    }
                ?>
            </div>
            <?php $images = get_field('slider');
            $total = 0;
            if( $images ): ?>
                <div class="overlay-slider" id="gallery"> 
                    <?php $total = count($images);      
                    foreach( $images as $image ):
                        echo '
                            <div class="slide">
                                <div class="imgwrap">
                                    <img src="'.$image['url'].'">
                                </div>
                            </div>
                            ';                  
                    endforeach;?>
                </div>
                <div class="footer-buttons close-images">
                    <button class="close-gallery">Close Images</button>
                </div> 
                <div class="footer-buttons close-images clickable">
                    <button class="close-gallery">Close Images</button>
                </div>
            <?php endif;?>            
        </sticky-image>        
    <?php endwhile; endif; ?>
            
<?php get_footer(); ?>