<?PHP
/*
Plugin Name: Secret Passage
Plugin URI: http://JoeAnzalone.com
Description: Adds a secret key combination to whisk you away to the admin screen.
Author: Joe Anzalone
Version: 1.0
Author URI: http://JoeAnzalone.com
License: GPL2
*/

/*  Copyright 2011 ~ Joe Anzalone <Joe@Shmit.com>

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$secret_passage_dir = basename(dirname(__FILE__));
$secret_passage_hotkey = get_option('secret_passage_hotkey', 'Ctrl+Shift+A');

function secret_passage(){
wp_enqueue_script('jquery');

global $secret_passage_dir;

wp_deregister_script('jquery-hotkeys');
wp_register_script('jquery-hotkeys', plugins_url() . '/' . $secret_passage_dir .'/jquery.hotkeys.js', array('jquery'));
wp_enqueue_script('jquery-hotkeys');


wp_register_script('secret-passage', plugins_url() . '/' . $secret_passage_dir . '/secret-passage.js', array('jquery-hotkeys'));
wp_enqueue_script('secret-passage');

global $secret_passage_hotkey;
wp_localize_script( 'secret-passage', 'settings', array(
	  	'hotkey' => $secret_passage_hotkey,
		'admin_url' => get_admin_url(),
		));

}

add_action('wp_print_scripts', 'secret_passage');


/* Options Page */
function secret_passage_menu() {
	//add_options_page('Secret Passage Options', 'Secret Passage', 'manage_options', 'secret_passage', 'secret_passage_options');
	add_submenu_page('options-general.php', 'Secret Passage Settings', 'Secret Passage', 'manage_options', 'secret_passage', 'secret_passage_options');
}
add_action('admin_menu', 'secret_passage_menu');

function secret_passage_options() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	require_once('settings.php');
}

function section_callback(){
//echo 'section_callback()';
}

function field_callback($blah){
global $secret_passage_hotkey;

echo "<input id='hotkey' name='secret_passage_hotkey' size='40' type='text' value='{$secret_passage_hotkey}' />";
//var_dump($options);
}

function secret_passage_settings(){
register_setting('secret_passage', 'secret_passage_hotkey');
add_settings_section( 'secret_passage', '', 'section_callback', 'secret_passage' );
add_settings_field( 'settings_field_id', 'Secret Key Combination', 'field_callback', 'secret_passage', 'secret_passage');

}
add_action('admin_init', 'secret_passage_settings');


/* END Options Page */


?>
