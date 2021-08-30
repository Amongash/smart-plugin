import { hideForm, showPageLoader } from "./helpers";
(function ($) {
	let registerForm = $("#smart-register-form");
	let message = $("#smart-message-container");
	let btn = $("#smart-submit");
	let overlay = $(".overlay");
	let loader = $(".lds-ellipsis");

	btn.on("click", function (e) {
		e.preventDefault();

		var first_name = retrieveFormValues("first_name");
		var last_name = retrieveFormValues("last_name");
		var phone = retrieveFormValues("phone");
		var email = retrieveFormValues("email");
		var gender = retrieveFormValues("gender");
		var agreement = retrieveFormValues("agreement");

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
				console.log(errorThrown);
			},
		});
	});

	function retrieveFormValues(name) {
		var value;
		$.each(
			$("input[name=" + name + "], select[name=" + name + "]"),
			function (i, v) {
				var theElement = $(v);
				var theValue = theElement.val();
				value = theValue;
			}
		);
		return value;
	}
})(jQuery);

// document.addEventListener("DOMContentLoaded", function (e) {
// 	let registerForm = document.getElementById("smart-register-form");
// 	let btn = document.getElementById("submit-register-form");

// 	registerForm.addEventListener("submit", function (e) {
// 		e.preventDefault();
// 		activateSpinner(btn);

// 		//ajax request
// 		let url = registerForm.dataset.url;
// 		console.log(url);
// 		let params = new URLSearchParams(new FormData(registerForm));

// 		fetch(url, {
// 			method: "POST",
// 			body: params,
// 		})
// 			.then((res) => res.json())
// 			.catch((error) => {
// 				console.error(error);
// 			})
// 			.then((response) => {
// 				//handle response
// 				if (response === 0 || response.status === "error") {
// 					// registerForm.querySelector(".js-form-error").classList.add("show");
// 					return;
// 				}
// 				deactivateSpinner(btn);
// 				// registerForm.querySelector(".js-form-success").classList.add("show");
// 				registerForm.reset();
// 				return;
// 			});
// 	});
// });
