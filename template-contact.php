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
                        <?php //the_content(); ?>
                        <div class="invert-linkstyle">
                            <dl>
                                <dt>
                            <h4>Address</h4>
                            </dt>
                                <dd><a href="https://maps.app.goo.gl/F434Qxw7BB2EB3Lq9" target="_blank" rel="noopener">90 Moor Street, Fitzroy,
                            3065 Victoria, Australia</a>
                            <a href="tel:+61 3 9489 0610">+61 3 9489 0610</a></dd>
                            </dl>
                            <dl>
                                <dt>
                            <h4>Instagram</h4>
                            </dt>
                                <dd><a href="https://www.instagram.com/flackstudio_/">@flackstudio_</a></dd>
                            </dl>
                            <dl>
                                <dt>
                            <h4 class="p1">General</h4>
                            </dt>
                                <dd><a href="mailto:info@flackstudio.com.au" target="_blank" rel="noopener noreferrer">info@flackstudio.com.au</a></dd>
                                <dt>
                            <h4 class="p1">Press</h4>
                            </dt>
                                <dd><a href="mailto:press@flackstudio.com.au" target="_blank" rel="noopener noreferrer">press@flackstudio.com.au</a></dd>
                                <dt>
                            <h4>New projects</h4>
                            </dt>
                                <dd><a href="mailto:newprojects@flackstudio.com.au" target="_blank" rel="noopener noreferrer">newprojects@flackstudio.com.au</a></dd>
                            </dl>
                        </div>
                        <!-- <span>If you’d like to receive the occasional email from us,</span> <a href="#subscribe">sign–up to our newsletter</a> -->
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