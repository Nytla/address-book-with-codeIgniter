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
	 * _CI
	 *
	 * @var null
	 */
	private $_CI;
	
	/**
	 * _config
	 *
	 * @var null
	 */
	private $_config;
	
	/**
	 * _locale
	 *
	 * @var null
	 */
	private $_locale;
	
	/**
	 * Enter description here...
	 *
	 */
	public function __construct() {
		
		/**
		 * First, assign the CodeIgniter object to a variable
		 */
		$this -> _CI =& get_instance();
		
		/**
		 * Load data from config file 
		 */
		$this -> _CI -> config -> load('config', TRUE);
		
		$this -> _config = $this -> _CI -> config -> item('config');
		
		/**
		 * Load data from locale file
		 */
		$this -> _CI -> lang -> load('locale', '/');
		
		$this -> _locale = $this -> _CI -> lang -> line('english');
	}
	
	/**
	 * Enter description here...
	 *
	 * @return unknown
	 */
	public function loadTest() {
		
		$this -> _CI -> load -> helper('url');
		
//		return index_page();

//		return $this -> _congig['common_charset'] . ' - ' . $this -> _congig['paths']['root'];

		return $this -> _locale['site']['name'] . '_|_';
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
	public function headerCreate($title, $blue_print_flag = FALSE) {

//		$this -> _locale = $this -> _CI -> lang -> line('book_list');
		
		/**
		 * Create array with variables for header tempalate
		 */
		$params = array(
			'charset'			=> $this -> _config['common_charset'],
//			'site_name'			=> $this -> lang -> line('site_name'),
			'title'				=> $this -> _locale[$title]['title'],
			'image_path'		=> $this -> _config['image_settings']['images_path'],
			'blue_print_path'	=> $this -> _config['css']['blue_print_path']
		);

		/**
		 * 
		 */
		$this -> _CI -> parser -> parse('header.html', $params);
		
		/**
		 * Create variable with header tempalate name
		 */
		//$template_name = $this -> config -> config['header'];

		if ($blue_print_flag) {
		
			$params = array(
				'blue_print_path'	=> $this -> _config['css']['blue_print_path']
			);
				
			$this -> _CI -> parser -> parse('blue_print.html', $params);
		}
	}

	/**
	 * scriptsContent
	 *
	 * This function include javascript or css our header
	 * 
	 * @return string $tempalate	This is source scripts tempalate
	 */
	public function scriptsCreate($css_array = FALSE, $js_array = '') {

		/**
		 * Include css or/and javascript content
		 */
//		$template_name = Config::dataArray('templates', 'scripts');

		/**
		 * CSS
		 */
		if ($css_array) {
			
			$css_params = array(
				'path'	=> $this -> _config['css']['path'],
				'css_array'	=> $css_array
			);
			
		}
		
		$this -> _CI -> parser -> parse('css.html', $css_params);
		
		/**
		 * JS
		 */
		if ($css_array) {
			
			$css_params = array(
				'path'	=> $this -> _config['js']['path'],
				'js_array'	=> $js_array
			);
			
		}
		
		$this -> _CI -> parser -> parse('js.html', $css_params);
		
		/**
		 * Create array with variables for scripts tempalate
		 */
		/*
		$params = array(
			"css_path"	=> $css_path,
			"js_path"	=> $js_path,
			"noscript"	=> Locale::languageEng('noscript', 'message'),
		);

		return Templating::renderingTemplate($template_name, $params);
		*/
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
