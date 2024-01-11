<?php get_header(); ?>
    <?php //if(!isset($_COOKIE['flack_visitor'])) { ?>
        <site-intro>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1848 403.61"><path d="m679.69,234.14h16.17v162.78h-330.58,0v-8.93h71.92V15.6h-71.92V6.68h193.44v8.92h-71.36v372.4h28.99c136.02,2.23,162.22-39.58,163.33-153.86Zm436.2,153.85h14.5v8.36h-193.44v-8.36h16.16c35.68-2.23,41.26-15.05,28.43-56.86l-29.54-95.88h-103.13l-31.22,89.2c-19.51,56.85-13.93,64.1,66.34,64.1v8.37h-158.87,0v-8.38h-3.35c38.46,0,62.43-16.16,75.26-50.72l101.46-275.39-8.92-31.78,5.57-4.46c11.71,2.79,17.84-8.36,23.42-19.51h6.68l99.21,304.38c20.07,60.76,36.24,76.93,91.43,76.93Zm-166.67-161.1l-45.71-147.73-51.84,147.73h97.55ZM0,15.6h71.92v372.39H0v8.92h0s194,0,194,0v-8.92h-71.92v-191.22c85.85,0,99.78,10.04,104.24,85.29h13.94V105.35h-13.94c-4.46,75.82-18.4,85.29-104.24,85.85V15.6h34.56c133.24,0,161.67,23.98,162.78,141.04h16.17V6.68H0v8.92Zm1833.51,372.39h0c-42.37-5.01-73.03-23.96-83.07-51.27l-79.71-215.75,32.33-44.04c33.45-45.15,69.69-61.32,128.22-61.32V6.68h-182.29v8.92c65.22,0,75.81,16.72,45.15,59.1l-145.5,196.78V15.6h71.36V6.68h-192.88v8.92h71.35v372.39h-71.35v8.92h192.88v-8.92h-71.36v-102.58l90.31-120.97,44.6,131.01c12.82,36.79,41.81,89.19-6.69,92.54h-16.17v8.92h187.31v-8.92h-14.49Zm-570.57,6.69c-83.06,0-117.63-60.2-117.63-192.88s36.23-191.77,117.07-191.77c74.14,0,112.05,46.83,120.97,146.62h20.63V0h-15.05c-1.67,28.43-15.61,34.56-45.71,21.74-18.4-10.03-40.69-21.74-80.27-21.74-105.36,0-179.51,83.62-179.51,201.8s74.15,201.81,179.51,201.81c89.19,0,138.24-54.08,148.83-166.13h-15.05c-5.02,103.13-50.73,157.2-133.79,157.2Zm0,8.93s0,0,0,0c0,0,0,0,0,0h0Z"/></svg>
        </site-intro>    
    <?php //} ?> 
    <?php if (have_posts()) : while (have_posts()) : the_post();?>
        <div>
            <?php if( have_rows('featured_projects') ):?>
                <div class="home-slider-wrap">
                <home-slider class="swiper">
                    <div class="swiper-wrapper">
                        <?php while( have_rows('featured_projects') ) : the_row();
                            $project = get_sub_field('project');
                            $image = get_sub_field('image');?>
                            <div class="swiper-slide">
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                                <div class="imgwrap" style="aspect-ratio:<?php echo $image['width'].'/'.$image['height'];?>">
                                    <img src="<?php echo $image['url'];?>" loading="lazy">
                                    <a href="<?php echo get_permalink($project->ID);?>" class="med-text">
                                        <h2><?php echo $project->post_title;?></h2>
                                    </a>
                                </div>    
                            </div>
                        <?php endwhile;?>
                    </div>
                    <div class="swiper-pagination"></div>
                </home-slider>
                </div>
            <?php endif;?>

            <home-marquee>
                <div class="mono">
                    <?php the_field('acknowledgement');?>
                </div>
            </home-marquee>
        </div>
    <?php endwhile; endif; ?>
        
<?php get_footer(); ?>