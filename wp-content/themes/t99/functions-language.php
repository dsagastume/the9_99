<?php

 /**
  * Retrieves and Stores a hard coded array that contains all the options.
  * 
  * @return array the Language theme options
  */
 function get_language_options () {
   $options = array ( ) ;

   $options[ 'default_language' ] = 'en' ;

   $options[ 'languages' ] = array ( ) ;
   $options[ 'languages' ][ 'en' ] = 'english' ;
   $options[ 'languages' ][ 'es' ] = 'español' ;

   $options[ 'available_languages' ] = array ( ) ;
   $options[ 'available_languages' ][ 'en' ] = 'en_US' ;
   $options[ 'available_languages' ][ 'es' ] = 'es_ES' ;

   $options[ 'post_types' ] = array ( ) ;
   $options[ 'post_types' ][ ] = 'post' ;
   $options[ 'post_types' ][ ] = 'page' ;
   $options[ 'post_types' ][ ] = 'artists' ;
   $options[ 'post_types' ][ ] = 'exhibitions' ;
   $options[ 'post_types' ][ ] = 'publications' ;

   return $options ;
 }

 add_action ( 'init' , 'language_initialization' , 0 ) ;

 /**
  * Initializes the Language Theme functions
  */
 function language_initialization () {
   language_parse_from_url () ;
 }

 /*
  *  Attach a function to handle the Language Metabox creation.
  */
 add_action ( 'add_meta_boxes' , 'language_add_metaboxes' ) ;

 function language_add_metaboxes () {

   $options = get_language_options () ;
   foreach ( $options[ 'post_types' ] as $post_type ) {
     foreach ( $options[ 'available_languages' ] as $key => $locale ) {

       // display a metabox for every non default language
       if ( $key !== $options[ 'default_language' ] ) {
         $id = 'language-' . $locale . '-' . $post_type ;
         $title = ucfirst ( $options[ 'languages' ][ $key ] ) ;
         $callback = 'language_create_metaboxes' ;
         $context = 'normal' ;
         $priority = 'high' ;
         $callback_args = array (
             'content_locale' => $locale
                 ) ;
         add_meta_box ( $id , $title , $callback , $post_type , $context , $priority , $callback_args ) ;
       }
     }
   }
 }

 function language_create_metaboxes ( $post , $args ) {
   $content_locale = $args[ 'args' ][ 'content_locale' ] ;

   // build the meta keys, used as input[name] attributes.
   $title_name = '_language_' . $content_locale . '_title' ;
   $content_name = '_language_' . $content_locale . '_content' ;

   // filter remove /[_]+/
   $filtered_content_name = str_replace ( '_' , '' , $content_name ) ;

   // fetch post title and content from metadata
   $post_title = get_post_meta ( $post -> ID , $title_name , true ) ;
   $post_content = get_post_meta ( $post -> ID , "_$filtered_content_name" , true ) ;

   // escape Title Input name attr and Post Title value attr for safe HTML echoing.
   $escaped_name = esc_attr ( htmlspecialchars ( $title_name ) ) ;
   $escaped_title = esc_attr ( htmlspecialchars ( $post_title ) ) ;

   // escape the content Input name for safe HTML echoing.
   $escaped_content = esc_attr ( htmlspecialchars ( $filtered_content_name ) ) ;

   echo '<div>' , '<input class="language_input" type="text" name="' , $escaped_name , '" size="30" value="' , $escaped_title ,
   '" autocomplete="off">' , '</div>' ;

   // finally, display a Wordpress Editor inside the current metabox.
   wp_editor ( $post_content , $escaped_content , array (
       'media_buttons' => false
   ) ) ;
 }

 function language_add_subtitle_input ( $post_id , $locale ) {

   $subtitle_name = '_language_' . $locale . '_subtitle' ;
   $post_subtitle = get_post_meta ( $post_id , $subtitle_name , true ) ;
   $escaped_subtitle = esc_attr ( htmlspecialchars ( $post_subtitle ) ) ;
   $escaped_subtitle_name = esc_attr ( htmlspecialchars ( $subtitle_name ) ) ;

   echo '<div class="relative">' ,
   '<input class="language_input" type="text" name="' , $escaped_subtitle_name , '" placeholder="' , __ ( 'Subtítulo' , 't99' ) , '", size="30" value="' , $escaped_subtitle ,
   '" autocomplete="off">' , '</div>' ;
 }

 add_action ( 'edit_form_after_title' , 'language_default_add_subtitle_input' ) ;

 function language_default_add_subtitle_input () {
   global $post ;
   $options = get_language_options () ;
   $default_language = $options[ 'default_language' ] ;
   $default_locale = $options[ 'available_languages' ][ $default_language ] ;
 }

 /**
  * Computes the desired Locale from the URL.
  */
 function language_parse_from_url () {
   $options = get_language_options () ;

   // detect current language from POST || GET vars
   if ( isset ( $_GET[ 'lan' ] ) ) {
     $language = $_GET[ 'lan' ] ;
   } else if ( isset ( $_POST[ 'lan' ] ) ) {
     $language = $_POST[ 'lan' ] ;
   } else if ( !isset($GLOBALS[ 'language_theme_locale' ])) {
     $language = 'en' ; //$options[ 'default_language' ] ;
   }

   if ( array_key_exists ( $language , $options[ 'available_languages' ] ) ) {
     $wp_language = $options[ 'available_languages' ][ $language ] ;
   } else {
     $default_language_key = 'en' ; //$options[ 'default_language' ] ;
     $wp_language = $options[ 'available_languages' ][ $default_language_key ] ;
   }

   // Initialize a global variable for storing the Locale Tag.
   $GLOBALS[ 'language_theme_locale' ] = $wp_language ;
 }

 /*
  * Defines a filter for setting the current them's Locale based 
  * on these Language Functions.
  */
 add_filter ( 'locale' , 'language_filter_locale' ) ;

 /**
  * Filters the Wordpress Default Locale global variable to show the value that
  * these language functions will require.
  * 
  * @global String $language_theme_locale this functions usable locale tag
  * @param String $locale the current Wordpress locale
  * @return String a new locale based on the URL retrieved value or a default setting
  */
 function language_filter_locale ( $locale ) {
   global $language_theme_locale ;
   return $language_theme_locale ;
 }

 add_filter ( 'wp_insert_post_data' , 'language_post_data_filter' , '99' , 2 ) ;

 function language_post_data_filter ( $data , $postarr ) {
   global $post ;

   $options = get_language_options () ;
   foreach ( $options[ 'available_languages' ] as $key => $locale ) {

     $subtitle_key = '_language_' . $locale . '_subtitle' ;
     if ( isset ( $postarr[ $subtitle_key ] ) ) {
       $post_title = $postarr[ $subtitle_key ] ;
       update_post_meta ( $post -> ID , $subtitle_key , $post_title ) ;
     }

     // save post language data for every non default language
     if ( $key !== $options[ 'default_language' ] ) {

       // build the meta keys, used as input[name] attributes.
       $title_key = '_language_' . $locale . '_title' ;
       $content_key = '_language_' . $locale . '_content' ;

       // filter remove /[_]+/
       $content_name = str_replace ( '_' , '' , $content_key ) ;
       $title_name = $title_key ;

       if ( isset ( $postarr[ $title_name ] ) ) {
         $post_title = $postarr[ $title_name ] ;
         update_post_meta ( $post -> ID , $title_key , $post_title ) ;
       }

       if ( isset ( $postarr[ $content_name ] ) ) {
         $post_content = $postarr[ $content_name ] ;
         update_post_meta ( $post -> ID , "_$content_name" , $post_content ) ;
       }
     }
   }

   return $data ;
 }

 function is_default_locale () {
   global $language_theme_locale ;
   $options = get_language_options () ;
   $locale_key = $options[ 'default_language' ] ;

   return $language_theme_locale === $options[ 'available_languages' ][ $locale_key ] ;
 }

 /**
  * Computes the current language based on the Wordpress BlogInfo.
  * @return String a two-character identifiyng the current language's locale.
  */
 function get_language () {
   $locale = get_bloginfo ( 'language' ) ;
   $mnemonic = substr ( $locale , 0 , 2 ) ;

   return $mnemonic ;
 }

 function is_language ( $locale ) {
   return get_language () === $locale ;
 }

 /**
  * Echoes the current two-character locale identifier for the blog.
  */
 function language () {
   echo get_language () ;
 }

 function language_get_the_content ( $post_id = null ) {
   global $language_theme_locale ;
   $post_id = ( null === $post_id ) ? get_the_ID () : $post_id ;

   if ( is_default_locale () ) {
     $post = get_post ( $post_id ) ;
     $post_content = $post -> post_content ;
   } else {
     // build the meta key and fetch post content from metadata
     $content_name = '_language_' . $language_theme_locale . '_content' ;
     $filtered_content_name = str_replace ( '_' , '' , $content_name ) ;
     $post_content = get_post_meta ( $post_id , "_$filtered_content_name" , true ) ;
   }

   return apply_filters ( 'the_content' , $post_content ) ;
 }

 function language_the_content ( $post_id = null ) {
   echo language_get_the_content ( $post_id ) ;
 }

 function language_get_the_title ( $post_id = null ) {
   global $language_theme_locale ;
   $post_id = ( null === $post_id ) ? get_the_ID () : $post_id ;

   if ( is_default_locale () ) {
     $post = get_post ( $post_id ) ;
     $post_title = $post -> post_title ;
   } else {
     // build the meta key and fetch post title from metadata
     $title_name = '_language_' . $language_theme_locale . '_title' ;
     $post_title = get_post_meta ( $post_id , $title_name , true ) ;
   }

   return apply_filters ( 'the_title' , $post_title ) ;
 }

 function language_the_title ( $post_id = null ) {
   echo language_get_the_title ( $post_id ) ;
 }

 function language_get_the_subtitle ( $post_id = null ) {
   global $language_theme_locale ;
   $post_id = ( null === $post_id ) ? get_the_ID () : $post_id ;

   // build the meta key and fetch post title from metadata
   $title_name = '_language_' . $language_theme_locale . '_subtitle' ;
   $post_title = get_post_meta ( $post_id , $title_name , true ) ;

   return $post_title ;
 }

 function language_the_subtitle ( $post_id = null ) {
   echo language_get_the_subtitle ( $post_id ) ;
 }

 function language_get_the_excerpt ( $post_id = null , $max_length = 25 , $more = '[...]' ) {
   $post_content = language_get_the_content ( $post_id ) ;
   $excerpt_length = apply_filters ( 'excerpt_length' , $max_length ) ;
   $excerpt_more = apply_filters ( 'excerpt_more' , $more ) ;
   $post_excerpt = wp_trim_words ( $post_content , $excerpt_length , $excerpt_more ) ;

   return $post_excerpt ;
 }

 function language_the_excerpt ( $post_id = null , $max_length = 25 , $more = '[...]' ) {
   echo language_get_the_excerpt ( $post_id , $max_length , $more ) ;
 }

 function language_the_time () {
   echo language_get_the_time () ;
 }

 function language_get_the_time () {
   $month_default = array (
       'Enero' , 'Febrero' , 'Marzo' , 'Abril' , 'Mayo' , 'Junio' , 'Julio' ,
       'Agosto' , 'Septiembre' , 'Octubre' , 'Noviembre' , 'Diciembre'
           ) ;
   $month = intval ( get_the_time ( 'n' ) ) - 1 ;
   $month_string = $month_default[ $month ] ;

   $year = get_the_time ( 'Y' ) ;
   $day = get_the_time ( 'j' ) ;
   $ordinal = get_the_time ( 'S' ) ;

   $current_language = get_language () ;
   $date = '' ;

   switch ( $current_language ) {
     case 'en':
       $date .= __ ( $month_string , 't99' ) . ' the&nbsp;' . $day . $ordinal . ',&nbsp;' . $year ;
       break ;
     case 'zh':
       $date .= $year . '/' . ($month + 1) . '/' . get_the_time ( 'd' ) ;
       break ;
     default:
       $date .= $day . ' de ' . $month_string . ' del&nbsp;' . $year ;
       break ;
   }

   echo $date ;
 }

 add_action ( 'admin_enqueue_scripts' , 'load_custom_wp_admin_style' ) ;

 function load_custom_wp_admin_style () {
   wp_enqueue_style ( 'language-admin-styles' , theme_url ( '/styles/admin-language.css' ) , array ( ) , '1.0' , 'all' ) ;
 }

?>