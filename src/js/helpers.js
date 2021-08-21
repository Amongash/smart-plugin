export function showPageLoader($overlay, $loader) {
	$overlay.show().css({
		opacity: 0.7,
		width: "100%",
		height: "100%",
	});
	$loader.attr("style", "display:block");
}

export function hideLoaderShowResponse($overlay, $loader) {
	$overlay.hide();
	$loader.attr("style", "display:none");
}

export function activateSpinner($btn) {
	$btn.attr("class", "spin");
	$btn.prop("disabled", true);
	return;
}

export function deactivateSpinner($btn) {
	$btn.removeAttr("class", "spin");
	$btn.prop("disabled", false);
	return;
}
export function retrieveFormValues(name) {
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
export function retrieveFormValues_Array(name) {
	var value = new Array();
	var counter = 0;
	$.each(
		$("input[name=" + name + "], select[name=" + name + "]"),
		function (i, v) {
			var theElement = $(v);
			var theValue = theElement.val();
			value[counter] = theValue;
			counter++;
		}
	);
	return value;
}

export function hideForm($form, $overlay, $loader, $message) {
	if (!$form) return;
	$form.fadeOut(3000, function () {
		hideLoaderShowResponse($overlay, $loader);
		$form.remove();
		$message.attr("style", "display:block");
	});
}
