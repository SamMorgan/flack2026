<?php
    /* Template Name: People */ 
    get_header(); ?>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="people-wrap">
                <?php 
                    if( have_rows('people') ):

                    while ( have_rows('people') ) : the_row();

                        $portrait = get_sub_field('portrait');
                        $name = get_sub_field('name');
                        $title = get_sub_field('title');
                        $text = get_sub_field('text');?>

                        <div class="person">
                            <?php 
                                if($portrait){
                                    echo '<div class="portrait imgwrap"><img src="'.$portrait['url'].'" /></div>';
                                }
                            ?>
                            <div class="details lrg-text">
                                <h2><?php echo $name;?>, <?php echo $title;?></h2>
                                <div class="bio"><?php echo $text;?></div>
                            </div>    
                        </div>

                    <?php endwhile;

                    endif;
                ?>

                <div class="people-title"><h1 class="lrg-text"><?php the_title();?></h1></div>
            </div>
        <?php endwhile; endif; ?>
        
<?php get_footer(); ?>