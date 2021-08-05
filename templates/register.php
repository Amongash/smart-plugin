<div>
    <form id="smart-register-form" action="#" method="post" data-url="<?php echo admin_url("admin-ajax.php"); ?>">
        <div>
            <label for="first_name">First Name<span class="input-required">*</span></label>
            <div class="field-container">
                <input type="text" placeholder="First Name" class="form-control" name="first_name" access="false" id="first_name" title="First Name" required="required" aria-required="true">
            </div>
        </div>
        <div>
            <label for="last_name">Last Name<span class="input-required">*</span></label>
            <div class="field-container">
                <input type="text" placeholder="Last Name" class="form-control" name="last_name" access="false" id="last_name" title="Last Name" required="required" aria-required="true">
            </div>
        </div>

        <div>
            <label for="phone">Phone<span class="input-required">*</span></label>
            <div class="field-container">
                <input type="text" placeholder="Phone" class="form-control" name="phone" access="false" id="phone" title="Phone" required="required" aria-required="true">
            </div>
        </div>
        <div>
            <label for="email">Email<span class="input-required">*</span></label>
            <div class="field-container">
                <input type="text" placeholder="Email" class="form-control" name="email" access="false" id="email" title="Email" required="required" aria-required="true">
            </div>
        </div>

        <div>
            <label for="gender">Gender<span class="input-required">*</span></label>
            <div class="field-container">
                <div class="radio-group">

                    <input name="gender" access="false" id="gender-0" required="required" aria-required="true" value="male" type="radio">
                    <label for="male">Male</label>

                    <input name="gender" access="false" id="gender-1" required="required" aria-required="true" value="female" type="radio">
                    <label for="female">Female</label>
                </div>
            </div>
        </div>

        <div>
            <label for="agreement" class="checkbox-group-label">User Agreement<span class="input-required">*</span><span class="tooltip-element" tooltip="User Agreement">?</span></label>
            <div class="field-container">
                <div class="checkbox-group">
                    <div class="checkbox-inline">
                        <input name="agreement" access="false" id="agreement" required="required" aria-required="true" type="checkbox">
                        <label for="agreement">I accept the terms &amp; conditions as well as the privacy policy.</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="field-container text-center">
            <div>
                <button id="submit-register-form" type="submit" class="btn btn-default btn-lg btn-sunset-form"><span class="spinner"></span>Submit</button>
            </div>
        </div>

        <input type="hidden" name="action" value="submit_register">
        <input type="hidden" name="register-nonce" value="<?php echo wp_create_nonce("register-nonce"); ?>">
    </form>
</div>