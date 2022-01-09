import { hideForm, showPageLoader } from "./helpers";

// Wait for the DOM to be ready
(function ($) {
	let registerForm = $("#smart-register-form");
	let message = $("#smart-message-container");
	let overlay = $(".overlay");
	let loader = $(".lds-ellipsis");
	// Initialize form validation on the registration form.
	$("#smart-register-form").validate({
		// Specify validation rules
		rules: {
			first_name: "required",
			last_name: "required",
			email: {
				required: true,
				// Specify that email should be validated by the built-in "email" rule
				email: true,
			},
			phone: {
				required: true,
				number: true,
			},
		},
		// Specify validation error messages
		messages: {
			first_name: "Please enter your first name.",
			last_name: "Please enter your last name.",
			phone: {
				required: "Please provide a valid phone number.",
			},
			email: "Please enter a valid email address.",
			gender: "Please select your gender.",
			agreement: "Please accept the user agreement to proceed.",
		},
		errorPlacement: (error, element) => {
			if (element.is(":radio")) error.appendTo(element.parents(".gender"));
			else if (element.is(":checkbox"))
				error.insertAfter(element.parents(".checkbox-group"));
			else error.insertAfter(element);
		},
		// Submit the form
		submitHandler: function () {
			$.ajax({
				url: registerForm.data("url"),
				type: "POST",
				data: new FormData(registerForm[0]),
				processData: false,
				contentType: false,
				beforeSend: function () {
					showPageLoader(overlay, loader);
				},
				success: function (data, status) {
					if (status !== "success") return;
					hideForm(registerForm, overlay, loader, message);

					// hideLoaderShowResponse(overlay, loader);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//if fails
					// console.log(errorThrown);
				},
			});
		},
	});

	$.validator.methods.phone = function (value, element) {
		return this.optional(element) || /^(\+254-|\+254|0)?\d{10}$/.test(value);
	};
})(jQuery);
