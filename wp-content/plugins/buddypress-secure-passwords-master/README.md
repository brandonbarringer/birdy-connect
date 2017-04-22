=== BuddyPress Secure Passwords ===
Contributors: azaleamollis
Donate link: http://arsmetrica.co.uk/
Tags: buddypress, registration, password, security, antispam
Requires at least: 4.1.1
Tested up to: 4.1.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The BuddyPress Secure Passwords plugin forces new members of a BuddyPress site to choose at least a medium-strength password when they register. 

== Description ==

The BuddyPress Secure Passwords plugin ONLY works on websites where the BuddyPress plugin is installed.

The plugin uses BuddyPress' built-in password strength checker. By default BuddyPress only displays the strength of the chosen password but it doesn't force users to use a strong one.

The BuddyPress Secure Passwords plugin solves this problem as it forces users to choose at least a medium-strength password on registration.

If the chosen password is weaker than medium-strength the users receive an error message on the registration page which asks them to choose at least a medium-strength password. 

As the password checker works with JavaScript, users also get an error message when JavaScript is disabled in their browser. This time they are asked to switch back the JS in their browsers in order to register.

When the BuddyPress Secure Passwords plugin is installed users can only register if their chosen password is validated as "Medium" or "Strong".

This plugin also helps significantly reduce registration spam on BuddyPress sites, as bots and spammers are usually not smart enough to find a medium-strength password.

There's no settings page for this plugin, it works out of the box. If you want to use it just activate it, if you want to stop it then deactivate it.

== Installation ==

1. Upload the `buddypress-secure-passwords` folder to the `/wp-content/plugins/` directory.
2. Check if BuddyPress is installed. If not, install BuddyPress before this plugin.
3. Activate the plugin through the 'Plugins' menu in the WordPress admin area.

== Changelog ==

= 1.0 =
* Initial version

== Screenshots ==

1. /assets/screenshots/weak-password.jpg
2. /assets/screenshots/no-js.jpg