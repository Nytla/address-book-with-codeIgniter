<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//English documetaton - http://ellislab.com/codeigniter/user-guide/libraries/parser.html
//Russian documentation - http://code-igniter.ru/user_guide/libraries/config.html
//CodeIgniter и Ajax посредством jQuery - http://www.ibm.com/developerworks/ru/library/wa-aj-codeigniter/index.html


class Auth_form extends CI_Controller {
	
	public function index() {
		
		/**
		 * 
		 */
//		$this->load->library('javascript');

//		$this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
		
		/**
		 * Set variable with data
		 */
		$data = array(
			'name' => 'Authorization',
			'charset' => $this -> config -> config['charset'],
			'persons' => array(
				array('f_name' => 'John'),
				array('f_name' => 'Ben'),
				array('f_name' => 'Hugo')
			)
		);
		
		/**
		 * Load parser
		 */
		$this -> load -> library('parser');
		
		$this -> parser -> parse('/admin/authorization.html', $data);
		
	}
	
}