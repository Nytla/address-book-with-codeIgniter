<?php
//http://code-igniter.ru/user_guide/general/models.html

class Welc extends CI_Model {
	
	public function user_data() {
		
		$user_array = array(
		
			'first_name' 	=> 'Igor',
			'last_name'		=> 'Anonim',
			'age'			=> '26',
			'age_two'		=> '27'
		
		);
		
		return $user_array;
	}
	
}

?>