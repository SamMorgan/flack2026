<?php 
    /* Template Name: Awards */
    get_header(); ?>    
    
    <div class="awards-wrap xs-text-mob">   
        <?php if( have_rows('awards') ):
            $first = true;
            while( have_rows('awards') ) : the_row();?>
                
                    <?php $year = get_sub_field('year');
                    if($year){
                        if(!$first){
                            echo '</div>';
                        }
                        echo '<div class="year-group"><div class="awards-year">'.$year.'</div>';
                    }?>
                    <div class="awards">
                        <div><?php the_sub_field('project');?></div>
                        <div><?php the_sub_field('award');?></div>
                        <div><?php the_sub_field('organisation');?></div>
                    </div>
                   
                <?php $first = false;
            endwhile;
            echo '</div>';
        endif;?>
    </div>

<?php get_footer(); ?>    