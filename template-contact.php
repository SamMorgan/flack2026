<?php /* Template Name: Contact */ 
    get_header(); ?>
    
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article class="page contact-page page-wrap"> 
        <div class="layout-wrap">
            <div class="title"><h1 class="lrg-text"><?php the_title();?></h1></div>
            <div class="desc"><div class="lrg-text">
                <?php the_content(); ?>
                <!-- //flackstudio.us15.list-manage.com/subscribe/post?u=1230b04e49706a4c6d3d99536&amp;id=eb88eee5db&amp;f_id=00bb92e0f0 -->                                                   
                <form id="subscribe" class="lrg-text" action="http://flackstudio.us15.list-manage.com/subscribe/post?u=1230b04e49706a4c6d3d99536&amp;id=bcd0148019&amp;c=callback" method="post" target="_blank" novalidate>
                    <div><input type="email" name="EMAIL" id="mce-EMAIL" value="" placeholder="Email address"></div>
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" id="js-validate-robot" name="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" tabindex="-1" value=""></div>
                    <div class="submit-wrap"><button type="submit" name="subscribe" id="mc-embedded-subscribe">Submit</button></div>
                    <div id="js-subscribe-response"></div>
                </form>    
            </div></div>  
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
                <div class="footer-buttons contact-buttons">
                    <a href="#" class="close-gallery">Information</a>,
                    &nbsp;<span><a href="#gallery" class="open-gallery">Images</a> (<?php echo $total;?>)</span>
                </div> 
                <div class="footer-buttons contact-buttons clickable">
                    <a href="#" class="close-gallery">Information</a>,
                    &nbsp;<span><a href="#gallery" class="open-gallery">Images</a> (<?php echo $total;?>)</span>
                </div>
        <?php endif;?>
    </article>
    
<?php endwhile; endif; ?>

    
<?php get_footer(); ?>