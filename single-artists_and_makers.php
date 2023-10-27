<?php get_header(); ?>
    

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article class="page-wrap artist-and-makers-wrap"> 
            <div class="layout-wrap">
                <h1 class="title lrg-text"><?php the_title();?></h1>
                <div class="desc lrg-text"><?php the_content(); ?></div>
                <aside class="data">
                    <?php 
                        $born = get_field('born');
                        $located = get_field('located');
                        $education = get_field('education');
                        $discipline = get_field('discipline');
                        $gallery = get_field('gallery');
                        $website = get_field('website');

                        if($born){
                            echo '<div class="detail"><span class="label">Born: </span><span class="deet">'.$born.'</span></div>';
                        }
                        if($located){
                            echo '<div class="detail"><span class="label">Located: </span><span class="deet">'.$located.'</span></div>';
                        }
                        if($education){
                            echo '<div class="detail"><span class="label">Education: </span><span class="deet">'.$education.'</span></div>';
                        }
                        if($discipline){
                            echo '<div class="detail"><span class="label">Discipline: </span><span class="deet">'.$discipline.'</span></div>';
                        }
                        if($gallery){
                            $gallery_name = $gallery['gallery_name'];
                            $gallery_link = $gallery['gallery_link'];
                            if($gallery_link){
                                echo '<div class="detail"><span class="label">Gallery: </span><span class="deet"><a href="'.$gallery_link.'" target="_blank">'.$gallery_name.'</a></span></div>';
                            }else{
                                echo '<div class="detail"><span class="label">Gallery: </span><span class="deet">'.$gallery_name.'</span></div>';
                            }
                        }
                        if($website){
                            $parsed = parse_url($website);
                            $website_text = $parsed['host'].$parsed['path'];
                            if(substr($website_text, -1) == '/') {
                                $website_text = substr($website_text, 0, -1);
                            }

                            echo '<div class="detail"><span class="label">Website: </span><span class="deet"><a href="'.$website.'" target="_blank">'.$website_text.'</a></span></div>';
                        }
                    ?>
                </aside>   
            </div>
                        
            <?php 
                $images = get_field('slider');
                $total = 0;
                if( $images ):   
                    echo '<div class="overlay-slider" id="overlay-slider">';
                    $total = count($images);      
                    foreach( $images as $image ):
                        echo '
                            <div class="slide">
                                <div class="imgwrap">
                                    <img src="'.$image['url'].'">
                                </div>
                            </div>
                            ';                  
                    endforeach;
                    echo '</div>';
                endif;
            ?>
         
            <?php
            $current_id = $post->ID;
            $am_args = array(
                'posts_per_page' => -1,
                'post_type'      => 'artists_and_makers',
                'orderby'        => 'menu_order',
                'order'          => 'ASC'
            );
            $position_posts = get_posts($am_args); 
            $count = 0;
            foreach ($position_posts as $position_post) { 
                $count++;
                if ($position_post->ID == $current_id) { 
                    $position = $count; break; 
                }
            }
            $posts_per_page = get_option('posts_per_page');
            $result = $position/$posts_per_page;
            $current_page = ceil($result); 
            $page_path = $current_page > 1 ? 'page/'.$current_page : "";
            ?>
            <div class="footer-buttons artist-and-makers-buttons">
                <button class="hide-artist-maker-images">Biography</button>,
                <?php if($images){ echo '&nbsp;<span><button class="show-artist-maker-images">Images</button> ('.$total.')</span>,'; }?> 
                &nbsp;<a class="close-artist-and-maker" href="<?php echo home_url('/artists-and-makers/'.$page_path);?>">Close</a>
            </div> 
            <div class="footer-buttons artist-and-makers-buttons clickable">
                <button class="hide-artist-maker-images">Biography</button>,
                <?php if($images){ echo '&nbsp;<span><button class="show-artist-maker-images">Images</button> ('.$total.')</span>,'; }?> 
                &nbsp;<a class="close-artist-and-maker" href="<?php echo home_url('/artists-and-makers/'.$page_path);?>">Close</a>
            </div>

        </article>
        
    <?php endwhile; endif; ?>

        
<?php get_footer(); ?>