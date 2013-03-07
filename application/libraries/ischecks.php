<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Adress Book Controller
 * 
 * page_forming.php
 *
 * This is file with page_form class
 * 
 * @category	controllers
 * @copyright	2012
 * @author	Igor Zhabskiy <Zhabskiy.Igor@gmail.com>
 */

/**
 * Indexes
 * 
 * This is indexes class
 * 
 * @version 0.1
 */
class Ischecks {
	
	/**
	 * _CI
	 *
	 * @var null
	 */
	private $_CI;
	
	/**
	 * Constructor
	 * 
	 * This function initialize our objects
	 */
	public function __construct() {
		
		/**
		 * First, assign the CodeIgniter object to a variable
		 */
		$this -> _CI =& get_instance();
	}
	
	/**
	 * checkRequest
	 * 
	 * Check AJAX Request
	 * 
	 * @access public
	 */
	public function checkAjaxRequest() {
		
		if (!$this -> _CI -> input -> is_ajax_request()) {
		
			show_404();
		}
		
/*
		try {
			$_SERVER['HTTP_X_REQUESTED_WITH'];
		
		} catch (Validation_Exception $object) {
		
			show_404();
		}
*/
	}
	
	/**
	 * Enter description here...
	 *
	 */
	public function checkAuthorization() {
		
		/**
		 * Check current url
		 */
		$position = strpos(current_url(), '/authorization');
		
		$redirect = ($position === FALSE) ? FALSE : TRUE;
		
		/**
		 * Check cookie from administrator
		 */
		$cookie_admin_id = get_cookie('admin_id');
		$cookie_admin_hash = get_cookie('admin_hash');
		
		if ($cookie_admin_id and $cookie_admin_hash) {
			
			$admin_data_array = $this -> _CI -> authorization_model -> getAdminIdAndHash($cookie_admin_id, $cookie_admin_hash); 
			
			if ($cookie_admin_id !== $admin_data_array['admin_id'] or $cookie_admin_hash !== $admin_data_array['admin_hash']) {
				
				/**
				 * Delete authorization cookie
				 */
				delete_cookie('admin_id');
				delete_cookie('admin_hash');
				
				/**
				 * Redirect
				 */
				if (!$redirect) {
					redirect(base_url() . index_page() . '/authorization/');
				}
			} else {
				
				/**
				 * Redirect
				 */
				if ($redirect) {
					redirect(base_url() . index_page() . '/layout/');
				}
			}
		} else {
			
			/**
			 * Redirect
			 */
			if (!$redirect) {
				redirect(base_url() . index_page() . '/authorization/');
			}
		}
		
	}
}









?>