document.addEventListener("DOMContentLoaded", function (e) {
	console.log("Script loaded successfully");
	// Get the modal
	const modal = document.getElementById("modal");

	// Get the button that opens the modal
	const getStartedBtn = document.getElementById("get-started-button");

	// Get the next button
	const nextBtn = document.getElementById("next-btn");

	// Get the message button
	const messageBtn = document.getElementById("message-btn");

	// Get the <span> element that closes the modal
	const span = document.getElementById("close-modal");

	// Get the message form
	const messageForm = document.getElementById("send-message-form");

	// Get the start shipping form
	const shippingForm = document.getElementById("start-shipping-form");

	// Get the success message form
	const successMessageForm = document.getElementById("success-message-form");

	// When the user clicks on the next button, display the message form
	nextBtn.addEventListener("click", () => {
		// Get the forms and change display styling
		shippingForm.style.display = "none";
		successMessageForm.style.display = "block";
	});

	messageBtn.addEventListener("click", () => {
		const baseURL = window.location.origin; // Get the base URL
		const contactURL = new URL("contact", baseURL); // Construct the new URL
		window.location.href = contactURL.href;
	});

	// When the user clicks on the button, open the modal
	getStartedBtn.onclick = function () {
		modal.style.display = "flex";
	};

	// When the user clicks on <span> (x), close the modal
	span.onclick = function () {
		modal.style.display = "none";
	};

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function (event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	};

	// When the user clicks on the "next" button, display the form
	nextBtn.onclick = function () {
		modal.style.display = "flex";
	};

	const emailInput = document.getElementById("email");
	const emailError = document.getElementById("email-error");
	emailInput.addEventListener("blur", () => {
		const email = emailInput.value;
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

		if (!emailRegex.test(email)) {
			emailError.style.display = "block";
		} else {
			emailError.style.display = "none";
		}
	});

	const fNameInput = document.getElementById("first-name");
	const fNameError = document.getElementById("first-name-error");

	fNameInput.addEventListener("blur", () => {
		const fName = fNameInput.value;

		if (fName == "" || fName.length < 3) {
			fNameError.style.display = "block";
		} else {
			fNameError.style.display = "none";
		}
	});
});
