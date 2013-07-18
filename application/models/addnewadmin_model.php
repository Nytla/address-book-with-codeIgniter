<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Addnewadmin_model
 * 
 * This is to add new administrator class
 *
 * @version 0.1
 */
class Addnewadmin_model extends CI_Model {
	
	/**
	 * _DB_table_name_administrators
	 * 
	 * @var string	This is name of Database
	 */
	private $_DB_table_name_administrators;
	
	/**
	 * Constructor
	 * 
	 * This funtion initialize prorerties with DB name
	 * 
	 * @access public
	 */
	public function __construct() {
		/**
		 * Set variables with name of DB table
		 */
		$this -> _DB_table_name_administrators = $this -> pageforming -> _config['table_name']['administrators'];	
	}
	
	/**
	 * getAdminNameFromDB
	 * 
	 * This function to get a name of administrator from database
	 *
	 * @access public
	 * @param string $login
	 * @return boolean
	 */
	public function getAdminNameFromDB($login) {
		
		$this -> db -> select('admin_id');
		
		$this -> db -> where('admin_login', $login);//$this -> db -> escape($login));
		
		$query = $this -> db -> get($this -> _DB_table_name_administrators);
		
		if ($query -> num_rows() > 0) {
			
			return TRUE;			
		} else {
			return FALSE; 
		}
	}
	
	/**
	 * addNewAdminInDB
	 * 
	 * This function to add new administrator in DB
	 *
	 * @access public
	 * @param array $admin_data
	 */
	public function addNewAdminInDB($admin_data) {
		
		/**
		 * Set array
		 */
		$insert_data = array(
			'admin_login' 		=> $admin_data['login'],
			'admin_password'	=> md5(md5($admin_data['password'])),
			'admin_permission' 	=> ($admin_data['admin_permission']) ? 1 : 0,
		);
		
		/**
		 * Insert data to DB
		 */
		$this -> db -> insert($this -> _DB_table_name_administrators, $insert_data);
	}
}