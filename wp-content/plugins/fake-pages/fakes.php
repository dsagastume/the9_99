<?php
/*
Plugin Name: the9.99 Fake Pages
Plugin URI: http://www.dsagastume.info
Description: Creates fake sub pages for artist custom post type
Version: 1.0
Author: Paulo Chang
Author URI: http://dsagastume.info
/* ----------------------------------------------*/
 
    // Fake pages' permalinks and titles. Change these to your required sub pages.
    $my_fake_pages = array(
        'cv' => 'cv',
        'works' => 'works',
        'press' => 'press'
    );
      
    add_filter('rewrite_rules_array', 'fsp_insertrules');
    add_filter('query_vars', 'fsp_insertqv');
      
    // Adding fake pages' rewrite rules
    function fsp_insertrules($rules)
    {
        global $my_fake_pages;
      
        $newrules = array();
        foreach ($my_fake_pages as $slug => $title)
            $newrules['artists/([^/]+)/' . $slug . '/?$'] = 'index.php?artists=$matches[1]&fpage=' . $slug;
      
        return $newrules + $rules;
    }
      
    // Tell WordPress to accept our custom query variable
    function fsp_insertqv($vars)
    {
        array_push($vars, 'fpage');
        return $vars;
    }
 
    // Remove WordPress's default canonical handling function
     
    remove_filter('wp_head', 'rel_canonical');
    add_filter('wp_head', 'fsp_rel_canonical');
    function fsp_rel_canonical()
    {
        global $current_fp, $wp_the_query;
      
        if (!is_singular())
            return;
      
        if (!$id = $wp_the_query->get_queried_object_id())
            return;
      
        $link = trailingslashit(get_permalink($id));
      
        // Make sure fake pages' permalinks are canonical
        if (!empty($current_fp))
            $link .= user_trailingslashit($current_fp);
      
        echo '<link rel="canonical" href="'.$link.'" />';
    }
 
    // Fake pages' permalinks and titles. Change these to your required sub pages.
    $my_fake_pages = array(
        'press' => 'press',
        'works' => 'works',
        'views' => 'views'
    );
      
    add_filter('rewrite_rules_array', 'exh_insertrules');
    add_filter('query_vars', 'exh_insertqv');
      
    // Adding fake pages' rewrite rules
    function exh_insertrules($rules)
    {
        global $my_fake_pages;
      
        $newrules = array();
        foreach ($my_fake_pages as $slug => $title)
            $newrules['exhibitions/([^/]+)/' . $slug . '/?$'] = 'index.php?exhibitions=$matches[1]&fpage=' . $slug;
      
        return $newrules + $rules;
    }
      
    // Tell WordPress to accept our custom query variable
    function exh_insertqv($vars)
    {
        array_push($vars, 'fpage');
        return $vars;
    }
 
    // Remove WordPress's default canonical handling function
     
    remove_filter('wp_head', 'rel_canonical');
    add_filter('wp_head', 'exh_rel_canonical');
    function exh_rel_canonical()
    {
        global $current_fp, $wp_the_query;
      
        if (!is_singular())
            return;
      
        if (!$id = $wp_the_query->get_queried_object_id())
            return;
      
        $link = trailingslashit(get_permalink($id));
      
        // Make sure fake pages' permalinks are canonical
        if (!empty($current_fp))
            $link .= user_trailingslashit($current_fp);
      
        echo '<link rel="canonical" href="'.$link.'" />';
    }

?>