<?php
/**
 * Core functions of the BuddyPress Secure Passwords plugin
 * 
 * @package BuddyPress Secure Passwords
 * @version 1.0
 * @author Azalea Mollis
*/

/*
 * Puts hidden password strength checker field onto the BP Registration Page
 */
function amet_bp_pwcheck_hidden_field() {
	?>
		<!-- Password Strength Check hidden field  -->
		<input type="hidden" id="amet_pw_check" name="amet_pw_check" value="" />
		
		<!-- Check if JavaScript is disabled -->
		<noscript>
			<input type="hidden" id="amet_js_check" name="amet_js_check" value="js-off" />
		</noscript>
	<?php 
}
add_action( 'bp_account_details_fields', 'amet_bp_pwcheck_hidden_field', 10 );

/*
 * Filters weak or ineligible passwords and passes back an error message on Registration Page
 */ 
function amet_registration_pw_filter() {
	
	global $bp;

	if( isset( $_POST['amet_pw_check'] ) ) {
		$amet_pw_check = true;
		
		if( $_POST['amet_pw_check'] == 'bad' || $_POST['amet_pw_check'] == 'short' ) {
			$amet_pw_check = false;
		}
	} 
	
	if( isset( $_POST['amet_js_check'] ) ) {
		
		$_POST['amet_pw_check'] = 'js-disabled';
		
	}
	
	if( isset( $_POST['amet_pw_check'] ) && $amet_pw_check == false ) {
		
		$bp->signup->errors['signup_password'] = __( 'Your password needs to be at least medium strength. Please choose a stronger one.', 'bpstrongpass' );
	
	} elseif( $_POST['amet_pw_check'] == 'js-disabled' ) {
		
		$bp->signup->errors['signup_password'] = __( 'Please enable JavaScript in your browser to complete the registration.', 'bpstrongpass' );
	
	}
	
}
add_filter( 'bp_signup_validate', 'amet_registration_pw_filter' );

/*
 * Passes password strength value before bp_actions is loaded.
 */
function amet_bp_pass_pw_strength() {
	
	if( isset( $_POST['amet_pw_check'] ) ) {
		
		$amet_pw_check = true;
	
		if( $_POST['amet_pw_check'] == 'bad' || $_POST['amet_pw_check'] == 'short' ) {
			$amet_pw_check = false;
		}
		
		return $amet_pw_check;
	}
	
}
add_action( 'bp_ready', 'amet_bp_pass_pw_strength' );
