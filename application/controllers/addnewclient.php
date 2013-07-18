<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Addnewclient
 * 
 * This class to add new client
 * 
 * @version 0.1
 */
class Addnewclient extends CI_Controller {
	
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
	 * @param integer $country_id
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
		$this -> pageforming -> headerCreate('add_new_client', TRUE);
		
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
			'file' => $this -> pageforming -> _config['js']['add_new_client']
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
			'page_name'				=> $this -> pageforming -> _locale['add_new_client']['page_name'],
			'first_name'			=> $this -> pageforming -> _locale['add_new_client']['first_name'],
			'last_name'				=> $this -> pageforming -> _locale['add_new_client']['last_name'],
			'email'					=> $this -> pageforming -> _locale['add_new_client']['email'],
			'country'				=> $this -> pageforming -> _locale['add_new_client']['country'],
			'country_array'			=> $this ->  addnewclient_model -> getAllCountriesFromDB(),
			'city'					=> $this -> pageforming -> _locale['add_new_client']['city'],
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
		);

		/**
		 * Parse our template
		 */
		$auth_template_name = $this -> pageforming -> _config['templates']['add_new_client'];
		
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
			
			
			$this -> addnewclient_model -> addNewClientInDb($this -> input -> post());
			
			echo json_encode(array(
				'flag'	=> TRUE,
				'message' => $this -> pageforming -> _locale['add_new_client']['add_good_message']
			));
		}
	}
	
	/**
	 * ajaxCitiesJSON
	 * 
	 * This fucntion get cities (json)
	 *
	 * @access public
	 */
	public function ajaxCitiesJSON() {
		
		/**
		 * Check AJAX Request
		 */
		$this -> ischecks -> checkAjaxRequest();
		
		/**
		 * Print data with cites (json)
		 */
		echo $this -> addnewclient_model -> getCitiesFromDB($_REQUEST['country_id'], $this->input->post('city'));	
	}

	/**
	 * ajaxUploadImages()
	 * 
	 * This function to upload and resize image
	 *
	 * @access public
	 */
	public function ajaxUploadImages() {
		
		/**
		 * Check AJAX Request
		 */
		$this -> ischecks -> checkAjaxRequest();
		
		/**
		 * Set settings for upload image
		 */
		$config['upload_path'] = './public/images/uploads_client/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1024';
		$config['max_width']  = '1300';
		$config['max_height']  = '1300';

		/**
		 * Load upload library
		 */
		$this->load->library('upload', $config);
		
		/**
		 * Check upload process
		 */
		if (!$this->upload->do_upload('image_file')) {
				
			/**
			 * Print error
			 */
			echo json_encode(array(
				'flag'	=> FALSE,
				'error'	=> $this->upload->display_errors()
			));
		
		} else {
			
			/**
			 * Get upload data
			 */
			$upload_data = $this->upload->data();
			
			/**
			 * Resize image
			 */
			$config['image_library'] = 'gd2';
			$config['source_image'] = $upload_data['full_path'];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 300;
			$config['height'] = 300;
			
			/**
			 * Load resize library
			 */
			$this->load->library('image_lib', $config);
			
			/**
			 * Check image resize
			 */
			if (!$this->image_lib->resize()) {
				
				/**
				 * Print error
				 */
			    echo $this->image_lib->display_errors();
			    
			} else {
				
				/**
				 * Set image's data
				 */
				$image_name = $upload_data['raw_name'] . '_thumb' . $upload_data['file_ext'];
				$size = getimagesize($upload_data['file_path'] . $image_name, $info);
				$array_size = explode('"', $size[3]);
				$image_height = $array_size[3];
				$image_width = $array_size[1];
				$image_description	= $this -> pageforming -> _locale['add_new_client']['thumbnail_photo'];
			
				/**
				 * Insert image id in DB
				 */
				$image_id = $this -> addnewclient_model -> addNewImegeToDB($image_name, $image_height, $image_width, $image_description);
				
				/**
				 * Print image's data
				 */
				echo json_encode(array(
					'flag'			=> TRUE,
					'image_id' 		=> $image_id,
					'image_name' 	=> '/public/images/uploads_client/' . $image_name,
					'image_height' 	=> $image_height,
					'image_width' 	=> $image_width,
					'image_alt' 	=> $image_description
				));
			}
		}
	}
}