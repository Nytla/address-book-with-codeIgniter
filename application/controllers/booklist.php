<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booklist extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		
		/**
		 * Set data for template
		 */
		$this->config->load('config', TRUE);
		
		$config = $this->config->item('config');
		
		//$config['common_charset'];
		
		//$config['paths']['root'];
		
		$data['title'] = 'First Load Page';
		
		$data['cont'] = 'This ... is test ^).' . $this -> testFunc();

		$this -> load -> library('pageforming');
		
//		$data['forming'] = $this -> pageforming -> loadTest();
		
		/**
		 * 
		 */
		$this -> pageforming -> headerCreate('book_list', TRUE);
		
		/**
		 * CSS
		 */
		$demo_table = array(
			'file' => 'demo_table.css'
		);

		$jquery_ui = array(
			'file' => 'jquery_ui.css'
		);
		
		$css_array = array(
			$demo_table,
			$jquery_ui
		);
		
		/**
		 * JS
		 */
		$jquery_library = array(
			'file' => 'jquery_1.8.0.js'
		);

		$book_list = array(
			'file' => 'book_list.js'
		);
		
		$js_array = array(
			$jquery_library,
			$book_list
		);
		
		$this -> pageforming -> scriptsCreate($css_array, $js_array);
		
		/**
		 * Parse our template
		 */
		$this -> parser -> parse('user/booklist.html', $data);
	}

	/**
	 * Enter description here...
	 *
	 * @return unknown
	 */
	private function testFunc() {
		return '<br> This content from private function...';
	}
}
?>
