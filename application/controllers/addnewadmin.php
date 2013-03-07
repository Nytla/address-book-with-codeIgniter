<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authorization
 * 
 * This is authorization class
 * 
 * @version 0.1
 */
class Addnewadmin extends CI_Controller {
	
	/**
	 * _login_rules
	 * 
	 * @var array
	 */
	private $_login_rules = array(
		'field' => 'login',
        'name' 	=> 'Login',
        'rules' => 'trim|required|min_length[5]|max_length[16]|alpha|xss_clean'
	);

	/**
	 * _password_rules
	 * 
	 * @var array
	 */
	private $_password_rules = array(
		'field' => 'password',
        'name' 	=> 'Password',
        'rules' => 'trim|required|min_length[6]|max_length[16]|alpha_numeric|xss_clean'
	);
	
	/**
	 * _password_confirm_rules
	 * 
	 * @var array
	 */
	private $_password_confirm_rules = array(
		'field' => 'confirm_password',
        'name' 	=> 'Confirm Password',
        'rules' => 'trim|required|matches[password]'
	);
	
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
		$this -> pageforming -> headerCreate('add_new_admin', TRUE);
		
		/**
		 * Include JS scripts for html
		 */
		$jquery_library = array(
			'path' => $this -> pageforming -> _config['jquery_lib']['path'],
			'file' => $this -> pageforming -> _config['jquery_lib']['jquery']
		);
		
		$formplugin = array(
			'path' => $this -> pageforming -> _config['jquery_lib']['path'],
			'file' => $this -> pageforming -> _config['jquery_lib']['form_plugin']
		);
		
		$addnewclient = array(
			'path' => $this -> pageforming -> _config['js']['path'],
			'file' => $this -> pageforming -> _config['js']['add_new_admin']
		);

		/**
		 * Set array for our template
		 */
		$js_array = array(
			$jquery_library,
//			$formplugin,
			$addnewclient
		);
		
		/**
		 * Parse our templates
		 */
		$this -> pageforming -> scriptsCreate(null, $js_array);
		
		/**
		 * Set parameters for our template
		 */		
		$data = array(
			'site_url' 			=> base_url() . index_page(),
			'layout'			=> $this -> pageforming -> _locale['add_new_admin']['layout'],
			'page_name'			=> $this -> pageforming -> _locale['add_new_admin']['page_name'],
			'login'				=> $this -> pageforming -> _locale['add_new_admin']['login'],
			'password'			=> $this -> pageforming -> _locale['add_new_admin']['password'],
			'confirm_password'	=> $this -> pageforming -> _locale['add_new_admin']['confirm_password'],
			'administrator'	=> $this -> pageforming -> _locale['add_new_admin']['administrator'],
			'add_good_message'	=> $this -> pageforming -> _locale['add_new_admin']['add_good_message'],
			'save'			=> $this -> pageforming -> _locale['add_new_client']['save'],

		);

		/**
		 * Parse our template
		 */
		$auth_template_name = $this -> pageforming -> _config['templates']['add_new_admin'];
		
		/**
		 * Parse our template
		 */
		$this -> parser -> parse($auth_template_name, $data);
		
		/**
		 * Create footer
		 */
		$this -> pageforming -> footerCreate();
	}
	
	/**
	 * ajaxCheckAdminData
	 * 
	 * This function to validation client's data
	 *
	 * @access public
	 */
	public function ajaxCheckAdminData() {
		
		/**
		 * Check AJAX Request
		 */
		$this -> ischecks -> checkAjaxRequest();
		
		/**
		 * Login validation
		 */
		$this -> form_validation -> set_rules($this -> _login_rules['field'], $this -> _login_rules['name'], $this -> _login_rules['rules']);
		
		/**
		 * Password validation
		 */
		$this -> form_validation -> set_rules($this -> _password_rules['field'], $this -> _password_rules['name'], $this -> _password_rules['rules']);
		
		/**
		 * Confirm password validation
		 */
		$this -> form_validation -> set_rules($this -> _password_confirm_rules['field'], $this -> _password_confirm_rules['name'], $this -> _password_confirm_rules['rules']);
		
		/**
		 * Set container for error block
		 */
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		/**
		 * Check our form
		 */
		if ($this->form_validation->run() == FALSE) {
			
			echo json_encode(array(
				'flag'	=> FALSE,
				'error'	=> validation_errors()
			));
			
		} else {
			
			/**
			 * To Check administrator name in DB
			 */
			if ($this -> addnewadmin_model -> getAdminNameFromDB($this -> input -> post('login'))) {
				
				echo json_encode(array(
					'flag'	=> FALSE,
					'error'	=> '<div class="error">' . $this -> pageforming -> _locale['add_new_admin']['admin_exists'] . '</div>'
				));
				
			} else {
				
				/**
				 * Add new administrator in DB
				 */
				$this -> addnewadmin_model -> addNewAdminInDB($this -> input -> post());
				
				/**
				 * Print good message
				 */
				echo json_encode(array(
					'flag'	=> TRUE,
					'message' => $this -> pageforming -> _locale['add_new_admin']['add_good_message']
				));
				
			}

			

			
		}
	}


}





















