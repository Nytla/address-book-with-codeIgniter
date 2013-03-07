<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Layout
 * 
 * This is layout class
 * 
 * @version 0.1
 */
class Layout extends CI_Controller {
	
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
		 * Get admin's permission
		 */
		$admin_permission = $this -> getAdminPermission();
		
		/**
		 * Create our header
		 */
		$this -> pageforming -> headerCreate('layout', TRUE);
		
		/**
		 * Include CSS styles for html
		 */
		$css_array = NULL;
		
		/**
		 * Include JS scripts for html
		 */
		$js_array = NULL;
		
		/**
		 * Parse our templates
		 */
		$this -> pageforming -> scriptsCreate();
		
		/**
		 * Set parameters for our template
		 */		
		$data = array(
			'ab'		=> $this -> pageforming -> _locale['site']['name'],
			'site_url' 	=> base_url() . index_page(),
			'log_out'	=> $this -> pageforming -> _locale['layout']['log_out'],	
			'add_admin'	=> $this -> pageforming -> _locale['layout']['add_admin'],
			'prepend'	=> ($admin_permission[0]['admin_permission'] == 1) ? 8 : 10,
			'add_admin' => ($admin_permission[0]['admin_permission'] == 1) ? ' | <a href="' . base_url() . index_page() . '/	addnewadmin">' . $this -> pageforming -> _locale['layout']['add_admin'] . '</a>' : '',
			'content'	=> $this -> pageforming -> _locale['layout']['content'] . get_cookie('admin_login'),
		);
		
		/**
		 * Parse our template
		 */
		$auth_template_name = $this -> pageforming -> _config['templates']['layout'];
		
		/**
		 * Parse our template
		 */
		$this -> parser -> parse($auth_template_name, $data);
		
		/**
		 * Create footer
		 */
		$this -> pageforming -> footerCreate();
	}
	
	private function getAdminPermission() {
		return $this -> layout_model -> getAdminPermissionFromDB();	
	}
}
?>