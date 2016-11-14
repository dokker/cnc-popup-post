<?php
namespace cncPP;

class Controller {
	public function __construct() {
		add_action('wp_ajax_get_post_content', [$this, 'ajax_get_post_content']);
		add_action('wp_ajax_nopriv_get_post_content', [$this, 'ajax_get_post_content']);
	}

	/**
	 * Ajax callback for serve post content by id
	 */
	public function ajax_get_post_content()
	{
		check_ajax_referer('cncpp_nonce');
		(int) $id = $_REQUEST['id'];
		$post_content = '';
		wp_send_json($post_content);
		wp_die();
	}
}