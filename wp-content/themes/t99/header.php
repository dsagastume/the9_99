<!DOCTYPE html>
<html <?php language_attributes (); ?>>
    <head>
        <meta charset="<?php bloginfo ( 'charset' ); ?>" /> <!-- configura el conjunto de caracteres -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php site_title(); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo ( 'pingback_url' ); ?>" />
        <link rel="icon" type="image/ico" href="<?php echo theme_url ( 'img/favicon.ico' ); ?>">        
        <?php wp_head (); ?>

        <?php
            if ( is_home() ) {
                ?>
                <link rel='stylesheet' id='vegas-style-css'  href='http://localhost/the9_99/wp-content/themes/t99/css/vendor/jquery.vegas.css?ver=3.5.1' type='text/css' media='all' /> 
                <script type='text/javascript' src='http://localhost/the9_99/wp-content/themes/t99/js/vendor/jquery.vegas.js?ver=3.5.1'></script>
                <?php 
            } 
        ?>
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
        <?php
            if ( is_home() ) {
                getSlideScript(); 
            } 
        ?>
    </head>
    <body <?php body_class (); ?> data-language="<?php bloginfo ( 'language' ); ?>">
        <div id="header">            
            <a id="logo" href="http://dsagastume.info/the9_99/"><span>the 9.99</span></a>        
            <a id="nav_toggle"><span>menu</span></a>            
            <nav>
                <ul>
                    <li><a href="<?php echo get_post_type_archive_link( 'artists' ); ?>">artists</a></li>
                    <li><a>exhibitions</a></li>
                    <li><a>publications</a></li>
                    <li><a>outdoors</a></li>
                    <li><a>gallery</a></li>
                    <li><a>contact</a></li>
                </ul>
            </nav>
        </div>
        <div id="main-content">