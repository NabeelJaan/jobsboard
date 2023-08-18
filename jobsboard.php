<?php
/*
    Plugin Name:  Jobs Board
    Plugin URI:   
    Description:  Jobs Board a simple WordPress plugin for posting jobs.
    Version:      1.0.0.0
    Author:       Muhammad Nabeel
    Author URI:   
    License:      MIT
    License URI:  
    Text Domain:  
    Domain Path:  /languages
*/

function jb_custom_post_type() {
	register_post_type('jobs_board',
		array(
			'labels'      => array(
				'name'          => __( 'Jobs Board', 'textdomain' ),
				'singular_name' => __( 'job', 'textdomain' ),
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array( 'slug' => 'Jobs Board' ),
		)
	);
}

add_action('init', 'jb_custom_post_type');


/**
 * Activate the plugin.
 */

 function pluginprefix_activate() {
	jb_custom_post_type();
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'pluginprefix_activate' );