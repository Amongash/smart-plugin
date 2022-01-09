export function showPageLoader($overlay, $loader) {
	$overlay.fadeIn("slow");
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
export function hideForm($form, $overlay, $loader, $message) {
	if (!$form) return;
	$form.fadeOut(3000, function () {
		hideLoaderShowResponse($overlay, $loader);
		$form.fadeOut("fast");
		$message.attr("style", "display:block");
	});
}
