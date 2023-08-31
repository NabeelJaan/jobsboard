<?php

// Custom Sites Template
function jobsboard_single_template($template) {
    if (is_singular('sites')) {
        return plugin_dir_path(__FILE__) . '../templates/single-jobsboard.php';
    }
    return $template;
}
add_filter('single_template', 'jobsboard_single_template');