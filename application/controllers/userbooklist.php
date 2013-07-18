<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Userbooklist
 * 
 * This is user book list class
 * 
 * @version 0.1
 */
class Userbooklist extends CI_Controller {
	
	/**
	 * index
	 * 
	 * Index Page for this controller.
	 *
	 * @access public
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {

		/**
		 * Create our header
		 */
		$this -> pageforming -> headerCreate('user_book_list', TRUE);
		
		/**
		 * Include CSS styles for html
		 */
		$demo_table = array(
			'file' => $this -> pageforming -> _config['css']['demo_table']
		);

		$jquery_ui = array(
			'file' => $this -> pageforming -> _config['css']['jquery_ui']
		);
		
		$css_array = array(
			$demo_table,
			$jquery_ui
		);
		
		/**
		 * Include JS scripts for html
		 */
		$jquery_library = array(
			'path' => $this -> pageforming -> _config['jquery_lib']['path'],
			'file' => $this -> pageforming -> _config['jquery_lib']['jquery']
		);

		$data_table = array(
			'path' => $this -> pageforming -> _config['jquery_lib']['path'],
			'file' => $this -> pageforming -> _config['jquery_lib']['data_table']
		);
		
		$book_list = array(
			'path' => $this -> pageforming -> _config['js']['path'],
			'file' => $this -> pageforming -> _config['js']['user_book_list']
		);
		
		$js_array = array(
			$jquery_library,
			$data_table,
			$book_list
		);
		
		/**
		 * Parse our templates
		 */
		$this -> pageforming -> scriptsCreate($css_array, $js_array);
		
		/**
		 * Set parameters for our template
		 */
		$phrase = $this -> booklist_model -> getRandomPhrase();
		
		$data = array(
			'login'				=> $this -> pageforming -> _locale['book_list']['login'],
			'site_name' 		=> $this -> pageforming -> _locale['site']['name'],
			'preloader_text' 	=> $this -> pageforming -> _locale['book_list']['preloader_text'],
			'image_path' 		=> $this -> pageforming -> _config['image_settings']['images_path'],
			'details_open'		=> $this -> pageforming -> _locale['book_list']['details_open'],
			'details_close'		=> $this -> pageforming -> _locale['book_list']['details_close'],
			'name_word'			=> $this -> pageforming -> _locale['book_list']['name_word'],
			'country_word'		=> $this -> pageforming -> _locale['book_list']['country_word'],
			'city_word'			=> $this -> pageforming -> _locale['book_list']['city_word'],
			'phrase' 			=> $phrase[0]['phrase_text']
		);
		
		/**
		 * Parse our template
		 */
		$book_list_template_name = $this -> pageforming -> _config['templates']['user_book_list'];
		
		/**
		 * Parse our template
		 */
		$this -> parser -> parse($book_list_template_name, $data);
		
		/**
		 * Create footer
		 */
		$this -> pageforming -> footerCreate();
	}

	/**
	 * ajaxClientDataJSON
	 * 
	 * This function get client't data (json) for ajax request
	 * 
	 * @access public
	 */
	public function ajaxClientDataJSON() {

		/**
		 * Check AJAX Request
		 */
		$this -> ischecks -> checkAjaxRequest();
		
		/**
		 * Print our client't data (json)
		 */
		echo $this -> booklist_model -> getClientDataJSON();
	}
}