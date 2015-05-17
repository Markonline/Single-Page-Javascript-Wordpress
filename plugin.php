<?php
/*
Plugin Name: Single Page Javascript Shortcodes
Version: 1.2
Plugin URI: /
Author: Markaay
Author URI: /
Description: Easily insert Single Page Javascript and necessary CDN scripts into your Wordpress pages and posts using shortcodes.
License: -
*/

$single_page_javascript_shortcodes = 1.0;

function load_script_piece_1() {
	$script_piece_encoded_value_1 = get_option( 'script_piece_1_code' );
	$script_piece_decoded_value_1 = html_entity_decode( $script_piece_encoded_value_1, ENT_COMPAT );

	if ( !empty( $script_piece_decoded_value_1 ) ) {
		$output .= " $script_piece_decoded_value_1";
	}
	return $output;
}
add_shortcode( 'script_piece_1', 'load_script_piece_1' );

function load_script_piece_2() {
	$script_piece_encoded_value_2 = get_option( 'script_piece_2_code' );
	$script_piece_decoded_value_2 = html_entity_decode( $script_piece_encoded_value_2, ENT_COMPAT );

	if ( !empty( $script_piece_decoded_value_2 ) ) {
		$output .= " $script_piece_decoded_value_2";
	}
	return $output;
}
add_shortcode( 'script_piece_2', 'load_script_piece_2' );


// Displays General Options menu
function single_page_javascript_options_page() {
	if ( function_exists( 'add_options_page' ) ) {
		add_options_page( 'Single page Javascript', 'Single page javascript', 'manage_options', __FILE__, 'single_page_javascript_insert' );
	}
}

function single_page_javascript_insert() {

	global $single_page_javascript_shortcodes;

	if ( isset( $_POST['info_update'] ) ) {
		echo '<div id="message" class="updated fade"><p><strong>';

		$tmpCode1 = htmlentities( stripslashes( $_POST['script_piece_1_code'] ) , ENT_COMPAT );
		update_option( 'script_piece_1_code', $tmpCode1 );

		$tmpCode1 = htmlentities( stripslashes( $_POST['script_piece_2_code'] ) , ENT_COMPAT );
		update_option( 'script_piece_2_code', $tmpCode1 );
				
		echo 'Changes saved';
		echo '</strong></p></div>';
	}

?>

	<div class="wrap">
		<h2><strong>Single page Javascript shortcodes</strong></h2>

		<p>Easily insert Single Page Javascript snippets and CDN scripts into your Wordpress pages and posts using shortcodes. Just copy the shortcodes onto your pages and posts and see your scripts in action.</p>
		<p>Don't forget to include the <code>script</code> tags! </p>
		
		
	    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
	    <input type="hidden" name="info_update" id="info_update" value="true" />

	    <fieldset class="options">
	    <table width="100%" border="0" cellspacing="0" cellpadding="6">

	    <tr valign="top"><td width="35%" align="left">
	    <strong>Javascript snippet 1:</strong>
	    <br>Copy and paste your javascript to the field on the right.
	    <br>To insert, use the shortcode: <code>[script_piece_1]</code>
	    </td><td align="left">
	    <textarea name="script_piece_1_code" rows="4" cols="50"><?php echo get_option( 'script_piece_1_code' ); ?></textarea>
	    </td></tr>

	    <tr valign="top"><td width="35%" align="left">
	    <strong>Javascript snippet 2:</strong>
	    <br>Copy and paste your javascript to the field on the right.
	    <br>To insert, use the shortcode: <code>[script_piece_2]</code>
	    </td><td align="left">
	    <textarea name="script_piece_2_code" rows="4" cols="50"><?php echo get_option( 'script_piece_2_code' ); ?></textarea>
	    </td></tr>

	    </table>
	    </fieldset>

	    <div class="submit">
	        <input type="submit" class="button-primary" name="info_update" value="Save changes" />
	    </div>

	    </form>
	</div>
<?php
}

// Adding the single_page_javascript_options_page in the Wordpress 'admin_menu'
add_action( 'admin_menu', 'single_page_javascript_options_page' );

add_filter('the_content', 'do_shortcode');
if (!is_admin())
{add_filter('widget_text', 'do_shortcode');}
add_filter('the_excerpt', 'do_shortcode');
