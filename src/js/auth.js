document.addEventListener("DOMContentLoaded", function (e) {
	const showAuthBtn = document.getElementById("smart-show-auth-form"),
		authContainer = document.getElementById("smart-auth-container"),
		close = document.getElementById("smart-auth-close");

	showAuthBtn.addEventListener("click", () => {
		authContainer.classList.add("show");
		showAuthBtn.parentElement.classList.add("hide");
	});

	close.addEventListener("click", () => {
		authContainer.classList.remove("show");
		showAuthBtn.parentElement.classList.remove("hide");
	});
});
