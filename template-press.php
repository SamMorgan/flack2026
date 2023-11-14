<?php 
    /* Template Name: Press */
    get_header(); ?>
    <div class="press-wrap" id="press-index" data-swup-fragment>   
        <?php $press_args = array(
            'posts_per_page' => -1,
            'post_type'      => 'press',
            'orderby'        => 'menu_order',
            'order'          => 'ASC'
        );

        $press_query = new WP_Query( $press_args );
        
        if( $press_query->have_posts() ) :
            while( $press_query->have_posts() ) : $press_query->the_post(); 

            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');

            $slider = get_field('slider');
            $link = '';
            $data_slides = '';
            if($slider){
                $link = '#';
                $slides_arr = array();
                foreach($slider as $slide){
                    $slides_arr[] = $slide['url'];
                }
                $data_slides = ' data-slides="'.implode(',',$slides_arr).'"';
            }else{
                $press_link_data = get_field('press_link');
                if($press_link_data){
                    if($press_link_data['link_to_a_pdf_file']){
                        $link = $press_link_data['pdf'];
                    }else{
                        $link = $press_link_data['url'];
                    }
                } 
            }?><press-card<?php echo $data_slides;?>>
                              
                        <?php if($link){
                            echo '<a class="thumbnail" href="'.$link.'" target="_blank" data-no-swup>';
                        }else{
                            echo '<div class="thumbnail">';
                        }?>    
                        <div class="img-wrap imgwrap">
                            <?php echo '<img class="static" src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';?>
                        </div>
                        <?php if($link){
                            echo '</a>';
                        }else{
                            echo '</div>';
                        }?>    
         
                    <div class="details">
                        <h2 class="title"><?php the_title();?></h2>
                        <?php the_content();?>
                        <?php 
                            if($link){
                                echo '<div><a href="'.$link.'" target="_blank" data-no-swup>View</a></div>';
                            } 
                        ?>
                    </div>

                    <?php 
                    // if($data_slides){
                    //     echo '<script>pressSlider'.$index.'='.json_encode($data_slides).'</script>';
                    // }
                    ?>
                     
            </press-card><?php                                
            endwhile;
        endif;

        wp_reset_query();?>
    </div>
<?php get_footer(); ?>    