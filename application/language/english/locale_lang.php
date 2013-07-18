<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| English Locale
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
*/
$lang = array(
	'english' => array(
	
		'site'						=> array(
			'name' 					=> 'Address Book',
			'year' 					=> 2013
		),
		
		'noscript'					=> array(
			'message'				=> 'Your browser does not support JavaScript or JavaScript has been disabled!'
		),
		
		'user_book_list'=> array(
			'title' 				=> 'Public Adress Book List'
		), 
		
		'book_list' 	=> array(
			'title' 				=> 'Admin: Adress Book List',
			'login'					=> 'Login',
			'search_word'			=> 'Search',
			'keywords_word'			=> 'Keywords',
			'id_word'				=> 'ID',
			'name_word'				=> 'Name',
			'country_word'			=> 'Country',
			'city_word'				=> 'City',
			'action_word'			=> 'Action',
			'preloader_text'		=> 'Loading...',
			'add_new_client'		=> 'Add New Client',
			'details_open'			=> 'Details open',
			'details_close'			=> 'Details close',
			'back_to_page_layout' 	=> 'Back to the Page Layout'

		),
		
		'authorization'	=> array(
			'title'					=> 'Admin: Login',
			'auth'					=> 'Authorization',
			'login'					=> 'Login:',
			'password'				=> 'Password:',
			'login_button'			=> 'Login',
			'error_empty'			=> 'Login or password is empty.',
			'error_captcha'			=> 'You did not validate captcha.',
			'error_incorect'		=> '<div class="error">Login or password is incorrect.</div>'
		),
		
		'layout'	=> array(
			'title'					=> 'Admin: Page Layout',
			'log_out'				=> 'Log Out',
			'add_admin'				=> 'Add New Admin',
			'content'				=> 'Welcome to the Admin Panel, '
		),
		
		'add_new_client'=> array(
			'title'					=> 'Admin: Add New Client',
			'page_name'				=> 'Add New Client',
			'first_name'			=> 'First Name:',
			'last_name'				=> 'Last Name:',
			'email'					=> 'Email:',
			'country'				=> 'Country:',
			'city'					=> 'City:',
			'empty_option'			=> '::ALL::',
			'photo'					=> 'Photo:',
			'thumbnail_photo'		=> 'Thumbnail photo',
			'preview'				=> 'Preview',
			'notes'					=> 'Notes:',
			'no_notes'				=> 'No information available.',
			'reset'					=> 'Reset',
			'back_to_book_list'		=> 'Back to the Address Book',
			'mess_max_length_notes' => '(1500 characters max.)',
			'add_good_message'		=> 'The new client has been added to the database.',
			'save'					=> 'Save',
		),
		
		'edit_client'=> array(
			'title'					=> 'Admin: Edit Client',
			'page_name'				=> 'Edit Client',
		),
		
		'add_new_admin'=> array(
			'title'					=> 'Admin: Add New Admin',
			'page_name'				=> 'Add New Admin',
			'layout'				=> 'Page Layout',
			'content'				=> 'Add New Administrator',
			'login'					=> 'Login',
			'password'				=> 'Password',
			'confirm_password'		=> 'Confirm password',
			'administrator'			=> 'Administrator',
			'admin_exists'			=> 'Adminitsrator with this login already exists.',
			'add_good_message'		=> 'The new administrator has been added to the database.'
		)
	)
);