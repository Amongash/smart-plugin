<div id="smart-page-container">
	<div class="header-text">
		<p class="has-neve-link-hover-color-color has-text-color"> Fill in the form and we’ll get in touch.</p>
	</div>

	<div>
		<form id="smart-contact-form" action="#" method="post" data-url="<?php echo admin_url("admin-ajax.php"); ?>">

			<div class="user-input">
				<div>
					<label for="name">Full Name<span class="input-required">*</span></label>
					<input type="text" class="field-input" placeholder="Full Name" id="name" name="name" required>
					<small class="field-msg error" data-error="invalidName">Your Name is Required</small>
				</div>

				<div>
					<label for="email">Email<span class="input-required">*</span></label>
					<input type="email" class="field-input" placeholder="Email" id="email" name="email" required>
					<small class="field-msg error" data-error="invalidEmail">Your Email is Required</small>

				</div>
			</div>

			<div class="user-input">
				<div>
					<label for="message">Message<span class="input-required">*</span></label>
					<textarea name="message" id="message" class="field-input" placeholder="Message" required></textarea>
					<small class="field-msg error" data-error="invalidMessage">A Message is Required</small>
				</div>
			</div>

			<div class="field-container text-center">
				<div class="submit-button">
					<button type="submit" class="submit-contact-form">Submit</button>
				</div>
				<small class="submit-msg js-form-submission">Submission in process, please wait&hellip;</small>
				<small class="submit-msg success js-form-success">Message Successfully submitted, thank you!</small>
				<small class="submit-msg error js-form-error">There was a problem with the Contact Form, please try again!</small>
			</div>

			<input type="hidden" name="action" value="submit_contact">
			<input type="hidden" name="nonce" value="<?php echo wp_create_nonce("contact-nonce"); ?>">
		</form>
	</div>

</div>