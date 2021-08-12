<div class="gform_wrapper">
    <div>
        <div>
            <h4 class="box-title">
                Items for Purchase
            </h4>
        </div>

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
                    <div class="gfield_list_row gfield_list_group">
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

    </div>
    <div class="box-footer">
        <button type="submit" id="validate">
            Submit
        </button>
    </div>
</div>


<!-- <script>
    $(document).ready(function () {

        $('#single')
            .formValidation({
                framework: 'bootstrap',
                err: {
                    container: 'tooltip'
                },
                row: {
                    selector: 'td'
                },
                // This option will not ignore invisible fields which belong to inactive panels
                excluded: ':hidden, :not(:visible)',
                fields: {
                    location: {
                        row: '.form-group-sm',
                        validators: {
                            notEmpty: {
                                message: '*required'
                            }
                        }
                    },
                    issue_date: {
                        row: '.form-group-sm',
                        validators: {
                            notEmpty: {
                                message: '*required'
                            },
                            date: {
                                format: 'YYYY-MM-DD',
                                message: '*date is not valid',
                                max: moment().format('YYYY-MM-DD'),
                                min: moment('2016-06-01').format('YYYY-MM-DD')
                            }
                        }
                    },
                    vaccine: {
                        validators: {
                            notEmpty: {
                                message: '*required'
                            }
                        }
                    },
                    batch_no: {
                        validators: {
                            notEmpty: {
                                message: '*required'
                            }
                        }
                    },
                    expiry_date: {
                        validators: {
                            notEmpty: {
                                message: '*required'
                            },
                            date: {
                                format: 'YYYY-MM-DD',
                                message: '*date is not valid',
                                min: moment().format('YYYY-MM-DD'),
                            }
                        }
                    },
                    stock_quantity: {
                        validators: {
                            notEmpty: {
                                message: '*required'
                            },
                            numeric: {
                                message: '*not a number'
                            },
                            greaterThan: {
                                value: 0,
                                message: '*not a valid number'
                            }
                        }
                    },
                    issue_quantity: {
                        validators: {
                            notEmpty: {
                                message: '*required'
                            },
                            numeric: {
                                message: '*not a number'
                            },
                            between: {
                                min: 0,
                                max: 'stock_quantity',
                                message: '*not a valid number'
                            }
                        }
                    },
                    vvm: {
                        validators: {
                            notEmpty: {
                                message: '*required'
                            }
                        }
                    }
                }
            }).on('click', '#table .add', function () {
            var thisRow = $(this).closest('tr');
            return validateRow(thisRow);

        }).on('click', '#table .remove', function () {
            if ($('#table tbody tr').length === 2) return;
            $(this).parents("tr").fadeOut('slow', function () {
                $(this).remove();
            });

        }).on('change', '#vaccine', function () {
            var row = $(this);
            var vaccine = row.val();
            load_batches(vaccine, row);

        }).on('change', '#batch_no', function () {
            var row = $(this);
            var batch = row.val();
            load_batch_details(batch, row);

        }).on('change', '#vvm', function () {
            var row = $(this);
            var vvm = row.val();
            if (vvm == '3' || vvm == '4') {
                swal({
                    title: "Alert",
                    text: "You cannot issue out these vaccines!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Proceed",
                    closeOnConfirm: true
                });
            }

        }).on('success.form.fv', function (e) {
            // Prevent form submission
            e.preventDefault();
            swal({
                    title: "Confirm Submission",
                    text: "Are you sure you want to submit the entered details?",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#54CEF7",
                    confirmButtonText: "Submit",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function (isConfirm) {
                    if (isConfirm) {
                        submit();
                    }
                });


        });

        function submit() {
            var vaccine_count = 0;
            $.each($(".vaccine"), function (i, v) {
                vaccine_count++;
            });

            var issue_date = retrieveFormValues('issue_date');
            var location = retrieveFormValues('location');
            var voucher = retrieveFormValues('voucher');

            var vaccines = retrieveFormValues_Array('vaccine');
            var batch_no = retrieveFormValues_Array('batch_no');
            var expiry_date = retrieveFormValues_Array('expiry_date');
            var vvm = retrieveFormValues_Array('vvm');
            var quantity = retrieveFormValues_Array('stock_quantity');
            var issue_quantity = retrieveFormValues_Array('issue_quantity');


            var dat = new Array();

            for (var i = 0; i < vaccine_count; i++) {
                var data = new Array();
                var get_vaccine = vaccines[i];
                var get_batch = batch_no[i];
                var get_expiry = expiry_date[i];
                var get_issue_quantity = issue_quantity[i];
                var get_quantity = quantity[i];
                var get_vvm = vvm[i];


                    data = {
                        "vaccine_id": get_vaccine,
                        "batch_no": get_batch,
                        "expiry_date": get_expiry,
                        "issue_quantity": get_issue_quantity,
                        "quantity": get_quantity,
                        "vvm": get_vvm
                    };

                dat.push(data);
            }

            batch = JSON.stringify(dat);
            $.ajax({
                url: $('#single').attr('action'),
                type: "POST",
                data: {
                    "issued_to": location,
                    "voucher": voucher,
                    "issue_date": issue_date,
                    "batch": batch
                },
                beforeSend: function () {
                    $('#validate').fadeOut(300, function () {
                        $(this).remove();
                    });
                },

                success: function (data, textStatus, jqXHR) {
                   // console.log(data);
                    window.location.replace('<?php echo site_url('stock/ledger'); ?>');
                },

                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                }
            });
        }

        $('#issue_date')
            .datepicker({
                dateFormat: "yy-mm-dd",
                maxDate: 0,
                beforeShow: function (textbox, instance) {
                    var txtBoxOffset = $(this).offset();
                    var top = txtBoxOffset.top;
                    var left = txtBoxOffset.left;
                    var textBoxWidth = $(this).outerWidth();
                    setTimeout(function () {
                        instance.dpDiv.css({
                            top: top - 100, //you can adjust this value accordingly
                            left: left + textBoxWidth//show at the end of textBox
                        });
                    }, 0);

                },
                onSelect: function (date, inst) {
                    /* Revalidate the field when choosing it from the datepicker */
                    $('#single').formValidation('revalidateField', 'issue_date');
                }
            });


        function load_batches(vaccine, row) {

            var dropdown_start = '<select class="form-control" id="batch_no" name="batch_no">';
            var dropdown_option = new Array();
            var default_option = "<option value=''>" + "Select batch" + "</option> ";
            var dropdown_end = '</select>';
            dropdown_option.push(default_option);
            if (vaccine.length > 0) {
                var request = $.ajax({
                    url: '<?php echo site_url('stock/batch'); ?>',
                    type: 'post',
                    data: {
                        "vaccine": vaccine
                    },
                });

                request.done(function (data) {
                    data = JSON.parse(data);

                    $.each(data, function (key, value) {
                        option = "<option value='" + value.batch_number + "'>" + value.batch_number + "</option> ";
                        dropdown_option.push(option);
                    });


                    row.closest("tr").find("#batch_no").replaceWith(dropdown_start + dropdown_option.join("") + dropdown_end),
                        fv = $('#single').data('formValidation');
                    fv.addField(row.closest("tr").find("#batch_no"));
                });
                request.fail(function (jqXHR, textStatus) {

                });
            } else {
                dropdown = dropdown_start + dropdown_end;
                row.closest("tr").find("#batch_no")
                    .replaceWith(dropdown),
                    fv = $('#single').data('formValidation');
                fv.addField(row.closest("tr").find("#batch_no").attr('disabled', ''));
                row.closest("tr").find("#expiry_date").val('');
                row.closest("tr").find("#stock_quantity").val('');
            }
        }


        function load_batch_details(batch, row) {

            if (batch.length > 0) {
                var request = $.ajax({
                    url: '<?php echo site_url('stock/batch_detail'); ?>',
                    type: 'post',
                    data: {
                        "batch": batch
                    },

                });

                request.done(function (data) {
                    data = JSON.parse(data);
                    $.each(data, function (key, value) {
                        row.closest("tr").find("#expiry_date").val(value.expiry_date);
                        row.closest("tr").find("#stock_quantity").val(value.balance);
                        $('#single').formValidation('revalidateField', 'expiry_date');
                        $('#single').formValidation('revalidateField', 'stock_quantity');
                    });
                });
                request.fail(function (jqXHR, textStatus) {

                });
            } else {
                row.closest("tr").find("#expiry_date").val('');
                row.closest("tr").find("#stock_quantity").val('');
            }
        }

        function validateRow(thisRow) {
            var fv = $('#single').data('formValidation'), // FormValidation instance
                // The current row
                $row = thisRow;
            // Validate the container
            fv.validateContainer($row);


            var isValidStep = fv.isValidContainer($row);
            if (isValidStep === false || isValidStep === null) {
                // Do not add row
                return false;
            }

            addRow($row);
        }

        function addRow(thisRow) {

            var template = $('#template');
            var cloned_object = template.clone().removeAttr('hidden').removeAttr('id');

            var single_row = thisRow.attr("row");
            var row_index = parseInt(single_row);
            var new_row = cloned_object.attr("row", row_index);


            new_row.insertAfter(thisRow).find('input').val('');

            var vaccine = new_row.find('select[name="vaccine"]').removeAttr('disabled');
            var batch_no = new_row.find('input[name="batch_no"]');
            var expiry_date = new_row.find('input[name="expiry_date"]');
            var issue_quantity = new_row.find('input[name="issue_quantity"]').removeAttr('disabled');
            var stock_quantity = new_row.find('input[name="stock_quantity"]');
            var vvm = new_row.find('select[name="vvm"]').removeAttr('disabled');

            $('#single').formValidation('addField', expiry_date);
            $('#single').formValidation('addField', vaccine);
            $('#single').formValidation('addField', batch_no);
            $('#single').formValidation('addField', issue_quantity);
            $('#single').formValidation('addField', stock_quantity);
            $('#single').formValidation('addField', vvm);

            new_row.slideDown();
        }

        function retrieveFormValues(name) {
            var dump;
            $.each($("input[name=" + name + "], select[name=" + name + "]"), function (i, v) {
                var theTag = v.tagName;
                var theElement = $(v);
                var theValue = theElement.val();
                dump = theValue;
            });
            return dump;
        }

        function retrieveFormValues_Array(name) {
            var dump = new Array();
            var counter = 0;
            $.each($("input[name=" + name + "], select[name=" + name + "]"), function (i, v) {
                var theTag = v.tagName;
                var theElement = $(v);
                var theValue = theElement.val();
                dump[counter] = theValue;

                counter++;
            });
            return dump;
        }


    });
</script> -->