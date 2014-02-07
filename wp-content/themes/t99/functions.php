<?php

require_once 'functions-language.php' ;

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

function t99_init () {

  /**
  * Registrar tamaño de imagen
  */

  load_theme_textdomain ( 't99' , get_template_directory () . '/languages' ) ;

  add_image_size( 'thumbnail', 550, 400, true );
  add_image_size( 'archive248by181', 275, 200, true );
  add_image_size( 'publications120by155', 120, 155, true );

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

    'supports' => array ( 'title', 'editor', 'author', 'thumbnail', 'custom-fields' )
      ) ;
  register_post_type ( 'artists', $args ) ;

/**
   * Create "Artists" Post Type
   */
  $labels = array (
    'name' => 'Publications',
    'singular_name' => 'Publication',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Publication',
    'edit_item' => 'Edit Publication',
    'new_item' => 'New Publication',
    'all_items' => 'All the Publications',
    'view_item' => 'View Publication',
    'search_items' => 'Search Publications',
    'not_found' => 'Publications not found',
    'not_found_in_trash' => 'Publications not found in trash',
    'parent_item_colon' => '',
    'menu_name' => 'Publications'
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

    'supports' => array ( 'title', 'editor', 'author', 'thumbnail' )
      ) ;
  register_post_type ( 'publications', $args ) ;


  $labels = array (
    'name' => 'Exhibitions',
    'singular_name' => 'Exhibition',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Exhibition',
    'edit_item' => 'Edit Exhibition',
    'new_item' => 'New Exhibition',
    'all_items' => 'All the Exhibitions',
    'view_item' => 'View Exhibition',
    'search_items' => 'Search Exhibitions',
    'not_found' => 'Exhibitions not found',
    'not_found_in_trash' => 'Exhibitions not found in trash',
    'parent_item_colon' => '',
    'menu_name' => 'Exhibitions'
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
    'taxonomies' => array('category'),

    'supports' => array ( 'title', 'editor', 'author', 'thumbnail' )
      ) ;
  register_post_type ( 'exhibitions', $args ) ;


 //register_taxonomy( 'categories', 'exhibitions', array( 'hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true ) );

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
  if (!is_attachment()) {
    ?>
    <script>
    console.log('no es attachment');
  function getVar(name, optionalUrl){
    var SearchString = optionalUrl || window.location.search;
    if(name==(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(SearchString))
      return decodeURIComponent(name[1]);
    };

  function removeVar(url, parameter){
    var urlparts= url.split('?');
    if (urlparts.length>=2) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);
        for (var i= pars.length; i-->0;)
            if (pars[i].lastIndexOf(prefix, 0)!==-1)
                pars.splice(i, 1);
        url= urlparts[0]+'?'+pars.join('&');
    }
    return url;
  };

  var languageAnchors = $$('.language-link');
  languageAnchors.each(function(item, index){
    var link = item.get ( 'href' );
    if (typeof(getVar('category',link))!="undefined") {
        link = removeVar(link, 'category');
       } else if (typeof(getVar('parent',link))!="undefined") {
        link = removeVar(link, 'parent');
       }
      item.set('href', link);
  });
  </script>
    <?php
  }
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

  wp_enqueue_style ( 'milkbox' , get_stylesheet_directory_uri ().'/css/milkbox/milkbox.css' ) ;
  //wp_enqueue_style ( 'vegas-style', get_template_directory_uri ().'/css/vendor/jquery.vegas.css') ;
  wp_enqueue_script ( 'mootools-core' , get_template_directory_uri () . '/js/vendor/mootools-core-1.4.5.js' , array ( 'jquery' ) , '1.4.5' , false ) ;
  wp_enqueue_script ( 'mootools-more' , get_template_directory_uri () . '/js/vendor/mootools-more-1.4.0.1.js' , array ( 'mootools-core' ) , '1.4.0.1' , false ) ;
  wp_enqueue_script ( 'milkbox-script' , get_template_directory_uri () . '/js/vendor/milkbox-yc.js' , array ( 't99-script' ) , false , false ) ;
  //wp_enqueue_script ( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array ( ) ) ;
  wp_enqueue_script ( 'jquery-ui-min', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js', array ('jquery') ) ;

  //wp_enqueue_script ( 'vegas-script', get_template_directory_uri () . '/js/vendor/jquery.vegas.js', array ('jquery') ) ;

  wp_enqueue_script ( 't99-script', get_template_directory_uri () . '/js/main.js', array ('mootools-more') ) ;


}

add_action ( 'wp_enqueue_scripts', 't99_scripts_styles' ) ;

/**
 * Dinamically adds home slideshow
 */
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
        <script class="deleteableScript">
          $(document).ready(function() {
            window.myBG=$("body").backstretch([
      <?php
      foreach ($images as $image) {
        $attachmenturl=wp_get_attachment_url($image->ID);
        $description= $image->post_content;
        $caption= $image->post_excerpt;
        $imageSrc = wp_get_attachment_image_src( $image->ID, 'full');
        $imageSrc = $imageSrc[0];
echo '    "'.$imageSrc.'",'."\n";
      }
      ?>
            ], {
              fade: 1000,
              duration: 4000
            });
          });
      </script>
      <?php
    }
}
/**
 * Dinamically adds gallery slideshow
 */
function getGalleryScript() {
    $args = array(
    'post_parent' => 109,
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page'=>-1
    );

    $images  = get_posts($args);
    if (!empty($images))  {
      ?>
        <script class="deleteableScript">
          $(document).ready(function() {
            $(".gallery-images").backstretch([
      <?php
      foreach ($images as $image) {
        $attachmenturl=wp_get_attachment_url($image->ID);
        $description= $image->post_content;
        $caption= $image->post_excerpt;
        $imageSrc = wp_get_attachment_image_src( $image->ID, 'full');
        $imageSrc = $imageSrc[0];
echo '    "'.$imageSrc.'",'."\n";
      }
      ?>
            ], {
              fade: 1000,
              duration: 4000
            });
          });
      </script>
      <?php
    }
}

function getContactScript() {
  ?>
<script>
$(document).ready(function(e) {
if ($("#map").length == 1) {
    var mapCanvas = document.getElementById('map');
    var latLng = new google.maps.LatLng(14.638255,-90.515451);
    var mapOptions = {
      center: latLng,
      zoom: 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);

    var markerShadow = {
      url: '<?php echo theme_url ("img/marker_shadow.png" ); ?>',
      anchor: new google.maps.Point(20, 65)
    };

    var marker = new google.maps.Marker({
      position: latLng,
      map: map,
      icon: '<?php echo theme_url ("img/marker.png" ); ?>',
//      shadow: markerShadow
    });
  }
  });
</script>
  <?php
}
/**
 * Prints the artist works html
 * @return html
 */
function getArtistWorks() {
    $args = array(
    'post_parent' => get_the_ID(),
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page'=>-1,
    'orderby'=>'menu_order',
    'order'=>'asc'
    );
    $images  = get_posts($args);
    foreach ($images as $image) {
        $attachmenturl=get_attachment_link($image->ID);
        $description= $image->post_content;
        $caption= $image->post_excerpt;
        $attr = array(
          // 'class' => "absolute",
          // 'data-type' => $term->slug
        );
        $imageSrc = wp_get_attachment_image_src( $image->ID, 'archive248by181', False);
        $imageSrc = $imageSrc[0];
        echo '<li><a href='.$attachmenturl.'?parent=works>';
        echo '<img src="'.$imageSrc.'">';
        echo '</a></li>';

        //echo '<img class="slide absolute transition-margin-left transition-width" data-type="'.$term->slug.'" src="'.$attachmenturl.'"></img>' . "\n";
    }
}

/**
 * Prints the items
 * @return html
 */
function getExhibitionItems($category = '') {
    if ($category != '') {
      $args = array(
      'post_type' => 'exhibitions',
      'posts_per_page'=>-1,
      'orderby'=>'menu_order',
      'order'=>'asc',
      'categories'=>$category
      );
    } else {
      $args = array(
      'post_type' => 'exhibitions',
      'posts_per_page'=>-1,
      'orderby'=>'menu_order',
      'order'=>'asc'
      );
    }
    $exhibitions  = get_posts($args);
    foreach ($exhibitions as $exhibition) {
        $exhibitionUrl=get_permalink($exhibition->ID);
        $title= language_get_the_title($exhibition->ID);
        $date = get_post_meta ( $exhibition->ID, '_data_input', true );
        $attr = array(
          // 'class' => "absolute",
          // 'data-type' => $term->slug
        );
        $imageSrc = get_the_post_thumbnail( $exhibition->ID, 'archive248by181');
        echo '<li><a href='.$exhibitionUrl.'>';
        echo '<div>';
        echo '<p>'.$title.'</p>';
        echo '<p><span>'.$date.'</span></p>';
        echo '</div>';
        echo $imageSrc;
        echo '</a></li>';
        //echo '<img class="slide absolute transition-margin-left transition-width" data-type="'.$term->slug.'" src="'.$attachmenturl.'"></img>' . "\n";
    }
}

/**
 * Prints the exhibition works
 * @return string
 */
function getExhibitionWorks() {
    $args = array(
    'post_parent' => get_the_ID(),
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page'=>-1,
    'attachment_category' => 'works',
    'orderby'=>'menu_order',
    'order'=>'asc'
    );
    $images  = get_posts($args);
    foreach ($images as $image) {
        $attachmenturl=get_attachment_link($image->ID);
        $description= $image->post_content;
        $caption= $image->post_excerpt;
        $attr = array(
          // 'class' => "absolute",
          // 'data-type' => $term->slug
        );
        $imageSrc = wp_get_attachment_image_src( $image->ID, 'thumbnail', False);
        $imageSrc = $imageSrc[0];
        echo '<li><a href='.$attachmenturl.'?category=works>';
        echo '<img src="'.$imageSrc.'">';
        echo '</a></li>';
        //echo '<img class="slide absolute transition-margin-left transition-width" data-type="'.$term->slug.'" src="'.$attachmenturl.'"></img>' . "\n";
    }
}

/**
 * Displays the exhibition views
 * @return string
 */
function getExhibitionViews() {
    $args = array(
    'post_parent' => get_the_ID(),
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'attachment_category' => 'views',
    'posts_per_page'=>-1,
    'orderby'=>'menu_order',
    'order'=>'asc'
    );
    $images  = get_posts($args);
    foreach ($images as $image) {
        $attachmenturl=get_attachment_link($image->ID);
        $description= $image->post_content;
        $caption= $image->post_excerpt;
        $attr = array(
          // 'class' => "absolute",
          // 'data-type' => $term->slug
        );
        $imageSrc = wp_get_attachment_image_src( $image->ID, 'thumbnail', False);
        $imageSrc = $imageSrc[0];
        echo '<li><a href='.$attachmenturl.'?category=views>';
        echo '<img src="'.$imageSrc.'">';
        echo '</a></li>';
        //echo '<img class="slide absolute transition-margin-left transition-width" data-type="'.$term->slug.'" src="'.$attachmenturl.'"></img>' . "\n";
    }
}

function filter_anchors( $content ) {
  $anchors = array('</a>');
  $content = str_ireplace( $anchors, '<span aria-hidden="true" data-icon="&#xe003;"></span></a>', $content );
  return $content;
}

add_filter( 'the_content', 'filter_anchors' );


function get_next_image() {
  $post = get_post();
  if (isset($_GET['category'])) {
    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' , 'attachment_category' => $_GET['category']) ) );
    foreach ( $attachments as $k => $attachment )
      if ( $attachment->ID == $post->ID )
        break;

    $k = $k + 1;
    if ($k == count($attachments)) $k=0;

    $output = $attachment_id = null;
    if ( isset( $attachments[ $k ] ) ) {
      $attachment_id = $attachments[ $k ]->ID;
      $output = get_attachment_link( $attachment_id )."?category=".$_GET['category'];
    }
  } else {
    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
    foreach ( $attachments as $k => $attachment )
      if ( $attachment->ID == $post->ID )
        break;

    $k = $k + 1;
    if ($k == count($attachments)) $k=0;

    $output = $attachment_id = null;
    if ( isset( $attachments[ $k ] ) ) {
      $attachment_id = $attachments[ $k ]->ID;
      $output = get_attachment_link( $attachment_id );
    }
  }


  if (isset($_GET['parent']))
    $output .= '?parent='.$_GET['parent'];

    return $output;

}

function get_prev_image() {
  $post = get_post();
  if (isset($_GET['category'])) {
    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' , 'attachment_category' => $_GET['category']) ) );
    foreach ( $attachments as $k => $attachment )
      if ( $attachment->ID == $post->ID )
        break;

    $k = $k - 1;
    if ($k == -1) $k=count($attachments)-1 ;

    $output = $attachment_id = null;
    if ( isset( $attachments[ $k ] ) ) {
      $attachment_id = $attachments[ $k ]->ID;
      $output = get_attachment_link( $attachment_id )."?category=".$_GET['category'];
    }
  } else {
    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
    foreach ( $attachments as $k => $attachment )
      if ( $attachment->ID == $post->ID )
        break;

    $k = $k - 1;
    if ($k == -1) $k=count($attachments)-1 ;

    $output = $attachment_id = null;
    if ( isset( $attachments[ $k ] ) ) {
      $attachment_id = $attachments[ $k ]->ID;
      $output = get_attachment_link( $attachment_id );
    }
  }
  if (isset($_GET['parent']))
    $output .= '?parent='.$_GET['parent'];

    return $output;
}

function get_image_category_link($parent) {
  if (isset($_GET['parent'])) {
    return ''.get_permalink($parent).$_GET['parent'];
  } elseif (isset($_GET['category'])) {
    return ''.get_permalink($parent).$_GET['category'];
  } else {
    return ''.get_permalink($parent);
  }
}

/************************************** PUBLICATIONS METABOX **************************************/
/**
* Adds the link - metabox to publications
*/

/* Define the custom box */

add_action( 'add_meta_boxes', 'publicationLink_add_custom_box' );

// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'publicationLink_add_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'publicationLink_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function publicationLink_add_custom_box() {
    $screens = array( 'publications' );
    foreach ($screens as $screen) {
        add_meta_box(
            'publicationLink_sectionid',
            __( 'Publication Link', 'publicationLink_textdomain' ),
            'publicationLink_inner_custom_box',
            $screen
        );
    }
}

/* Prints the box content */
function publicationLink_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'publicationLink_noncename' );

  // The actual fields for data entry
  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
  $value = get_post_meta( $post->ID, '_my_meta_value_key', true );
  echo '<input placeholder="http://www.yoururl.com/" type="text" id="publicationLink_new_field" name="publicationLink_new_field" value="'.esc_attr($value).'" size="75" />';
}

/* When the post is saved, saves our custom data */
function publicationLink_save_postdata( $post_id ) {


  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['publicationLink_noncename'] ) || ! wp_verify_nonce( $_POST['publicationLink_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // Thirdly we can save the value to the database

  //if saving in a custom table, get post_ID
  $post_ID = $_POST['post_ID'];
  //sanitize user input
  $mydata = sanitize_text_field( $_POST['publicationLink_new_field'] );

  // Do something with $mydata
  // either using
  add_post_meta($post_ID, '_my_meta_value_key', $mydata, true) or
    update_post_meta($post_ID, '_my_meta_value_key', $mydata);
  // or a custom table (see Further Reading section below)
}

/**
 *
 * @ type $post_id
 * @return type
 */
function publication_get_the_link ( $post_id = null ) {
  $post_id = ( null === $post_id ) ? get_the_ID () : $post_id;
    $content = get_post_meta ( $post_id, '_my_meta_value_key', true );
  return $content;
}

/**
 *
 * @param int $post_id
 */
function publication_the_link ( $post_id ) {
  echo publication_get_the_link ( $post_id );
}

/************************************** EXHIBITION METABOX **************************************/
/**
 * Adds a metabox in the post edit page
 */
function data_add_metabox () {
  $post_types = array ( 'exhibitions' );
  foreach ( $post_types as $type ) {
    add_meta_box ( 'data_metabox',
              __ ( 'Exhibition Duration', 't99' ),
              'data_create_metabox', $type );
  }
}

// hook the add_meta_boxes action: data_add_metabox()
add_action ( 'add_meta_boxes', 'data_add_metabox' );

/**
 * Renders the text editor in the data metabox
 * @param stdClass $post
 */
function data_create_metabox ( $post ) {
  $data_content = get_post_meta ( $post -> ID, '_data_input', true );
  echo 'English: <input type="text" id="datainput" name="datainput" value="'.esc_attr($data_content).'" size="75" /><br/>';

  $data_content_esp = get_post_meta ( $post -> ID, '_data_input_esp', true );
  echo 'Español: <input type="text" id="datainputesp" name="datainputesp" value="'.esc_attr($data_content_esp).'" size="75" />';
  //   wp_editor ( $data_content, 'datainput', array (
  //   'media_buttons' => false,
  // ) );
}

/**
 * Saves the data info as a metadata value of the post
 * @global stdClass $post
 * @param array $data
 * @param array $postarr
 * @return array
 */

function data_filter_handler ( $data, $postarr ) {
  global $post;
  if ( isset ( $postarr[ 'datainputesp' ] ) ) {
    update_post_meta ( $post -> ID, '_data_input_esp', $postarr[ 'datainputesp' ] );
  }
  if ( isset ( $postarr[ 'datainput' ] ) ) {
    update_post_meta ( $post -> ID, '_data_input', $postarr[ 'datainput' ] );
  }
  return $data;
}

// hook the post edit/create/update action: data_filter_handler()
add_filter ( 'wp_insert_post_data', 'data_filter_handler', '99', 2 );
/**
 *
 * @ type $post_id
 * @return type
 */
function data_get_the_content ( $post_id = null ) {
  $post_id = ( null === $post_id ) ? get_the_ID () : $post_id;
    // $content = get_post_meta ( $post_id, '_data_input', true );

  if (isset($_GET['lan'])) {
    if ( $_GET['lan']=='en' ) {
      $content = get_post_meta ( $post_id, '_data_input', true );
    } else {
    $content = get_post_meta ( $post_id, '_data_input_esp', true );
    }
  } else {
    $content = get_post_meta ( $post_id, '_data_input', true );
  }

  return $content;

}

/**
 *
 * @param int $post_id
 */
function data_the_content ( $post_id ) {
  echo data_get_the_content ( $post_id );
}
/****************************************************************************/

/************************************** IMAGE METABOX **************************************/

/**
 * Adding our custom fields to the $form_fields array
 *
 * @param array $form_fields
 * @param object $post
 * @return array
 */
function my_image_attachment_fields_to_edit($form_fields, $post) {
    // $form_fields is a special array of fields to include in the attachment form
    // $post is the attachment record in the database
    //     $post->post_type == 'attachment'
    // (attachments are treated as posts in WordPress)

    // add our custom field to the $form_fields array
    // input type="text" name/id="attachments[$attachment->ID][custom1]"
    $form_fields["custom1"] = array(
        "label" => __("Custom Text Field"),
        "input" => "text", // this is default if "input" is omitted
        "value" => get_post_meta($post->ID, "_custom1", true)
    );
    // if you will be adding error messages for your field,
    // then in order to not overwrite them, as they are pre-attached
    // to this array, you would need to set the field up like this:
    $form_fields["custom1"]["label"] = __("Spanish Title");
    $form_fields["custom1"]["input"] = "textarea";
    $form_fields["custom1"]["value"] = get_post_meta($post->ID, "_custom1", true);

    $form_fields["custom2"] = array(
        "label" => __("Custom Text Field"),
        "input" => "text", // this is default if "input" is omitted
        "value" => get_post_meta($post->ID, "_custom2", true)
    );
    // if you will be adding error messages for your field,
    // then in order to not overwrite them, as they are pre-attached
    // to this array, you would need to set the field up like this:
    $form_fields["custom2"]["label"] = __("Spanish Content");
    $form_fields["custom2"]["input"] = "textarea";
    $form_fields["custom2"]["value"] = get_post_meta($post->ID, "_custom2", true);

    return $form_fields;
}
// attach our function to the correct hook
add_filter("attachment_fields_to_edit", "my_image_attachment_fields_to_edit", null, 2);

/**
 * @param array $post
 * @param array $attachment
 * @return array
 */

// function my_save_attachment_location( $attachment_id ) {
//     if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']))
//     {
//       if ( isset( $_REQUEST['attachments'][$attachment_id]['custom1'] ) ) {
//         $location = $_REQUEST['attachments'][$attachment_id]['custom1'];
//         if (strlen ($location)>2)
//         update_post_meta( $attachment_id, '_custom1', $location );
//       }

//       if ( isset( $_REQUEST['attachments'][$attachment_id]['custom2'] ) ) {
//         $location = $_REQUEST['attachments'][$attachment_id]['custom2'];
//         if (strlen ($location)>2)
//         update_post_meta( $attachment_id, '_custom2', $location );
//       }
//     }
//     if ( isset( $_REQUEST['attachments'][$attachment_id]['custom1'] ) ) {
//         $location = $_REQUEST['attachments'][$attachment_id]['custom1'];
//         update_post_meta( $attachment_id, '_custom1', $location );
//     }

//     if ( isset( $_REQUEST['attachments'][$attachment_id]['custom2'] ) ) {
//         $location = $_REQUEST['attachments'][$attachment_id]['custom2'];
//         update_post_meta( $attachment_id, '_custom2', $location );
//     }
// }

//add_action( 'edit_attachment', 'my_save_attachment_location' );

/**
 * @param array $post
 * @param array $attachment
 * @return array
 */
function my_image_attachment_fields_to_save($post, $attachment) {
    // $attachment part of the form $_POST ($_POST[attachments][postID])
    // $post attachments wp post array - will be saved after returned
    //     $post['post_type'] == 'attachment'

    if ($attachment['custom1']  ) {
        update_post_meta( $post['ID'], '_custom1', $attachment['custom1'] );
    }

    if ($attachment['custom2']  ) {
        update_post_meta( $post['ID'], '_custom2', $attachment['custom2'] );
    }

    return $post;
}

add_filter('attachment_fields_to_save', 'my_image_attachment_fields_to_save', 10, 2);

function image_get_the_content ( $post_id = null ) {
  $post_id = ( null === $post_id ) ? get_the_ID () : $post_id;
  if (isset($_GET['lan'])) {
    if ( $_GET['lan']=='en' ) {
      $content = get_the_content();
    } else {
    $content = get_post_meta ( $post_id, '_custom2', true );
    }
  } else {
    $content = get_post_meta ( $post_id, '_custom2', true );
  }
  return $content;
}

function image_get_the_title ( $post_id = null ) {
  $post_id = ( null === $post_id ) ? get_the_ID () : $post_id;
  if (isset($_GET['lan'])) {
    if ( $_GET['lan']=='en' ) {
      $title = get_the_title();
    } else {
    $title = get_post_meta ( $post_id, '_custom1', true );
    }
  } else {
    $title = get_post_meta ( $post_id, '_custom1', true );
  }
  return $title;
}

function image_get_embedding ( $post_id = null ) {
  return get_the_excerpt();
}

/* Can be added to functions.php */
add_filter( 'rewrite_rules_array','my_insert_rewrite_rules' );
add_action( 'wp_loaded','my_flush_rules' );

// flush_rules() if our rules are not yet included
function my_flush_rules() {
$rules = get_option( 'rewrite_rules' );
if ( ! isset( $rules['exhibitions/category/(.*/?)$'] ) ) {
global $wp_rewrite;
$wp_rewrite->flush_rules();
}
}

// Adding a new rule
function my_insert_rewrite_rules( $rules ) {
$newrules = array();
$newrules['exhibitions/category/(.*/?)$'] = 'index.php?post_type=exhibitions&category_name=$matches[1]';
return $newrules + $rules;
}