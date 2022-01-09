import { hideForm, showPageLoader } from "./helpers";
(function ($) {
	let quoteForm = $("#smart-quote-form");
	let message = $("#smart-message-container");
	let overlay = $(".overlay");
	let loader = $(".lds-ellipsis");

	function collectData() {
		let items = 0;
		$(".list_items").each(function () {
			items++;
		});

		var first_name = retrieveFormValues("first_name");
		var last_name = retrieveFormValues("last_name");
		var phone = retrieveFormValues("phone");
		var email = retrieveFormValues("email");
		var confirm_email = retrieveFormValues("confirm_email");
		var service = retrieveCheckboxValues_Array("service");
		var product_name = retrieveFormValues_Array("product_name");
		var product_link = retrieveFormValues_Array("product_link");
		var product_option = retrieveFormValues_Array("product_option");
		var product_quantity = retrieveFormValues_Array("product_quantity");
		var other_info = retrieveFormValues("other_info");
		var nonce = retrieveFormValues("nonce");
		var products = [];
		for (var i = 0; i < items; i++) {
			var get_name = product_name[i];
			var get_link = product_link[i];
			var get_option = product_option[i];
			var get_quantity = product_quantity[i];

			let data = {
				name: get_name,
				link: get_link,
				options: get_option,
				quantity: get_quantity,
			};

			products.push(data);
		}

		return {
			first_name: first_name,
			last_name: last_name,
			phone: phone,
			email: email,
			confirm_email: confirm_email,
			service: service,
			products,
			other_info: other_info,
			nonce: nonce,
			action: "submit_quote",
		};
	}

	// Initialize form validation on the registration form.
	$("#smart-quote-form").validate({
		// Submit the form
		submitHandler: function () {
			const data = collectData();
			$.ajax({
				url: quoteForm.data("url"),
				type: "POST",
				data: data,
				beforeSend: function () {
					showPageLoader(overlay, loader);
				},
				success: function (data, status) {
					if (status !== "success") return;
					hideForm(quoteForm, overlay, loader, message);

					// hideLoaderShowResponse(overlay, loader);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//if fails
					// console.log(errorThrown);
				},
			});
		},
	});

	$(".add_list_item").on("click", function () {
		let clone = $("#template").clone(true);
		clone = clone
			.removeAttr("id")
			.removeAttr("style")
			.attr("id", "list_items")
			.attr("class", "gfield_list_row gfield_list_group list_items");
		clone.insertBefore("#template");
	});

	$(".delete_list_item").on("click", function () {
		let parent = $(this).parent().parent();
		let container = $(".list_items");
		if (container.length === 1) return;
		parent.remove();
	});

	$.validator.methods.phone = function (value, element) {
		return this.optional(element) || /^(\+254-|\+254|0)?\d{10}$/.test(value);
	};

	function retrieveFormValues_Array(name) {
		var value = new Array();
		var counter = 0;

		$("input[name=" + name + "], select[name=" + name + "]").each(function (
			i,
			v
		) {
			var theElement = $(v);
			var theValue = theElement.val();
			value[counter] = theValue;
			counter++;
		});
		return value;
	}

	function retrieveCheckboxValues_Array(name) {
		var value = new Array();
		var counter = 0;

		$("input[name=" + name + "][type=checkbox]:checked").each(function (i, v) {
			var theElement = $(v);
			var theValue = theElement.val();
			value[counter] = theValue;
			counter++;
		});
		return value;
	}

	function retrieveFormValues(name) {
		var value;
		$(
			"input[name=" +
				name +
				"], select[name=" +
				name +
				"], textarea[name=" +
				name +
				"]"
		).each(function (i, v) {
			var theElement = $(v);
			var theValue = theElement.val();
			value = theValue;
		});
		return value;
	}
})(jQuery);
