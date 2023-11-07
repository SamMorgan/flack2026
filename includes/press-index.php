
<dialog id="press-slider" data-swup-fragment<?php if(is_singular('press')){ echo ' open';}?>>
<?php if(is_singular('press')){ ?>
    <a href="<?php echo get_permalink(2170);?>" class="close-bg" data-swup-link-to-fragment="#press-index"></a>
    <div class="modal-wrap">    
        <a href="<?php echo get_permalink(2170);?>" class="close" data-swup-link-to-fragment="#press-index">Close</a>
        <?php $images = get_field('slider');
        if( $images ): ?>   
            <press-slider class="swiper">
                <div class="swiper-wrapper">   
                    <?php foreach( $images as $image ):
                        $ratio = $image['width'] > $image['height'] ? 'landscape' : 'portrait';
                        echo '
                        <div class="swiper-slide">
                            <img src="'.$image['url'].'" loading="lazy">
                        </div>';                 
                    endforeach;?>
                </div>
                <div class="swiper-pagination"></div>
            </press-slider>
        <?php endif;?>
    </div>    
    <?php } ?> 
</dialog>         
<div class="press-wrap" id="press-index" data-swup-fragment>   
    <?php $press_args = array(
        'posts_per_page' => -1,
        'post_type'      => 'press',
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    );

    $press_query = new WP_Query( $press_args );

    if( $press_query->have_posts() ) while( $press_query->have_posts() ) : $press_query->the_post(); 

        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
        ?><div class="press-card">
            <div class="wrap">
                <?php 
                    // $press_link_data = get_field('press_link');
                    // if($press_link_data){
                    //     if($press_link_data['link_to_a_pdf_file']){
                    //         $link = $press_link_data['pdf'];
                    //     }else{
                    //         $link = $press_link_data['url'];
                    //     }
                    // } 
                    if(get_field('slider')){
                        $link = get_permalink();
                    }
                ?>                    
                <div class="thumbnail">
                    <?php if($link){
                        echo '<a href="'.$link.'" data-link-to-fragment="#press-slider">';
                    }?>    
                    <div class="img-wrap imgwrap">
                        <?php echo '<img class="static" src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';?>
                    </div>
                    <?php if($link){
                        echo '</a>';
                    }?>    
                </div>
                <div class="details">
                    <h2 class="title"><?php the_title();?></h2>
                    <?php the_content();?>
                    <?php 
                        if($link){
                            echo '<div><a href="'.$link.'" target="_blank" data-no-swup>View</a></div>';
                        } 
                    ?>
                </div>
            </div>       
        </div><?php 
                                        
    endwhile;

    wp_reset_query();?>
</div>