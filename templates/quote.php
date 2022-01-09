<div class="plugin-container">
    <div class="overlay" style="display: none">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="smart-message-container" class="animate-bottom">
        <h6 class="success-message">Thank you for your submission. We'll review the information provided and get back to you as soon as possible.</h6>
    </div>
    <div>
        <form action="#" id="smart-quote-form" method="post" data-url="<?php echo admin_url("admin-ajax.php"); ?>">
            <div class="gform_wrapper">
                <div class="gform_fields">
                    <div class="gfield ">
                        <fieldset>
                            <legend class="gfield_label gfield_label_before_complex">
                                Your Name
                                <span class="gfield_required">
                                    <span class="gfield_required gfield_required_text">(Required)</span>
                                </span>
                            </legend>
                            <div class="ginput_complex ginput_container no_prefix has_first_name no_middle_name has_last_name no_suffix gf_name_has_2 ginput_container_name">
                                <span class="name_first">
                                    <input type="text" name="first_name" id="first_name" value="" aria-label="First name" aria-required="true" placeholder="First name">
                                    <label for="first_name">First Name</label>
                                </span>
                                <span class="name_last">
                                    <input type="text" name="last_name" id="last_name" value="" aria-label="Last name" aria-required="true" placeholder="Last name">
                                    <label for="last_name">Last Name</label>
                                </span>
                            </div>
                        </fieldset>
                    </div>
                    <div class="gfield gfield--width-full gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                        <label class="gfield_label" for="phone">Your Phone Number
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_text">(Required)</span>
                            </span>
                        </label>
                        <div class="ginput_container ginput_container_phone">
                            <input name="phone" id="phone" class="large" type="tel" value="" placeholder="+254712345678" aria-required="true" aria-invalid="false">
                        </div>
                    </div>
                    <fieldset class="gfield gfield--width-full gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                        <legend class="gfield_label gfield_label_before_complex">
                            Your Email Address
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_text">(Required)</span>
                            </span>
                        </legend>
                        <div class="ginput_complex ginput_container ginput_container_email" id="input_4_3_container">
                            <span class="ginput_left">
                                <input class="" type="email" name="email" id="email" value="" placeholder="Enter your correct email address">
                                <label for="email">Enter Email</label>
                            </span>
                            <span class="ginput_right">
                                <input class="" type="email" name="confirm_email" id="confirm_email" value="" placeholder="Enter your correct email address">
                                <label for="confirm_email">Confirm Email</label>
                            </span>
                            <div class="gf_clear gf_clear_complex"></div>
                        </div>
                    </fieldset>

                    <fieldset class="gfield gfield--width-full gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                        <legend class="gfield_label gfield_label_before_complex">Service
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_text">(Required)</span>
                            </span>
                        </legend>
                        <div class="ginput_container ginput_container_checkbox">
                            <div class="gfield_checkbox" id="service">
                                <div class="gchoice">
                                    <input class="gfield-choice-input" name="service" type="checkbox" value="purchase_for_me" id="purchase">
                                    <label for="purchase">Purchase For Me</label>
                                </div>
                                <div class="gchoice">
                                    <input class="gfield-choice-input" name="service" type="checkbox" value="ship_only" id="ship">
                                    <label for="ship">Ship Only</label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="gfield_description">'Purchase For Me' Service means you tell us what you
                    want to buy and we will send you a quote with all costs included in 24 hours. The price includes the
                    product, the local fees and charges, e.g. sales tax or local delivery fees being charged by the seller
                    to our US or UK warehouse (if any), and our service charge/ estimated shipping cost to Kenya.
                    Please NOTE: You are responsible for payment of your items. We only make purchases after you
                    make payment to us. 'Ship Only' Service means that you will make the purchase on your own and
                    have the items shipped to our US or UK warehouse. All you need is just a quote on the estimate
                    shipping costs for the item.</div> -->
                    </fieldset>

                    <fieldset class="gfield gfield--width-full gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                        <legend class="gfield_label gfield_label_before_complex">
                            Product List
                            <span class="gfield_required">
                                <span class="gfield_required gfield_required_text">(Required)</span>
                            </span>
                        </legend>
                        <div class="ginput_container ginput_container_list ginput_list">

                            <div class="gfield_list gfield_list_container">
                                <div class="gfield_list_header">
                                    <div class="gfield_header_item">Product Name</div>
                                    <div class="gfield_header_item">Product Link</div>
                                    <div class="gfield_header_item">Product Color/Size/Option</div>
                                    <div class="gfield_header_item">Product Quantity</div>
                                    <div class="gfield_header_item">&nbsp;</div>
                                </div>
                                <div class="gfield_list_groups">
                                    <div class="gfield_list_row gfield_list_group list_items" id="list_items">
                                        <div class="gfield_list_group_item gfield_list_cell " data-label="Product Name">
                                            <input type="text" name="product_name" value="">
                                        </div>
                                        <div class="gfield_list_group_item gfield_list_cell " data-label="Product Link">
                                            <input type="text" name="product_link" value="">
                                        </div>
                                        <div class="gfield_list_group_item gfield_list_cell " data-label="Product Color/Size/Option">
                                            <input type="text" name="product_option" value="">
                                        </div>
                                        <div class="gfield_list_group_item gfield_list_cell " data-label="Product Quantity">
                                            <input type="text" name="product_quantity" value="">
                                        </div>
                                        <div class="gfield_list_icons">
                                            <button type="button" class="add_list_item " aria-label="Add row">Add</button>
                                            <button type="button" class="delete_list_item" aria-label="Remove row ">Remove</button>
                                        </div>
                                    </div>
                                    <div id="template" class="gfield_list_row gfield_list_group" style="display: none">
                                        <div class="gfield_list_group_item gfield_list_cell " data-label="Product Name">
                                            <input type="text" name="product_name" value="">
                                        </div>
                                        <div class="gfield_list_group_item gfield_list_cell " data-label="Product Link">
                                            <input type="text" name="product_link" value="">
                                        </div>
                                        <div class="gfield_list_group_item gfield_list_cell " data-label="Product Color/Size/Option">
                                            <input type="text" name="product_option" value="">
                                        </div>
                                        <div class="gfield_list_group_item gfield_list_cell " data-label="Product Quantity">
                                            <input type="text" name="product_quantity" value="">
                                        </div>
                                        <div class="gfield_list_icons">
                                            <button type="button" class="add_list_item " aria-label="Add row">Add</button>
                                            <button type="button" class="delete_list_item" aria-label="Remove row ">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>


                    <div class="gfield gfield--width-full field_sublabel_below field_description_below gfield_visibility_visible">
                        <label class="gfield_label" for="Other Instructions">Other Instructions (Leave it blank, if none)</label>
                        <div class="ginput_container ginput_container_textarea">
                            <textarea name="other_info" id="other_info" class="textarea large" placeholder="Enter any other special instructions you may have pertaining your order." rows="10" cols="50"></textarea>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="submit-button">
                        <button id="submit-quote-form" type="submit" class="btn btn-default btn-lg btn-sunset-form">
                            <span class="spinner"></span>Submit

                        </button>
                    </div>
                </div>
                <input type="hidden" name="action" value="submit_quote">
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce("nonce"); ?>">
            </div>
        </form>
    </div>