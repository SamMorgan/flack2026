<?php get_header(); ?>
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <sticky-image class="page page-wrap"> 
            
            <?php 
                if ( has_post_thumbnail() ) {
                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
                    echo '<div class="thumb"><img src="'.$thumb[0].'"></div>';
                }    
            ?>
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
            
        </sticky-image>
        
    <?php endwhile; endif; ?>
            
<?php get_footer(); ?>