<?php
    /* Template Name: People */ 
    get_header(); ?>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if( have_rows('people') ): 
            $mobile_offset = '';
            while ( have_rows('people') ) : the_row();
                $first_portrait = get_sub_field('portrait');
                if ( $first_portrait ) {
                    $mobile_offset = ' style="--mobile-offset:-'.(($first_portrait['height']/$first_portrait['width'])*50).'%"';
                    break;
                }
            endwhile;
            reset_rows();
            ?>
            <div class="people-wrap" <?php echo $mobile_offset;?>>
                <?php while ( have_rows('people') ) : the_row();

                    $portrait = get_sub_field('portrait');
                    $name = get_sub_field('name');
                    $title = get_sub_field('title');
                    $text = get_sub_field('text');?>
                    <div class="person-wrap">
                        <div class="person">
                            <?php 
                                if($portrait){
                                    echo '<lazy-img class="portrait imgwrap">
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
                <?php endwhile;?>
            </div>
            <?php endif; ?>
            <?php if( have_rows('team') ): ?>
            <div class="team-wrap">
                <?php while ( have_rows('team') ) : the_row();
                    $portrait = get_sub_field('portrait');
                    $name = get_sub_field('name');
                    $title = get_sub_field('title');?>
                    <div class="team-member">
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
                        <div class="details">
                            <h2><?php echo $name;?>,</h2>
                            <h3><?php echo $title;?></h3>
                        </div>    
                    </div>
                <?php endwhile;?>
            </div>
            <?php endif; ?>
        <?php endwhile; endif; ?>
        
<?php get_footer(); ?>