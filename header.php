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
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-16x16.png">
    <!-- <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/images/favicon/site.webmanifest"> -->
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/safari-pinned-tab.svg" color="#000000">
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
                            $current_work_query = new WP_Query( array(
                                'post_type' => 'projects',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array (
                                        'taxonomy' => 'status',
                                        'field' => 'slug',
                                        'terms' => 'current',
                                    )
                                ),
                            ) );

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

                            $archive_work_query = new WP_Query( array(
                                'post_type' => 'projects',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array (
                                        'taxonomy' => 'status',
                                        'field' => 'slug',
                                        'terms' => 'archive',
                                    )
                                ),
                            ) );
                        ?>
                        <ul>
                            <li <?php if(is_page('current')){ echo 'class="current-menu-item"'; }?>><a href="<?php echo home_url();?>/current/">Current <span>(<?php echo $current_work_query->post_count;?>)</span></a></li>
                            <li <?php if(is_page('upcoming')){ echo 'class="current-menu-item"'; }?>><a href="<?php echo home_url();?>/upcoming/">Upcoming <span>(<?php echo $upcoming_work_query->post_count;?>)</span></a></li>
                            <li <?php if(is_page('archive')){ echo 'class="current-menu-item"'; }?>><a href="<?php echo home_url();?>/archive/">Archive <span>(<?php echo $archive_work_query->post_count;?>)</span></a></li>
                        </ul>                
                    </div>
                    <div class="menu-section">
                        <h3>Practice</h3>
                        <?php wp_nav_menu(array('menu'=>'Practice','container'=>false));?>
                    </div>
                    <div class="menu-section">
                        <h3>Community</h3>
                        <?php wp_nav_menu(array('menu'=>'Friends','container'=>false));?>
                    </div>
                </div> 
                <ul class="ig-sub">
                    <li><a href="https://www.instagram.com/flackstudio_/" target="_blank">Instagram</a></li>
                    <li><a href="<?php echo home_url();?>/contact/#subscribe">Subscribe</a></li>
                </ul>   
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
                    }else{
                        the_title();
                    }
                }
                echo '</h1>';
            }    
        ?></div>
    </header>
    <main>
    <div class="main-wrap swup-main transition-fade">