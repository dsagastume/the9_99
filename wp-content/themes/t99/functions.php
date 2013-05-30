<?php

add_theme_support( "post-thumbnails" );

function wordpress_head_cleanup() {
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);

  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

  add_filter('use_default_gallery_style', '__return_null');
}

add_action('init', 'wordpress_head_cleanup');

define( 'DISALLOW_FILE_EDIT', true );

function t99_init () {

  /**
  * Registrar tamaño de imagen
  */
  //add_image_size( 'single-thumb', 313, 220, true );
  
  /**
   * Create "Artists" Post Type
   */
  $labels = array (
    'name' => 'Artists',
    'singular_name' => 'Artist',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Artist',
    'edit_item' => 'Edit Artist',
    'new_item' => 'New Artist',
    'all_items' => 'All the Artists',
    'view_item' => 'View Artist',
    'search_items' => 'Search Artists',
    'not_found' => 'Artists not found',
    'not_found_in_trash' => 'Artists not found in trash',
    'parent_item_colon' => '',
    'menu_name' => 'Artists'
      ) ;

  $args = array (
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'has_archive' => true,
    'rewrite' => true,
    'hierarchical' => true,
    'menu_position' => null,

    'supports' => array ( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' )
      ) ;  
  register_post_type ( 'artists', $args ) ;


}

add_action ( 'init', 't99_init' ) ;

/**
* Returns current theme url, if path is received returns relative path
*
* @param string $path optional path parameter
* @return string current theme url
*/
function theme_url ( $path = '' ) {
  $url = get_template_directory_uri () ;

  if ( ! empty ( $path ) && is_string ( $path ) && strpos ( $path, '..' ) === false )
    $url .= '/' . ltrim ( $path, '/' ) ;

  return $url ;

}

/**
 * Serves as an indicator for knowing if the current request was 
 * triggered by an ajax call from the client.
 * 
 * @return boolean <code>true</code> if the current request is 
 * ajax-driven and <code>false</code> otherwise;
 */
function ajax () {
  return ( ! empty ( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower ( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest') ||
      ! empty ( $_REQUEST[ 'action' ] ) || ! empty ( $_REQUEST[ 'ajax' ] ) ;

}

/**
 * Includes the Wordpress Header Template if the current request is not 
 * ajax oriented.
 * 
 * @param optional name, will call header-name template
 */
function require_header ( $name = null ) {
  if ( ! ajax () ) {
    get_header ( $name ) ;
  }

}

/**
 * Includes the Wordpress Footer Template if the current request is not 
 * ajax oriented.
 * 
 * @param optional name, will call footer-name template
 */
function require_footer ( $name = null ) {
  if ( ! ajax () ) {
    get_footer ( $name ) ;
  }

}


/**
 * Print the <title> tag based on what is being viewed.
 */
function site_title () {
  global $page , $paged ;

  wp_title ( '|' , true , 'right' ) ;

  // Add the blog name.
  bloginfo ( 'name' ) ;

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo ( 'description' , 'display' ) ;
  if ( $site_description && ( is_home () || is_front_page () ) ) {
    echo " | $site_description" ;
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    echo ' | ' . sprintf ( __ ( 'Page %s' , 'alegalis' ) , max ( $paged , $page ) ) ;
  }
}

/**
 * Echoes a DIV DOM Element with information about the current requested resource such as
 * Body Class or other data.
 * 
 * @param String $class classes to add to the metadata DOM Element.
 */
function body_metadata ( $class = '' ) {
  echo '<div id="body-metadata" class="' . join ( ' ' , get_body_class ( $class ) ) . '" data-title="' ;
  site_title () ;
  echo '"></div>' ;
}


/**
 * @param string $filename
 * @return string 
 */
function make_filename_hash ( $filename ) {
  $info = pathinfo ( $filename ) ;
  $ext = empty ( $info[ 'extension' ] ) ? '' : '.' . $info[ 'extension' ] ;
  $name = basename ( $filename, $ext ) ;
  return md5 ( $name . time () ) . $ext ;

}
// Add filter to sanitize file names after upload: make_filename_hash()
add_filter ( 'sanitize_file_name', 'make_filename_hash', 10 ) ;

function update_jquery() {  
 if(!is_admin()){     
    wp_deregister_script( 'jquery' );
wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
}
}     
add_action('wp_enqueue_scripts', 'update_jquery');


/**
 * Enqueues scripts and styles for front-end.
 */
function t99_scripts_styles () {

  wp_enqueue_style ( 'fonts-style', 'http://fonts.googleapis.com/css?family=Source+Code+Pro:300,400,600') ;
  wp_enqueue_style ( 't99-style', get_stylesheet_uri (), array ('fonts-style')) ;
  //wp_enqueue_style ( 'vegas-style', get_template_directory_uri ().'/css/vendor/jquery.vegas.css') ;

  //wp_enqueue_script ( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array ( ) ) ;
  wp_enqueue_script ( 'jquery-ui-min', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js', array ('jquery') ) ;

  //wp_enqueue_script ( 'vegas-script', get_template_directory_uri () . '/js/vendor/jquery.vegas.js', array ('jquery') ) ;

  wp_enqueue_script ( 't99-script', get_template_directory_uri () . '/js/main.js', array ('jquery') ) ;
  

}

add_action ( 'wp_enqueue_scripts', 't99_scripts_styles' ) ;

function getSlideScript() {
    $args = array( 
    'post_parent' => 2,
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page'=>-1
    );
    $images  = get_posts($args);
    if (!empty($images))  {
      ?>
        <script>
          $(document).ready(function() {
            $.vegas.defaults = {
              background: {
                loading:false
              }
            }
            $.vegas('slideshow', {
              preload:true,
              delay:16000,
              backgrounds:[             
      <?php
      foreach ($images as $image) {    
        $attachmenturl=wp_get_attachment_url($image->ID);
        $description= $image->post_content;
        $caption= $image->post_excerpt;
        $imageSrc = wp_get_attachment_image_src( $image->ID, 'full');
        $imageSrc = $imageSrc[0];
echo "                { src:'".$imageSrc."', fade:4000 },";
      }
      ?>
            ]
          });
        }); 
        </script>    
      <?php 
    }
}

function getPostImages() {
    $args = array( 
    'post_parent' => get_the_ID(),
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page'=>-1
    );
    $images  = get_posts($args);
    foreach ($images as $image) {    
        $attachmenturl=wp_get_attachment_url($image->ID);
        $description= $image->post_content;
        $caption= $image->post_excerpt;
        $attr = array(
          // 'class' => "absolute",
          // 'data-type' => $term->slug
        );
        $imageSrc = wp_get_attachment_image_src( $image->ID, 'full', False);
        $imageSrc = $imageSrc[0];
        echo '<li><a>';
        echo '<img src="'.$imageSrc.'">';
        echo '</a></li>';
        //echo '<img class="slide absolute transition-margin-left transition-width" data-type="'.$term->slug.'" src="'.$attachmenturl.'"></img>' . "\n";
    }
}



/********************************************* METABOX **************************************/
/**
 * Adds a metabox in the post edit page
 */
// function data_add_metabox () {
//   $post_types = array ( 'vivienda', 'desarrollo', 'geotecnia' );
//   foreach ( $post_types as $type ) {
//     add_meta_box ( 'data_metabox', 
//               __ ( 'Datos de Proyecto', 't99' ), 
//               'data_create_metabox', $type );
//   }
// }

// // hook the add_meta_boxes action: data_add_metabox()
// add_action ( 'add_meta_boxes', 'data_add_metabox' );

// /**
//  * Renders the text editor in the data metabox
//  * @param stdClass $post 
//  */
// function data_create_metabox ( $post ) {
//   $data_content = get_post_meta ( $post -> ID, '_data_input', true );
//     wp_editor ( $data_content, 'datainput', array (
//     'media_buttons' => false,
//   ) );
// }

// *
//  * Saves the data info as a metadata value of the post
//  * @global stdClass $post
//  * @param array $data
//  * @param array $postarr
//  * @return array 
 
// function data_filter_handler ( $data, $postarr ) {
//   global $post;
//   if ( isset ( $postarr[ 'datainput' ] ) ) {
//     update_post_meta ( $post -> ID, '_data_input', $postarr[ 'datainput' ] );
//   }
//   return $data;
// }

// // hook the post edit/create/update action: data_filter_handler()
// add_filter ( 'wp_insert_post_data', 'data_filter_handler', '99', 2 );

// /**
//  *
//  * @param type $post_id
//  * @return type 
//  */
// function data_get_the_content ( $post_id = null ) {
//   $post_id = ( null === $post_id ) ? get_the_ID () : $post_id;
//     $content = get_post_meta ( $post_id, '_data_input', true );
//   return wpautop($content);
// }

// /**
//  *
//  * @param int $post_id 
//  */
// function data_the_content ( $post_id ) {
//   echo data_get_the_content ( $post_id );
// }