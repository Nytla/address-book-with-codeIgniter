<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Booklistmodel
 * 
 * Enter description here...
 *
 * @version 0.1
 */
class Editclient_model extends CI_Model {
	
	/**
	 * _DB_table_name_clients
	 * 
	 * @var string	This is name of Database
	 */
	private $_DB_table_name_clients;
	
	/**
	 * _DB_table_name_countries
	 * 
	 * @var string	This is name of Database
	 */
	private $_DB_table_name_countries;
	
	/**
	 * _DB_table_name_cities
	 * 
	 * @var string	This is name of Database
	 */
	private $_DB_table_name_cities;
	
	/**
	 * _DB_table_name_photos
	 * 
	 * @var string	This is name of Database
	 */
	private $_DB_table_name_photos;
	
	/**
	 * Construct
	 * 
	 * This function initialize table properties
	 */
	public function __construct() {
		/**
		 * Set variables with name of DB table
		 */
		$this -> _DB_table_name_clients		= $this -> pageforming -> _config['table_name']['clients'];
		$this -> _DB_table_name_countries	= $this -> pageforming -> _config['table_name']['countries'];
		$this -> _DB_table_name_cities		= $this -> pageforming -> _config['table_name']['cities'];
		$this -> _DB_table_name_photos		= $this -> pageforming -> _config['table_name']['photos'];
	}
	
	public function getClientDataFromDB($id) {
		
		$client_id = preg_replace("/([^\d])/", '', $id);
		
		/**
		 * Select client's information
		 */
		$this -> db -> select('first_name, last_name, email, country, city, photo, notes');
		
		$this -> db -> where('id', $client_id);
		
		$query = $this -> db -> get($this -> _DB_table_name_clients);
		
		if ($query -> num_rows() > 0) {
			
			return $query -> result_array();
			
		} else {
			return FALSE;
		}
	}
	
	/**
	 * getAllCountriesFromDB
	 *
	 * This function get all countries from Database
	 *
	 * @param integer $country_id
	 * @return array / boolean
	 */
	public function getAllCountriesFromDB($country_id) {
		
		$country_id = preg_replace("/([^\d])/", '', $country_id);
		
		/**
		 * Select countries
		 */
		$this -> db -> select('country_id, countryname_en');
		
		$this -> db -> order_by('countryname_en', 'ASC');
		
		$query = $this -> db -> get($this -> _DB_table_name_countries);
		
		if ($query -> num_rows() > 0) {
			
			$coutry_array = array();
			
			$selected = ' selected="selected"';
			
			foreach ($query -> result_array() as $row) {
				
				$coutry_array[] = array(
					'country_id' 		=> $row['country_id'],
					'countryname_en'	=> $row['countryname_en'],
					'selected'			=> ($country_id == $row['country_id']) ? $selected : ''
				);
			}
			
			return $coutry_array;
			
		} else {
			return FALSE;
		}
	}
	
	/**
	 * getCitiesFromDB
	 *
	 * This function get all countries from Database
	 *
	 * @param integer $country_id
	 * @param integer $city_id
	 * 
	 * @return array / boolean
	 */
	public function getCitiesFromDB($country_id, $city_id) {
		
		$country_id = preg_replace("/([^\d])/", '', $country_id);
		$city_id = preg_replace("/([^\d])/", '', $city_id);
		
		/**
		 * Get city's data
		 */
		$this -> db -> select('city_id, cityname_en');
		
		$this -> db -> where('country_id', $country_id);
		
		$this -> db -> order_by('cityname_en', 'ASC');
		
		$query = $this -> db -> get($this -> _DB_table_name_cities);
		
		if ($query -> num_rows() > 0) {
			
			$city_array = array();
			
			$selected = ' selected="selected"';
			
			foreach ($query -> result_array() as $row) {
				
				$city_array[] = array(
					'city_id' 		=> $row['city_id'],
					'cityname_en'	=> $row['cityname_en'],
					'selected'		=> ($city_id == $row['city_id']) ? $selected : ''
				);
			}
			
			return $city_array;
			
		} else {
			return FALSE;
		}
	}
	
	/**
	 * getImageDataFromDB
	 * 
	 * This function to get image's data
	 *
	 * @param integer $image_id
	 * @return array / boolean
	 */
	public function getImageDataFromDB($image_id) {
		
		$image_id = ($image_id == 0) ? 1 : preg_replace("/([^\d])/", '', $image_id);
		
		/**
		 * Get image data
		 */
		$this -> db -> select('photo_id, photo_name, photo_height, photo_width, photo_description');
		
		$this -> db -> where('photo_id', $image_id);
		
		$query = $this -> db -> get($this -> _DB_table_name_photos);
		
		if ($query -> num_rows() > 0) {
			
			return $query -> result_array();
			
		} else {
			return FALSE;
		}
	}
	
	/**
	 * editClientDataFromDB
	 * 
	 * This function update client data in SB
	 *
	 * @param arrat $data_array
	 * @return boolean
	 */
	public function editClientDataFromDB($data_array) {
		
		$client_id = preg_replace("/([^\d])/", '', $data_array['client_id']);
		
		if ($client_id) {
		
			/**
			 * Set array with updating data
			 */
			$update_data = array(
				'first_name' 	=> $data_array['first_name'],
				'last_name'  	=> $data_array['last_name'],
				'email' 	 	=> $data_array['email'],
				'country' 		=> $data_array['country'],
				'city' 			=> $data_array['city'],
				'photo'			=> $data_array['photo_id'],
				'notes' 		=> $data_array['notes']
			);
			
			/**
			 * Update client's data
			 */
			$this -> db -> where ('id', $data_array['client_id']);
			
			$this -> db -> update($this -> _DB_table_name_clients, $update_data);
		} else {
			
			return FALSE;
		}
	}
}
?>