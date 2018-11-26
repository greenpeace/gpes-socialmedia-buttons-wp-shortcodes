<?php
/**
 * @package simple_socialmedia_buttons
 * @version 0.3
 */
/*
Plugin Name: Simple socialmedia buttons UI
Plugin URI: https://github.com/greenpeace/gpes-socialmedia-buttons-wp-shortcodes
Description: GUI for the [simple_socialmedia_buttons] shortcode.
Author: Osvaldo Gago
Text Domain: simple-socialmedia-buttons-ui
Domain Path: /languages
Version: 0.3
Author URI: https://osvaldo.pt
*/

defined( 'ABSPATH' ) or die( 'You can\'t do that !' );

/**
 * Initiate plugin's translations
 */
function simple_socialmedia_buttons_ui_load_plugin_textdomain() {
    load_plugin_textdomain( 'simple-socialmedia-buttons-ui', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'simple_socialmedia_buttons_ui_load_plugin_textdomain' );

/**
 * Shortcake UI detection
 */
function shortcode_ui_simple_socialmedia_buttons_detection() {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		add_action( 'admin_notices', 'shortcode_ui_simple_socialmedia_buttons_notices' );
	}
}

function shortcode_ui_simple_socialmedia_buttons_notices() {
	if ( current_user_can( 'activate_plugins' ) ) {
		?>
		<div class="error message">
			<p><?php __('Shortcode UI plugin must be active for Shortcode Simple socialmedia buttons UI plugin to function.', 'simple-socialmedia-buttons-ui') ?></p>
		</div>
		<?php
	}
}

add_action( 'init', 'shortcode_ui_simple_socialmedia_buttons_detection' );

/**
 * UI for the shortcode simple_socialmedia_buttons
 */
function shortcode_ui_simple_socialmedia_buttons() {
    
    $simple_socialmedia_buttons_fields = array(
        array(
			'label'  => __('URL to share', 'simple-socialmedia-buttons-ui'),
            'description'  => __('URL to share, without utm parameters. Without other parameters as well.', 'simple-socialmedia-buttons-ui'),
			'attr'   => 'url',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => 'https://',
				'data-test'   => 1,
			),
		),
        array(
			'label'  => __('Event category', 'simple-socialmedia-buttons-ui'),
			'description'  => __('A word to use in Google Analytics. It will be used in the utm_campaign field and in Analytics events.', 'simple-socialmedia-buttons-ui'),
			'attr'   => 'event_category',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => '',
				'data-test'   => 1,
			),
		),
        array(
			'label'  => __('Tweet', 'add-to-cal-ui'),
			'description'  => __('The message to tweet, without hashtags.', 'simple-socialmedia-buttons-ui'),
			'attr'   => 'tweet',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => '',
				'data-test'   => 1,
			),
		),
        array(
			'label'  => __('Whatsapp message', 'add-to-cal-ui'),
			'description'  => __('The message to send in whatsapp, without hashtags.', 'simple-socialmedia-buttons-ui'),
			'attr'   => 'msg',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => '',
				'data-test'   => 1,
			),
		)
    );
    
    $simple_socialmedia_buttons_args = array(
		'label' => __('Simple socialmedia buttons', 'simple-socialmedia-buttons-ui'),
		'listItemImage' => 'dashicons-share',
		'attrs' => $simple_socialmedia_buttons_fields,
	);
        
    shortcode_ui_register_for_shortcode( 'simple_socialmedia_buttons', $simple_socialmedia_buttons_args );
}

add_action( 'register_shortcode_ui', 'shortcode_ui_simple_socialmedia_buttons' );

?>
