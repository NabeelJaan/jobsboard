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

	register_post_type('job_application',[
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

	// Register Taxomonies
	register_taxonomy('job_categories', ['jobs_board'], [
		'label'         		=> __( 'Job Categories', 'Nabeel' ),
		'public'        		=> true,
		'hierarchical'  		=> true,
		'show_ui'       		=> true,
		'query_var'     		=> true,
		'show_in_rest'			=> true,
		'show_admin_column'     => true,
		'show_in_quick_edit'    => true,	
		'rewrite'				=> [ 'slug' => 'job Categories' ],
	]);

	register_taxonomy('job_types', ['jobs_board'], [
		'label'         		=> __( 'Job Types', 'Nabeel' ),
		'public'        		=> true,
		'hierarchical'  		=> true,
		'show_ui'       		=> true,
		'query_var'     		=> true,
		'show_in_rest'			=> true,
		'show_admin_column'     => true,
		'show_in_quick_edit'    => true,
		'rewrite'				=> [ 'slug' => 'job types' ],
	]);

	register_taxonomy('job_location', ['jobs_board'], [
		'label'         		=> __( 'Job Location', 'Nabeel' ),
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

add_action('init', 'jb_custom_post_type');


function jobsboard_meta_boxe() {
    $screens = [ 'post', 'jobs_board' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'jobsboard_box_id',
            'Job data',
            'jobsboard_custom_box_html',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'jobsboard_meta_boxe' );

function jobsboard_custom_box_html( $post ) {
    $company_name = get_post_meta( $post->ID, '_jobsboard_company_name', true );
    $company_website = get_post_meta( $post->ID, '_jobsboard_company_website', true );
    $company_tagline = get_post_meta( $post->ID, '_jobsboard_company_tagline', true );
    $company_logo = get_post_meta( $post->ID, '_jobsboard_company_logo', true );
    ?>
		<label for="company_name">Company Name:</label>
		<input type="text" id="company_name" name="company_name" value="<?php echo esc_attr( $company_name ); ?>">

		<label for="company_website">Company Website:</label>
		<input type="url" id="company_website" name="company_website" value="<?php echo esc_attr( $company_website ); ?>">

		<label for="company_tagline">Company Tagline:</label>
		<input type="text" id="company_tagline" name="company_tagline" value="<?php echo esc_attr( $company_tagline ); ?>">

		<label for="company_logo">Company Logo:</label>
		<input type="text" id="company_logo" name="company_logo" value="<?php echo esc_attr( $company_logo ); ?>">
    <?php
}

function jobsboard_save_postdata( $post_id ) {
    if ( array_key_exists( '_jobsboard_company_name', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_jobsboard_company_name',
            sanitize_text_field( $_POST['company_name'] )
        );
    }
	if ( array_key_exists( 'company_website', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_jobsboard_company_website',
            sanitize_text_field( $_POST['company_website'] )
        );
    }
	if ( array_key_exists( 'company_tagline', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_jobsboard_company_tagline',
            sanitize_text_field( $_POST['company_tagline'] )
        );
    }
	if ( array_key_exists( 'company_logo', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_jobsboard_company_logo',
            sanitize_text_field( $_POST['company_logo'] )
        );
    }
}
add_action( 'save_post', 'jobsboard_save_postdata' );




/**
 * Activate the plugin.
 */

 function pluginprefix_activate() {
	jb_custom_post_type();
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'pluginprefix_activate' );