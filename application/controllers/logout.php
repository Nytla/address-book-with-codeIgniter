<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Logout
 * 
 * This is logout class
 * 
 * @version 0.1
 */
class Logout extends CI_Controller {
	
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
		 * Delete admin cookie
		 */
		delete_cookie('admin_id');
		delete_cookie('admin_login');
		delete_cookie('admin_hash');
		
		/**
		 * Redirect
		 */
		redirect(base_url() . index_page() . '/authorization/');
	}
}
?>