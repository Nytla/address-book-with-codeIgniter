/** 
 * @fileoverview This file add new record of client
 * @author Igor Zhabskiy Zhabskiy.Igor@gmail.com
 * @version 0.1
 */
$(document).ready(function() {

	/**
	 * Set width for select country element
	 */
	$("#country").css("width", "235");

	/**
	 * Create select list for our cities when page loaded
	 */
	var option_selected = $("#country option:selected").val();

	var option_selected_city = $("#city option:selected").val();
	
	if (option_selected != "") {

		/**
		 * Set object with our options (country id)
		 */
		var object_options = {
			module:		'cities_formed',
			file_name:	'cities_formed.php',
			data:		{ 
				country_id: option_selected,
				city_id: option_selected_city
			}
		};

		/**
		 * Get cities from DB
		 */
		$.ajaxes(object_options);
	}

	/**
	 * Create select list for our cities
	 */
	$("#country").change(function() {

		/**
		 * Set object with our options (country id)
		 */
		var object_options = {
			module:		'cities_formed',
			file_name:	'cities_formed.php',
			data:		{ country_id: this.value }
		};

		/**
		 * Get cities from DB
		 */
		$.ajaxes(object_options);
	});

	/**
	 * Clear our forms
	 */
	$("#reset_forms").click(function() {
		$("#InformationForm, #NotesForm").clearForm();
	});

	/**
	 * Validate form with informatons
	 */

	/**
	 * Action or disabled input file button Upload
	 */
	$.InputFileButton();
	

	$("#upload_photo").click(function() {
		
		$.uploadImage();
	});
	

	/**
	 * Submit all forms
	 */
	$("#save").click(function() {

		var form_data = $("#InformationForm").serialize() +'&'+ $("#NotesForm").serialize();

		$.validateForm(form_data);

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
	$.validateForm = function(data) {

		$.ajax({
			type: "POST",
			dataType: "json",
			url: '/index.php/addnewclient/ajaxCheckClientData/',
			cache: false,
			data: data,
			success: function(object) {
				
				$("#photo_id").val('');
				
				if (object.flag == false) {
					
					$("#validate_errors").html(object.error);
					
				} else {
					
					$("#validate_errors").html('');
					
					$("#InformationForm, #NotesForm").clearForm();

					/**
					 * Hide our forms
					 */
					$('#forms_content').addClass("hide");

					/**
					 * Show success message
					 */
					$('#add_good_message')
						.removeClass("hide")
						.html(object.message);
				}
				
			}
		});
	}
})(jQuery);

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
			url: '/index.php/addnewclient/ajaxCitiesJSON/',
			cache: false,
			data: object_options.data,
			success: function(object) {

				switch(object_options.module) {

					case 'cities_formed':

						/**
						 * Set select element width
						 */
						$("#city").css("width", "235");

						/**
						 * Delete all options element, but not first
						 */
						$("#city option").remove();

						$("#city").append(new Option('::ALL::', ''));

						/**
						 * Create options element for sity list
						 */
						$.each(object.cities, function(index, value) {
							
							var city_id = $("#city_id").val();
							
							if (city_id == index) {
							
								$("#city").append(new Option(value, index, true));
							} else {
								
								$("#city").append(new Option(value, index));
							}
						});
					break;
				}
			}
		});
	}
})(jQuery);

/**
 * uploadPhoto This is awesome jQuery plugin which upload client photo
 *
 * @class uploadPhoto
 * @memberOf jQuery.fn
 */
(function($) {
	$.uploadImage = function() {

		/**
		 * Upload image and preview if form (#ImagesForm) submited
		 */
		$("#ImagesForm").submit(function() {
			
			$(this).ajaxSubmit({
				
				method : 'POST',
				dataType:  'json', 
				url: '/index.php/addnewclient/ajaxUploadImages/',
				beforeSend: function() {
	
					/**
					 * Disable upload button
					 */
					$("#save").attr("disabled", "disabled");
	
					/**
					 * show progressbar
					 */
					$("#preloader").removeClass('hide');
	
					/**
					 * Hide error message
					 */
					$("#errors_image").addClass('hide');
				},
				complete: function(data) {
					
					/**
					 * Disable "Upload" button
					 */
					$("#upload_photo").attr("disabled", "disabled");
	
					/**
					 * Hide progressbar
					 */
					$("#preloader").addClass('hide');
					
				},
				success: function(object) {
					
					/**
					 * 
					 */
					if (object.flag == false) {
						
						/**
						 * 
						 */
						$("#preview_photo").html('');
						$("#photo_id").val('');
						
						/**
						 * Print error message
						 */
						$("#errors_image")
							.removeClass('hide')
							.addClass('error')
							.html(object.error);

					} else {
					
						$("#validate_errors").html('');
						
						/**
						* Enable submit button
						*/
						$("#save").removeAttr("disabled");
						
						/**
						* Preview client photo
						*/
						$("#preview_photo")
							.html('')
							.append('<img>');
						
						$("#preview_photo img")	
							.attr("width", object.image_width)
							.attr("height", object.image_height)
							.attr("src", object.image_name)
							.attr("alt", object.image_alt)
							.attr("id", object.image_id)
							.parent()
							.slideDown();
						
						$("#photo_id").val(object.image_id);
					}
				}
			}); 
			
			return false;
		});
	}
})(jQuery);

/**
 * InputFileButton This is jQuery plugin which enabled or disabled upload photo button
 *
 * @class InputFileButton
 * @memberOf jQuery.fn
 */
(function($) {
	$.InputFileButton = function() {

		var img_path = $("#image_file").val();

		if (img_path != "") {
			$("#upload_photo").removeAttr("disabled");
		}

		$("#image_file").change(function(img_path) {

			if (img_path != "") {
				$("#upload_photo").removeAttr("disabled");

			}
		});
	}
})(jQuery);