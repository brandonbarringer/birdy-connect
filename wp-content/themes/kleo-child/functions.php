<?php
/**
 * @package WordPress
 * @subpackage Kleo
 * @author Brandon Barringer
 * @since birdyConnect 1.0
 */


// Pulls in the parent styles and our styles to override where needed
function birdy_enqueue_styles() {

    $parent_style = 'parent-style'; 

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/assets/styles/application.min.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'birdy_enqueue_styles', '99' );

?>
