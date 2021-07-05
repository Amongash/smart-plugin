document.addEventListener("DOMContentLoaded", function (e) {
	let contactForm = document.getElementById("smart-contact-form");

	contactForm.addEventListener("submit", (e) => {
		e.preventDefault();
		//reset the form messages
		resetMessages();
		//collect data
		let data = {
			name: contactForm.querySelector('[name="name"]').value,
			email: contactForm.querySelector('[name="email"]').value,
			message: contactForm.querySelector('[name="message"]').value,
			nonce: contactForm.querySelector('[name="nonce"]').value,
		};
		console.log(data);

		//validate data
		if (!data.name) {
			contactForm
				.querySelector('[data-error="invalidName"]')
				.classList.add("show");
			return;
		}

		if (!data.email) {
			contactForm
				.querySelector('[data-error="invalidEmail"]')
				.classList.add("show");
			return;
		}

		if (!data.message) {
			contactForm
				.querySelector('[data-error="invalidMessage"]')
				.classList.add("show");
			return;
		}

		//ajax request
		let url = contactForm.dataset.url;
		let params = new URLSearchParams(new FormData(contactForm));
		contactForm.querySelector(".js-form-submission").classList.add("show");

		fetch(url, {
			method: "POST",
			body: params,
		})
			.then((res) => res.json())
			.catch((error) => {
				resetMessages();
				contactForm.querySelector(".js-form-error").classList.add("show");
				console.error(error);
			})
			.then((response) => {
				resetMessages();

				//handle response
				if (response === 0 || response.status === "error") {
					contactForm.querySelector(".js-form-error").classList.add("show");
					return;
				}
				contactForm
					.querySelector(".js-form-submission")
					.classList.remove("show");
				contactForm.querySelector(".js-form-success").classList.add("show");
				contactForm.reset();
				return;
			});
	});
});

function resetMessages() {
	document
		.querySelectorAll(".field-msg")
		.forEach((field) => field.classList.remove("show"));
}

function validateEmail(email) {
	let re =
		/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLocaleLowerCase());
}
