<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Adress Book Controller
 * 
 * page_forming.php
 *
 * This is file with page_form class
 * 
 * @category	controllers
 * @copyright	2012
 * @author	Igor Zhabskiy <Zhabskiy.Igor@gmail.com>
 */

/**
 * Indexes
 * 
 * This is indexes class
 * 
 * @version 0.1
 */
class Pageforming {

	/**
	 * Enter description here...
	 *
	 * @var unknown_type
	 */
	private $_CI;
	
	/**
	 * 
	 */
	public function __construct() {
		
		/**
		 * First, assign the CodeIgniter object to a variable
		 */
		$this -> _CI =& get_instance();
	}
	
	public function loadTest() {
		
		$this -> _CI -> load -> helper('url');
		
		return index_page();
	}
	
	/**
	 * headerCreate
	 * 
	 * This function create content for header template
	 * 
	 * @param string $title
	 * @param integer $flag
	 * @return string $tempalate	This is source header tempalate
	 */
	public function headerCreate($title = '', $flag_blue_print = 0) {

		
		
		/**
		 * Create variable with header tempalate name
		 */
		$template_name = $this -> config -> config['header'];

		/**
		 * Create array with variables for header tempalate
		 */
		$params = array(
			"charset"			=> $this -> config -> config['charset'],
			"site_name"			=> $this -> lang -> line('site_name'),
			"title"				=> $title,
			"image_path"		=> Config::dataArray('image_settings', 'images_path'),
			"screen"			=> Config::dataArray('css', 'path'),
			"print"				=> Config::dataArray('css', 'path'),
			"ie"				=> Config::dataArray('css', 'path'),
			"jquery"			=> Config::dataArray('jquery_lib', 'path'),
			"flag_blue_print"	=> $flag_blue_print
		);

		return Templating::renderingTemplate($template_name, $params);
	}

	/**
	 * scriptsContent
	 *
	 * This function include javascript or css our header
	 * 
	 * @return string $tempalate	This is source scripts tempalate
	 */
	public function scriptsContent($css_path = '', $js_path = '') {

		/**
		 * Include css or/and javascript content
		 */
		$template_name = Config::dataArray('templates', 'scripts');

		/**
		 * Create array with variables for scripts tempalate
		 */
		$params = array(
			"css_path"	=> $css_path,
			"js_path"	=> $js_path,
			"noscript"	=> Locale::languageEng('noscript', 'message'),
		);

		return Templating::renderingTemplate($template_name, $params);
	}

	/**
	 * footerContent
	 * 
	 * This function print footer template
	 * 
	 * @return string $tempalate	This is source footer tempalate
	 */
	public function footerContent() {

		/**
		 * Create variable with footer tempalate name
		 */
		$template_name = Config::dataArray('templates', 'footer');

		/**
		 * Create array with variable for footer tempalate
		 */
		$create_project_year = Locale::languageEng('site', 'year');

		$dash = chr(45);

		$params = array(
			"year" => (date("Y") == $create_project_year) ? date("Y") : $create_project_year . $dash . date("Y"),
		);

		return Templating::renderingTemplate($template_name, $params);
	}
}
?>
