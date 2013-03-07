<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Booklistmodel
 * 
 * Enter description here...
 *
 * @version 0.1
 */
class Layout_model extends CI_Model {
	
	/**
	 * _DB_table_name_administrators
	 * 
	 * @var string	This is name of Database
	 */
	private $_DB_table_name_administrators;
	
	/**
	 * Construct
	 * 
	 * This function initialize table properties
	 */
	public function __construct() {
		/**
		 * Set variables with name of DB table
		 */
		$this -> _DB_table_name_administrators	= $this -> pageforming -> _config['table_name']['administrators'];
	}
	
	/**
	 * getAllCountriesFromDB
	 *
	 * This function get all countries from Database
	 *
	 * @return array / boolean
	 */
	public function getAdminPermissionFromDB() {
		
		$cookie_admin_id = get_cookie('admin_id');
		
		$admin_id = preg_replace("/([^\d])/", '', $cookie_admin_id);
		
		if ($admin_id) {
		
			/**
			 * Select administrator information
			 */
			$this -> db -> select('admin_permission');
			
			$this -> db -> where('admin_id', $admin_id);
			
			$query = $this -> db -> get($this -> _DB_table_name_administrators);
			
			if ($query -> num_rows() > 0) {
				
				$data_array = $query -> result_array();
				
				if (is_array($data_array)) {
					return $data_array;
				} else {
					return FALSE;
				}
			}
			
		} else {
			return FALSE;
		}
	}
}
?>