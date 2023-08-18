<?php



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


include_once("activation.php");

?>