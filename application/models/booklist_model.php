<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Booklistmodel
 * 
 * This is book list class
 *
 * @version 0.1
 */
class Booklist_model extends CI_Model {
	
	/**
	 * _DB_table_name_clients
	 * 
	 * @var string	This is name of Database
	 */
	static private $_DB_table_name_clients;

	/**
	 * _DB_table_name_countries
	 * 
	 * @var string	This is name of Database
	 */
	static private $_DB_table_name_countries;

	/**
	 * _DB_table_name_cities
	 * 
	 * @var string	This is name of Database
	 */
	static private $_DB_table_name_cities;

	/**
	 * _DB_table_name_photos
	 * 
	 * @var string	This is name of Database
	 */
	static private $_DB_table_name_photos;

	/**
	 * _DB_table_name_countries_phrases
	 * 
	 * @var string	This is name of Database
	 */
	static private $_DB_table_name_phrases;
	
	/**
	 * Constructor
	 *
	 * This function initialize connect to our Database
	 *
	 * @access public
	 */
	public function __construct() {

		/**
		 * Set variables with name of DB table
		 */
		$this -> _DB_table_name_clients		= $this -> pageforming -> _config['table_name']['clients'];
		$this -> _DB_table_name_countries	= $this -> pageforming -> _config['table_name']['countries'];
		$this -> _DB_table_name_cities		= $this -> pageforming -> _config['table_name']['cities'];
		$this -> _DB_table_name_photos		= $this -> pageforming -> _config['table_name']['photos'];
		$this -> _DB_table_name_phrases		= $this -> pageforming -> _config['table_name']['phrases'];
	}
	
	/**
	 * getClientDataJSON
	 * 
	 * This function to get a data of client 
	 *
	 * @access public
	 * @return array
	 */
	public function getClientDataJSON() {
		
		/**
		 * Create query for mysql
		 */
		$query = $this -> db -> query("
			SELECT 
				`id`,
				`first_name`,
				`last_name`,
				`email`,
				`notes`,
				`countryname_en`,
				`cityname_en`,
				`photo_name`,
				`photo_height`,
				`photo_width`,
				`photo_description`
			FROM 
				{$this -> _DB_table_name_clients}, 
				{$this -> _DB_table_name_countries}, 
				{$this -> _DB_table_name_cities},
				{$this -> _DB_table_name_photos} 
			WHERE 
				{$this -> _DB_table_name_clients}.country = {$this -> _DB_table_name_countries}.country_id
				AND {$this -> _DB_table_name_clients}.city = {$this -> _DB_table_name_cities}.city_id
				AND 
					IF ({$this -> _DB_table_name_clients}.photo = '0', {$this -> _DB_table_name_photos}.photo_id = '1', {$this -> _DB_table_name_clients}.photo = {$this -> _DB_table_name_photos}.photo_id)
		");
		
		/**
		 * Set array with query result
		 */
		$result = $query -> result_array();
		
		/**
		 * Return a data (json) of client 
		 */
		return json_encode($result);
	}
	
	/**
	 * deleteClientFromDB
	 * 
	 * This function to delete a client from DB
	 *
	 * @access public
	 * @param string $client_id
	 * @return string (json)
	 */
	public function deleteClientFromDB($client_id) {

		$this -> db -> where('id', $client_id);
		
		$delete = $this -> db -> delete($this -> _DB_table_name_clients);
		
		return json_encode(array("flag" => $delete));
	}
	
	
	
	/**
	 * getRandomPhrase
	 * 
	 * This function get random phrase from DB
	 *
	 * @access public
	 * @return array
	 */
	public function getRandomPhrase() {

		$this -> db -> order_by('RAND()', '');
		
		$this -> db -> limit('1');

		$query = $this -> db -> get($this -> pageforming -> _config['table_name']['phrases']);
		
		return $query -> result_array();
	}
}