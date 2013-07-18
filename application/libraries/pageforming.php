<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Adress Book Library
 * 
 * pageforming.php
 *
 * This is file with Pageforming class
 * 
 * @category	controllers
 * @copyright	2012
 * @author		Igor Zhabskiy <Zhabskiy.Igor@gmail.com>
 */

/**
 * Pageforming
 * 
 * This is Pageforming class
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
	public $_config;
	
	/**
	 * _locale
	 *
	 * @var null
	 */
	public $_locale;
	
	/**
	 * Constructor
	 * 
	 * This function initialize our objects
	 * 
	 * @access public
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
	 * headerCreate
	 * 
	 * This function create content for header template
	 * 
	 * @access public
	 * @param string $title
	 * @param boolean $flag
	 * @return string $tempalate	This is source header tempalate
	 */
	public function headerCreate($title, $blue_print_flag = FALSE) {

		/**
		 * Create variable with header tempalate name
		 */
		$header_template_name = $this -> _config['templates']['header'];
		
		/**
		 * Create array with variables for header tempalate
		 */
		$params = array(
			'charset'			=> $this -> _config['common']['charset'],
			'title'				=> $this -> _locale[$title]['title'],
			'image_path'		=> $this -> _config['image_settings']['images_path'],
			'blue_print_path'	=> $this -> _config['css']['blue_print_path']
		);

		/**
		 * Parse our template
		 */
		$this -> _CI -> parser -> parse($header_template_name, $params);
		
		/**
		 * Create variable with blue print framework tempalate name
		 */
		$bp_template_name = $this -> _config['templates']['blue_print'];

		if ($blue_print_flag) {
		
			$params = array(
				'blue_print_path'	=> $this -> _config['css']['blue_print_path']
			);
			
			/**
			 * Parse our template
			 */
			$this -> _CI -> parser -> parse($bp_template_name, $params);
		}
	}

	/**
	 * scriptsCreate
	 *
	 * This function include javascript or css our header
	 * 
	 * @access public
	 * @return string $tempalate	This is source scripts tempalate
	 */
	public function scriptsCreate($css_array = FALSE, $js_array = FALSE) {

		if ($css_array) {
			
			/**
			 * Create variable with CSS tempalate name
			 */
			$css_template_name = $this -> _config['templates']['css'];
			
			/**
			 * Create array with variables for CSS tempalate
			 */
			$css_params = array(
				'path'	=> $this -> _config['css']['path'],
				'css_array'	=> $css_array
			);
			
			/**
			 * Parse our template
			 */
			$this -> _CI -> parser -> parse($css_template_name, $css_params);
		}
		
		if ($js_array) {
			
			/**
			 * Create variable with CSS tempalate name
			 */
			$js_template_name = $this -> _config['templates']['js'];
			
			/**
			 * Create array with variables for JS tempalate
			 */
			$css_params = array(
				'js_array'		=> $js_array,
				
			);
			
			/**
			 * Parse our template
			 */
			$this -> _CI -> parser -> parse($js_template_name, $css_params);
		}
		
		/**
		 * Create variable with noscript tempalate name
		 */
		$noscript_template_name = $this -> _config['templates']['noscript'];
		
		$noscript_params = array(
			'noscript' => $this -> _locale['noscript']['message']
		);
		
		/**
		 * Parse our template
		 */
		$this -> _CI -> parser -> parse($noscript_template_name, $noscript_params);
	}

	/**
	 * footerContent
	 * 
	 * This function print footer template
	 * 
	 * @access public
	 * @return string $tempalate	This is source footer tempalate
	 */
	public function footerCreate() {

		/**
		 * Create variable with footer tempalate name
		 */
		$template_name = $this -> _config['templates']['footer'];

		/**
		 * Create array with variable for footer tempalate
		 */
		$create_project_year = $this -> _locale['site']['year'];

		$dash = chr(45);

		/**
		 * Create array with variables for footer tempalate
		 */
		$params = array(
			'year' => (date("Y") == $create_project_year) ? date("Y") : $create_project_year . $dash . date("Y"),
		);

		$this -> _CI -> parser -> parse($template_name, $params);
	}
	
	/**
	 * Destructor
	 *
	 * This is destructor close connect with Data Base
	 * 
	 * @access public
	 */
	public function __destruct() {}
}