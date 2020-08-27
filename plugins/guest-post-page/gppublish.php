<?php
/*
Plugin Name: Guest Post publish
Description: Guest Post publish.
Version: 1.1
Author: Venkatesh
Text Domain: guest-post-page
*/


/**
 * Starts output buffer so that auth_redirect() 
 */

// Hooking up our function to theme setup

function gpp_start_buffers()
{
	ob_start();
   
}

add_action('init', 'gpp_start_buffers');

/**
 * Initializes plugin options on first run
 */
function gpp_initialize_options()
{
	$activation_flag = get_option('gpp_misc');

	if ($activation_flag)
		return;
	$gpp_restrictions = array(
		'min_words_title'    => 2,	
		'min_words_content'  => 2,	
		'min_excert'           => 1,	
		'thumbnail_required' => true
	);
	$gpp_misc = array(		
		'posts_per_page'      => 10
	);

	update_option('gpp_post_restrictions', $gpp_restrictions);
	update_option('gpp_misc', $gpp_misc);
}

register_activation_hook(__FILE__, 'gpp_initialize_options');

function gpp_messages()
{
	$gpp_messages = array(
		'unsaved_changes_warning'      => __('You have unsaved changes. Proceed anyway?', 'guest-post-page'),
		'confirmation_message'         => __('Are you sure?', 'guest-post-page'),
		'media_lib_string'             => __('Choose Image', 'guest-post-page'),
		'required_field_error'         => __('You missed one or more required fields', 'guest-post-page'),
		'general_form_error'           => __('Your submission has errors. Please try again!', 'guest-post-page'),
		'title_short_error'            => __('The title is too short', 'guest-post-page'),	
		'article_short_error'          => __('The article is too short', 'guest-post-page'),
		'featured_image_error'         => __('You need to choose a featured image', 'guest-post-page')
	);

	return $gpp_messages;
}

/**
 * Removes plugin data before uninstalling
 */
function gpp_rollback()
{
	wp_deregister_style('gpp-style');
	wp_deregister_script('gpp-script');
	delete_option('gpp_post_restrictions');
	delete_option('gpp_misc');
	delete_option('gpp_messages');

}

register_uninstall_hook(__FILE__, 'gpp_rollback');

/**
 * Enqueue scripts and stylesheets
 */
function gpp_register_resources()
{
	wp_register_style('gpp-style', plugins_url('assets/css/style.css', __FILE__), array(), '1.0', 'all');
	wp_register_script("gpp-script", plugins_url('assets/js/scripts.js', __FILE__), array('jquery'));
	wp_localize_script('gpp-script', 'gppajaxhandler', array('ajaxurl' => admin_url('admin-ajax.php')));
	$gpp_rules = get_option('gpp_post_restrictions');	

	wp_localize_script('gpp-script', 'gpp_messages', gpp_messages());
}

add_action('init', 'gpp_register_resources');


/**
 * scan shortcode.
 *
 * @param string $content post content to scan
 * @param string $tag shortcode text
 * @return bool: whether or not the shortcode exists in $content
 */
if (!function_exists('has_shortcode')) {
	function has_shortcode($content, $tag)
	{
		if (stripos($content, '[' . $tag . ']') !== false)
			return true;
		return false;
	}
}

/* Includes */
include('modules/ajax.php');

include('modules/shortcodes.php');

include('modules/panel.php');


