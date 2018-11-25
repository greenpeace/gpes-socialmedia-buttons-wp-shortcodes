<?php
/**
 * @package simple_socialmedia_buttons
 * @version 0.2
 */
/*
Plugin Name: Simple socialmedia buttons
Plugin URI: https://github.com/greenpeace/gpes-socialmedia-buttons-wp-shortcodes
Description: Add a social media buttons shortcode <code>[simple_socialmedia_buttons url='https://es.greenpeace.org/es/' tweet='This is my tweet' msg='This is my Whatsapp message' event_category='MyAnalyticsEventCategory' ]</code>
Author: Osvaldo Gago
Text Domain: simple-socialmedia-buttons
Domain Path: /languages
Version: 0.2
Author URI: https://osvaldo.pt
*/

defined( 'ABSPATH' ) or die( 'You can\'t do that !' );

/**
 * Initiate plugin's translations
 */
function simple_socialmedia_buttons_load_plugin_textdomain() {
    load_plugin_textdomain( 'simple-socialmedia-buttons', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'simple_socialmedia_buttons_load_plugin_textdomain' );


/**
 * Timber plugin detection
 */
function simple_socialmedia_buttons_plugin_detection() {
	if ( !class_exists('Timber') ) {
		add_action( 'admin_notices', 'simple_socialmedia_buttons_notices' );
	}
}

/**
 * Timber plugin notice
 */
function simple_socialmedia_buttons_notices() {
	if ( current_user_can( 'activate_plugins' ) ) {
		?>
		<div class="error message">
			<p>Timber not found. You must enable this plugin!</p>
		</div>
		<?php
	}
}

add_action( 'init', 'simple_socialmedia_buttons_plugin_detection' );

/**
 * Generates the shortcode
 */
function shortcode_simple_socialmedia_buttons($atts = [], $content = null, $tag = '') {

    // Assets loading

    wp_enqueue_script('shortcode_simple_socialmedia_buttons', plugin_dir_url(__FILE__) . 'js/shortcode-simple-socialmedia-buttons.js', array(), '0.2');

    wp_enqueue_style('shortcode_timber', plugin_dir_url(__FILE__) . 'css/shortcode-simple-socialmedia-buttons.css', array(), '0.2' );

    // Shortcode attributes and content loading

    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    $attributes = shortcode_atts([
        'url' => __(' Please add an URL ', 'simple-socialmedia-buttons'),
        'tweet' => __(' Please add a tweet to the shortcode ', 'simple-socialmedia-buttons'),
        'msg' => __(' Please add a Whatsapp message to the shortcode ', 'simple-socialmedia-buttons'),
        'event_category' => __('Default', 'simple-socialmedia-buttons')
    ], $atts, $tag);

    $attributes['content'] = $content;

    // Render output

    if ( class_exists('Timber') ) {

        // Output with timber

        $output = Timber::compile( 'views/simple-socialmedia-buttons.twig', $attributes );

        return $output;

    } else {

        // Fallback output without timber

        $output = '';
        $output = '<div class="social-links">';
        $output .= '<p>' .  __('Share in social media:', 'simple-socialmedia-buttons') .'</p>';
        $output .= '<p>';
        $output .= '<a class="fb-link" data-url="'. esc_url($attributes['url']) .'?utm_campaign=' . esc_attr($attributes['event_category']) . '&utm_source=facebook&utm_medium=social_network_link" data-clickeventcategory="' . esc_attr($attributes['event_category']) . '" data-clickeventlabel="Facebook">Facebook</a> &nbsp; ';
        $output .= '<a class="tw-link" data-tweet="' . esc_attr($attributes['tweet']) . ' ' . esc_url($attributes['url']) . '?utm_campaign=' . esc_attr($attributes['event_category']) .'&utm_source=twitter&utm_medium=social_network_link" data-clickeventcategory="' . esc_attr($attributes['event_category']) . '" data-clickeventlabel="Twitter">Twitter</a> &nbsp;';
        $output .= '<a class="wa-link" data-msg="' . esc_attr($attributes['msg']) . ' ' . esc_url($attributes['url']) . '?utm_campaign=' . esc_attr($attributes['event_category']) . '&utm_source=whatsapp&utm_medium=social_network_link" data-clickeventcategory="' . esc_attr($attributes['event_category']) . '" data-clickeventlabel="Whatsapp">Whatsapp</a>';
        $output .= '</p>';
        $output .= '</div>';

        return $output;

    }

}

add_shortcode('simple_socialmedia_buttons', 'shortcode_simple_socialmedia_buttons');

?>
