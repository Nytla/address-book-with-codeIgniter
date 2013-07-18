<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Booklist
 * 
 * This is book list class
 * 
 * @version 0.1
 */
class Booklist extends CI_Controller {
	
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
		 * Check authorization
		 */
		$this -> ischecks -> checkAuthorization();

		/**
		 * Create our header
		 */
		$this -> pageforming -> headerCreate('book_list', TRUE);
		
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
			'file' => $this -> pageforming -> _config['js']['book_list']
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
			'site_name' 		=> $this -> pageforming -> _locale['site']['name'],
			'site_url' 			=> base_url() . index_page(),
			'preloader_text' 	=> $this -> pageforming -> _locale['book_list']['preloader_text'],
			'add_new_client'	=> $this -> pageforming -> _locale['book_list']['add_new_client'],
			'image_path' 		=> $this -> pageforming -> _config['image_settings']['images_path'],
			'details_open'		=> $this -> pageforming -> _locale['book_list']['details_open'],
			'details_close'		=> $this -> pageforming -> _locale['book_list']['details_close'],
			'id_word'			=> $this -> pageforming -> _locale['book_list']['id_word'],
			'name_word'			=> $this -> pageforming -> _locale['book_list']['name_word'],
			'country_word'		=> $this -> pageforming -> _locale['book_list']['country_word'],
			'city_word'			=> $this -> pageforming -> _locale['book_list']['city_word'],
			'action_word'		=> $this -> pageforming -> _locale['book_list']['action_word'],
			'back_to_page_layout'=> $this -> pageforming -> _locale['book_list']['back_to_page_layout'],
			'phrase' 			=> $phrase[0]['phrase_text']
		);
		
		/**
		 * Parse our template
		 */
		$book_list_template_name = $this -> pageforming -> _config['templates']['book_list'];
		
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
	
	/**
	 * ajaxDeleteClient
	 * 
	 * This funciton to delete client (ajax)
	 *
	 * @access public
	 */
	public function ajaxDeleteClient() {
		
		/**
		 * Check AJAX Request
		 */
		$this -> ischecks -> checkAjaxRequest();
		
		/**
		 * Delete
		 */
		echo $this -> booklist_model -> deleteClientFromDB($_POST['id']);	
	}
}