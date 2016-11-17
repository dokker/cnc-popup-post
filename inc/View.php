<?php
namespace cncPP;

class View {
	private $data = array();

	public function __construct()
	{
	}

	/**
	 * Assign new value to data stack
	 * @param  string $variable Variable name
	 * @param  mixed $value    Value of the variable
	 */
	public function assign($variable, $value)
	{
		$this->data[$variable] = $value;
	}

	/**
	 * Render content using the given template file
	 * @param  string $template Template file name without extension
	 * @return string           Generated HTML markup
	 */
	public function render($template)
	{
		extract($this->data);
		$file = plugin_dir_path(dirname(__FILE__)) . 'templates' . DIRECTORY_SEPARATOR . $template . '.tpl.php';
		if (!file_exists($file)) {
			throw new \Exception("File doesn't exist");
		}
		ob_start();
		include($file);
		return ob_get_clean();
	}
}