<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Booklistmodel
 * 
 * Enter description here...
 *
 * @version 0.1
 */
class Authorization_model extends CI_Model {
	
	/**
	 * _DB_table_name_administrators
	 * 
	 * @var string	This is name of Database
	 */
	private $_DB_table_name_administrators;
	
	/**
	 * Enter description here...
	 *
	 */
	public function __construct() {
		/**
		 * Set variables with name of DB table
		 */
		$this -> _DB_table_name_administrators	= $this -> pageforming -> _config['table_name']['administrators'];
	}
	
	/**
	 * getAdminIdAndHash
	 * 
	 * This function get administrator's id and hash
	 *
	 * @param unknown_type $admin_id
	 * @param unknown_type $admin_hash
	 * 
	 * @return unknown
	 */
	public function getAdminIdAndHash($admin_id, $admin_hash) {

		$query = $this -> db -> query("SELECT `admin_id`, `admin_hash` FROM {$this -> _DB_table_name_administrators} WHERE `admin_id` = '{$admin_id}' AND `admin_hash` = '{$admin_hash}'");
		
		if ($query -> num_rows() > 0) {
			return $query -> row_array();
		} else {
			FALSE;
		}
	}
	
	/**
	 * getAdminData
	 * 
	 * Enter description here...
	 *
	 * @param unknown_type $admin_login
	 * @return unknown
	 */
	public function getAdminData($admin_login) {
		
		/**
		 * 
		 */
		$this -> db -> select('admin_id, admin_login, admin_password, admin_permission');
		
		$this -> db -> where('admin_login', mysql_escape_string($admin_login));
		
		$query = $this -> db -> get($this -> _DB_table_name_administrators);
		
//		$num_rows = $query -> db -> num_rows();
		
		if ($query -> num_rows() > 0) {
			
			$data['flag'] = TRUE;
			$data['admin_data'] = $query -> row_array();
			
			return $data;
		} else {
			return FALSE;
		}
	}
	
	public function updateHash($admin_id, $hash) {
		
//		$this->db->where('username',$user);
//      $this->db->update('users',$email);

		$this -> db -> where('admin_id', $this->db->escape_str($admin_id));
		
		$this -> db -> update($this -> _DB_table_name_administrators, array('admin_hash' => $hash));
	}
	
}















?>