<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authorization
 * 
 * This is authorization class
 * 
 * @version 0.1
 */
class Editclient extends CI_Controller {
	
	/**
	 * _firstname_rules
	 * 
	 * @var array
	 */
	private $_firstname_rules = array(
		'field' => 'first_name',
        'name' 	=> 'First Name',
        'rules' => 'trim|required|min_length[2]|max_length[32]|alpha|xss_clean'
	);
	
	/**
	 * _lastname_rules
	 * 
	 * @var array
	 */
	private $_lastname_rules = array(
		'field' => 'last_name',
        'name' 	=> 'Last Name',
        'rules' => 'trim|required|min_length[2]|max_length[32]|alpha|xss_clean'
	);
	
	/**
	 * _email_rules
	 * 
	 * @var array
	 */
	private $_email_rules = array(
		'field' => 'email',
        'name' 	=> 'Email',
        'rules' => 'trim|required|min_length[5]|max_length[32]|valid_email|xss_clean'
	);
	
	/**
	 * _country_rules
	 * 
	 * @var array
	 */
	private $_country_rules = array(
		'field' => 'country',
        'name' 	=> 'Country',
        'rules' => 'trim|required|numeric|xss_clean'
	);
	
	/**
	 * _city_rules
	 * 
	 * @var array
	 */
	private $_city_rules = array(
		'field' => 'city',
        'name' 	=> 'City',
        'rules' => 'trim|required|numeric|xss_clean'
	);
	
	/**
	 * _photo_rules
	 * 
	 * @var array
	 */
	private $_photo_rules = array(
		'field' => 'photo_id',
        'name' 	=> 'Photo',
        'rules' => 'trim|required|numeric|xss_clean'
	);
	
	/**
	 * _notes_rules
	 * 
	 * @var array
	 */
	private $_notes_rules = array(
		'field' => 'notes',
        'name' 	=> 'Notes',
        'rules' => 'trim|max_length[1500]|xss_clean'
	);
	
	/**
	 * index
	 * 
	 * Index Page for this controller.
	 *
	 * @param integer $client_id
	 * @access public
	 */
	public function edit($client_id) {

		/**
		 * Check authorization
		 */
		$this -> ischecks -> checkAuthorization();

		/**
		 * Check client's exists and get data
		 */
		$client_data = $this -> editclient_model -> getClientDataFromDB($client_id);
		
		if (!$client_data) {
			
			show_404();
		}
		
		/**
		 * Get image's data
		 */	
		$image_data = $this -> editclient_model -> getImageDataFromDB($client_data[0]['photo']);
		
		/**
		 * Create our header
		 */
		$this -> pageforming -> headerCreate('edit_client', TRUE);
		
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
			'file' => $this -> pageforming -> _config['js']['edit_client']
		);

		/**
		 * Set array for our template
		 */
		$js_array = array(
			$jquery_library,
			$formplugin,
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
			'site_url' 				=> base_url() . index_page(),
			'page_name'				=> $this -> pageforming -> _locale['edit_client']['page_name'],
			'first_name'			=> $this -> pageforming -> _locale['add_new_client']['first_name'],
			'last_name'				=> $this -> pageforming -> _locale['add_new_client']['last_name'],
			'email'					=> $this -> pageforming -> _locale['add_new_client']['email'],
			'country'				=> $this -> pageforming -> _locale['add_new_client']['country'],
			'country_array'			=> $this -> editclient_model -> getAllCountriesFromDB($client_data[0]['country']),
			'city'					=> $this -> pageforming -> _locale['add_new_client']['city'],
			'city_array'			=> $this -> editclient_model -> getCitiesFromDB($client_data[0]['country'], $client_data[0]['city']),			
			'empty_option'			=> $this -> pageforming -> _locale['add_new_client']['empty_option'],
			'photo'					=> $this -> pageforming -> _locale['add_new_client']['photo'],
			'image_path' 			=> $this -> pageforming -> _config['image_settings']['images_path'],
			'preloader_text'		=> $this -> pageforming -> _locale['book_list']['preloader_text'],
			'notes'					=> $this -> pageforming -> _locale['add_new_client']['notes'],
			'save'					=> $this -> pageforming -> _locale['add_new_client']['save'],
			'reset'					=> $this -> pageforming -> _locale['add_new_client']['reset'],
			'back_to_book_list'		=> $this -> pageforming -> _locale['add_new_client']['back_to_book_list'],
			'mess_max_length_notes' => $this -> pageforming -> _locale['add_new_client']['mess_max_length_notes'],
			'add_good_message'		=> $this -> pageforming -> _locale['add_new_client']['add_good_message'],
			'client_id_value'		=> $client_id,
			'first_name_value'		=> $client_data[0]['first_name'],
			'last_name_value'		=> $client_data[0]['last_name'],
			'email_value'			=> $client_data[0]['email'],
			'notes_value'			=> $client_data[0]['notes'],
			'image_id_value'		=> $image_data[0]['photo_id'],
			'image_clients_path'	=> $this -> pageforming -> _config['image_settings']['image_clients_path'],
			'img_src' 				=> $image_data[0]['photo_name'],
			'img_alt' 				=> $image_data[0]['photo_description'],
			'img_height' 			=> $image_data[0]['photo_height'],
			'img_width' 			=> $image_data[0]['photo_width'],
			'img_id' 				=> $image_data[0]['photo_id'],
			
		);

		/**
		 * Parse our template
		 */
		$auth_template_name = $this -> pageforming -> _config['templates']['edit_client'];
		
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
	 * ajaxCheckClientData
	 * 
	 * This function to validation client's data
	 *
	 * @access public
	 */
	public function ajaxCheckClientData() {

		/**
		 * Check AJAX Request
		 */
		$this -> ischecks -> checkAjaxRequest();
		
		/**
		 * First Name validation
		 */
		$this -> form_validation -> set_rules($this -> _firstname_rules['field'], $this -> _firstname_rules['name'], $this -> _firstname_rules['rules']);
		
		/**
		 * Last Name validation
		 */
		$this -> form_validation -> set_rules($this -> _lastname_rules['field'], $this -> _lastname_rules['name'], $this -> _lastname_rules['rules']);
		
		/**
		 * Email validation
		 */
		$this -> form_validation -> set_rules($this -> _email_rules['field'], $this -> _email_rules['name'], $this -> _email_rules['rules']);
		
		/**
		 * Country validation
		 */
		$this -> form_validation -> set_rules($this -> _country_rules['field'], $this -> _country_rules['name'], $this -> _country_rules['rules']);
		
		/**
		 * City validation
		 */
		$this -> form_validation -> set_rules($this -> _city_rules['field'], $this -> _city_rules['name'], $this -> _city_rules['rules']);
		
		/**
		 * Photo validation
		 */
		$this -> form_validation -> set_rules($this -> _photo_rules['field'], $this -> _photo_rules['name'], $this -> _photo_rules['rules']);

		/**
		 * Notes validation
		 */
		$this -> form_validation -> set_rules($this -> _notes_rules['field'], $this -> _notes_rules['name'], $this -> _notes_rules['rules']);

		
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
			
//			$this -> addnewclient_model -> addNewClientInDb($this -> input -> post());

			$this -> editclient_model -> editClientDataFromDB($this -> input -> post());
			
//echo 'YES!_';

			echo json_encode(array(
				'flag'	=> TRUE,
				'message' => $this -> pageforming -> _locale['add_new_client']['add_good_message']
			));
		}
	}
}
?>