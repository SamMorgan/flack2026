<?php get_header(); ?>
    

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article class="page page-wrap"> 
            <div class="layout-wrap">
                <div class="title"><h1 class="lrg-text"><?php the_title();?></h1></div>
                <div class="desc"><div class="lrg-text"><?php the_content(); ?></div></div>
                <?php 
                    if ( has_post_thumbnail() ) {
                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
                        $padding = $thumb[2]/$thumb[1]*100;
                        echo '<aside class="data hide-mobile"><div class="thumb"><div class="imgwrap" style="padding-bottom:'.$padding.'%"><img src="'.$thumb[0].'"></div></div></aside>';
                    }else{
                        $aside = get_field('aside');
                        echo '<aside class="data">'.$aside.'</aside>';
                    }    
                ?>
            </div>
            <?php 
            $images = get_field('slider');
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
        </article>
        
    <?php endwhile; endif; ?>

        
<?php get_footer(); ?>