<?php
    /* Template Name: People */ 
    get_header(); ?>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="people-wrap">
                <?php 
                    if( have_rows('people') ):
                    $first = true;
                    while ( have_rows('people') ) : the_row();

                        $portrait = get_sub_field('portrait');
                        $name = get_sub_field('name');
                        $title = get_sub_field('title');
                        $text = get_sub_field('text');?>
                        <div class="person-wrap">
                            <div class="person">
                                <?php 
                                    if($portrait){
                                        $mobile_offset = '';
                                        if($first){
                                            $mobile_offset = ' style="--mobile-offset:-'.(($portrait['height']/$portrait['width'])*50).'%"';
                                        }
                                        echo '<lazy-img class="portrait imgwrap"'.$mobile_offset.'>
                                        <img 
                                            src="'.$portrait['url'].'" 
                                            width="'.$portrait['width'].'" 
                                            height="'.$portrait['height'].'" 
                                            style="aspect-ratio:'.$portrait['width'].'/'.$portrait['height'].'"
                                        />
                                        </lazy-img>';
                                    }
                                ?>
                                <div class="details med-text">
                                    <h2><?php echo $name;?>, <?php echo $title;?></h2>
                                    <div class="bio"><?php echo $text;?></div>
                                </div>    
                            </div>
                        </div>
                    <?php $first = false; 
                    endwhile;

                    endif;
                ?>
            </div>
        <?php endwhile; endif; ?>
        
<?php get_footer(); ?>