<?php /* Template Name: Contact */
get_header(); ?>
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <sticky-image class="page page-wrap"> 
            
            <div class="thumb"><?php 
                if ( has_post_thumbnail() ) {
                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
                    echo '<lazy-img style="aspect-ratio:'.$thumb[1].'/'.$thumb[2].'"><img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></lazy-img>';
                }    
            ?></div>
            <div class="desc">
                <div class="med-text">
                    <div class="med-text contact-details">
                        <?php if( have_rows('contact_details') ):
                            echo '<div class="invert-linkstyle">';
                            while( have_rows('contact_details') ) : the_row();
                                $space_after = get_sub_field('sapce_after') ? ' class="space-after"' : '';
                                echo '<dl'.$space_after.'><dt><h4>'; the_sub_field('label'); echo '</h4></dt><dd>'; the_sub_field('details'); echo '</dd></dl>';
                            endwhile;
                            echo '</div>';
                        endif;?>
                    </div>     
                </div>
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