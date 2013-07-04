<!DOCTYPE html>
<html <?php language_attributes (); ?>>
<head>
<meta charset="<?php bloginfo ( 'charset' ); ?>" /> <!-- configura el conjunto de caracteres -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php site_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo ( 'pingback_url' ); ?>" />
<link rel="icon" type="image/ico" href="<?php echo theme_url ( 'img/favicon.ico' ); ?>">        
<script type="text/javascript">
var Server = Server || { } ;
// Misc Data
Server.debug = true ;
// Wordpress based URL's
Server.url = { } ;
Server.url.titulo = '<?php wp_title ( '|', true, 'right' ); ?>' ;
Server.url.site = '<?php echo site_url (); ?>' ;
Server.url.home = '<?php echo home_url (); ?>' ;
Server.url.theme = '<?php echo theme_url (); ?>' ;
Server.url.admin = '<?php echo admin_url (); ?>' ;
Server.url.ajax = '<?php echo admin_url ( 'admin-ajax.php' ); ?>' ;
</script>
<?php wp_head (); ?>        
<script type="text/javascript" src="<?php echo theme_url ('js/vendor/jquery.backstretch.min.js'); ?>"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
</head>
<body <?php body_class (); ?> data-language="<?php bloginfo ( 'language' ); ?>">
<div id="header">            
<a id="logo" href="<?php echo site_url (); ?>"><span>the 9.99</span></a>        

<ul class="lang-nav">
    <li><a class="display-block float-left language-link border-right" href="?lan=es"><?php _e ( 'esp' , 't99' ) ; ?></a></li>
    <li><a class="display-block float-left language-link border-right" href="?lan=en"><?php _e ( 'eng' , 't99' ) ; ?></a></li>
</ul>

<a id="nav_toggle"><span>menu</span></a>            
<nav>
<ul>
    <li><a href="<?php echo get_post_type_archive_link( 'artists' ); ?>"><?php _e ( 'artists' , 't99' ) ; ?></a></li>
    <li><a href="<?php echo get_post_type_archive_link( 'exhibitions' ); ?>"><?php _e ( 'exhibitions' , 't99' ) ; ?></a></li>
    <!-- <li><a >publications</a></li> -->
    <li><a href="<?php echo home_url( 'outdoors')?>"><?php _e ( 'outdoors' , 't99' ) ; ?></a></li>
    <li><a href="<?php echo home_url( 'gallery')?>"><?php _e ( 'gallery' , 't99' ) ; ?></a></li>
    <li><a href="<?php echo home_url( 'contact')?>"><?php _e ( 'contact' , 't99' ) ; ?></a></li>
</ul>
</nav>
</div>
<div id="main-content" style="min-height: 650px;">