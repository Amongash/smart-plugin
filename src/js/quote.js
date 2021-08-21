import { activateSpinner, deactivateSpinner } from "./helpers";
(function ($) {
	$(".add_list_item").click(function () {
		let clone = $("#template").clone(true);
		clone = clone
			.removeAttr("id")
			.removeAttr("style")
			.attr("id", "list_items")
			.attr("class", "gfield_list_row gfield_list_group list_items");
		clone.insertBefore("#template");
	});

	$(".delete_list_item").click(function () {
		let parent = $(this).parent().parent();
		let container = $(".list_items");
		if (container.length === 1) return;
		parent.remove();
	});

	$("#submit-quote-form").click(function () {
		let $btn = $(this);
		activateSpinner($btn);
		submit();
	});

	function submit() {
		let items = 0;
		$.each($("#list_items"), function () {
			items++;
		});

		// var issue_date = retrieveFormValues("issue_date");
		// var location = retrieveFormValues("location");
		// var voucher = retrieveFormValues("voucher");

		// var vaccines = retrieveFormValues_Array("vaccine");
		// var batch_no = retrieveFormValues_Array("batch_no");
		// var expiry_date = retrieveFormValues_Array("expiry_date");
		// var vvm = retrieveFormValues_Array("vvm");
		// var quantity = retrieveFormValues_Array("stock_quantity");
		// var issue_quantity = retrieveFormValues_Array("issue_quantity");

		// var dat = new Array();

		// for (var i = 0; i < vaccine_count; i++) {
		// 	var data = new Array();
		// 	var get_vaccine = vaccines[i];
		// 	var get_batch = batch_no[i];
		// 	var get_expiry = expiry_date[i];
		// 	var get_issue_quantity = issue_quantity[i];
		// 	var get_quantity = quantity[i];
		// 	var get_vvm = vvm[i];

		// 	data = {
		// 		vaccine_id: get_vaccine,
		// 		batch_no: get_batch,
		// 		expiry_date: get_expiry,
		// 		issue_quantity: get_issue_quantity,
		// 		quantity: get_quantity,
		// 		vvm: get_vvm,
		// 	};

		// 	dat.push(data);
		// }

		// batch = JSON.stringify(dat);
		// $.ajax({
		// 	url: $("#single").attr("action"),
		// 	type: "POST",
		// 	data: {
		// 		issued_to: location,
		// 		voucher: voucher,
		// 		issue_date: issue_date,
		// 		batch: batch,
		// 	},
		// 	beforeSend: function () {
		// 		$("#validate").fadeOut(300, function () {
		// 			$(this).remove();
		// 		});
		// 	},

		// 	success: function (data, textStatus, jqXHR) {
		// 		console.log(data);
		// 	},

		// 	error: function (jqXHR, textStatus, errorThrown) {
		// 		//if fails
		// 	},
		// });
	}
})(jQuery);
