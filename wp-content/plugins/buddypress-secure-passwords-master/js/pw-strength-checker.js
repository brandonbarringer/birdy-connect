/** 
 * Verifies the strength of the password
 * 
 *  @package BuddyPress Secure Passwords
 *  @author Azalea Mollis
 *  @version 1.0
 */ 
( function( jQuery ){
	function check_password_strength() {
		var pass1 = jQuery( '.password-entry' ).val(),
		    pass2 = jQuery( '.password-entry-confirm' ).val(),
		    strength;

		if ( ! pass1 ) {
			jQuery( '#amet_pw_check' ).val( 'empty' );
			return;
		}

		strength = wp.passwordStrength.meter( pass1, wp.passwordStrength.userInputBlacklist(), pass2 );

		switch ( strength ) {
			case 2:
				jQuery( '#amet_pw_check' ).val( 'bad' );
				break;
			case 3:
				jQuery( '#amet_pw_check' ).val( 'good' );
				break;
			case 4:
				jQuery( '#amet_pw_check' ).val( 'strong' );
				break;
			case 5:
				jQuery( '#amet_pw_check' ).val( 'short' );
				break;
			default:
				jQuery( '#amet_pw_check' ).val( 'short' );
				break;
		}
	}

	// Bind check_password_strength to keyup events in the password fields
	jQuery( document ).ready( function() {
		jQuery( '.password-entry' ).val( '' ).keyup( check_password_strength );
		jQuery( '.password-entry-confirm' ).val( '' ).keyup( check_password_strength );
	});

} )( jQuery );
