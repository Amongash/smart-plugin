<div id="smart-page-container">
    <form class="smart-register-form" id="smart-register-form" method="post" action="<?php echo admin_url('admin-ajax.php') ?>" target="_top" on="submit-success: AMP.setState({'isHidden': event.response.success})">
        <div submitting class="submit-msg success">
            <template type="amp-mustache">
                Creating account...
            </template>
        </div>
        <div submit-success class="submit-msg success">
            <template type="amp-mustache">
                Thank you for signing up. Please check your email for further instructions.
            </template>
        </div>
        <div submit-error class="submit-msg error">
            <template type="amp-mustache">
                {{message}}
            </template>
        </div>
        <div [hidden]="isHidden">
            <div class="details">
                <div class="user-details">
                    <div>
                        <label for="first_name">First Name<span class="input-required">*</span></label>
                        <input type="text" placeholder="First Name" class="form-control" name="first_name" id="first_name" title="First Name" required aria-required="true">
                    </div>
                    <div>
                        <label for="last_name">Last Name<span class="input-required">*</span></label>
                        <input type="text" placeholder="Last Name" class="form-control" name="last_name" id="last_name" title="Last Name" required aria-required="true">
                    </div>
                </div>
            </div>

            <div class="details">
                <div class="user-details">
                    <div>
                        <label for="phone">Phone<span class="input-required">*</span></label>
                        <input type="text" placeholder="+254" class="form-control" name="phone" id="phone" title="Phone" required aria-required="true">
                    </div>
                    <div>
                        <label for="email">Email<span class="input-required">*</span></label>
                        <input type="text" placeholder="Email" class="form-control" name="email" id="email" title="Email" required aria-required="true">
                    </div>
                </div>
            </div>

            <div class="details">
                <div class="gender">
                    <label for="gender">Gender<span class="input-required">*</span></label>
                    <div>
                        <input class="choice-input" name="gender" id="gender-male" required aria-required="true" value="male" type="radio">
                        <label for="male">Male</label>
                    </div>

                    <div>
                        <input class="choice-input" name="gender" id="gender-female" required aria-required="true" value="female" type="radio">
                        <label for="female">Female</label>
                    </div>
                </div>
            </div>

            <div class="user-agreement">
                <label for="agreement" class="checkbox-group-label">User Agreement?<span class="input-required">*</span></label>
                <div class="checkbox-group">
                    <div class="checkbox-inline">
                        <input class="choice-input" name="agreement" id="agreement" required aria-required="true" type="checkbox">
                        <label for="agreement">I agree to the <a class="conditions" href="/terms-and-conditions">Terms &amp; Conditions</a> &amp; <a class="conditions" href="/privacy-policy">Privacy Policy</a>.</label>
                    </div>
                </div>

            </div>

            <div class="field-container text-center">
                <div class="submit-button">
                    <button id="smart-submit" type="submit" class="submit-register-form">Create Account</button>
                </div>
            </div>

            <input type="hidden" name="action" value="submit_register">
            <input type="hidden" name="register-nonce" value="<?php echo wp_create_nonce("register-nonce"); ?>">
        </div>
    </form>
</div>