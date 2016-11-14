<?php
namespace cncPP;

class Model {
	public function __construct()
	{
	}

	/**
	 * Get post data by id
	 * @param  int $id Post ID
	 * @return array     Postdata
	 */
	public function getPostData($id)
	{
		$post = get_post($id);
		$postdata = [
			'title' => $post->post_title,
			'content' => $post->post_content,
		];
		return $postdata;
	}
}