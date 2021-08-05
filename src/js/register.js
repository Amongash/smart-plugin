document.addEventListener("DOMContentLoaded", function (e) {
	let registerForm = document.getElementById("smart-register-form");
	let btn = document.getElementById("submit-register-form");

	registerForm.addEventListener("submit", function (e) {
		e.preventDefault();
		activateSpinner(btn);

		//ajax request
		let url = registerForm.dataset.url;
		console.log(url);
		let params = new URLSearchParams(new FormData(registerForm));

		fetch(url, {
			method: "POST",
			body: params,
		})
			.then((res) => res.json())
			.catch((error) => {
				console.error(error);
			})
			.then((response) => {
				//handle response
				if (response === 0 || response.status === "error") {
					// registerForm.querySelector(".js-form-error").classList.add("show");
					return;
				}
				deactivateSpinner(btn);
				// registerForm.querySelector(".js-form-success").classList.add("show");
				registerForm.reset();
				return;
			});
	});
});

function activateSpinner($btn) {
	$btn.classList.add("spin");
	$btn.disabled = true;
	return;
}

function deactivateSpinner($btn) {
	$btn.classList.remove("spin");
	$btn.disabled = false;
	return;
}
