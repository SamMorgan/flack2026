<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post();?>
        <div>
            <?php if( have_rows('featured_projects') ):?>
                <home-slider class="swiper">
                    <div class="swiper-wrapper">
                        <?php while( have_rows('featured_projects') ) : the_row();
                            $project = get_sub_field('project');
                            $image = get_sub_field('image');?>
                            <div class="swiper-slide">
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                                <home-img class="imgwrap" style="aspect-ratio:<?php echo $image['width'].'/'.$image['height'];?>">
                                    <img src="<?php echo $image['url'];?>" loading="lazy">
                                    <a href="<?php echo get_permalink($project->ID);?>" class="med-text">
                                        <h2><?php echo $project->post_title;?></h2>
                                    </a>
                                </home-img>    
                            </div>
                        <?php endwhile;?>
                    </div>
                    <div class="swiper-pagination"></div>
                </home-slider>
            <?php endif;?>

            <home-marquee>
                <div class="mono">
                    <?php the_field('acknowledgement');?>
                </div>
            </home-marquee>
        </div>
    <?php endwhile; endif; ?>
        
<?php get_footer(); ?>