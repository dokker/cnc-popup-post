<?php
/*
Plugin Name: CNC Popup Post
Plugin URI: https://github.com/dokker/cnc-popup-post
Description: Wordpress plugin for show post contents in popup
Version: 1.0
Author: docker
Author URI: https://hu.linkedin.com/in/docker
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoload
 */
$vendorAutoload = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
if (is_file($vendorAutoload)) {
	require_once($vendorAutoload);
}

function __cnc_popup_post_load_plugin()
{
	// load translations
	load_plugin_textdomain( 'cnc-popup-post', false, 'cnc-popup-post/languages' );

	$events = new cncPP\ContentType('popup', 
		['menu_icon' => 'dashicons-calendar-alt', 'has_archive' => false, 'supports' => ['title', 'editor', 'thumbnail']], 
		['singular_name' => __('Popup', 'cnc-popup-post'), 'plural_name' => __('Popups', 'cnc-popup-post')],
		_x('popups', 'popups archive slug', 'cnc-popup-post'));

	// instantiate classes to register hooks
	$controller = new cncPP\Controller();
}

add_action('plugins_loaded', '__cnc_popup_post_load_plugin');
