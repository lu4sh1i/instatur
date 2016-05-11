<?php
/**
* Enqueues child theme stylesheet, loading first the parent theme stylesheet.
*/
function themify_custom_enqueue_child_theme_styles() {
wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'themify_custom_enqueue_child_theme_styles' );

add_action('after_setup_theme', 'wp_kill_parent_post');

function wp_kill_parent_post() {
    remove_action('init', 'post_type_services');
    remove_action('init', 'post_type_clients');
    remove_action('init', 'post_type_team');
    remove_action('init', 'post_type_pricing');
    remove_action('init', 'post_type_testimonials');

}
