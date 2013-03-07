<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Booklistmodel
 * 
 * Enter description here...
 *
 * @version 0.1
 */
class Addnewclient_model extends CI_Model {
	
	/**
	 * _DB_table_name_administrators
	 * 
	 * @var string	This is name of Database
	 */
	private $_DB_table_name_administrators;
	
	/**
	 * _DB_table_name_administrators
	 * 
	 * @var string	This is name of Database
	 */
	private $_DB_table_name_countries;
	
	/**
	 * Constructor
	 * 
	 * This funtion initialize prorerties with DB name
	 */
	public function __construct() {
		/**
		 * Set variables with name of DB table
		 */
		$this -> _DB_table_name_clients	= $this -> pageforming -> _config['table_name']['clients'];
		$this -> _DB_table_name_administrators	= $this -> pageforming -> _config['table_name']['administrators'];
		$this -> _DB_table_name_countries		= $this -> pageforming -> _config['table_name']['countries'];
		$this -> _DB_table_name_cities		= $this -> pageforming -> _config['table_name']['cities'];
		$this -> _DB_table_name_photos		= $this -> pageforming -> _config['table_name']['photos'];
	}
	
	/**
	 * getAllCountriesFromDB
	 *
	 * This function get all countries from Database
	 *
	 * @return array / boolean
	 */
	public function getAllCountriesFromDB() {
		
		/**
		 * Select administrator information
		 */
		$this -> db -> select('country_id, countryname_en');
		
		$this -> db -> order_by('countryname_en', 'ASC');
		
		$query = $this -> db -> get($this -> _DB_table_name_countries);
		
		if ($query -> num_rows() > 0) {
			
			$coutry_array = array();
			
			foreach ($query -> result_array() as $row) {
				
				$coutry_array[] = array(
					'country_id' 		=> $row['country_id'],
					'countryname_en'	=> $row['countryname_en']
				);
			}
		}
		
		return $coutry_array;
	}
	
	/**
	 * getCitiesFromDB
	 *
	 * This function get cities from Database depending on selected country
	 *
	 * @param string $country_id
	 * @return array / boolean
	 */
	public function getCitiesFromDB($country_id = '', $city_id = '') {
		
		/**
		 * Get cities from DB
		 */
		$this -> db -> select('city_id, cityname_en');
		
		$this -> db -> where('country_id' , mysql_escape_string($country_id)); 
		
		$this -> db -> order_by('cityname_en', 'ASC');
		
		$query = $this -> db -> get($this -> _DB_table_name_cities);
		
		/**
		 * 
		 */
		if ($query -> num_rows() > 0) {
			
			foreach ($query -> result_array() as $row) {
				
				$data_array[$row['city_id']] = $row['cityname_en'];
				
			}
		}
		
		return (isset($data_array) and is_array($data_array)) ? json_encode(array('city' => $city_id, 'flag' => true, "cities" => $data_array)) : json_encode(array("flag" => false));
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $image_name
	 * @param unknown_type $image_height
	 * @param unknown_type $image_width
	 * @param unknown_type $image_description
	 * @return unknown
	 */
	public function addNewImegeToDB($image_name, $image_height, $image_width, $image_description) {
		
		/**
		 * 
		 */
		$insert_data = array(
			'photo_name' => $image_name,
			'photo_height' => $image_height,
			'photo_width' => $image_width,
			'photo_description' => $image_description
		);
		
		/**
		 * 
		 */
		$this -> db -> insert($this -> _DB_table_name_photos, $insert_data);
		
		return $this->db->insert_id();
	}
	
	public function addNewClientInDb($data_array) {
		
		/**
		 * 
		 */
		$insert_data = array(
			'first_name'=> $data_array['first_name'],
			'last_name' => $data_array['last_name'],
			'email' 	=> $data_array['email'],
			'country' 	=> $data_array['country'],
			'city' 		=> $data_array['city'],
			'photo' 	=> $data_array['photo_id'],
			'notes'	 	=> ($data_array['notes']) ? $data_array['notes'] : $this -> pageforming -> _locale['add_new_client']['no_notes']
		);

		/**
		 * 
		 */
		$this -> db -> insert($this -> _DB_table_name_clients, $insert_data);
	}
}


























?>