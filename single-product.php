<?php get_header(); ?>

    <div class="project-wrap" id="project-wrap">
        <span id="counter" class="counter"></span>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="projects-slider" id="project-slider">
                <?php 
                    $status = wp_get_post_terms( $post->ID, 'status', array("fields" => "slugs") );
                    $film = get_field('film');

                    $thumbs = "";
                    $i = 1;
                    if( have_rows('product_gallery') ): 
                        while( have_rows('product_gallery') ): the_row(); 
                            if( get_row_layout() == 'single_image' ): 
                                $image = get_sub_field('image');
                                echo '
                                    <div class="project-image-wrap landscape" data-counter="'.$i.'">
                                        <lazy-img class="imgwrap project-img">
                                            <img src="'.$image['url'].'" data-index="'.$i.'">
                                        </lazy-img>
                                    </div>
                                    '; 
                                $thumbs .= '<li class="thumb"><div class="thumbwrap"><div class="thumb-center"><img class="button" src="'.$image['sizes']['medium'].'"></div></div><div class="num">'.$i.'</div></li>';
                                $i++;  
                            elseif( get_row_layout() == 'portrait_images' ): 
                                $image_left = get_sub_field('image_left');
                                $image_right = get_sub_field('image_right');
                                $counter = $i;
                                if($image_left && $image_right){
                                    $next = $i + 1;
                                    $counter = $i .'–'. $next;
                                }?>
                                    <div class="project-image-wrap portrait" data-counter="<?php echo $counter;?>">
                                        <div class="imgwrap project-img">
                                            <?php 
                                                if($image_left){ 
                                                    echo '<img src="'.$image_left['url'].'" data-index="'.$i.'">'; 
                                                    $thumbs .= '<li class="thumb"><div class="thumbwrap"><div class="thumb-center"><img class="button" src="'.$image_left['sizes']['medium'].'"></div></div><div class="num">'.$i.'</div></li>';
                                                    $i++; 
                                                }
                                            ?>
                                        </div> 
                                        <div class="imgwrap project-img">
                                            <?php 
                                                if($image_right){ 
                                                    echo '<img src="'.$image_right['url'].'" data-index="'.$i.'">'; 
                                                    $thumbs .= '<li class="thumb"><div class="thumbwrap"><div class="thumb-center"><img class="button" src="'.$image_right['sizes']['medium'].'"></div></div><div class="num">'.$i.'</div></li>';
                                                    $i++; 
                                                }
                                            ?>
                                        </div>    
                                    </div>

                            <?php endif; 
                        endwhile;                     
                    endif; 
                    $total = $i - 1;?> 
            </div>
            <div class="information" id="information">
                <div class="layout-wrap med-text">
                    <div class="project-data"><?php 
                        $details = get_field_object('details');
                        if($details){
                            $i = 0;
                            foreach($details['value'] as $val){
                                if($val){
                                    $label = $details['sub_fields'][$i]['label'];
                                    echo '<div><span class="label">'.$label.':</span> <span class="deet">'.$val.'<span></div>';
                                }
                                $i++;
                            }
                        }    
                    ?></div>
                </div>    
            </div>
            <?php if($film){ ?>
            <div class="film">
                <input type="range" class="seek-bar" id="seek-bar" value="0" min="0" max="100">
                <div class="seek-bar-track"><span id="seek-bar-line"></span></div>
                <span id="countdown"></span>
                <video class="vid-elem" id="video" src="<?php echo $film;?>" playsinline loop></video>
            </div>
            <?php } ?> 
            <div class="thumbnails">
                <ul <?php if($total < 7){ echo 'class="less-than"';}?>><?php echo $thumbs;?></ul>   
            </div> 
            <div class="details">
                <?php if($film){ echo '<button class="open-film">Film</button>,&nbsp;'; } ?>
                <span><button class="all-images">All Images</button> (<?php echo $total;?>)</span>,&nbsp;<button class="open-info">Information</button>,&nbsp;<a class="close-project" href="<?php echo home_url('/').$status[0];?>">Close</a>
            </div> 
            <div class="details clickable">
                <?php if($film){ echo '<button class="open-film">Film</button>,&nbsp;'; } ?>
                <span><button class="all-images">All Images</button> (<?php echo $total;?>)</span>,&nbsp;<button class="open-info">Information</button>,&nbsp;<a class="close-project" href="<?php echo home_url('/').$status[0];?>">Close</a>
            </div>                                                     
        <?php endwhile; endif; ?>
    </div>
<?php get_footer(); ?>