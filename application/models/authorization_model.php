<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authorization_model
 * 
 * This is authorization class
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
	 * Constructor
	 * 
	 * This function initialize a name of DB 
	 * 
	 * @access public
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
	 * @access public
	 * @param string $admin_id
	 * @param string $admin_hash
	 * @return array / boolean
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
	 * This function to get a data of administrator
	 *
	 * @access public
	 * @param string $admin_login
	 * @return array / boolean
	 */
	public function getAdminData($admin_login) {
		
		/**
		 * Select data from SB
		 */
		$this -> db -> select('admin_id, admin_login, admin_password, admin_permission');
		
		$this -> db -> where('admin_login', mysql_escape_string($admin_login));
		
		$query = $this -> db -> get($this -> _DB_table_name_administrators);
		
		if ($query -> num_rows() > 0) {
			
			$data['flag'] = TRUE;
			$data['admin_data'] = $query -> row_array();
			
			return $data;
		} else {
			return FALSE;
		}
	}
	
	/**
	 * Enter description here...
	 *
	 * @access public
	 * @param string $admin_id
	 * @param string $hash
	 */
	public function updateHash($admin_id, $hash) {
		$this -> db -> where('admin_id', $this->db->escape_str($admin_id));
		$this -> db -> update($this -> _DB_table_name_administrators, array('admin_hash' => $hash));
	}
}