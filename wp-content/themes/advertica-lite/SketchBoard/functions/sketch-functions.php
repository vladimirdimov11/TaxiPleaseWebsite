<?php
global $advertica_themename;
global $advertica_shortname;

/***************** EXCERPT LENGTH ************/
function advertica_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'advertica_excerpt_length');

/***************** READ MORE ****************/
function advertica_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'advertica_excerpt_more');

/************* CUSTOM PAGE TITLE ***********/
add_filter( 'wp_title', 'advertica_title' );
function advertica_title($title)
{
	$advertica_title = $title;
	if ( is_home() && !is_front_page() ) {
		$advertica_title .= get_bloginfo('name');
	}
	if ( is_front_page() ){
		$advertica_title .=  get_bloginfo('name');
		$advertica_title .= ' | '; 
		$advertica_title .= get_bloginfo('description');
	}
	if ( is_search() ) {
		$advertica_title .=  get_bloginfo('name');
	}
	if ( is_author() ) { 
		global $wp_query;
		$curauth = $wp_query->get_queried_object();	
		$advertica_title .= __('Author: ','advertica-lite');
		$advertica_title .= $curauth->display_name;
		$advertica_title .= ' | ';
		$advertica_title .= get_bloginfo('name');
	}
	if ( is_single() ) {
		$advertica_title .= get_bloginfo('name');
	}
	if ( is_page() && !is_front_page() ) {
		$advertica_title .= get_bloginfo('name');
	}
	if ( is_category() ) {
		$advertica_title .= get_bloginfo('name');
	}
	if ( is_year() ) { 
		$advertica_title .= get_bloginfo('name');
	}
	if ( is_month() ) {
		$advertica_title .= get_bloginfo('name');
	}
	if ( is_day() ) {
		$advertica_title .= get_bloginfo('name');
	}
	if (function_exists('is_tag')) { 
		if ( is_tag() ) {
			$advertica_title .= get_bloginfo('name');
		}
		if ( is_404() ) {
			$advertica_title .= get_bloginfo('name');
		}					
	}
	return $advertica_title;
}

/**
 * SETS UP THE CONTENT WIDTH VALUE BASED ON THE THEME'S DESIGN.
 */
if ( ! isset( $content_width ) ){
    $content_width = 900;
}
add_filter('body_class','advertica_lite_class_name');
function advertica_lite_class_name($classes) {
	$classes[] = 'advertica-lite';
	return $classes;
}

//BACKGROUND STYLE
function advertica_bg_style($option) {
	$background = sketch_get_option($option);
	$bg_style = NULL;
	if ($background) {
		if($background['image']){
			$bg_style = 'background:';				
			if ($background['color']) {			
				$bg_style .= $background['color'];
			}
			if ($background['image']) {
				$bg_style .= ' url('.$background['image'].')';
			}
			if ($background['repeat']) {
				$bg_style .= ' '.$background['repeat'];
			}
			if ($background['attachment']) {
				$bg_style .= ' '.$background['attachment'];
			}
			if ($background['position']) {
				$bg_style .= ' '.$background['position']. ';';
			}

		} else{
			if ($background['color']) {
				$bg_style .= 'background:'.$background['color'];
			}
		}
	}
return $bg_style;	
}