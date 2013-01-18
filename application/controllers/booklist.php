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
		$data['title'] = 'First Load Page';
		$data['cont'] = 'This ... is test ^).' . $this -> testFunc();

		$this -> load -> library('pageforming');
		
		$data['forming'] = $this -> pageforming -> loadTest();
		
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