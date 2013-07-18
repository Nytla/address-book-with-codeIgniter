/** 
 * @fileoverview This file validate authorization data
 * @author Igor Zhabskiy Zhabskiy.Igor@gmail.com
 * @version 0.1
 */
$(document).ready(function() {

	/**
	 * Hide errors messages
	 */
	$("[name ^= 'value']").keypress(function() {
		
		$('#error_empty')
			.removeClass()
			.addClass("hide");

		$('#error_capcha')
			.removeClass()
			.addClass("hide");
	});

	/**
	 * Submit authorization form on Ajax
	 */
	$("#authForm").submit(function() {
		
		/**
		 * Set variables
		 */
		var login = $("#login").val();
		
		var password = $("#password").val();
		
		var captcha = $("#hide").val();
		
		/**
		 * If login or password is empty than return error message
		 */
		if(login == '' || password == '') {

			$('#error_empty')
				.removeClass()
				.addClass("error");
			
			return false;
		}

		/**
		 * If input hidden was introduced then view error 
		 */
		if (captcha !== '') {

			$('#error_capcha')
				.removeClass()
				.addClass("error");

			return false;
		}
	});
});