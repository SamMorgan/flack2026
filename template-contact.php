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
                        
                           <span>If you’d like to receive the occasional email from us,</span> <a href="#subscribe">sign–up to our newsletter</a>
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

        <sub-form>
            <a class="close bg" href="<?php the_permalink();?>"></a>
            <form class="med-text" action="http://flackstudio.us15.list-manage.com/subscribe/post?u=1230b04e49706a4c6d3d99536&amp;id=bcd0148019&amp;c=callback" method="post" target="_blank" novalidate>
                <a class="close" href="<?php the_permalink();?>"></a>
                <div class="form-wrap">
                <div><input type="email" name="EMAIL" id="mce-EMAIL" value="" placeholder="Email address"></div>
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" id="js-validate-robot" name="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" tabindex="-1" value=""></div>
                <div class="submit-wrap"><button type="submit" name="subscribe" id="mc-embedded-subscribe">Submit</button></div>
                <div id="js-subscribe-response"></div>
                </div>
            </form>
        </sub-form>

    <?php endwhile; endif; ?>
            
<?php get_footer(); ?>