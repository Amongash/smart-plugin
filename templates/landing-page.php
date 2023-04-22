<style type="text/css">
    .get-started-overlay {
        position: fixed;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 999;
        display: none;
        width: 100%;
        height: 100%;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.59);
    }

    @media screen and (max-width: 991px) {
        .get-started-overlay {
            z-index: 99999;
        }
    }

    @media screen and (max-width: 479px) {
        .start-shipping-overlay {
            padding-top: 0;
            padding-right: 0;
            padding-left: 0;
            justify-content: flex-start;
        }
    }


    .get-started-popup {
        box-sizing: border-box;
        position: relative;
        z-index: 999;
        display: flex;
        width: 100%;
        max-width: 620px;
        min-height: 500px;
        padding: 20px 40px 10px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 20px;
        background-color: #14171c;
        color: #fff;
    }

    @media screen and (max-width: 479px) {
        .get-started-popup {
            max-height: 100vh;
            min-height: 100vh;
            padding: 40px 20px;
            border-radius: 0;
        }
    }

    .start-shipping-form {
        max-width: 100%;
        margin-right: auto;
        margin-left: auto;
    }

    .w-form {
        margin: 0 0 15px;
    }

    .start-shipping-popup--head {
        max-width: 350px;
        margin-right: auto;
        margin-bottom: 20px;
        margin-left: auto;
        font-size: 18px;
        line-height: 120%;
        font-weight: 700;
        text-align: center;
    }

    .btn-primary {
        display: block;
        width: 100%;
    }

    .btn-popup-close {
        position: absolute;
        left: auto;
        top: 40px;
        right: 24px;
        bottom: auto;
        display: flex;
        width: 30px;
        height: 30px;
        justify-content: center;
        align-items: center;
        filter: invert(100%);
    }

    .text-input {
        display: block !important;
        text-align: center;
    }

    .w-input {
        width: 100%;
        height: 38px;
        margin-bottom: 10px;
        vertical-align: middle;
    }

    .w-inline-block {
        max-width: 100%;
        display: inline-block;
    }

    .form-success-message {
        background-color: transparent;
        padding: 0;
        font-weight: 700;
    }

    .w-form-done {
        text-align: center;
        display: none;
    }

    .spacer {
        width: 100%;
        height: 8px;
    }

    .form-success-t-small {
        font-size: 18px;
        line-height: 120%;
    }

    .w-form-fail {
        background-color: #ffdede;
        margin-top: 10px;
        padding: 10px;
        display: none;
    }

    .fname-error-hero {
        margin-bottom: 10px;
        color: red;
    }

    .email-error-hero {
        margin-bottom: 10px;
        color: red;
    }

    .hide {
        display: none;
    }

    .close-block {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
    }
</style>
<div class="get-started-overlay" id="modal">
    <div class="get-started-popup">
        <div class="start-shipping-form w-form">
            <form id="wf-form-Start-Shipping-Form" name="wf-form-Start-Shipping-Form" data-name="Start Shipping Form"
                method="#" class="form-start-shipping" aria-label="Start Shipping Form">
                <div class="start-shipping-popup--head">
                    <div><img width="200" loading="lazy"
                            src="https://uploads-ssl.webflow.com/60efd1ce3ab7112537596e11/62dc06f22ec145136f1a2d83_shipping-icon.png"
                            alt=""></div>
                    <div>Get our U.S. Address to start shipping now. Or request a quote for items you'd like us to
                        purchase for you.</div>
                </div><input type="text" class="text-input f-fullname-hero w-input" maxlength="256" name="first-name"
                    placeholder="First Name" id="first-name">
                <div class="fname-error-hero hide" id="first-name-error">*Please enter your First Name</div><input type="email"
                    class="text-input f-emailid-hero w-input" maxlength="256" name="email" 
                    placeholder="Enter your email address here" id="email">
                <div class="email-error-hero hide"  id="email-error">*Please enter your email address</div><input type="button" id="email-submit"
                    value="Get our US Address" data-wait="Please wait..."
                    class="btn-primary btn-get-started-hero w-button">
            </form>
            <div class="form-success-message w-form-done" tabindex="-1" role="region"
                aria-label="Start Shipping Form success">
                <div><img
                        src="https://uploads-ssl.webflow.com/60efd1ce3ab7112537596e11/62dc06f2e724d718b044d0d8_done-icon.png"
                        loading="lazy" width="100" alt="">
                    <div class="spacer"></div>
                    <div>Great <span class="popup__first-name">{first name}</span>!</div>
                    <div class="spacer"></div>
                    <div class="form-success-t-small">Need to shop online or ship a package now? Use our US address
                        shown below:</div>
                    <div class="success-message-details">
                        <div>Your First &amp; Last name</div>
                        <div>Street Address: 17401 Nichols Ln SUITE J</div>
                        <div>City: Huntington Beach</div>
                        <div>State: California (CA)</div>
                        <div>Zip Code: 92647</div>
                    </div>
                    <div class="form-success-t-small weight-n">Once your package has been shipped by the sender,
                        create a Savo Store account to provide us with the tracking number and recipient's name. You
                        can start shopping and shipping now and then create your account later.</div>
                    <div class="form-success-t-small">Want us to shop for you? Click on the button below to request
                        a Buy &amp; Ship quote.</div>
                    <div class="spacer _24"></div><a href="#" class="btn-form-finish xl w-button">Request a Buy
                        &amp; Ship Quote</a>
                </div>
            </div>
            <div class="w-form-fail" tabindex="-1" role="region" aria-label="Start Shipping Form failure">
                <div>Oops! Something went wrong while submitting the form.</div>
            </div>
        </div>
        <span id="close-modal" href="#" class="btn-popup-close"><img
                src="https://uploads-ssl.webflow.com/60efd1ce3ab7112537596e11/60efd1ce3ab7118424596e9a_icon-close.svg"
                loading="lazy" width="20" alt=""></span>
        <!-- <div class="close-block"></div> -->
    </div>
</div>