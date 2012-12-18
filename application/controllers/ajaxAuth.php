<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AjaxAuth extends CI_Controller {
	
	/**
	 * checkAuth
	 * 
	 * This function check authorization
	 */
	public function checkAuth() {
		
		$login = $_POST['login'];
		
		$flag = (isset($login) and !empty($login)) ? array("flag" => true) : array("flag" => false);

		print json_encode($flag);

//		return json_encode(array($_REQUEST['login']));

//		print json_encode(array("test" => 'gfdd'));
	}
}