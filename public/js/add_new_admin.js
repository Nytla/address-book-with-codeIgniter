/** 
 * @fileoverview This file add new record of administrator
 * @author Igor Zhabskiy Zhabskiy.Igor@gmail.com
 * @version 0.1
 */
$(document).ready(function() {

//	alert('xcv');
	
	/**
	 * Hide errors
	 */
	$("#login").keypress(function() {
		$('#error_incorect_login')
			.removeClass()
			.addClass("hide");

		$('#error_exists')
			.removeClass()
			.addClass("hide");

		$('#add_good_message')
			.removeClass()
			.addClass("hide");
	});

	$("#pass").keypress(function() {
		$('#error_incorect_pass')
			.removeClass()
			.addClass("hide");
	});

	$("#addAdminForm").submit(function(){
		
		/**
		 * Set object with our login and password
		 */
		var options = { 
			login: $("#login").val(),
			password: $("#password").val(),
			confirm_password: $("#confirm_password").val(),
			admin_permission: $("#admin_permission").val()
		};

		/**
		 * Submit form on ajax
		 */
		$.ajaxes(options);
		
		return false;
	});
});

/**
 * ajaxes This is awesome jQuery plugin.
 *
 * @class ajaxes
 * @param {object} object_options This is options for ajax query
 * @memberOf jQuery.fn
 */
(function($) {
	$.ajaxes = function(object_options) {

		$.ajax({  
			type: "POST",
			dataType: "json",
			url: '/index.php/addnewadmin/ajaxCheckAdminData/',
			cache: false,
			data: object_options,
			success: function(object) {

				if (object.flag == false) {			

					/**
					 * Show error message
					 */
					$('#error_message')
						.removeClass("hide")
						.html(object.error);
				} else {

					/**
					 * Hide form
					 */
					$('#addAdminForm').addClass("hide");
					
					/**
					 * Clear form
					 */
					$("#login").val('');

					$("#pass").val('');

					$("#confirm_pass").val('');

					/**
					 * Show success message
					 */
					$('#add_good_message')
						.removeClass("hide")
						.addClass("success");
				}
			}
		});
	}
})(jQuery);
