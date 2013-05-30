<?php require_header();
		$current_fp = get_query_var('fpage');
		if (!$current_fp) {
        	get_template_part( 'single', 'artists-index' );
	    } else if ($current_fp == 'cv') {
	        get_template_part( 'single', 'artists-cv' );
	    } else if ($current_fp == 'works') {
	        get_template_part( 'single', 'artists-works' );
	    } else if ($current_fp == 'press') {
	        get_template_part( 'single', 'artists-press' );
	    }; 
require_footer(); ?>