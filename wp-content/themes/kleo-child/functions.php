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
        wp_get_theme() -> get( 'Version' )
    );

}

// Creates member industry types for BuddyPress
function birdy_register_member_types() {

	include_once('inc/industries.php'); // array of industry types; slug => string

	foreach ( $industries as $industry => $str_name ) {
		bp_register_member_type( $industry, array(
			'labels' => array('name' => $str_name ),
			'has_directory' => true
			));
	}

}
// register memeber types in buddyPress
add_action( 'bp_register_member_types', 'birdy_register_member_types' );

// enqueues styles in last position
add_action( 'wp_enqueue_scripts', 'birdy_enqueue_styles', '99' );

?>
