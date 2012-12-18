<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		/*
		$data = array(
			'mess' => 'This is amazing test %).'
		);
		*/
		
		/**
		 * Load Model
		 */
		$model = $this -> load -> model('Welc');
		
		$data = $this -> Welc -> user_data();
		
		/**
		 * Load lenguage
		 */
//		$this->lang->load('locale');
		
		$data['name'] = $this->lang->line('site_name');
		
		/**
		 * Load parser
		 */
		$this -> load -> library('parser');
		
		$this -> parser -> parse('welcome_message.html', $data);
		
//		$this->load->view('welcome_message.html', $data);
	}
	
	public function test() {
		echo 'Test__';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */