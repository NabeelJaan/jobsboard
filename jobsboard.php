<?php

/*
    Plugin Name:  Jobs Board
    Plugin URI:   
    Description:  Jobs Board a simple WordPress plugin for posting jobs.
    Version:      1.0.0
    Author:       Muhammad Nabeel
    Author URI:   
    License:      MIT
    License URI:  
    Text Domain:  
    Domain Path:  /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit;



function jb_custom_post_type() {

	register_post_type('jobs_board',[
			'labels'      => array(
				'name'          => __( 'Jobs Board', 'Nabeel' ),
				'singular_name' => __( 'job', 'Nabeel' ),
			),
			'public'      => true,
			'has_archive' => true,
			'menu_icon'	  => 'dashicons-businessperson',
			'supports'    => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
			'rewrite'     => array( 'slug' => 'Jobs Board' ),
		]
	);

	register_post_type('Job Application',[
			'labels'      => array(
				'name'          => __( 'Job Application', 'Nabeel' ),
				'singular_name' => __( 'application', 'Nabeel' ),
			),
			'public'      => true,
			'has_archive' => true,
			'show_in_menu' => 'edit.php?post_type=jobs_board',
			'menu_icon'	  => 'dashicons-businessperson',
			'supports'    => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
			'rewrite'     => array( 'slug' => 'Jobs Board' ),
		]
	);

}

add_action('init', 'jb_custom_post_type');


function wpdocs_create_book_tax_rewrite() {

	register_taxonomy('Job Categories', ['jobs_board'], [
		'label'         		=> __( 'job Categories', 'Nabeel' ),
		'public'        		=> true,
		'hierarchical'  		=> true,
		'show_ui'       		=> true,
		'query_var'     		=> true,
		'show_in_rest'			=> true,
		'show_admin_column'     => true,
		'show_in_quick_edit'    => true,
		'rewrite'				=> [ 'slug' => 'job Categories' ],
	]);

	register_taxonomy('Job Types', ['jobs_board'], [
		'label'         		=> __( 'job Types', 'Nabeel' ),
		'public'        		=> true,
		'hierarchical'  		=> true,
		'show_ui'       		=> true,
		'query_var'     		=> true,
		'show_in_rest'			=> true,
		'show_admin_column'     => true,
		'show_in_quick_edit'    => true,
		'rewrite'				=> [ 'slug' => 'job types' ],
	]);

	register_taxonomy('Job Location', ['jobs_board'], [
		'label'         		=> __( 'job Location', 'Nabeel' ),
		'public'        		=> true,
		'hierarchical'  		=> true,
		'show_ui'       		=> true,
		'query_var'     		=> true,
		'show_in_rest'			=> true,
		'show_admin_column'     => true,
		'show_in_quick_edit'    => true,
		'rewrite'				=> [ 'slug' => 'job Location' ],
	]);

}

add_action( 'init', 'wpdocs_create_book_tax_rewrite', 0 );


/**
 * Activate the plugin.
 */

 function pluginprefix_activate() {
	jb_custom_post_type();
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'pluginprefix_activate' );