<?php
/*
 * Template Name: Single Job Post
 * Template Post Type: post
*/

global $post;

?>

<div class="single_post">

<?php

    if ( have_posts() ) :
        while ( have_posts() ) : the_post();


            
            echo '<h1>' . get_the_title() . '</h1>';
            
            the_content();



        endwhile;
    endif;

?>

<div>