<?php
/*
Plugin Name: BuddyPress Secure Passwords
Description: This plugin forces new members of a BuddyPress site to choose at least a medium-strength password when they register. If the chosen password is weaker than that they receive an error message. There's no settings page for this plugin, it works out of the box. If you want to use it just activate it, if you want to stop it then deactivate it. This plugins ONLY works together with BuddyPress.
Version: 1.0
Package: BuddyPress Secure Passwords
Requires at least: WP 4.1.1, BP 2.2.1
Author: Azalea Mollis
Author URI: http://twitter.com/azaleamollis
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) )
	exit;
/*
 * Adds admin notice if BP is not installed
 */
function amet_bp_check() {
	
	if( !class_exists( 'BuddyPress' ) )  {
		
		add_action( 'admin_notices', 'amet_bp_install_notice' );
		
	}
	
}
add_action( 'plugins_loaded', 'amet_bp_check', 999 );

/*
 * The content of the admin notice
 */
function amet_bp_install_notice() {
	
	echo '<div id="message" class="error fade"><p>';
	_e('The <strong>BuddyPress Secure Passwords</strong> plugin requires the BuddyPress plugin to work. Please install BuddyPress first, or deactivate the BuddyPress Secure Passwords plugin.');
	echo '</p></div>';
	
}

/*
 * Loads the password strength checker
 */
function amet_load_js() {
	
	wp_enqueue_script( 'pw-strength-checker', plugins_url( 'js/pw-strength-checker.min.js', __FILE__ ), array( 'password-strength-meter' ), null, true );
	
}
add_action( 'wp_enqueue_scripts', 'amet_load_js', 50 );

/*
 * Inits the plugin
 */
function amet_init() {
	
	require( dirname( __FILE__ ) . '/inc/buddypress-secure-passwords.php' );
	
}
add_action( 'bp_include', 'amet_init' );