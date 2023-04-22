document.addEventListener("DOMContentLoaded", function (e) {
	// Get the modal
	let modal = document.getElementById("modal");

	// Get the button that opens the modal
	let btn = document.getElementById("get-started-button");

	// Get the <span> element that closes the modal
	let span = document.getElementById("close-modal");

	// When the user clicks on the button, open the modal
	btn.onclick = function () {
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

	const submitBtn = document.getElementById("email-submit");

	submitBtn.addEventListener("click", (event) => {
		event.preventDefault(); // prevent default form submission
		console.log("Submit button clicked");
	});

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
