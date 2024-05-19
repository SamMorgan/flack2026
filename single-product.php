<?php get_header(); ?>

    <div class="project-wrap" id="project-wrap">
        <span id="counter" class="counter"></span>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="projects-slider" id="project-slider">
                <?php 
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
                <div class="layout-wrap">
                    <div class="project-data"><?php 
                        $details = get_field('product_details');
                        if($details){
                            echo $details;
                        }    
                    ?></div>
                </div>    
            </div>
            <?php 
            if(isset($_GET['collection'])){
                $collection = $_GET['collection'];
            }
            $products = get_posts(array(
                'post_type' => 'page',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => '_wp_page_template',
                        'value' => 'template-products.php', // template name as stored in the dB
                    ),
                    array(
                        'key' => 'products', // name of custom field
                        'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                        'compare' => 'LIKE'
                    )
                )
            ));
            if($products){
                $collection_data = get_post_parent($products[0]);
                if($collection_data){
                    $collection= $collection_data->post_name; 
                }
            }?>
            <div class="thumbnails">
                <ul <?php if($total < 7){ echo 'class="less-than"';}?>><?php echo $thumbs;?></ul>   
            </div> 
            <div class="details">
                <span><button class="all-images">All Images</button> (<?php echo $total;?>)</span>,&nbsp;<button class="open-info">Information</button>,&nbsp;<a class="close-project" href="<?php 
                    if(isset($collection)){
                        echo home_url('/products/'.$collection.'/products');
                    }else{
                        echo home_url('/');
                    }
                ?>">Close</a>
            </div> 
            <div class="details clickable">
                <span><button class="all-images">All Images</button> (<?php echo $total;?>)</span>,&nbsp;<button class="open-info">Information</button>,&nbsp;<a class="close-project" href="<?php 
                    if(isset($collection)){
                        echo home_url('/products/'.$collection.'/products');
                    }else{
                        echo home_url('/');
                    }
                ?>">Close</a>
            </div>                                                     
        <?php endwhile; endif; ?>
    </div>
<?php get_footer(); ?>