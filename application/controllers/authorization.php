<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authorization
 * 
 * This is authorization class
 * 
 * @version 0.1
 */
class Authorization extends CI_Controller {
	
	/**
	 * _login_rules
	 * 
	 * @var array
	 */
	private $_login_rules = array(
		'field' => 'valueLogin',
        'name' 	=> 'Login',
        'rules' => 'trim|required|min_length[5]|max_length[16]|alpha|xss_clean'
	);
	
	/**
	 * _password_rules
	 * 
	 * @var array
	 */
	private $_password_rules = array(
		'field' => 'valuePassword',
        'name' 	=> 'Password',
        'rules' => 'trim|required|min_length[6]|max_length[16]|alpha_numeric|xss_clean'
	);
	
	/**
	 * index
	 * 
	 * Index Page for this controller.
	 *
	 * @access public
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($error_message = '') {
		
		/**
		 * Check authorization
		 */
		if ($this->form_validation->run() == FALSE) {
			$this -> ischecks -> checkAuthorization();
		}
		
		/**
		 * Create our header
		 */
		$this -> pageforming -> headerCreate('authorization', TRUE);
		
		/**
		 * Include JS scripts for html
		 */
		$jquery_library = array(
			'path' => $this -> pageforming -> _config['jquery_lib']['path'],
			'file' => $this -> pageforming -> _config['jquery_lib']['jquery']
		);

		
		$authorization = array(
			'path' => $this -> pageforming -> _config['js']['path'],
			'file' => $this -> pageforming -> _config['js']['authorization']
		);
		
		$js_array = array(
			$jquery_library,
			$authorization
		);
		
		/**
		 * Parse our templates
		 */
		$this -> pageforming -> scriptsCreate(null, $js_array);
		
		/**
		 * Set parameters for our template
		 */
		$data = array(
			'auth'				=> $this -> pageforming -> _locale['authorization']['auth'],
			'login' 			=> $this -> pageforming -> _locale['authorization']['login'],
			'password' 			=> $this -> pageforming -> _locale['authorization']['password'],
			'login_button' 		=> $this -> pageforming -> _locale['authorization']['login_button'],
			'login_value'		=> set_value('valueLogin', ''),
			'password_value'	=> set_value('valuePassword', ''),
			'error_empty'		=> $this -> pageforming -> _locale['authorization']['error_empty'],
			'error_captcha'		=> $this -> pageforming -> _locale['authorization']['error_captcha'],
			'errors'			=> $error_message
		);
		
		/**
		 * Parse our template
		 */
		$auth_template_name = $this -> pageforming -> _config['templates']['authorization'];
		
		/**
		 * Parse our template
		 */
		$this -> parser -> parse($auth_template_name, $data);
		
		/**
		 * Create footer
		 */
		$this -> pageforming -> footerCreate();
	}
	
	public function checkForm() {
		
		/**
		 * Login validation
		 */
		$this -> form_validation -> set_rules($this -> _login_rules['field'], $this -> _login_rules['name'], $this -> _login_rules['rules']);
		
		/**
		 * Password validation
		 */
		$this -> form_validation -> set_rules($this -> _password_rules['field'], $this -> _password_rules['name'], $this -> _password_rules['rules']);
		
		/**
		 * Set container for error block
		 */
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		/**
		 * 
		 */
		if ($this->form_validation->run() == FALSE) {

			$this -> index(validation_errors());
			
		} else {
			
			$login_post = $this->input->post('valueLogin');

			$password_post = md5(md5($this->input->post('valuePassword')));
			
			$admin_data_array = $this -> authorization_model -> getAdminData($this->input->post('valueLogin'));
			
			/**
			 * 
			 */
			if ($admin_data_array['flag'] and $admin_data_array['admin_data']['admin_password'] === $password_post) {
				
				$this -> setAuthorization($admin_data_array['admin_data']);
				
			} else {
				
				$this -> index($this -> pageforming -> _locale['authorization']['error_incorect']);
			}
		}
	}
	
	/**
	 * setAuthorization
	 * 
	 * Enter description here...
	 *
	 * @param array $admin_data_array
	 */
	private function setAuthorization($admin_data_array) {

		/**
		 * Generate hash
		 */
		$hash = random_string('alnum', 32);
		
		/**
		 * Update hash in DB
		 */
		$this -> authorization_model -> updateHash($admin_data_array['admin_id'], $hash);
		
		/**
		 * Set cookie with admin id and admin hash
		 */
		$this -> input -> set_cookie('admin_id', $admin_data_array['admin_id'], $this -> pageforming -> _config['cookie']['one_day']);
		$this -> input -> set_cookie('admin_login', $admin_data_array['admin_login'], $this -> pageforming -> _config['cookie']['one_day']);
		$this -> input -> set_cookie('admin_hash', $hash, $this -> pageforming -> _config['cookie']['one_day']);
		
		/**
		 * Check administator information
		 */
		redirect(base_url() . index_page() . '/layout/');
	}
}
?>