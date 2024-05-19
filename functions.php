<?php
/*
 * Enable post thumbnail support
 */
  add_theme_support( 'post-thumbnails' );

  //set_post_thumbnail_size( 600, 400, true ); // Normal post thumbnails
  //add_image_size( 'banner-thumb', 566, 250, true ); // Small thumbnail size
  add_image_size( 'project-thumb', 960, 910, true ); // Square thumbnail used by sharethis and facebook  


/*
 * Enable Wordpress features
 */
  
  // Enable styling of Admin
  //add_editor_style('css/editor-style.css'); 
   
    // Turn on menus
  register_nav_menus(
    array(
      'practice' => 'Practice',
      'friends' => 'Friends',
    )
  );

    // admin bar off //
    add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
    function set_user_admin_bar_false_by_default($user_id) {
        update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
        update_user_meta( $user_id, 'show_admin_bar_admin', 'false' );
    }
    // Set WordPress theme varibles
  // if ( ! isset( $content_width ) ) {
  //  $content_width = 720;
  // }
  // function set_content_width() {
  //  global $content_width;
  //  if ( is_single() ) {
  //    $content_width = 720;   
  //  } else {
  //    $content_width = 720;
  //  }
  // }
  // add_action( 'template_redirect', 'set_content_width' );
    
    // Excerpts for pages
   // add_post_type_support( 'page', 'excerpt' );     



    function enqueue_scripts_styles() {

        wp_enqueue_script( 'js', get_template_directory_uri() . "/dist/bundle.js", array(), filemtime( get_stylesheet_directory() . '/dist/bundle.js' ), true );

        wp_localize_script( 'js', 'sitevars', array(
            'ajaxurl'   => admin_url( 'admin-ajax.php' ),
            'homeurl'   => home_url()
            )
        );    
     
        wp_enqueue_style( 'style', get_template_directory_uri() . "/dist/bundle.css", array(), filemtime( get_stylesheet_directory() . '/dist/bundle.css' ) );
    }
    add_action( 'wp_enqueue_scripts', 'enqueue_scripts_styles' );



    add_filter('body_class','custom_class_names');
    function custom_class_names($classes) {
        
        // Mobile detects
        switch (true) {         
            case wp_is_mobile() :
                $classes[] = 'is-mobile';                
                break;
            
            default :
                $classes[] = 'not-mobile';                            
                break;
        }

        global $post;
        if ( isset( $post ) ) {
            $classes[] = $post->post_name;
        }        

        return $classes;
    }



    
    add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
    function my_toolbars( $toolbars ){
        // Uncomment to view format of $toolbars
        /*
        echo '< pre >';
            print_r($toolbars);
        echo '< /pre >';
        die;
        */

        // Add a new toolbar called "Very Simple"
        // - this toolbar has only 1 row of buttons
        $toolbars['Very Simple' ] = array();
        $toolbars['Very Simple' ][1] = array('link', 'unlink');

        // Edit the "Full" toolbar and remove 'code'
        // - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
        if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
        {
            unset( $toolbars['Full' ][2][$key] );
        }

        // remove the 'Basic' toolbar completely
        unset( $toolbars['Basic' ] );

        // return $toolbars - IMPORTANT!
        return $toolbars;
    }


    function get_content_by_id($postid){
        $content_post = get_post($postid);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        echo $content; 
    } 

    add_action( 'init', 'register_cpt_press' );

    function register_cpt_press() {

        $labels = array( 
            'name' => _x( 'Press', 'press' ),
            'singular_name' => _x( 'Press', 'press' ),
            'add_new' => _x( 'Add New', 'press' ),
            'add_new_item' => _x( 'Add New Press', 'press' ),
            'edit_item' => _x( 'Edit Press', 'press' ),
            'new_item' => _x( 'New Press', 'press' ),
            'view_item' => _x( 'View Press', 'press' ),
            'search_items' => _x( 'Search press', 'press' ),
            'not_found' => _x( 'No press found', 'press' ),
            'not_found_in_trash' => _x( 'No press found in Trash', 'press' ),
            'parent_item_colon' => _x( 'Parent press:', 'press' ),
            'menu_name' => _x( 'Press', 'press' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            
            
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        );

        register_post_type( 'press', $args );
    }

    add_action( 'init', 'register_cpt_projects' );

    function register_cpt_projects() {

        $labels = array( 
            'name' => _x( 'Projects', 'projects' ),
            'singular_name' => _x( 'Project', 'projects' ),
            'add_new' => _x( 'Add New', 'projects' ),
            'add_new_item' => _x( 'Add New Project', 'projects' ),
            'edit_item' => _x( 'Edit Project', 'projects' ),
            'new_item' => _x( 'New Project', 'projects' ),
            'view_item' => _x( 'View Project', 'projects' ),
            'search_items' => _x( 'Search Projects', 'projects' ),
            'not_found' => _x( 'No Projects found', 'projects' ),
            'not_found_in_trash' => _x( 'No Projects found in Trash', 'projects' ),
            'parent_item_colon' => _x( 'Parent projects:', 'projects' ),
            'menu_name' => _x( 'Projects', 'projects' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            
            
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        );

        register_post_type( 'projects', $args );
    }
    


    add_action( 'init', 'register_cpt_artists_and_makers' );

    function register_cpt_artists_and_makers() {

        $labels = array( 
            'name' => _x( 'Artists & Makers', 'artists_and_makers' ),
            'singular_name' => _x( 'Artist & Maker', 'artists_and_makers' ),
            'add_new' => _x( 'Add New', 'artists_and_makers' ),
            'add_new_item' => _x( 'Add New Artist & Maker', 'artists_and_makers' ),
            'edit_item' => _x( 'Edit Artist & Maker', 'artists_and_makers' ),
            'new_item' => _x( 'New Artist & Maker', 'artists_and_makers' ),
            'view_item' => _x( 'View Artist & Maker', 'artists_and_makers' ),
            'search_items' => _x( 'Search Artists & Makers', 'artists_and_makers' ),
            'not_found' => _x( 'No Artists & Makers found', 'artists_and_makers' ),
            'not_found_in_trash' => _x( 'No Artists & Makers found in Trash', 'artists_and_makers' ),
            'parent_item_colon' => _x( 'Parent Artist & Maker:', 'artists_and_makers' ),
            'menu_name' => _x( 'Artists & Makers', 'artists_and_makers' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            
            

            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => array('slug' => 'artists-and-makers'),
            'capability_type' => 'post'
        );

        register_post_type( 'artists_and_makers', $args );
    }


    add_action( 'init', 'register_cpt_product' );

    function register_cpt_product() {

        $labels = array( 
            'name' => _x( 'Products', 'product' ),
            'singular_name' => _x( 'Product', 'product' ),
            'add_new' => _x( 'Add New', 'product' ),
            'add_new_item' => _x( 'Add New product', 'product' ),
            'edit_item' => _x( 'Edit product', 'product' ),
            'new_item' => _x( 'New product', 'product' ),
            'view_item' => _x( 'View product', 'product' ),
            'search_items' => _x( 'Search product', 'product' ),
            'not_found' => _x( 'No product found', 'product' ),
            'not_found_in_trash' => _x( 'No product found in Trash', 'product' ),
            'parent_item_colon' => _x( 'Parent product:', 'product' ),
            'menu_name' => _x( 'Products', 'product' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            
            'supports' => array( 'title', 'thumbnail' ),
            
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            
            
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        );

        register_post_type( 'product', $args );
    }
    // add_filter( 'posts_where', 'cws_posts_where' );

    // function cws_posts_where ( $where ) {
    //     if ( isset( $_GET['is_post_type_archive_test'] ) )
    //         var_dump( is_post_type_archive('artists_and_makers') );
    //     return $where;
    // }




    function project_status_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Status', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Status', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Status', 'text_domain' ),
            'all_items'                  => __( 'All Status\'', 'text_domain' ),
            'parent_item'                => __( 'Parent Status', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent Status:', 'text_domain' ),
            'new_item_name'              => __( 'New Status Name', 'text_domain' ),
            'add_new_item'               => __( 'Add New Status', 'text_domain' ),
            'edit_item'                  => __( 'Edit Status', 'text_domain' ),
            'update_item'                => __( 'Update Status', 'text_domain' ),
            'view_item'                  => __( 'View Status', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate Status\' with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove Status\'', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'              => __( 'Popular Status\'', 'text_domain' ),
            'search_items'               => __( 'Search Status\'', 'text_domain' ),
            'not_found'                  => __( 'Not Found', 'text_domain' ),
            'no_terms'                   => __( 'No Status\'', 'text_domain' ),
            'items_list'                 => __( 'Items Status', 'text_domain' ),
            'items_list_navigation'      => __( 'Items Status navigation', 'text_domain' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            //'rewrite'                    => array( 'slug' => 'type' ),
            'rewrite'                    => true,
        );
        register_taxonomy( 'status', array( 'projects' ), $args );
    
    }
    add_action( 'init', 'project_status_taxonomy', 0 );




/**
* Author: Michael Fields
* Source: http://wordpress.mfields.org/2010/set-default-terms-for-your-custom-taxonomies-in-wordpress-3-0/
* Thanks a lot for the nice tweak
*/


/**
 * Define default terms for custom taxonomies in WordPress 3.0.1
 *
 * @author    Michael Fields     http://wordpress.mfields.org/
 * @props     John P. Bloch      http://www.johnpbloch.com/
 *
 * @since     2010-09-13
 * @alter     2010-09-14
 *
 * @license   GPLv2
 */
function mfields_set_default_object_terms( $post_id, $post ) {
    if ( 'publish' === $post->post_status ) {
        $defaults = array(
            'status' => array( 'archive' ),
            );
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
            $terms = wp_get_post_terms( $post_id, $taxonomy );
            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
            }
        }
    }
}
add_action( 'save_post_projects', 'mfields_set_default_object_terms', 100, 2 );

/**
* Just change the 'post_tag' with the taxonomy slug you want to target
* and change 'taco' and 'banana' with the slug of the term you want to make default
* you can add multiple taxonomy at once so the line#19 is applicable only then
*/



// add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );
	
// function add_current_nav_class($classes, $item) {
    
//     // Getting the current post details
//     global $post;
    
//     // Getting the post type of the current post
//     $current_post_type = get_post_type_object(get_post_type($post->ID));
//     $current_post_type_slug = $current_post_type->rewrite[slug];
        
//     // Getting the URL of the menu item
//     $menu_slug = strtolower(trim($item->url));
    
//     // If the menu item URL contains the current post types slug add the current-menu-item class
//     if (strpos($menu_slug,$current_post_type_slug) !== false) {
    
//        $classes[] = 'current-menu-item';
    
//     }
    
//     // Return the corrected set of classes to be added to the menu item
//     return $classes;

// }



add_filter( 'manage_media_columns', 'sk_media_columns_filesize' );
/**
 * Filter the Media list table columns to add a File Size column.
 *
 * @param array $posts_columns Existing array of columns displayed in the Media list table.
 * @return array Amended array of columns to be displayed in the Media list table.
 */
function sk_media_columns_filesize( $posts_columns ) {
	$posts_columns['filesize'] = __( 'File Size', 'my-theme-text-domain' );

	return $posts_columns;
}

add_action( 'manage_media_custom_column', 'sk_media_custom_column_filesize', 10, 2 );
/**
 * Display File Size custom column in the Media list table.
 *
 * @param string $column_name Name of the custom column.
 * @param int    $post_id Current Attachment ID.
 */
function sk_media_custom_column_filesize( $column_name, $post_id ) {
	if ( 'filesize' !== $column_name ) {
		return;
	}

	$bytes = filesize( get_attached_file( $post_id ) );

	echo size_format( $bytes, 2 );
}

add_action( 'admin_print_styles-upload.php', 'sk_filesize_column_filesize' );
/**
 * Adjust File Size column on Media Library page in WP admin
 */
function sk_filesize_column_filesize() {
	echo
	'<style>
		.fixed .column-filesize {
			width: 10%;
		}
	</style>';
}


add_action('admin_head', 'admin_styles');
function admin_styles() {
	?>
	<style>
		.small-wysiwyg iframe {
			min-height:60px;
            height:60px !important;
		}
	</style>
	<?php
}


// function signup_form_func($atts, $content=null) { 
//     extract(
//         shortcode_atts(
//            array( 'linktext' => null, ),
//            $atts
//         )
//      );
//     return '<div><sub-form>
//         <a href="#subscribe">'.$linktext.'</a> 
//         <form id="subscribe" class="med-text" action="http://flackstudio.us15.list-manage.com/subscribe/post?u=1230b04e49706a4c6d3d99536&amp;id=bcd0148019&amp;c=callback" method="post" target="_blank" novalidate>
//             <div><input type="email" name="EMAIL" id="mce-EMAIL" value="" placeholder="Email address"></div>
//             <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" id="js-validate-robot" name="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" tabindex="-1" value=""></div>
//             <div class="submit-wrap"><button type="submit" name="subscribe" id="mc-embedded-subscribe">Submit</button></div>
//             <div id="js-subscribe-response"></div>
//         </form>
//     </sub-form></div>';
// }
// //add_filter( 'signup_form', 'signup_form_func' );
// add_action( 'init', 'register_shortcodes');
// function register_shortcodes(){
//     add_shortcode('signup_form', 'signup_form_func' );
// }

class BS_Page_Walker extends Walker_Page {
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='dropdown-menu' role='menu'>\n";
    }

    public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
        if ( $depth ) {
            $indent = str_repeat( "\t", $depth );
        } else {
            $indent = '';
        }

        $css_class = array( 'page_item', 'page-item-' . $page->ID );

        if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
            $css_class[] = 'page_item_has_children';
        }

        if ( ! empty( $current_page ) ) {
            $_current_page = get_post( $current_page );
            if ( in_array( $page->ID, $_current_page->ancestors ) ) {
                $css_class[] = 'current_page_ancestor';
            }
            if ( $page->ID == $current_page ) {
                $css_class[] = 'current_page_item';
            } elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
                $css_class[] = 'current_page_parent';
            }
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        /**
         * Filter the list of CSS classes to include with each page item in the list.
         *
         * @since 2.8.0
         *
         * @see wp_list_pages()
         *
         * @param array   $css_class    An array of CSS classes to be applied
         *                             to each list item.
         * @param WP_Post $page         Page data object.
         * @param int     $depth        Depth of page, used for padding.
         * @param array   $args         An array of arguments.
         * @param int     $current_page ID of the current page.
         */
        $css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

        if ( '' === $page->post_title ) {
            $page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );
        }

        $args['link_before'] = empty( $args['link_before'] ) ? '' : $args['link_before'];
        $args['link_after'] = empty( $args['link_after'] ) ? '' : $args['link_after'];


        /** This filter is documented in wp-includes/post-template.php */
        if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
            $output .= $indent . sprintf(
                    '<li class="%s"><a href="%s" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">%s%s%s <span class="caret"></span></a>',
                    $css_classes,
                    get_permalink( $page->ID ),
                    $args['link_before'],
                    apply_filters( 'the_title', $page->post_title, $page->ID ),
                    $args['link_after']
                );
        } else {
            $product_count = "";
            if(get_page_template_slug($page) === 'template-products.php'){
                $products = get_field('products',$page->ID);
                if($products){
                    $product_count = ' ('.count($products).')';
                }
            }
            $output .= $indent . sprintf(
                    '<li class="%s"><a href="%s">%s%s%s</a>%s',
                    $css_classes,
                    get_permalink( $page->ID ),
                    $args['link_before'],
                    apply_filters( 'the_title', $page->post_title, $page->ID ),
                    $args['link_after'],
                    $product_count
                );
        }


        if ( ! empty( $args['show_date'] ) ) {
            if ( 'modified' == $args['show_date'] ) {
                $time = $page->post_modified;
            } else {
                $time = $page->post_date;
            }

            $date_format = empty( $args['date_format'] ) ? '' : $args['date_format'];
            $output .= ' ' . mysql2date( $date_format, $time );
        }
    }
}