<?php

// Custom Sites Template
function jobsboard_single_template($template) {
    if (is_singular('sites')) {
        return plugin_dir_path(__FILE__) . '../templates/single-jobsboard.php';
    }
    return $template;
}
add_filter('single_template', 'jobsboard_single_template');

/*
    =====================
      Style sheet
    =====================
*/

wp_enqueue_style('jobsboard_style', get_template_directory_uri(). 'css/style.css', array(), '1.0.0', 'all' );

/*
    =====================
      Add Custom columns
    =====================
*/

do_action( "manage_{$post->jobs_board}_posts_custom_column", $column_name, $post->ID );