<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#" style="--rand-color:<?php
    $colors = get_field('colours',12);
    $rand = rand(0, (count($colors) - 1));
    echo $colors[$rand]['colour'];
?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(' | ','true','right'); ?><?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">     
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <meta name="format-detection" content="telephone=no"> 
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-16x16.png">
    <!-- <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/favicon/site.webmanifest"> -->
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/favicon/safari-pinned-tab.svg" color="#000000">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-57238684-1', 'auto');
      ga('send', 'pageview');

    </script>
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>
	<header class="site-header" id="site-header">
        <div id="main-menu" class="main-nav-wrap">      
            <div class="toggle-menu"><span></span></div>
            <div class="close-menu"></div>
            <nav class="main-nav">
                <div class="swup-menu med-text">
                    <div class="menu-section">
                        <h3>Works</h3>
                        <?php 
                            // $current_work_query = new WP_Query( array(
                            //     'post_type' => 'projects',
                            //     'posts_per_page' => -1,
                            //     'tax_query' => array(
                            //         array (
                            //             'taxonomy' => 'status',
                            //             'field' => 'slug',
                            //             'terms' => 'current',
                            //         )
                            //     ),
                            // ) );

                            $upcoming_work_query = new WP_Query( array(
                                'post_type' => 'projects',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array (
                                        'taxonomy' => 'status',
                                        'field' => 'slug',
                                        'terms' => 'upcoming',
                                    )
                                ),
                            ) );
                            $residential_work_query = new WP_Query( array(
                                'post_type' => 'projects',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    'relation' => 'AND',
                                    array (
                                        'taxonomy' => 'project-category',
                                        'field' => 'slug',
                                        'terms' => array('residential'),
                                        'operator' => 'IN',
                                        //'include_children' => false,
                                    ),
                                    array (
                                        'taxonomy' => 'status',
                                        'field' => 'slug',
                                        'terms' => array('upcoming'),
                                        'operator' => 'NOT IN',
                                        //'include_children' => false,
                                    ),
                                ),
                            ) );

                            $commercial_work_query = new WP_Query( array(
                                'post_type' => 'projects',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    'relation' => 'AND',
                                    array (
                                        'taxonomy' => 'project-category',
                                        'field' => 'slug',
                                        'terms' => 'commercial',
                                        //'include_children' => false,
                                    ),
                                    array (
                                        'taxonomy' => 'status',
                                        'field' => 'slug',
                                        'terms' => array('upcoming'),
                                        'operator' => 'NOT IN',
                                        //'include_children' => false,
                                    ),
                                ),
                            ) );

                            // $archive_work_query = new WP_Query( array(
                            //     'post_type' => 'projects',
                            //     'posts_per_page' => -1,
                            //     'tax_query' => array(
                            //         array (
                            //             'taxonomy' => 'status',
                            //             'field' => 'slug',
                            //             'terms' => 'archive',
                            //         )
                            //     ),
                            // ) );
                        ?>
                        <ul>
                            <!-- <li <?php if(is_page('current')){ echo 'class="current-menu-item"'; }?>><a href="<?php echo home_url();?>/current/">Current <span>(<?php echo $current_work_query->post_count;?>)</span></a></li> -->
                            <li <?php if(is_tax('project-category', 'residential') || term_is_ancestor_of(
                                get_term_by('slug', 'residential', 'project-category'),
                                get_queried_object(),
                                'project-category'
                            )){ echo 'class="current-menu-item"'; }?>><a href="<?php echo home_url();?>/project-category/residential/">Residential <span>(<?php echo $residential_work_query->post_count;?>)</span></a></li>
                            <li <?php if(is_tax('project-category','commercial') || term_is_ancestor_of(
                                get_term_by('slug', 'commercial', 'project-category'),
                                get_queried_object(),
                                'project-category'
                            )){ echo 'class="current-menu-item"'; }?>><a href="<?php echo home_url();?>/project-category/commercial/">Commercial <span>(<?php echo $commercial_work_query->post_count;?>)</span></a></li>
                            <li <?php if(is_page('upcoming')){ echo 'class="current-menu-item"'; }?>><a href="<?php echo home_url();?>/upcoming/">Upcoming <span>(<?php echo $upcoming_work_query->post_count;?>)</span></a></li>
                            <!-- <li <?php if(is_page('archive')){ echo 'class="current-menu-item"'; }?>><a href="<?php echo home_url();?>/archive/">Archive <span>(<?php echo $archive_work_query->post_count;?>)</span></a></li> -->
                        </ul>                
                    </div>
                    <div class="menu-section">
                        <h3>Practice</h3>
                        <?php wp_nav_menu(array('menu'=>'Practice','container'=>false));?>
                    </div>
                    <?php $children = wp_list_pages( 'depth=1&title_li=&child_of=3787&echo=0' ); // $children = wp_list_pages( 'depth=1&title_li=&child_of=5333&echo=0' );
                    if ( $children) : ?>
                    <div class="menu-section">
                        <h3>Products</h3>
                        <ul>
                            <?php echo $children; ?>
                        </ul>
                    </div>    
                    <?php endif; ?>
                    <div class="menu-section">
                        <h3>Community</h3>
                        <?php wp_nav_menu(array('menu'=>'Friends','container'=>false));?>
                    </div>
                </div> 
                <div class="ig-sub">
                    <sub-form>
                        <ul>
                            <li><a href="https://www.instagram.com/flackstudio_/" target="_blank">Instagram</a></li>
                            <li><a href="#subscribe">Subscribe</a></li>
                        </ul> 
                        <form action="//flackstudio.us15.list-manage.com/subscribe/post?u=1230b04e49706a4c6d3d99536&amp;id=bcd0148019&amp;c=callback" method="post" target="_blank" novalidate>
                            <div class="form-wrap">
                                <input type="email" name="EMAIL" id="mce-EMAIL" value="" placeholder="Email address">
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" id="js-validate-robot" name="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" tabindex="-1" value=""></div>
                                <button type="submit" name="subscribe" id="mc-embedded-subscribe">Submit</button>
                            </div>
                            <div id="js-subscribe-response"></div>
                        </form>
                    </sub-form> 
                </div>     
            </nav>
        </div>
        <h1 class="site-title"><a href="<?php echo home_url();?>"><?php echo get_bloginfo('name', 'display');?></a></h1>
        <div class="page-title transition-fade"><?php
            global $post; 
            if ( !is_front_page() ) {
                echo '<h1>';
                if( $post && $post->post_parent ){
                    echo get_the_title($post->post_parent);
                }else{
                    if(is_post_type_archive('artists_and_makers')){
                        echo 'Artists & Makers';
                    }elseif(is_page('current')){
                        echo 'Works — Current ('.$current_work_query->post_count.')';
                    }elseif(is_page('upcoming')){
                        echo 'Works — Upcoming ('.$upcoming_work_query->post_count.')';
                    }elseif(is_page('archive')){
                        echo 'Works — Archive ('.$archive_work_query->post_count.')';
                    }elseif(is_tax('project-category')){
                        $term = get_queried_object();
                        if ( $term instanceof WP_Term && $term->parent ) {
                            $parent = get_term($term->parent, $term->taxonomy);
                            if ( $parent && ! is_wp_error($parent) ) {
                                echo 'Works — ' . esc_html($parent->name) . ', ' . esc_html($term->name);
                            } else {
                                echo 'Works — ' . esc_html($term->name);
                            }
                        } elseif ( $term instanceof WP_Term ) {
                            echo 'Works — ' . esc_html($term->name);
                        } else {
                            the_title();
                        }
                    }else{
                        the_title();
                    }
                }
                echo '</h1>';
            }    
        ?></div>
    </header>
    <?php if(is_front_page()){ ?>
    <site-intro>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1848 403.61"><path d="m679.69,234.14h16.17v162.78h-330.58,0v-8.93h71.92V15.6h-71.92V6.68h193.44v8.92h-71.36v372.4h28.99c136.02,2.23,162.22-39.58,163.33-153.86Zm436.2,153.85h14.5v8.36h-193.44v-8.36h16.16c35.68-2.23,41.26-15.05,28.43-56.86l-29.54-95.88h-103.13l-31.22,89.2c-19.51,56.85-13.93,64.1,66.34,64.1v8.37h-158.87,0v-8.38h-3.35c38.46,0,62.43-16.16,75.26-50.72l101.46-275.39-8.92-31.78,5.57-4.46c11.71,2.79,17.84-8.36,23.42-19.51h6.68l99.21,304.38c20.07,60.76,36.24,76.93,91.43,76.93Zm-166.67-161.1l-45.71-147.73-51.84,147.73h97.55ZM0,15.6h71.92v372.39H0v8.92h0s194,0,194,0v-8.92h-71.92v-191.22c85.85,0,99.78,10.04,104.24,85.29h13.94V105.35h-13.94c-4.46,75.82-18.4,85.29-104.24,85.85V15.6h34.56c133.24,0,161.67,23.98,162.78,141.04h16.17V6.68H0v8.92Zm1833.51,372.39h0c-42.37-5.01-73.03-23.96-83.07-51.27l-79.71-215.75,32.33-44.04c33.45-45.15,69.69-61.32,128.22-61.32V6.68h-182.29v8.92c65.22,0,75.81,16.72,45.15,59.1l-145.5,196.78V15.6h71.36V6.68h-192.88v8.92h71.35v372.39h-71.35v8.92h192.88v-8.92h-71.36v-102.58l90.31-120.97,44.6,131.01c12.82,36.79,41.81,89.19-6.69,92.54h-16.17v8.92h187.31v-8.92h-14.49Zm-570.57,6.69c-83.06,0-117.63-60.2-117.63-192.88s36.23-191.77,117.07-191.77c74.14,0,112.05,46.83,120.97,146.62h20.63V0h-15.05c-1.67,28.43-15.61,34.56-45.71,21.74-18.4-10.03-40.69-21.74-80.27-21.74-105.36,0-179.51,83.62-179.51,201.8s74.15,201.81,179.51,201.81c89.19,0,138.24-54.08,148.83-166.13h-15.05c-5.02,103.13-50.73,157.2-133.79,157.2Zm0,8.93s0,0,0,0c0,0,0,0,0,0h0Z"/></svg>
    </site-intro> 
    <?php } ?>
    <main>
    <div class="main-wrap swup-main transition-fade">