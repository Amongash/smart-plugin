(function ($) {
	$(".add_list_item").click(function () {
		let clone = $("#template").clone(true);
		clone = clone.removeAttr("id").removeAttr("style");
		clone.insertBefore("#template");
	});

	$(".delete_list_item").click(function () {
		let parent = $(this).parent().parent();
		if ($(".gfield_list_group").length === 2) return;
		parent.remove();
	});
})(jQuery);
