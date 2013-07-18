/**
 * @fileoverview This file formed book list for user
 * @author Igor Zhabskiy Zhabskiy.Igor@gmail.com
 * @version 0.1
 */
$(document).ready(function() {
	
//	alert('This is test :-).');

	console.log('Oopsing.');
	
	$("#subm").click(function() {

		var login = $("#login").val();
		
		$.ajax({ 
			type: "POST",
			dataType: "json",
			url: "/index.php/ajaxAuth/checkAuth/",// + login,
			cache: false,
			data: {
				login: login
			},
			success: function(object) {
	
				console.log(object);
				
				/*
				if (object.flag === true) {
					console.log('Yes mama mia');
				} else {
					console.log('No mama');
				}
				*/
			}
		});
	});
	
});