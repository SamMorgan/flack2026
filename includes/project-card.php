<div class="project-card allcaps">
    <a href="<?php the_permalink();?>" class="tooltip">
        <div class="rollover imgwrap"><?php the_post_thumbnail('full');?></div>
        <span><?php the_field('project_number');?></span>
        <h3><?php the_title();?></h3>
        <span><?php the_field('year');?></span>
    </a>
</div>