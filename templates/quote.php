<div class="plugin-container">
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
                <label class="gfield_label" for="input_4_2">Your Phone Number
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_text">(Required)</span>
                    </span>
                </label>
                <div class="ginput_container ginput_container_phone">
                    <input name="phone" id="phone" class="large" type="tel" value="" placeholder="+254712345678" aria-required="true" aria-invalid="false">
                </div>
            </div>
            <fieldset id="field_4_3" class="gfield gfield--width-full gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                <legend class="gfield_label gfield_label_before_complex">
                    Your Email Address
                    <span class="gfield_required">
                        <span class="gfield_required gfield_required_text">(Required)</span>
                    </span>
                </legend>
                <div class="ginput_complex ginput_container ginput_container_email" id="input_4_3_container">
                    <span id="input_4_3_1_container" class="ginput_left">
                        <input class="" type="email" name="input_3" id="input_4_3" value="" placeholder="Enter your correct email address" aria-required="true" aria-invalid="false"> <label for="input_4_3">Enter Email</label> </span> <span id="input_4_3_2_container" class="ginput_right"> <input class="" type="email" name="input_3_2" id="input_4_3_2" value="" placeholder="Enter your correct email address" aria-required="true" aria-invalid="false">
                        <label for="input_4_3_2">Confirm Email</label>
                    </span>
                    <div class="gf_clear gf_clear_complex"></div>
                </div>
            </fieldset>

            <fieldset id="field_4_7" class="gfield gfield--width-full gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                <legend class="gfield_label gfield_label_before_complex">Service<span class="gfield_required"><span class="gfield_required gfield_required_text">(Required)</span></span></legend>
                <div class="ginput_container ginput_container_checkbox">
                    <div class="gfield_checkbox" id="input_4_7">
                        <div class="gchoice gchoice_4_7_1">
                            <input class="gfield-choice-input" name="input_7.1" type="checkbox" value="Purchase For Me" id="choice_4_7_1" aria-describedby="gfield_description_4_7">
                            <label for="choice_4_7_1" id="label_4_7_1">Purchase For Me</label>
                        </div>
                        <div class="gchoice gchoice_4_7_2">
                            <input class="gfield-choice-input" name="input_7.2" type="checkbox" value="Ship Only" id="choice_4_7_2"> <label for="choice_4_7_2" id="label_4_7_2">Ship Only</label>
                        </div>
                    </div>
                </div>
                <div class="gfield_description" id="gfield_description_4_7">'Purchase For Me' Service means you tell us what you
                    want to buy and we will send you a quote with all costs included in 24 hours. The price includes the
                    product, the local fees and charges, e.g. sales tax or local delivery fees being charged by the seller
                    to our US or UK warehouse (if any), and our service charge/ estimated shipping cost to Kenya.
                    Please NOTE: You are responsible for payment of your items. We only make purchases after you
                    make payment to us. 'Ship Only' Service means that you will make the purchase on your own and
                    have the items shipped to our US or UK warehouse. All you need is just a quote on the estimate
                    shipping costs for the item.</div>
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
                                    <input aria-invalid="false" aria-required="true" aria-label="Product Name" type="text" name="name[]" value="">
                                </div>
                                <div class="gfield_list_group_item gfield_list_cell " data-label="Product Link">
                                    <input aria-invalid="false" aria-required="true" aria-label="Product Link" type="text" name="link[]" value="">
                                </div>
                                <div class="gfield_list_group_item gfield_list_cell " data-label="Product Color/Size/Option">
                                    <input aria-invalid="false" aria-required="true" aria-label="Product Color/Size/Option" type="text" name="option[]" value="">
                                </div>
                                <div class="gfield_list_group_item gfield_list_cell " data-label="Product Quantity">
                                    <input aria-invalid="false" aria-required="true" aria-label="Product Quantity" type="text" name="quantity[]" value="">
                                </div>
                                <div class="gfield_list_icons">
                                    <button type="button" class="add_list_item " aria-label="Add row">Add</button>
                                    <button type="button" class="delete_list_item" aria-label="Remove row ">Remove</button>
                                </div>
                            </div>
                            <div id="template" class="gfield_list_row gfield_list_group" style="display: none">
                                <div class="gfield_list_group_item gfield_list_cell " data-label="Product Name">
                                    <input aria-invalid="false" aria-required="true" aria-label="Product Name" type="text" name="name[]" value="">
                                </div>
                                <div class="gfield_list_group_item gfield_list_cell " data-label="Product Link">
                                    <input aria-invalid="false" aria-required="true" aria-label="Product Link" type="text" name="link[]" value="">
                                </div>
                                <div class="gfield_list_group_item gfield_list_cell " data-label="Product Color/Size/Option">
                                    <input aria-invalid="false" aria-required="true" aria-label="Product Color/Size/Option" type="text" name="option[]" value="">
                                </div>
                                <div class="gfield_list_group_item gfield_list_cell " data-label="Product Quantity">
                                    <input aria-invalid="false" aria-required="true" aria-label="Product Quantity" type="text" name="quantity[]" value="">
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

            <div id="field_4_8" class="gfield gfield--width-full field_sublabel_below field_description_below gfield_visibility_visible">
                <label class="gfield_label" for="input_4_8">
                    Upload your Shopping List
                </label>
                <div class="ginput_container ginput_container_fileupload">
                    <input type="hidden" name="MAX_FILE_SIZE" value="268435456">
                    <input name="input_8" id="input_4_8" type="file" class="large" aria-describedby="gfield_upload_rules_4_8 gfield_description_4_8" onchange="javascript:gformValidateFileSize( this, 268435456 );">
                    <span class="gform_fileupload_rules" id="gfield_upload_rules_4_8">Max. file size: 5 MB.</span>
                    <div class="validation_message validation_message--hidden-on-empty" id="live_validation_message_4_8">

                    </div>
                </div>
                <div class="gfield_description" id="gfield_description_4_8">If you have an excel sheet or MS word with the list and
                    links of items you'd like to buy on your computer, upload it here.
                </div>
            </div>

            <div id="field_4_9" class="gfield gfield--width-full field_sublabel_below field_description_below gfield_visibility_visible"><label class="gfield_label" for="input_4_9">Other Instructions (Leave it blank, if none)</label>
                <div class="ginput_container ginput_container_textarea">
                    <textarea name="input_9" id="input_4_9" class="textarea large" placeholder="Enter any other special instructions you may have pertaining your order." aria-invalid="false" rows="10" cols="50"></textarea>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button id="submit-quote-form" type="submit" class="btn btn-default btn-lg btn-sunset-form">
                <span class="spinner"></span>Submit
            </button>
        </div>
    </div>
</div>