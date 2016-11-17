<?php
namespace cncPP;

class Controller {
	public function __construct() {
		$this->plugin_path = plugin_dir_path(dirname(__FILE__));
		$this->plugin_url = plugin_dir_url(dirname(__FILE__));

		$this->model = new \cncPP\Model();
		$this->view = new \cncPP\View();

		add_action('wp_ajax_get_post_content', [$this, 'ajax_get_post_content']);
		add_action('wp_ajax_nopriv_get_post_content', [$this, 'ajax_get_post_content']);
		add_action('wp_enqueue_scripts', [$this, 'registerScripts']);
	}

	/**
	 * Ajax callback for serve post content by id
	 */
	public function ajax_get_post_content()
	{
		check_ajax_referer('cncpp_nonce');
		(int) $id = $_REQUEST['id'];
		$postdata = $this->model->getPostData($id);
		$this->view->assign('post_title', $postdata['title']);
		$this->view->assign('post_content', $postdata['content']);
		$post_content = $this->view->render('popup-content');
		wp_send_json($post_content);
		wp_die();
	}

	/**
	 * Callback for register necessary scripts
	 * @return [type] [description]
	 */
	public function registerScripts()
	{
		wp_enqueue_style('cnc-popup-post-main', $this->plugin_url . 'assets/css/main.css');
		wp_register_script('cnc-popup-post-main', $this->plugin_url . 'assets/js/main.js', array('jquery'), '1', true);
		wp_enqueue_script('cnc-popup-post-main');
		// Prepare script for use AJAX
		wp_localize_script( 'cnc-popup-post-main', 'cnc_popup_post_obj', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		    'nonce'    => wp_create_nonce('cncpp_nonce'),
	    ) );
		// Builtin WP function to register thickbox dependent scripts
	    add_thickbox();
	}
}
