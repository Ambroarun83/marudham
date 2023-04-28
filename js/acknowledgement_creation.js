const personMultiselect = new Choices('#verification_person', {
    removeItemButton: true,
    noChoicesText: null,
    placeholder: true,
    placeholderValue: 'Select Verification Person',
});

$(document).ready(function () {

    window.onscroll = function () {
        var navbar = document.getElementById("navbar");
        var stickyHeader = navbar.offsetTop;
        if (window.pageYOffset > 500) {
            $('#navbar').fadeIn('fast');
            navbar.classList.add("stickyHeader")
        } else {
            $('#navbar').fadeOut('fast');
            navbar.classList.remove("stickyHeader");
        }
    };

    // Verification Tab Change Radio buttons
    $('#cus_profile,#documentation,#loan_calc').click(function () {
        var verify = $('input[name=verification_type]:checked').val();

        if (verify == 'cus_profile') {
            $('#customer_profile').show(); $('#cus_document').hide(); $('#customer_loan_calc').hide();

        }
        if (verify == 'documentation') {
            $('#customer_profile').hide(); $('#cus_document').show(); $('#customer_loan_calc').hide();
            onLoadDocEditFunction();

        }
        if (verify == 'loan_calc') {
            $('#customer_profile').hide(); $('#cus_document').hide(); $('#customer_loan_calc').show();
            onLoadEditFunction();
            getUserBasedLoanCategory();
            setTimeout(() => {
                getCategoryInfo();
                var sub_cat_id = $('#sub_category').val();
                getLoaninfo(sub_cat_id);
                profitCalculationInfo();
            }, 1000)
        }
    })

    ///Documentation 

    //Signed Doc Validation Hide, // Signed Modal Doc Upload.
    $('#docNameCheck').hide(); $('#signTypeCheck').hide(); $('#docCountCheck').hide(); $('#docupdCheck').hide();

    $('#sign_type').change(function () { // Signed Type 
        let type = $(this).val();

        if (type == '3') {
            $('#relation_doc').show();
            signTypeRelation();

        } else {
            $('#relation_doc').hide();
        }
    })

    $("body").on("click", "#signed_doc_edit", function () {
        let id = $(this).attr('value');
        signTypeRelation();

        $.ajax({
            url: 'verificationFile/documentation/signed_doc_edit.php',
            type: 'POST',
            data: { "id": id },
            dataType: 'json',
            cache: false,
            success: function (result) {

                $("#signedID").val(result['id']);
                $("#doc_name").val(result['doc_name']);
                $("#sign_type").val(result['sign_type']);

                if (result['sign_type'] == '3') {
                    $('#relation_doc').show();
                    $("#signType_relationship").val(result['signType_relationship']);

                } else {
                    $('#relation_doc').hide();
                }

                $("#doc_Count").val(result['doc_Count']);

            }
        });

    });

    $("#signDocUploads").on('submit', function (e) {
        e.preventDefault();

        let doc_name = $("#doc_name").val();
        let sign_type = $("#sign_type").val();
        let doc_Count = $("#doc_Count").val();
        let req_id = $('#doc_req_id').val();
        let signeddoc_upd = $('#signdoc_upd').val();

        if (doc_name != "" && sign_type != "" && doc_Count != "" && req_id != "" && signeddoc_upd != "") {
            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/sign_info_doc_upload.php',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (response) {

                    var insresult = response.includes("Uploaded");
                    if (insresult) {
                        $('#signInsertOk').show();
                        setTimeout(function () {
                            $('#signInsertOk').fadeOut('fast');
                        }, 2000);
                    }
                    else {
                        $('#signNotOk').show();
                        setTimeout(function () {
                            $('#signNotOk').fadeOut('fast');
                        }, 2000);
                    }

                    resetsignInfo();
                }
            });
            $('#docNameCheck').hide(); $('#signTypeCheck').hide(); $('#docCountCheck').hide(); $('#docupdCheck').hide();
        } else {

            if (doc_name == "") {
                $('#docNameCheck').show();
            } else {
                $('#docNameCheck').hide();
            }

            if (sign_type == "") {
                $('#signTypeCheck').show();
            } else {
                $('#signTypeCheck').hide();
            }

            if (doc_Count == "") {
                $('#docCountCheck').show();
            } else {
                $('#docCountCheck').hide();
            }

            if (signeddoc_upd == "") {
                $('#docupdCheck').show();
            } else {
                $('#docupdCheck').hide();
            }

        }
    });
    
    ///Cheque Modal Doc Upload
    $('#chequebankCheck').hide(); $('#holdertypeCheck').hide(); $('#chequeCountCheck').hide(); $('#chequeupdCheck').hide();

    $("#chequeUploads").on('submit', function (e) {
        e.preventDefault();

        let req_id = $('#cheque_req_id').val();
        let holder_type = $("#holder_type").val();
        let chequebank_name = $("#chequebank_name").val();
        let cheque_count = $("#cheque_count").val();
        let chequeID = $("#chequeID").val();
        let cheque_upd = $("#cheque_upd").val();

        if (holder_type != "" && chequebank_name != "" && cheque_count != "" && req_id != "" && cheque_upd != "") {
            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/cheque_upload.php',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (response) {

                    var insresult = response.includes("Uploaded");
                    if (insresult) {
                        $('#signInsertOk').show();
                        setTimeout(function () {
                            $('#signInsertOk').fadeOut('fast');
                        }, 2000);
                    }
                    else {
                        $('#signNotOk').show();
                        setTimeout(function () {
                            $('#signNotOk').fadeOut('fast');
                        }, 2000);
                    }

                    resetchequeInfo();
                }
            });
            $('#chequebankCheck').hide(); $('#holdertypeCheck').hide(); $('#chequeCountCheck').hide(); $('#chequeupdCheck').hide();
        } else {

            if (holder_type == "") {
                $('#holdertypeCheck').show();
            } else {
                $('#holdertypeCheck').hide();
            }

            if (chequebank_name == "") {
                $('#chequebankCheck').show();
            } else {
                $('#chequebankCheck').hide();
            }

            if (cheque_count == "") {
                $('#chequeCountCheck').show();
            } else {
                $('#chequeCountCheck').hide();
            }

            if (cheque_upd == "") {
                $('#chequeupdCheck').show();
            } else {
                $('#chequeupdCheck').hide();
            }

        }
    });

    $("body").on("click", "#cheque_info_edit", function () {
        let id = $(this).attr('value');
        chequeHolderName(); // Holder Name From Family Table.

        $.ajax({
            url: 'verificationFile/documentation/cheque_info_edit.php',
            type: 'POST',
            data: { "id": id },
            dataType: 'json',
            cache: false,
            success: function (result) {

                $("#chequeID").val(result['id']);
                $("#holder_type").val(result['holder_type']);


                if (result['holder_type'] != '2') {
                    $('#holder_name').show();
                    $('#holder_relationship_name').hide();
                    $("#holder_name").val(result['holder_name']);

                } else {
                    $('#holder_name').hide();
                    $('#holder_relationship_name').show();

                    $("#holder_relationship_name").val(result['holder_relationship_name']);
                }

                $("#cheque_relation").val(result['cheque_relation']);
                $("#chequebank_name").val(result['chequebank_name']);
                $("#cheque_count").val(result['cheque_count']);

            }
        });

    });


    ////Mortgage Info  
    $('#mortgageprocessCheck').hide(); $('#propertyholdertypeCheck').hide(); $('#docpropertytypeCheck').hide(); $('#docpropertymeasureCheck').hide(); $('#docpropertylocCheck').hide(); $('#docpropertyvalueCheck').hide();
    $('#mortgagenameCheck').hide(); $('#mortgagedsgnCheck').hide(); $('#mortgagenumCheck').hide(); $('#regofficeCheck').hide(); $('#mortgagevalueCheck').hide(); $('#mortgagedocCheck').hide(); $('#mortgagedocUpdCheck').hide();

    $('#mortgage_process').change(function () {

        let process = $(this).val();

        if (process == '0') {
            $('#Mortgageprocess').show();
        } else {
            $('#Mortgageprocess').hide();

            $('#Propertyholder_type').val('');
            $('#Propertyholder_name').val('');
            $('#Propertyholder_relationship_name').val('');
            $('#doc_property_relation').val('');
            $('#doc_property_pype').val('');
            $('#doc_property_measurement').val('');
            $('#doc_property_location').val('');
            $('#doc_property_value').val('');
            $('#mortgage_name').val('');
            $('#mortgage_dsgn').val('');
            $('#mortgage_nuumber').val('');
            $('#reg_office').val('');
            $('#mortgage_value').val('');
            $('#mortgage_document').val('');
            $('#mortgage_document_upd').val('');
        }
    })

    $('#Propertyholder_type').change(function () {
        let type = $(this).val();
        let req_id = $('#req_id').val();

        if (type == '0') {
            $('#Propertyholder_name').show();
            $('#Propertyholder_relationship_name').val('');
            $('#Propertyholder_relationship_name').hide();

            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/check_holder_name.php',
                data: { "type": type, "reqId": req_id },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#Propertyholder_name').val(result['name']);
                    $('#doc_property_relation').val('NIL');
                }
            });

        } else if (type == '1') {
            $('#Propertyholder_name').show();
            $('#Propertyholder_relationship_name').val('');
            $('#Propertyholder_relationship_name').hide();

            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/check_holder_name.php',
                data: { "type": type, "reqId": req_id },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#Propertyholder_name').val(result['name']);
                    $('#doc_property_relation').val(result['relationship']);
                }
            });

        } else if (type == '2') {
            $('#Propertyholder_name').hide();
            $('#Propertyholder_relationship_name').show();
            $('#Propertyholder_name').val('');
            $('#doc_property_relation').val('');

            mortgageHolderName();

        } else {
            $('#Propertyholder_name').show();
            $('#Propertyholder_relationship_name').hide();
            $('#Propertyholder_name').val('');
            $('#doc_property_relation').val('');

        }
    });

    $('#Propertyholder_relationship_name').change(function () {
        let fam_id = $(this).val();
        $.ajax({
            url: 'verificationFile/documentation/find_cheque_relation.php',
            type: 'POST',
            data: { "fam_id": fam_id },
            dataType: 'json',
            success: function (response) {
                $('#doc_property_relation').val(response);

            }
        });
    });

        //Mortgage Document upload show/hide based on select YES/NO.
         var pend = document.querySelector('#pendingchk');
        $('#mortgage_document').change(function () {
            var docupd = $(this).val();
    
            if (docupd == '0') {
                $('#docUpd').show();
                $('#pendingchk').removeAttr('checked')
    
            } else {
                $('#mortgage_document_upd').val('');
                $('#docUpd').hide();
                pend.checked = true;
            }
        })

         //when Mortgage Document pending is Checked then document will empty and Doc is NO////
   
    $('#pendingchk').click(function () {

        if (pend.checked == true) {
            $('#mortgage_document_upd').val('');
            $('#mortgage_document').val('1');
            $('#docUpd').hide();
        } else {
            $('#mortgage_document').val('0');
            $('#docUpd').show();
        }
    })

    // $('#mortgage_document_upd').change(function () {
    //     var upd = $(this).val();
    //     if (upd != "") {
    //         pend.checked = false;
    //     }
    // })

    //Endorsement Info
    $('#endorsementprocessCheck').hide(); $('#ownertypeCheck').hide(); $('#vehicletypeCheck').hide(); $('#vehicleprocessCheck').hide(); $('#enCompanyCheck').hide(); $('#enModelCheck').hide(); $('#vehicle_reg_noCheck').hide(); $('#endorsementnameCheck').hide(); $('#enRCCheck').hide(); $('#enKeyCheck').hide(); $('#rcdocUpdCheck').hide();
    $('#endorsement_process').change(function () {

        let process = $(this).val();

        if (process == '0') {
            $('#endorsementprocess').show();
        } else {
            $('#endorsementprocess').hide();

            $('#owner_type').val('');
            $('#owner_name').val('');
            $('#ownername_relationship_name').val('');
            $('#en_relation').val('');
            $('#vehicle_type').val('');
            $('#vehicle_process').val('');
            $('#en_Company').val('');
            $('#en_Model').val('');
            $('#vehicle_reg_no').val('');
            $('#endorsement_name').val('');
            $('#en_RC').val('');
            $('#en_Key').val('');
            $('#RC_document_upd').val('');
        }
    })

    $('#owner_type').change(function () {
        let type = $(this).val();
        let req_id = $('#req_id').val();

        if (type == '0') {
            $('#owner_name').show();
            $('#ownername_relationship_name').val('');
            $('#ownername_relationship_name').hide();

            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/check_holder_name.php',
                data: { "type": type, "reqId": req_id },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#owner_name').val(result['name']);
                    $('#en_relation').val('NIL');
                }
            });

        } else if (type == '1') {
            $('#owner_name').show();
            $('#ownername_relationship_name').val('');
            $('#ownername_relationship_name').hide();

            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/check_holder_name.php',
                data: { "type": type, "reqId": req_id },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#owner_name').val(result['name']);
                    $('#en_relation').val(result['relationship']);
                }
            });

        } else if (type == '2') {
            $('#owner_name').hide();
            $('#ownername_relationship_name').show();
            $('#owner_name').val('');
            $('#en_relation').val('');

            endorseHolderName();
        } else {
            $('#owner_name').show();
            $('#ownername_relationship_name').hide();
            $('#owner_name').val('');
            $('#en_relation').val('');
        }
    });

    $('#ownername_relationship_name').change(function () {
        let fam_id = $(this).val();
        $.ajax({
            url: 'verificationFile/documentation/find_cheque_relation.php',
            type: 'POST',
            data: { "fam_id": fam_id },
            dataType: 'json',
            success: function (response) {
                $('#en_relation').val(response);

            }
        });
    });

    var enpend = document.querySelector('#endorsependingchk');
    $('#endorsependingchk').click(function () {

        if (enpend.checked == true) {
            $('#RC_document_upd').val('');
            $('#en_RC').val('1');
            $('#RCdocUpd').hide();
        } else {
            $('#en_RC').val('0');
            $('#RCdocUpd').show();
        }
    })

    // $('#RC_document_upd').change(function () {
    //     var rcupd = $(this).val();

    //     if (rcupd != "") {
    //         enpend.checked = false;
    //     }
    // })

    //RC upload.
   
    $('#en_RC').change(function () {
        var rcupd = $(this).val();

        if (rcupd == '0') {
            $('#RCdocUpd').show();
            enpend.checked = false;

        } else {
            $('#RC_document_upd').val('');
            $('#RCdocUpd').hide();
            enpend.checked = true;
        }
    })

    //Gold Info
    $('#goldCheck').hide(); $('#GoldstatusCheck').hide(); $('#GoldtypeCheck').hide(); $('#purityCheck').hide(); $('#goldCountCheck').hide(); $('#goldWeightCheck').hide(); $('#goldValueCheck').hide();
    $('#gold_info').change(function () {

        let gold = $(this).val();

        if (gold == '0') {
            $('#GoldInfo').show();
        } else {
            $('#GoldInfo').hide();

            $('#gold_sts').val('');
            $('#gold_type').val('');
            $('#Purity').val('');
            $('#gold_Count').val('');
            $('#gold_Weight').val('');
            $('#gold_Value').val('');
        }
    })

    $('#document_holder').change(function () {
        let type = $(this).val();
        let req_id = $('#req_id').val();

        if (type == '0') {
            $('#docholder_name').show();
            $('#docholder_relationship_name').val('');
            $('#docholder_relationship_name').hide();

            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/check_holder_name.php',
                data: { "type": type, "reqId": req_id },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#docholder_name').val(result['name']);
                    $('#doc_relation').val('NIL');
                }
            });

        } else if (type == '1') {
            $('#docholder_name').show();
            $('#docholder_relationship_name').val('');
            $('#docholder_relationship_name').hide();

            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/check_holder_name.php',
                data: { "type": type, "reqId": req_id },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#docholder_name').val(result['name']);
                    $('#doc_relation').val(result['relationship']);
                }
            });

        } else if (type == '2') {
            $('#docholder_name').hide();
            $('#docholder_relationship_name').show();
            $('#docholder_name').val('');
            $('#doc_relation').val('');

            docHolderName();
        } else {
            $('#docholder_name').show();
            $('#docholder_relationship_name').hide();
            $('#docholder_name').val('');
            $('#doc_relation').val('');
        }
    });

    $('#docholder_relationship_name').change(function () {
        let fam_id = $(this).val();
        $.ajax({
            url: 'verificationFile/documentation/find_cheque_relation.php',
            type: 'POST',
            data: { "fam_id": fam_id },
            dataType: 'json',
            success: function (response) {
                $('#doc_relation').val(response);

            }
        });
    });

    $('#documentnameCheck').hide(); $('#documentdetailsCheck').hide(); $('#documentTypeCheck').hide(); $('#docholderCheck').hide();

    //To Show Relationship value on edit page.////
    let mortgage = $('#Propertyholder_type').val();
    if (mortgage == '2') {
        $('#Propertyholder_name').hide();
        $('#Propertyholder_relationship_name').show();
        mortgageHolderName();
        let mortgageHolder = $('#mortgage_relation_name').val();

        setTimeout(() => {
            $('#Propertyholder_relationship_name').val(mortgageHolder);
        }, 500);
    }

    let ot = $('#owner_type').val();
    if (ot == '2') {
        $('#owner_name').hide();
        $('#ownername_relationship_name').show();
        endorseHolderName();
        let Endorsename = $('#en_relation_name').val();

        setTimeout(() => {
            $('#ownername_relationship_name').val(Endorsename);
        }, 500);
    }

    let docHolder = $('#document_holder').val();
    if (docHolder == '2') {
        $('#docholder_name').hide();
        $('#docholder_relationship_name').show();
        docHolderName();
        let holder = $('#docrelation_name').val();

        setTimeout(() => {
            $('#docholder_relationship_name').val(holder);
        }, 500);
    }


});   ////////Document Ready End

$(function () {
    $('.icon-chevron-down1').parent().next('div').slideUp(); //To collapse all card on load

    $('input').attr('readonly', true);
    $('select').attr('disabled', true);

    getImage(); // To show customer image when window onload.

    resetFamDetails(); //Family Table List

    resetGroupDetails()    //Group Family Modal Table Reset 

    resetPropertyinfoList() //Property Info List.

    resetbankinfoList(); //Bank Info List.

    resetkycinfoList(); //KYC Info List.

    //Documentation
    getstaffCode(); // Atuo Generate Doc ID.
    resetsignInfo(); // Signed Doc info Reset.
    resetsigninfoList(); // Signed Doc List Reset.

    chequeinfoList(); // Cheque Info List.
    resetchequeInfo();

    feedbackList(); // Feedback List.

    verificationPerson() //Verification Person


    var state_upd = $('#state_upd').val();
    if (state_upd != '') {
        getDistrictDropdown(state_upd);
    }
    var district_upd = $('#district_upd').val();
    if (district_upd != '') {
        getTalukDropdown(district_upd);
    }
    var taluk_upd = $('#taluk_upd').val();
    if (taluk_upd != '') {
        getTalukBasedArea(taluk_upd);
    }
    var area_upd = $('#area_upd').val();
    if (area_upd != '') {
        getAreaBasedSubArea(area_upd);
    }


    $('.modalTable').DataTable({
        'processing': true,
        'iDisplayLength': 5,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).find('td:first').html(dataIndex + 1);
        },
        "drawCallback": function (settings) {
            this.api().column(0).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        },
    });

    // when Mortgage Doc is YES then Pending is UNCHECKED.
    var docupd = $('#mortgage_document').val();

    if (docupd == '0') {
        $('#pendingchk').removeAttr('checked');
        $('#docUpd').show();
    }

    //When Endorsement Doc is YES then Pending is UNCHECKED.
    var endocupd = $('#en_RC').val();

    if (endocupd == '0') {
        $('#endorsependingchk').removeAttr('checked');
        $('#RCdocUpd').show();
    }

});

function getImage() { // Cus img show onload.
    let imgName = $('#cus_image').val();
    $('#imgshow').attr('src', "uploads/request/customer/" + imgName + " ");

    var guarentorimg = $('#guarentor_image').val();
    $('#imgshows').attr('src', "uploads/verification/guarentor/" + guarentorimg + " ");
}

function resetFamDetails() {

    let req_id = $('#req_id').val();
    var guarentor_name = $('#guarentor_name_upd').val();

    $.ajax({
        url: 'verificationFile/verification_fam_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#famList").empty();
            $("#famList").html(html);
        }
    });

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#guarentor_name").empty();
            $("#guarentor_name").append("<option value=''>" + 'Select Guarantor' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                var selected = '';
                if (guarentor_name != '' && guarentor_name == fam_id) {
                    selected = 'selected';
                }
                $("#guarentor_name").append("<option value='" + fam_id + "' " + selected + ">" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#guarentor_name option:first-child");
                $("#guarentor_name").html($("#guarentor_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#guarentor_name").prepend(firstOption);
            }

        }
    });
}

// Verification Info Person 
function verificationPerson() {
    let req_id = $('#req_id').val();

    var verification_person_upd = $('#verification_person_upd').val();
    var values = verification_person_upd.split(',');


    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {
            personMultiselect.clearStore();
            var len = response.length;
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                var selected = '';
                if (verification_person_upd != '' && values.includes(fam_id)) {
                    selected = 'selected';
                }
                var items = [
                    {
                        value: fam_id,
                        label: fam_name,
                        selected: selected,
                    }
                ];
                personMultiselect.setChoices(items);
                personMultiselect.init();
            }
        }
    });
}

function resetGroupDetails() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_group_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#GroupList").empty();
            $("#GroupList").html(html);
        }
    });
}

///////////////////////// Property Info Starts /////////////////////////////////////
function resetPropertyinfoList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_property_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#propertyList").empty();
            $("#propertyList").html(html);
        }
    });
}

////////////////////////////// Bank Info ///////////////////////////////////////////////////////
function resetbankinfoList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_bank_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#bankResetTable").empty();
            $("#bankResetTable").html(html);
        }
    });
}

////////////////////////// KYC Info ////////////////////////////////////////////////
function resetkycinfoList() {
    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verification_kyc_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#kycListTable").empty();
            $("#kycListTable").html(html);

        }
    });
}

//get district dropdown
function getDistrictDropdown(StateSelected) {

    var optionsList;
    var htmlString = "<option value='Select District'>Select District</option>";
    {
        var TamilNadu = ["Chennai", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul", "Erode", "Kancheepuram", "Kanniyakumari", "Karur", "Madurai", "Nagapattinam",
            "Namakkal", "Nilgiris", "Perambalur", "Pudukottai", "Ramanathapuram", "Salem", "Sivagangai", "Thanjavur", "Theni", "Thiruvallur", "Tiruvannamalai", "Thiruvarur",
            "Thoothukudi", "Tiruchirappalli", "Thirunelveli", "Vellore", "Viluppuram", "Virudhunagar", "Ariyalur", "Krishnagiri", "Tiruppur", "Chengalpattu", "Kallakurichi",
            "Ranipet", "Tenkasi", "Tirupathur", "Mayiladuthurai"];
        var Puducherry = ["Puducherry"];
    }//District list
    switch (StateSelected) {
        case "TamilNadu":
            optionsList = TamilNadu;
            break;
        case "Puducherry":
            optionsList = Puducherry;
            break;
        case "SelectState":
            optionsList = ["Select District"];
            break;
    }

    var district_upd = $('#district_upd').val();
    for (var i = 0; i < optionsList.length; i++) {
        var selected = '';
        if (district_upd != undefined && district_upd != '' && district_upd == optionsList[i]) { selected = "selected"; }
        htmlString = htmlString + "<option value='" + optionsList[i] + "' " + selected + " >" + optionsList[i] + "</option>";
    }
    $("#district").html(htmlString);
    $("#district1").val(district_upd);

    {//To Order Alphabetically
        var firstOption = $("#district option:first-child");
        $("#district").html($("#district option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#district").prepend(firstOption);
    }
}

//get Taluk Dropdown
function getTalukDropdown(DistSelected) {

    var optionsList;
    var htmlString = "<option value='Select Taluk'>Select Taluk</option>";
    {
        var Chennai = ["Alandur", "Ambattur", "Aminjikarai", "Ayanavaram", "Egmore", "Guindy", "Madhavaram", "Madhuravoyal", "Mambalam", "Mylapore", "Perambur", "Purasavakkam", "Sholinganallur", "Thiruvottriyur", "Tondiarpet", "Velacherry"];
        var Coimbatore = ["Aanaimalai", "Annur", "Coimbatore(North)", "Coimbatore(South)", "Kinathukadavu", "Madukarai", "Mettupalayam", "Perur", "Pollachi", "Sulur", "Valparai"];
        var Cuddalore = ["Cuddalore", "Bhuvanagiri", "Chidambaram", "Kattumannarkoil", "Kurinjipadi", "Panruti", "Srimushnam", "Thittakudi", "Veppur", "Virudhachalam"];
        var Dharmapuri = ["Dharmapuri", "Harur", "Karimangalam", "Nallampalli", "Palacode", "Pappireddipatti", "Pennagaram"];
        var Dindigul = ["Atthur", "Dindigul (East)", "Dindigul (West)", "Guziliyamparai", "Kodaikanal", "Natham", "Nilakottai", "Oddanchatram", "Palani", "Vedasandur"];
        var Erode = ["Erode", "Anthiyur", "Bhavani", "Gobichettipalayam", "Kodumudi", "Modakurichi", "Nambiyur", "Perundurai", "Sathiyamangalam", "Thalavadi"];
        var Kancheepuram = ["Kancheepuram", "Kundrathur", "Sriperumbudur", "Uthiramerur", "Walajabad"];
        var Kanniyakumari = ["Agasteeswaram", "Kalkulam", "Killiyur", "Thiruvatar", "Thovalai", "Vilavankodu"];
        var Karur = ["Karur", "Aravakurichi", "Kadavur", "Krishnarayapuram", "Kulithalai", "Manmangalam", "Pugalur"];
        var Madurai = ["Kallikudi", "Madurai (East)", "Madurai (North)", "Madurai (South)", "Madurai (West)", "Melur", "Peraiyur", "Thirumangalam", "Thiruparankundram", "Usilampatti", "Vadipatti"];
        var Nagapattinam = ["Nagapattinam", "Kilvelur", "Thirukkuvalai", "Vedaranyam"];
        var Namakkal = ["Namakkal", "Kholli Hills", "Kumarapalayam", "Mohanoor", "Paramathi Velur", "Rasipuram", "Senthamangalam", "Tiruchengode"];
        var Nilgiris = ["Udagamandalam", "Coonoor", "Gudalur", "Kothagiri", "Kundah", "Pandalur"];
        var Perambalur = ["Perambalur", "Alathur", "Kunnam", "Veppanthattai"];
        var Pudukottai = ["Pudukottai", "Alangudi", "Aranthangi", "Avudiyarkoil", "Gandarvakottai", "Iluppur", "Karambakudi", "Kulathur", "Manamelkudi", "Ponnamaravathi", "Thirumayam", "Viralimalai"];
        var Ramanathapuram = ["Ramanathapuram", "Kadaladi", "Kamuthi", "Kezhakarai", "Mudukulathur", "Paramakudi", "Rajasingamangalam", "Rameswaram", "Tiruvadanai"];
        var Salem = ["Salem", "Attur", "Edapadi", "Gangavalli", "Kadaiyampatti", "Mettur", "Omalur", "Pethanayakanpalayam", "Salem South", "Salem West", "Sankari", "Vazhapadi", "Yercaud"];
        var Sivagangai = ["Sivagangai", "Devakottai", "Ilayankudi", "Kalaiyarkovil", "Karaikudi", "Manamadurai", "Singampunari", "Thirupuvanam", "Tirupathur"];
        var Thanjavur = ["Thanjavur", "Boothalur", "Kumbakonam", "Orathanadu", "Papanasam", "Pattukottai", "Peravurani", "Thiruvaiyaru", "Thiruvidaimaruthur"];
        var Theni = ["Theni", "Aandipatti", "Bodinayakanur", "Periyakulam", "Uthamapalayam"];
        var Thiruvallur = ["Thiruvallur", "Avadi", "Gummidipoondi", "Pallipattu", "Ponneri", "Poonamallee", "R.K. Pet", "Tiruthani", "Uthukottai"];
        var Tiruvannamalai = ["Thiruvannamalai", "Arni", "Chengam", "Chetpet", "Cheyyar", "Jamunamarathur", "Kalasapakkam", "Kilpennathur", "Polur", "Thandramet", "Vandavasi", "Vembakkam"];
        var Thiruvarur = ["Thiruvarur", "Kodavasal", "Koothanallur", "Mannargudi", "Nannilam", "Needamangalam", "Thiruthuraipoondi", "Valangaiman"];
        var Thoothukudi = ["Thoothukudi", "Eral", "Ettayapuram", "Kayathar", "Kovilpatti", "Ottapidaram", "Sattankulam", "Srivaikundam", "Tiruchendur", "Vilathikulam"];
        var Tiruchirappalli = ["Lalgudi", "Manachanallur", "Manapparai", "Marungapuri", "Musiri", "Srirangam", "Thottiam", "Thuraiyur", "Tiruchirapalli (West)", "Tiruchirappalli (East)", "Tiruverumbur"];
        var Thirunelveli = ["Tirunelveli", "Ambasamudram", "Cheranmahadevi", "Manur", "Nanguneri", "Palayamkottai", "Radhapuram", "Thisayanvilai"];
        var Vellore = ["Vellore", "Aanikattu", "Gudiyatham", "K V Kuppam", "Katpadi", "Pernambut"];
        var Viluppuram = ["Villupuram", "Gingee", "Kandachipuram", "Marakanam", "Melmalaiyanur", "Thiruvennainallur", "Tindivanam", "Vanur", "Vikravandi"];
        var Virudhunagar = ["Virudhunagar", "Aruppukottai", "Kariyapatti", "Rajapalayam", "Sathur", "Sivakasi", "Srivilliputhur", "Tiruchuli", "Vembakottai", "Watrap"];
        var Ariyalur = ["Ariyalur", "Andimadam", "Sendurai", "Udaiyarpalayam"];
        var Krishnagiri = ["Krishnagiri", "Anjetty", "Bargur", "Hosur", "Pochampalli", "Sulagiri", "Thenkanikottai", "Uthangarai"];
        var Tiruppur = ["Avinashi", "Dharapuram", "Kangeyam", "Madathukkulam", "Oothukuli", "Palladam", "Tiruppur (North)", "Tiruppur (South)", "Udumalaipettai"];
        var Chengalpattu = ["Chengalpattu", "Cheyyur", "Maduranthakam", "Pallavaram", "Tambaram", "Thirukalukundram", "Tiruporur", "Vandalur"];
        var Kallakurichi = ["Kallakurichi", "Chinnaselam", "Kalvarayan Hills", "Sankarapuram", "Tirukoilur", "Ulundurpet"];
        var Ranipet = ["Arakkonam", "Arcot", "Kalavai", "Nemili", "Sholingur", "Walajah"];
        var Tenkasi = ["Tenkasi", "Alangulam", "Kadayanallur", "Sankarankovil", "Shenkottai", "Sivagiri", "Thiruvengadam", "Veerakeralampudur"];
        var Tirupathur = ["Tirupathur", "Ambur", "Natrampalli", "Vaniyambadi"];
        var Mayiladuthurai = ["Mayiladuthurai", "Kuthalam", "Sirkali", "Tharangambadi"];
        var Puducherry = ["Puducherry", "Oulgaret", "Villianur", "Bahour", "Karaikal", "Thirunallar", "Mahe", "Yanam"];

    }//taluk list
    switch (DistSelected) {
        case "Ariyalur":
            optionsList = Ariyalur;
            break;
        case "Chengalpattu":
            optionsList = Chengalpattu;
            break;
        case "Chennai":
            optionsList = Chennai;
            break;
        case "Coimbatore":
            optionsList = Coimbatore;
            break;
        case "Dharmapuri":
            optionsList = Dharmapuri;
            break;
        case "Erode":
            optionsList = Erode;
            break;
        case "Cuddalore":
            optionsList = Cuddalore;
            break;
        case "Dindigul":
            optionsList = Dindigul;
            break;
        case "Kallakurichi":
            optionsList = Kallakurichi;
            break;
        case "Kanniyakumari":
            optionsList = Kanniyakumari;
            break;
        case "Krishnagiri":
            optionsList = Krishnagiri;
            break;
        case "Nagapattinam":
            optionsList = Nagapattinam;
            break;
        case "Perambalur":
            optionsList = Perambalur;
            break;
        case "Ramanathapuram":
            optionsList = Ramanathapuram;
            break;
        case "Salem":
            optionsList = Salem;
            break;
        case "Tenkasi":
            optionsList = Tenkasi;
            break;
        case "Theni":
            optionsList = Theni;
            break;
        case "Thirunelveli":
            optionsList = Thirunelveli;
            break;
        case "Thiruvarur":
            optionsList = Thiruvarur;
            break;
        case "Tirupathur":
            optionsList = Tirupathur;
            break;
        case "Tiruvannamalai":
            optionsList = Tiruvannamalai;
            break;
        case "Vellore":
            optionsList = Vellore;
            break;
        case "Virudhunagar":
            optionsList = Virudhunagar;
            break;
        case "Kancheepuram":
            optionsList = Kancheepuram;
            break;
        case "Karur":
            optionsList = Karur;
            break;
        case "Madurai":
            optionsList = Madurai;
            break;
        case "Namakkal":
            optionsList = Namakkal;
            break;
        case "Pudukottai":
            optionsList = Pudukottai;
            break;
        case "Ranipet":
            optionsList = Ranipet;
            break;
        case "Sivagangai":
            optionsList = Sivagangai;
            break;
        case "Thanjavur":
            optionsList = Thanjavur;
            break;
        case "Nilgiris":
            optionsList = Nilgiris;
            break;
        case "Thiruvallur":
            optionsList = Thiruvallur;
            break;
        case "Thoothukudi":
            optionsList = Thoothukudi;
            break;
        case "Tiruppur":
            optionsList = Tiruppur;
            break;
        case "Tiruchirappalli":
            optionsList = Tiruchirappalli;
            break;
        case "Viluppuram":
            optionsList = Viluppuram;
            break;
        case "Mayiladuthurai":
            optionsList = Mayiladuthurai;
            break;
        case "Puducherry":
            optionsList = Puducherry;
            break;
        case "Select District":
            optionsList = ["Select Taluk"];
            break;
    }
    var taluk_upd = $('#taluk_upd').val();
    for (var i = 0; i < optionsList.length; i++) {
        var selected = '';
        if (taluk_upd != undefined && taluk_upd != '' && taluk_upd == optionsList[i]) { selected = "selected"; }
        htmlString = htmlString + "<option value='" + optionsList[i] + "' " + selected + " >" + optionsList[i] + "</option>";
    }
    $("#taluk").html(htmlString);
    $("#taluk1").val(taluk_upd);

    {//To Order Alphabetically
        var firstOption = $("#taluk option:first-child");
        $("#taluk").html($("#taluk option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#taluk").prepend(firstOption);
    }
}

//Get Taluk Based Area
function getTalukBasedArea(talukselected) {
    var area_upd = $('#area_upd').val();
    $.ajax({
        url: 'requestFile/ajaxGetEnabledAreaName.php',
        type: 'post',
        data: { 'talukselected': talukselected },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#area").empty();
            $("#area").append("<option value=''>" + 'Select Area' + "</option>");
            for (var i = 0; i < len; i++) {
                var area_id = response[i]['area_id'];
                var area_name = response[i]['area_name'];
                var selected = '';
                if (area_upd != undefined && area_upd != '' && area_upd == area_id) {
                    selected = 'selected';
                }
                $("#area").append("<option value='" + area_id + "' " + selected + ">" + area_name + "</option>");
            }

            $("#area_name").val('');
            $("#area_id").val('');

            {//To Order Alphabetically
                var firstOption = $("#area option:first-child");
                $("#area").html($("#area option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#area").prepend(firstOption);
            }
        }
    });
}

//Get Area Based Sub Area
function getAreaBasedSubArea(area) {
    var sub_area_upd = $('#sub_area_upd').val();
    $.ajax({
        url: 'requestFile/ajaxGetEnabledSubArea.php',
        type: 'post',
        data: { 'area': area },
        dataType: 'json',
        success: function (response) {

            $('#sub_area').empty();
            $('#sub_area').append("<option value='' >Select Sub Area</option>");
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (sub_area_upd != undefined && sub_area_upd != '' && sub_area_upd == response[i]['sub_area_id']) {
                    selected = 'selected';
                }
                $('#sub_area').append("<option value='" + response[i]['sub_area_id'] + "' " + selected + ">" + response[i]['sub_area_name'] + " </option>");
            }
        }
    });
}

//Customer Feedback Modal 
function feedbackList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/customer_feedback_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#feedbackListTable").empty();
            $("#feedbackListTable").html(html);

            $("#feedback_label").val('');
            $("#cus_feedback").val('');
            $("#feedbackID").val('');
        }
    });
}
//Customer Feedback Modal End

//////////////////////////////////////////////////// Documentation  Start////////////////////////////////////////
function onLoadDocEditFunction() {//On load for Loan Calculation edit

    $('select#mortgage_process').removeAttr('disabled');
    $('select#Propertyholder_type').removeAttr('disabled');
    $('input#Propertyholder_name').removeAttr('readonly');
    $('select#Propertyholder_relationship_name').removeAttr('disabled');
    $('input#doc_property_pype').removeAttr('readonly');
    $('input#doc_property_measurement').removeAttr('readonly');
    $('input#doc_property_location').removeAttr('readonly');
    $('input#doc_property_value').removeAttr('readonly');

    $('input#mortgage_name').removeAttr('readonly');
    $('input#mortgage_dsgn').removeAttr('readonly');
    $('input#mortgage_nuumber').removeAttr('readonly');
    $('input#reg_office').removeAttr('readonly');
    $('input#mortgage_value').removeAttr('readonly');
    $('#mortgage_document').removeAttr('disabled');

    $('input#vehicle_reg_no').removeAttr('readonly');
    $('input#endorsement_name').removeAttr('readonly');
    $('#en_RC').removeAttr('disabled');
    $('#en_Key').removeAttr('disabled');

    $('select#endorsement_process').removeAttr('disabled');
    $('select#owner_type').removeAttr('disabled');
    $('input#owner_name').removeAttr('readonly');
    $('select#ownername_relationship_name').removeAttr('disabled');
    $('select#vehicle_type').removeAttr('disabled');
    $('select#vehicle_process').removeAttr('disabled');
    $('input#en_Company').removeAttr('readonly');
    $('input#en_Model').removeAttr('readonly');

    $('select#gold_info').removeAttr('disabled');
    $('select#gold_sts').removeAttr('disabled');
    $('input#gold_type').removeAttr('readonly');
    $('input#Purity').removeAttr('readonly');
    $('input#gold_Count').removeAttr('readonly');
    $('input#gold_Weight').removeAttr('readonly');
    $('input#gold_Value').removeAttr('readonly');

    $('input#document_name').removeAttr('readonly');
    $('input#document_details').removeAttr('readonly');
    $('select#document_type').removeAttr('disabled');
    $('select#document_holder').removeAttr('disabled');
    $('input#docholder_name').removeAttr('readonly');
    $('select#docholder_relationship_name').removeAttr('disabled');

}
//Get DOC id 
function getstaffCode() {
    let doc_Id = $('#doc_table_id').val();
    $.ajax({
        url: 'verificationFile/documentation/doc_id_autoGen.php',
        type: "post",
        dataType: "json",
        data: { "id": doc_Id },
        cache: false,
        success: function (response) {
            var docId = response;
            $('#doc_id').val(docId);
        }
    })
}

function endorseHolderName() {

    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#ownername_relationship_name").empty();
            $("#ownername_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                $("#ownername_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#ownername_relationship_name option:first-child");
                $("#ownername_relationship_name").html($("#ownername_relationship_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#ownername_relationship_name").prepend(firstOption);
            }

        }
    });
}

function mortgageHolderName() {
    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#Propertyholder_relationship_name").empty();
            $("#Propertyholder_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                $("#Propertyholder_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#Propertyholder_relationship_name option:first-child");
                $("#Propertyholder_relationship_name").html($("#Propertyholder_relationship_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#Propertyholder_relationship_name").prepend(firstOption);
            }

        }
    });
}

function docHolderName() {
    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#docholder_relationship_name").empty();
            $("#docholder_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                $("#docholder_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#docholder_relationship_name option:first-child");
                $("#docholder_relationship_name").html($("#docholder_relationship_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#docholder_relationship_name").prepend(firstOption);
            }

        }
    });
}

function resetsignInfo() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/documentation/sign_info_upd_reset.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#signTable").empty();
            $("#signTable").html(html);

            $("#doc_name").val('');
            $("#sign_type").val('');
            $("#signType_relationship").val('');
            $("#doc_Count").val('');
            $("#signdoc_upd").val('');
            $("#signedID").val('');

        }
    });
}

function signTypeRelation() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#signType_relationship").empty();
            $("#signType_relationship").append("<option value=''>" + 'Select Relationship' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                var relationship = response[i]['relationship'];
                $("#signType_relationship").append("<option value='" + fam_id + "'>" + fam_name + ' - ' + relationship + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#signType_relationship option:first-child");
                $("#signType_relationship").html($("#signType_relationship option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#signType_relationship").prepend(firstOption);
            }

        }
    });
}

function resetsigninfoList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/documentation/acknowledge_sign_doc_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#signDocResetTable").empty();
            $("#signDocResetTable").html(html);
        }
    });
}

function filesCount() {
    var cnt = $('#doc_Count').val();
    var signFile = document.querySelector('#signdoc_upd');

    if (signFile.files.length == cnt) {
        return true;
    } else {
        alert('Please select ' + cnt + ' files.')
        $("#signdoc_upd").val('');
        return false;
    }
}

//Cheque Info List
function chequeinfoList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/documentation/cheque_info_upd_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#ChequeResetTable").empty();
            $("#ChequeResetTable").html(html);
        }
    });
}

function resetchequeInfo() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/documentation/cheque_info_upd_reset.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#chequeTable").empty();
            $("#chequeTable").html(html);

            $("#holder_type").val('');
            $("#holder_name").val('');
            $("#holder_relationship_name").val('');
            $("#cheque_relation").val('');
            $("#chequebank_name").val('');
            $("#cheque_count").val('');
            $("#cheque_upd").val('');
            $("#chequeID").val('');

        }
    });
}

function chequeHolderName() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#holder_relationship_name").empty();
            $("#holder_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                $("#holder_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#holder_relationship_name option:first-child");
                $("#holder_relationship_name").html($("#holder_relationship_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#holder_relationship_name").prepend(firstOption);
            }

        }
    });
}

function chequefilesCount() {
    var cnt = $('#cheque_count').val();
    var chequeFile = document.querySelector('#cheque_upd');

    if (chequeFile.files.length == cnt) {
        return true;
    } else {
        alert('Please select ' + cnt + ' files.')
        $("#cheque_upd").val('');
        return false;
    }
}

//Documentation Submit Validation
$('#submit_documentation').click(function () {
    doc_submit_validation();
});

function doc_submit_validation() {

    var cus_id_doc = $('#cus_id_doc').val(); var mortgage_process = $('#mortgage_process').val(); var Propertyholder_type = $('#Propertyholder_type').val(); var doc_property_pype = $('#doc_property_pype').val(); var doc_property_measurement = $('#doc_property_measurement').val(); var doc_property_location = $('#doc_property_location').val(); var doc_property_value = $('#doc_property_value').val();
    var endorsement_process = $('#endorsement_process').val(); var owner_type = $('#owner_type').val(); var vehicle_type = $('#vehicle_type').val(); var vehicle_process = $('#vehicle_process').val();
    var en_Company = $('#en_Company').val(); var en_Model = $('#en_Model').val(); var gold_info = $('#gold_info').val(); var gold_sts = $('#gold_sts').val(); var gold_type = $('#gold_type').val(); var Purity = $('#Purity').val(); var gold_Count = $('#gold_Count').val(); var gold_Weight = $('#gold_Weight').val(); var gold_Value = $('#gold_Value').val(); var document_name = $('#document_name').val(); var document_details = $('#document_details').val(); var document_type = $('#document_type').val(); var document_holder = $('#document_holder').val();
    var req_id = $('#req_id').val(); $('#mortgage_document_upd').val(); $('#RC_document_upd').val();

    var mortgage_name = $('#mortgage_name').val(); var mortgage_dsgn = $('#mortgage_dsgn').val(); var mortgage_nuumber = $('#mortgage_nuumber').val(); var reg_office = $('#reg_office').val(); var mortgage_value = $('#mortgage_value').val(); var mortgage_document = $('#mortgage_document').val();

    var vehicle_reg_no = $('#vehicle_reg_no').val();
    var endorsement_name = $('#endorsement_name').val(); var en_RC = $('#en_RC').val(); var en_Key = $('#en_Key').val();

    if (cus_id_doc == '') {
        Swal.fire({
            timerProgressBar: true,
            timer: 2000,
            title: 'Please Complete Customer Profile!',
            icon: 'error',
            showConfirmButton: true,
            confirmButtonColor: '#009688'
        });
        event.preventDefault();
    }

    if (mortgage_process == '') {
        event.preventDefault();
        $('#mortgageprocessCheck').show();
    } else {
        $('#mortgageprocessCheck').hide();
    }

    if (mortgage_process == '0') {
        if (Propertyholder_type == '') {
            event.preventDefault();
            $('#propertyholdertypeCheck').show();
        } else {
            $('#propertyholdertypeCheck').hide();
        }
        if (doc_property_pype == '') {
            event.preventDefault();
            $('#docpropertytypeCheck').show();
        } else {
            $('#docpropertytypeCheck').hide();
        }
        if (doc_property_measurement == '') {
            event.preventDefault();
            $('#docpropertymeasureCheck').show();
        } else {
            $('#docpropertymeasureCheck').hide();
        }
        if (doc_property_location == '') {
            event.preventDefault();
            $('#docpropertylocCheck').show();
        } else {
            $('#docpropertylocCheck').hide();
        }
        if (doc_property_value == '') {
            event.preventDefault();
            $('#docpropertyvalueCheck').show();
        } else {
            $('#docpropertyvalueCheck').hide();
        }
        if (mortgage_name == '') {
            event.preventDefault();
            $('#mortgagenameCheck').show();
        } else {
            $('#mortgagenameCheck').hide();
        }
        if (mortgage_dsgn == '') {
            event.preventDefault();
            $('#mortgagedsgnCheck').show();
        } else {
            $('#mortgagedsgnCheck').hide();
        }
        if (mortgage_nuumber == '') {
            event.preventDefault();
            $('#mortgagenumCheck').show();
        } else {
            $('#mortgagenumCheck').hide();
        }
        if (reg_office == '') {
            event.preventDefault();
            $('#regofficeCheck').show();
        } else {
            $('#regofficeCheck').hide();
        }
        if (mortgage_value == '') {
            event.preventDefault();
            $('#mortgagevalueCheck').show();
        } else {
            $('#mortgagevalueCheck').hide();
        }
        if (mortgage_document == '') {
            event.preventDefault();
            $('#mortgagedocCheck').show();
        } else {
            $('#mortgagedocCheck').hide();
        }
    }


    if (endorsement_process == '') {
        event.preventDefault();
        $('#endorsementprocessCheck').show();
    } else {
        $('#endorsementprocessCheck').hide();
    }

    if (endorsement_process == '0') {
        if (owner_type == '') {
            event.preventDefault();
            $('#ownertypeCheck').show();
        } else {
            $('#ownertypeCheck').hide();
        }
        if (vehicle_type == '') {
            event.preventDefault();
            $('#vehicletypeCheck').show();
        } else {
            $('#vehicletypeCheck').hide();
        }
        if (vehicle_process == '') {
            event.preventDefault();
            $('#vehicleprocessCheck').show();
        } else {
            $('#vehicleprocessCheck').hide();
        }
        if (en_Company == '') {
            event.preventDefault();
            $('#enCompanyCheck').show();
        } else {
            $('#enCompanyCheck').hide();
        }
        if (en_Model == '') {
            event.preventDefault();
            $('#enModelCheck').show();
        } else {
            $('#enModelCheck').hide();
        }
        if (vehicle_reg_no == '') {
            event.preventDefault();
            $('#vehicle_reg_noCheck').show();
        } else {
            $('#vehicle_reg_noCheck').hide();
        }
        if (endorsement_name == '') {
            event.preventDefault();
            $('#endorsementnameCheck').show();
        } else {
            $('#endorsementnameCheck').hide();
        }
        if (en_RC == '') {
            event.preventDefault();
            $('#enRCCheck').show();
        } else {
            $('#enRCCheck').hide();
        }
        if (en_Key == '') {
            event.preventDefault();
            $('#enKeyCheck').show();
        } else {
            $('#enKeyCheck').hide();
        }
    }


    if (gold_info == '') {
        event.preventDefault();
        $('#goldCheck').show();
    } else {
        $('#goldCheck').hide();
    }

    if (gold_info == '0') {

        if (gold_sts == '') {
            event.preventDefault();
            $('#GoldstatusCheck').show();
        } else {
            $('#GoldstatusCheck').hide();
        }
        if (gold_type == '') {
            event.preventDefault();
            $('#GoldtypeCheck').show();
        } else {
            $('#GoldtypeCheck').hide();
        }
        if (Purity == '') {
            event.preventDefault();
            $('#purityCheck').show();
        } else {
            $('#purityCheck').hide();
        }
        if (gold_Count == '') {
            event.preventDefault();
            $('#goldCountCheck').show();
        } else {
            $('#goldCountCheck').hide();
        }
        if (gold_Weight == '') {
            event.preventDefault();
            $('#goldWeightCheck').show();
        } else {
            $('#goldWeightCheck').hide();
        }
        if (gold_Value == '') {
            event.preventDefault();
            $('#goldValueCheck').show();
        } else {
            $('#goldValueCheck').hide();
        }

    }


    if (document_name == '') {
        event.preventDefault();
        $('#documentnameCheck').show();
    } else {
        $('#documentnameCheck').hide();
    }
    if (document_details == '') {
        event.preventDefault();
        $('#documentdetailsCheck').show();
    } else {
        $('#documentdetailsCheck').hide();
    }
    if (document_type == '') {
        event.preventDefault();
        $('#documentTypeCheck').show();
    } else {
        $('#documentTypeCheck').hide();
    }
    if (document_holder == '') {
        event.preventDefault();
        $('#docholderCheck').show();
    } else {
        $('#docholderCheck').hide();
    }


    // $.ajax({
    //     url: 'verificationFile/documentation/docValidationModal.php',
    //     data: { 'req_id': req_id, 'table': 'signed_doc_info' },
    //     type: 'post',
    //     cache: false,
    //     success: function (response) {
    //         if (response == "0") {
    //             event.preventDefault();
    //             $('#signed_infoCheck').show();
    //         } else if (response == "1") {
    //             $('#signed_infoCheck').hide();
    //         }
    //     }
    // })
    // $.ajax({
    //     url: 'verificationFile/documentation/docValidationModal.php',
    //     data: { 'req_id': req_id, 'table': 'cheque_info' },
    //     type: 'post',
    //     cache: false,
    //     success: function (response) {
    //         if (response == "0") {
    //             event.preventDefault();
    //             $('#Cheque_infoCheck').show();
    //         } else if (response == "1") {
    //             $('#Cheque_infoCheck').hide();
    //         }
    //     }
    // })
}

//////////////////////////////////////////////////// Documentation  END////////////////////////////////////////


//////////////////////////////////////////////////////////////////// Loan Calculation Functions Start ///////////////////////////////////////////////////////////////////////////////
function onLoadEditFunction() {//On load for Loan Calculation edit
    // setTimeout(()=> {
    $('select#loan_category').removeAttr('disabled');
    $('select#sub_category').removeAttr('disabled');
    $('input#tot_value').removeAttr('readonly');
    $('input#ad_amt').removeAttr('readonly');
    $('input#loan_amt').removeAttr('readonly');
    $('select#profit_type').removeAttr('disabled');
    // $('input#due_method_calc').removeAttr('readonly');
    // $('input#due_type').removeAttr('readonly');
    $('select#profit_method').removeAttr('disabled');
    $('input#calc_method').removeAttr('readonly');
    $('select#due_method_scheme').removeAttr('disabled');
    $('select#day_scheme').removeAttr('disabled');
    $('select#scheme_name').removeAttr('disabled');
    // $('input#int_rate').removeAttr('readonly');
    // $('input#due_period').removeAttr('readonly');
    $('input#doc_charge').removeAttr('readonly');
    $('input#proc_fee').removeAttr('readonly');
    $('input#due_start_from').removeAttr('readonly');
    $('input#refresh_cal').removeAttr('readonly');
    $('select#collection_method').removeAttr('disabled');
    // },100)
}

$('#loan_category').change(function () {
    var loan_cat = $(this).val();
    getSubCategory(loan_cat);
})

$('#refresh_cal').click(function () {

    var profit_method = $('#profit_method').val(); // if profit method changes, due type is EMI
    if (profit_method == 'after_intrest') {
        getLoanAfterInterest();
    } else if (profit_method == 'pre_intrest') {
        getLoanPreInterest();
    }

    var due_type = $('#due_type').val(); //If Changes not found in profit method, calculate loan amt for monthly basis
    if (due_type == 'Interest') {
        getLoanInterest();
    }

    var due_method_scheme = $('#due_method_scheme').val();
    if (due_method_scheme == '1') {//Monthly scheme as 1
        getLoanMonthly();
    } else if (due_method_scheme == '2') {//Weekly scheme as 2
        getLoanWeekly();
    } else if (due_method_scheme == '3') {//Daily scheme as 3
        getLoanDaily();
    }
});

$('#day_scheme').change(function(){
    $('#due_start_from').val('');
    $('#maturity_month').val('');
})

$('#due_start_from').change(function(){
    var due_start_from = $('#due_start_from').val(); // get start date to calculate maturity date
    var due_period = parseInt($('#due_period').val()); //get due period to calculate maturity date
    var profit_type = $('#profit_type').val()
    if(profit_type == '1'){ //Based on the profit method choose due method from input box
        var due_method = $('#due_method_calc').val()
    }else if(profit_type == '2'){
        var due_method = $('#due_method_scheme').val()
    }

    if(due_method == 'Monthly' || due_method == '1'){ // if due method is monthly or 1(for scheme) then calculate maturity by month
        
        var maturityDate = moment(due_start_from, 'YYYY-MM-DD').add(due_period, 'months').format('YYYY-MM-DD');
        $('#maturity_month').val(maturityDate);
    
    }else if(due_method == '2'){//if Due method is weekly then calculate maturity by week
        
        var due_day = parseInt($('#day_scheme').val());
        
        var momentStartDate = moment(due_start_from, 'YYYY-MM-DD').startOf('day').isoWeekday(due_day);//Create a moment.js object from the start date and set the day of the week to the due day value
        
        var weeksToAdd = Math.floor(due_period-1);//Set the weeks to be added by giving due period. subract 1 because by default it taking extra 1 week
        
        momentStartDate.add(weeksToAdd, 'weeks'); //Add the calculated number of weeks to the start date.
        
        if (momentStartDate.isBefore(due_start_from)) {
            momentStartDate.add(1, 'week'); //If the resulting maturity date is before the start date, add another week.
        }
        
        var maturityDate = momentStartDate.add(1, 'week').format('YYYY-MM-DD'); //Get the final maturity date as a formatted string.
        
        $('#maturity_month').val(maturityDate);
    
    }else if(due_method == '3'){
        var momentStartDate = moment(due_start_from, 'YYYY-MM-DD').startOf('day');
        var daysToAdd = Math.floor(due_period);
        momentStartDate.add(daysToAdd, 'days');
        var maturityDate = momentStartDate.format('YYYY-MM-DD');
        $('#maturity_month').val(maturityDate);
    }

})

$('#submit_loan_calculation').click(function(){
    $('#refresh_cal').trigger('click'); //For calculate once again if user missed to refresh calculation

    loan_calc_validation();
})


function getGroupandLine(sub_area_id) {

    $.ajax({
        url: 'verificationFile/getGroupandLine.php',
        data: { 'sub_area_id': sub_area_id },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            $('#area_group').val(response['group_name']);
            $('#area_line').val(response['line_name']);
        }
    })
}

//Fetch Loan category list Based on Agent
function getUserBasedLoanCategory() {
    var loan_category = $('#loan_category_load').val();
    var loan_category_upd = $('#loan_category_upd').val();
    $.ajax({
        url: 'verificationFile/LoanCalculation/getUserBasedLoanCategory.php',
        data: {},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            $('#loan_category').empty();
            $('#loan_category').append("<option value='' >Select Loan Category</option>");
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (loan_category_upd == '' || loan_category_upd == undefined) { //if update is not available, then only use on load value of loan category
                    if (loan_category != undefined && loan_category != '' && loan_category == response[i]['loan_category_id']) {
                        selected = 'selected';
                        getSubCategory(response[i]['loan_category_id']);
                    }
                } else {
                    if (loan_category_upd != undefined && loan_category_upd != '' && loan_category_upd == response[i]['loan_category_id']) {
                        selected = 'selected';
                        getSubCategory(response[i]['loan_category_id']);
                    }
                }

                $('#loan_category').append("<option value='" + response[i]['loan_category_id'] + "' " + selected + " >" + response[i]['loan_category_name'] + " </option>");
            }
            ;
        }
    })
}

//Fetch Sub Category Based on loan category
function getSubCategory(loan_cat) {
    var sub_category = $('#sub_category_load').val();
    var sub_categoryu_upd = $('#sub_category_upd').val();
    $.ajax({
        url: 'requestFile/getSingleSubCategory.php',
        type: 'POST',
        dataType: 'json',
        cache: false,
        data: { 'loan_cat': loan_cat },
        success: function (response) {

            $('#sub_category').empty();
            $('#sub_category').append("<option value='' >Select Sub Category</option>");
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (sub_categoryu_upd == '' || sub_categoryu_upd == undefined) { //if update is not available, then only use on load value of loan category
                    if (sub_category != undefined && sub_category != '' && sub_category == response[i]['sub_category_name']) {
                        selected = 'selected';
                    }
                } else {
                    if (sub_categoryu_upd != undefined && sub_categoryu_upd != '' && sub_categoryu_upd == response[i]['sub_category_name']) {
                        selected = 'selected';
                    }
                }
                $('#sub_category').append("<option value='" + response[i]['sub_category_name'] + "' " + selected + ">" + response[i]['sub_category_name'] + " </option>");
            }
        }
    })
}

//Get Category info From Request
function getCategoryInfo() {
    var sub_category_upd = $('#sub_category_upd').val();
    var sub_cat = $('#sub_category').val();
    $.ajax({
        url: 'requestFile/getCategoryInfo.php',
        data: { 'sub_cat': sub_cat },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            category_info = ''
            $('#moduleTable').empty();
            $('#moduleTable').append('<tbody><tr>');
            if (response.length != 0) {
                var tb = 35;
                for (var i = 0; i < response.length; i++) {
                    $('#moduleTable tbody tr').append(`<td><label for="disabledInput">` + response[i]['loan_category_ref_name'] + `</label><span class="required">&nbsp;*</span><input type="text" class="form-control" id="category_info" name="category_info[]" 
                    value='`+ category_info + `' tabindex='` + tb + `' required placeholder='Enter ` + response[i]['loan_category_ref_name'] + `'></td>`);
                    tb++;
                }
                $('#moduleTable tbody tr').append(`<td><button type="button" tabindex='` + tb + `' id="add_category_info[]" name="add_category_info" 
                class="btn btn-primary add_category_info">Add</button> </td><td><span class='icon-trash-2 deleterow' id='deleterow' tabindex='`+ tb + `'></span></td>
                </tr></tbody></table>`);

                var category_content = $('#moduleTable tbody tr').html(); //To get the appended category list

                var category_count = $('#moduleTable tbody tr').find('td').length - 2;//To find input fields count
                getCategoryInputs(category_count, category_content, sub_category_upd);

                $(document).on('click', '.add_category_info', function () {
                    $('#moduleTable tbody').append('<tr>' + category_content + '</tr>');
                    // $('#moduleTable tbody tr:last input').filter(':last').val('');
                });

                // remove delete option for last child
                $('#deleterow:last').filter(':last').removeClass('deleterow');

                $(document).on('click', '.deleterow', function () {
                    $(this).parent().parent().remove();
                });

            }
        }
    });


    function getCategoryInputs(category_count, category_content, sub_category_upd) {

        var req_id = $('#req_id').val();
        $.ajax({
            url: 'verificationFile/LoanCalculation/getCategoryInfo.php',
            data: { 'req_id': req_id, 'sub_category_upd': sub_category_upd },
            dataType: 'json',
            type: 'post',
            cachec: false,
            success: function (response) {
                var trCount = Math.ceil(response.length / category_count); // number of rows needed

                for (var j = 0; j < trCount - 1; j++) {
                    $('#moduleTable tbody').append('<tr>' + category_content + '</tr>');
                    // $('#moduleTable tbody tr:last input').filter(':last').val('');
                }
                for (var i = 0; i < response.length; i++) {
                    $('#moduleTable tbody input').each(function (index) {
                        $(this).val(response[index]);
                    });
                }
            }
        })
    }

}

//Get New Category Info
$('#sub_category').change(function () {
    var sub_cat = $(this).val();
    $.ajax({
        url: 'requestFile/getCategoryInfo.php',
        data: { 'sub_cat': sub_cat },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            $('#moduleTable').empty();
            $('#moduleTable').prepend('<tbody><tr>');
            if (response.length != 0) {
                var tb = 35;
                for (var i = 0; i < response.length; i++) {
                    $('#moduleTable tbody tr').append(`<td><label for="disabledInput">` + response[i]['loan_category_ref_name'] + `</label><span class="required">&nbsp;*</span><input type="text" class="form-control" id="category_info" name="category_info[]" 
                    value='' tabindex='`+ tb + `' required placeholder='Enter ` + response[i]['loan_category_ref_name'] + `'></td>`);
                    $('.category_info').show();
                    tb++;


                }
                $('#moduleTable tbody tr').append(`<td><button type="button" tabindex='` + tb + `' id="add_category_info[]" name="add_category_info" 
                class="btn btn-primary add_category_info">Add</button> </td><td><span class='icon-trash-2 deleterow' id='deleterow' tabindex='`+ tb + `'></span></td>
                </tr></tbody>`);

                category_content = $('#moduleTable tbody').html(); //To get the appended category list

                // unbind the event handler
                $(document).off('click', '.add_category_info');
                $(document).on('click', '.add_category_info', function () {
                    console.log(category_content)
                    $('#moduleTable tbody').append(category_content);
                });

                // remove delete option for last child
                $('#deleterow:last').filter(':last').removeClass('deleterow');

                // unbind the event handler
                $(document).off('click', '.deleterow');
                $(document).on('click', '.deleterow', function () {
                    $(this).parent().parent().remove();
                });
            } else {
                $('.category_info').hide();
            }
        }
    })
    $('#tot_value').val(''); $('#ad_amt').val(''); $('#loan_amt').val('');
    getLoaninfo(sub_cat);
})

//Fetch loan Details based on category select
function getLoaninfo(sub_cat_id) {

    $.ajax({
        url: 'requestFile/getLoanInfo.php',
        data: { 'sub_cat_id': sub_cat_id },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            if (response['advance'] == 'Yes') {
                $('.advance_yes').show();
                $('#loan_amt').attr('readonly', true);

                $('#tot_value').unbind('blur').blur(function () {// to calculate loan amount ant advance percentage
                    var amt = $('#tot_value').val();
                    var advance = $('#ad_amt').val();
                    var loan_amt = parseInt(amt) - parseInt(advance);

                    if (amt <= parseInt(response['loan_limit'])) {
                        if (loan_amt != NaN) {
                            $('#loan_amt').val(loan_amt.toFixed(0));
                        }
                    } else {
                        alert('Please Enter Lesser amount!');
                        $('#tot_value').val('');
                        $('#loan_amt').val('');
                    }
                })

                $('#ad_amt').unbind('blur').blur(function () {//To calculate loan amount and advance percentage
                    var amt = $('#tot_value').val();
                    var advance = $('#ad_amt').val();
                    var loan_amt = amt - advance;
                    $('#loan_amt').val(loan_amt.toFixed(0));
                });

            } else {
                $('.advance_yes').hide();
                $('#loan_amt').removeAttr('readonly');
                $('#loan_amt').unbind('blur').blur(function () {// to calculate loan amount ant advance percentage
                    var loan_amt = $(this).val();

                    if (loan_amt <= parseInt(response['loan_limit'])) {
                        $('#loan_amt').val(loan_amt.toFixed(0));
                    } else {
                        alert('Please Enter Lesser amount!');
                        $('#loan_amt').val('');
                    }
                })
            }
        }
    })
}

//to fetch Calculation based inputs
function profitCalculationInfo() {
    var sub_cat = $('#sub_category').val();
    var profit_type = $('#profit_type').val();
    var due_method = $('#due_method_scheme').val();
    if (profit_type != '') { //Call only if profit type autamatically set
        profitCalAjax(profit_type, sub_cat); //Call for edit
    }
    if (due_method != '') {//Call only if due method autamatically set
        schemeAjax(due_method, sub_cat); //Call for edit
    }
    setTimeout(function () {
        var scheme_name = $('#scheme_name').val();
        if (scheme_name != '') {//Call only if scheme name autamatically set
            schemeCalAjax(scheme_name); //Call for edit
        }
    }, 1000)

    $('#profit_type').change(function () {//On change evemt

        $('.calculation').hide(); // to hide calculation inputs
        $('.scheme').hide();// to hide Scheme inputs
        $('.emi-calculation').hide(); // to hide calculation inputs
        $('.interest-calculation').hide(); // to hide calculation inputs
        $('#profit_method').empty(); // to empty calculation inputs
        $('#calc_method').val(''); // to empty calculation inputs

        $('#due_method_scheme').val(''); // to clear due method selection 
        $('.day_scheme').hide(); // to Hide day shceme
        $('#day_scheme').val(''); // to clear day scheme selection 
        $('#scheme_name').val(''); // to clear scheme name selection 

        $('#int_rate').val(''); $('#int_rate').attr('readonly', false);
        $('#due_period').val(''); $('#due_period').attr('readonly', false);
        $('.min-max-int').text('*');
        $('.min-max-due').text('*');
        $('.min-max-doc').text('*');
        $('.min-max-proc').text('*');

            $('#due_start_from').val('');
            $('#maturity_month').val('');
            
        var profit_type = $(this).val();
        var sub_cat = $('#sub_category').val();
        profitCalAjax(profit_type, sub_cat)

    });//Profit Type change event end

    $('#due_method_scheme').change(function () {
        var due_method = $(this).val();

        if (due_method == '2') { // show weekdays only if weekly due method selected
            $('.day_scheme').show();
        } else {
            $('.day_scheme').hide();
        }

        var sub_cat = $('#sub_category').val();
        schemeAjax(due_method, sub_cat);

        $('#int_rate').val(''); $('#int_rate').attr('readonly', false);
        $('#due_period').val(''); $('#due_period').attr('readonly', false);
        $('.min-max-int').text('*');
        $('.min-max-due').text('*');
        $('.min-max-doc').text('*');
        $('.min-max-proc').text('*');

        $('#due_start_from').val('');
        $('#maturity_month').val('');
    });

    $('#scheme_name').change(function () { //Scheme Name change event
        var scheme_id = $(this).val();
        schemeCalAjax(scheme_id);
    })
}

//
function profitCalAjax(profit_type, sub_cat) {
    var profit_method_upd = $('#profit_method_upd').val()
    if ($('#int_rate_upd').val()) { var int_rate_upd = $('#int_rate_upd').val(); } else { var int_rate_upd = ''; }
    if ($('#due_period_upd').val()) { var due_period_upd = $('#due_period_upd').val(); } else { var due_period_upd = ''; }
    if ($('#doc_charge_upd').val()) { var doc_charge_upd = $('#doc_charge_upd').val(); } else { var doc_charge_upd = ''; }
    if ($('#proc_fee_upd').val()) { var proc_fee_upd = $('#proc_fee_upd').val(); } else { var proc_fee_upd = ''; }
    if (profit_type == '1') {//if Calculation selected
        $('.calculation').show();
        $('.scheme').hide();
        $.ajax({ // To show profit calculation infos based on sub category
            url: 'verificationFile/LoanCalculation/getProfitCalculationInfo.php',
            data: { 'sub_cat': sub_cat },
            dataType: 'json',
            type: 'post',
            cache: false,
            success: function (response) {
                if (response['due_type'] == 'emi') {
                    $('.emi-calculation').show();
                    $('.interest-calculation').hide();
                    $('#due_type').val('EMI');

                    var profit_method = response['profit_method'].split(','); //Splitting into array by exploding comma (',')
                    $('#profit_method').empty();
                    $('#profit_method').append(`<option value=''>Select Profit Method</option>`);
                    for (var i = 0; i < profit_method.length; i++) {
                        if (profit_method[i] == 'pre_intrest') { valuee = 'Pre Interest'; } else if (profit_method[i] == 'after_intrest') { valuee = 'After Interest'; }
                        var selected = '';
                        if (profit_method_upd != '' && profit_method_upd != undefined && profit_method_upd == profit_method[i]) {
                            selected = 'selected';
                        }
                        $('#profit_method').append(`<option value='` + profit_method[i] + `' ` + selected + `>` + valuee + `</option>`);
                    }
                    $('#calc_method').val('');

                    //To set min and maximum 
                    $('.min-max-int').text('* (' + response['intrest_rate_min'] + '% - ' + response['intrest_rate_max'] + '%) ');
                    $('#int_rate').attr('onBlur', `if( parseFloat($(this).val()) > '` + response['intrest_rate_max'] + `' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+ response['intrest_rate_min'] + `' && parseFloat($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#int_rate').val(int_rate_upd);
                    $('.min-max-due').text('* (' + response['due_period_min'] + ' - ' + response['due_period_max'] + ') ');
                    $('#due_period').attr('onBlur', `if( parseInt($(this).val()) > '` + response['due_period_max'] + `' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseInt($(this).val()) < '`+ response['due_period_min'] + `' && parseInt($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#due_period').val(due_period_upd);

                    $('.min-max-doc').text('* (' + response['document_charge_min'] + '% - ' + response['document_charge_max'] + '%) ');
                    $('#doc_charge').attr('onBlur', `if( parseFloat($(this).val()) > '` + response['document_charge_max'] + `' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+ response['document_charge_min'] + `' && parseFloat($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#doc_charge').val(doc_charge_upd);

                    $('.min-max-proc').text('* (' + response['processing_fee_min'] + '% - ' + response['processing_fee_max'] + '%) ');
                    $('#proc_fee').attr('onBlur', `if( parseFloat($(this).val()) > '` + response['processing_fee_max'] + `' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+ response['processing_fee_min'] + `' && parseInt($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#proc_fee').val(proc_fee_upd);

                } else if (response['due_type'] == 'intrest') {

                    $('.emi-calculation').hide();
                    $('.interest-calculation').show();
                    $('#due_type').val('Interest');
                    $('#profit_method').empty();
                    $('#calc_method').val(response['calculate_method']);

                    //To set min and maximum 
                    $('.min-max-int').text('* (' + response['intrest_rate_min'] + '% - ' + response['intrest_rate_max'] + '%) ');
                    $('#int_rate').attr('onBlur', `if( parseFloat($(this).val()) > '` + response['intrest_rate_max'] + `' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+ response['intrest_rate_min'] + `' && parseFloat($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#int_rate').val(int_rate_upd);

                    $('.min-max-due').text('* (' + response['due_period_min'] + ' - ' + response['due_period_max'] + ') ');
                    $('#due_period').attr('onBlur', `if( parseInt($(this).val()) > '` + response['due_period_max'] + `' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseInt($(this).val()) < '`+ response['due_period_min'] + `' && parseInt($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#due_period').val(due_period_upd);

                    $('.min-max-doc').text('* (' + response['document_charge_min'] + '% - ' + response['document_charge_max'] + '%) ');
                    $('#doc_charge').attr('onBlur', `if( parseFloat($(this).val()) > '` + response['document_charge_max'] + `' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+ response['document_charge_min'] + `' && parseFloat($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#doc_charge').val(doc_charge_upd);

                    $('.min-max-proc').text('* (' + response['processing_fee_min'] + '% - ' + response['processing_fee_max'] + '%) ');
                    $('#proc_fee').attr('onBlur', `if( parseFloat($(this).val()) > '` + response['processing_fee_max'] + `' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+ response['processing_fee_min'] + `' && parseFloat($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#proc_fee').val(proc_fee_upd);
                }
            }
        })
    } else if (profit_type == '2') { //if Scheme selected
        $('.calculation').hide(); // to hide calculation inputs
        $('.scheme').show(); // to show scheme inputs
    } else {
        $('.calculation').hide(); // to hide calculation inputs
        $('.scheme').hide(); // to hide scheme inputs
    }
}

//
function schemeAjax(due_method, sub_cat) {
    var scheme_upd = $('#scheme_upd').val();
    $.ajax({ //To show scheme names based on sub category
        url: 'verificationFile/LoanCalculation/getSchemeNames.php',
        data: { 'sub_cat': sub_cat, 'due_method': due_method },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            $('#scheme_name').empty();
            $('#scheme_name').append(`<option value=''>Select Scheme Name</option>`);
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (scheme_upd != '' && scheme_upd != undefined && scheme_upd == response[i]['scheme_id']) {
                    selected = 'selected';
                }
                $('#scheme_name').append(`<option value='` + response[i]['scheme_id'] + `' ` + selected + `>` + response[i]['scheme_name'] + `</option>`);
            }
        }
    });
}

//
function schemeCalAjax(scheme_id) {
    if (scheme_id != '') {
        if ($('#int_rate_upd').val()) { var int_rate_upd = $('#int_rate_upd').val(); } else { var int_rate_upd = ''; }
        if ($('#due_period_upd').val()) { var due_period_upd = $('#due_period_upd').val(); } else { var due_period_upd = ''; }
        if ($('#doc_charge_upd').val()) { var doc_charge_upd = $('#doc_charge_upd').val(); } else { var doc_charge_upd = ''; }
        if ($('#proc_fee_upd').val()) { var proc_fee_upd = $('#proc_fee_upd').val(); } else { var proc_fee_upd = ''; }

        $.ajax({ //show scheme based loan info using scheme id
            url: 'verificationFile/LoanCalculation/getSchemeDetails.php',
            dataType: 'json',
            type: 'post',
            data: { 'scheme_id': scheme_id },
            cache: false,
            success: function (response) {
                //To set min and maximum 

                $('#int_rate').val(response['intrest_rate']); $('#int_rate').attr('readonly', true); // setting readonly due to fixed interest

                $('#due_period').val(response['due_period']); $('#due_period').attr('readonly', true); // setting readonly due to fixed due period

                if (response['doc_charge_type'] == 'amt') { type = '₹' } else if (response['doc_charge_type'] == 'percentage') { type = '%'; } //Setting symbols
                $('.min-max-doc').text('* (' + response['doc_charge_min'] + ' ' + type + ' - ' + response['doc_charge_max'] + ' ' + type + ') '); //setting min max values in span
                $('#doc_charge').attr('onBlur', `if( parseInt($(this).val()) > '` + response['doc_charge_max'] + `' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseInt($(this).val()) < '`+ response['doc_charge_min'] + `' && parseInt($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                $('#doc_charge').val(doc_charge_upd);

                if (response['proc_fee_type'] == 'amt') { type = '₹' } else if (response['proc_fee_type'] == 'percentage') { type = '%'; }//Setting symbols
                $('.min-max-proc').text('* (' + response['proc_fee_min'] + ' ' + type + ' - ' + response['proc_fee_max'] + ' ' + type + ') ');//setting min max values in span
                $('#proc_fee').attr('onBlur', `if( parseInt($(this).val()) > '` + response['proc_fee_max'] + `' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                    if( parseInt($(this).val()) < '`+ response['proc_fee_min'] + `' && parseInt($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                $('#proc_fee').val(doc_charge_upd);
            }
        })
    } else {
        $('#int_rate').val(''); $('#int_rate').attr('readonly', false);
        $('#due_period').val(''); $('#due_period').attr('readonly', false);
        $('.min-max-int').text('*');
        $('.min-max-due').text('*');
        $('.min-max-doc').text('*');
        $('.min-max-proc').text('*');

        $('#due_start_from').val('');
        $('#maturity_month').val('');
    }
}

//To Get Loan Calculation for After Interest
function getLoanAfterInterest() {
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();
    
    $('#loan_amt_cal').val(parseInt(loan_amt).toFixed(0)); //get loan amt from loan info card
    $('#principal_amt_cal').val(parseInt(loan_amt).toFixed(0)); // principal amt as same as loan amt for after interest

    var interest_rate = (parseInt(loan_amt) * (parseFloat(int_rate)/100) * parseInt(due_period)).toFixed(0); //Calculate interest rate 
    
    var roundedInterest = Math.ceil(interest_rate / 5) * 5; //to increase interest rate to nearest multiple of 5
    if (roundedInterest < interest_rate) {
        roundedInterest += 5;
    }

    $('.int-diff').text('* (Difference: +' + parseInt(roundedInterest - interest_rate) + ')'); //To show the difference amount
    $('#int_amt_cal').val(parseInt(roundedInterest));

    var tot_amt = parseInt(loan_amt) + parseFloat(interest_rate); //Calculate total amount from principal/loan amt and interest rate
    $('#tot_amt_cal').val(parseInt(tot_amt).toFixed(0));

    var due_amt = parseInt(tot_amt) / parseInt(due_period);//To calculate due amt by dividing total amount and due period given on loan info
    $('#due_amt_cal').val(parseInt(due_amt).toFixed(0));

    var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    $('#doc_charge_cal').val(parseInt(doc_charge).toFixed(0));

    var proc_fee = parseInt(loan_amt) * (parseFloat(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    $('#proc_fee_cal').val(parseInt(proc_fee).toFixed(0));

    var net_cash = parseInt(loan_amt) - parseFloat(doc_charge) - parseFloat(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(parseInt(net_cash).toFixed(0));
}

//To Get Loan Calculation for Pre Interest
function getLoanPreInterest() {
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();
    $('#loan_amt_cal').val(parseInt(loan_amt).toFixed(0)); //get loan amt from loan info card


    var int_amt = (parseInt(loan_amt) * (parseFloat(int_rate)/100) * parseInt(due_period)).toFixed(0); //Calculate interest rate 
    var roundedInterest = Math.ceil(int_amt / 5) * 5;
    if (roundedInterest < int_amt) {
        roundedInterest += 5;
    }
    $('.int-diff').text('* (Difference: +' + parseInt(roundedInterest - int_amt) + ')'); //To show the difference amount
    $('#int_amt_cal').val(parseInt(roundedInterest));

    var princ_amt = parseInt(loan_amt) - parseInt(int_amt); // Calculate principal amt by subracting interest amt from loan amt
    $('#principal_amt_cal').val(parseInt(princ_amt).toFixed(0)); 

    var tot_amt = parseInt(princ_amt) + parseFloat(int_amt); //Calculate total amount from principal/loan amt and interest rate
    $('#tot_amt_cal').val(parseInt(tot_amt).toFixed(0));

    var due_amt = parseInt(tot_amt) / parseInt(due_period);//To calculate due amt by dividing total amount and due period given on loan info
    $('#due_amt_cal').val(parseInt(due_amt).toFixed(0));

    var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    $('#doc_charge_cal').val(parseInt(doc_charge).toFixed(0));

    var proc_fee = parseInt(loan_amt) * (parseFloat(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    $('#proc_fee_cal').val(parseInt(proc_fee).toFixed(0));

    var net_cash = parseInt(princ_amt) - parseInt(doc_charge) - parseInt(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(parseInt(net_cash).toFixed(0));
}

//To Get Loan Calculation for Interest due type
function getLoanInterest() {
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();

    $('#loan_amt_cal').val(parseInt(loan_amt).toFixed(0)); //get loan amt from loan info card
    $('#principal_amt_cal').val(parseInt(loan_amt).toFixed(0)); 

    $('#tot_amt_cal').val('');
    $('#due_amt_cal').val('');//Due period will be monthly by default so no need of due amt
    
    var int_amt = (parseInt(loan_amt) * (parseFloat(int_rate)/100)).toFixed(0) ; //Calculate interest rate 

    var roundedInterest = Math.ceil(int_amt / 5) * 5;
    if (roundedInterest < int_amt) {
        roundedInterest += 5;
    }
    $('.int-diff').text('* (Difference: +' + parseInt(roundedInterest - int_amt) + ')'); //To show the difference amount
    $('#int_amt_cal').val(parseInt(roundedInterest));

    var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    $('#doc_charge_cal').val(parseInt(doc_charge).toFixed(0));

    var proc_fee = parseInt(loan_amt) * (parseFloat(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    $('#proc_fee_cal').val(parseInt(proc_fee).toFixed(0));

    var net_cash = parseInt(loan_amt) - parseInt(doc_charge) - parseInt(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(parseInt(net_cash).toFixed(0));
}

//To Get Loan Calculation for Monthly Scheme method
function getLoanMonthly() {
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();

    $('#loan_amt_cal').val(parseInt(loan_amt).toFixed(0)); //get loan amt from loan info card

    var int_amt = (parseInt(loan_amt) * (parseFloat(int_rate)/100)).toFixed(0) ; //Calculate interest rate 
    var roundedInterest = Math.ceil(int_amt / 5) * 5;
    if (roundedInterest < int_amt) {
        roundedInterest += 5;
    }
    $('.int-diff').text('* (Difference: +' + parseInt(roundedInterest - int_amt) + ')'); //To show the difference amount
    $('#int_amt_cal').val(parseInt(roundedInterest));

    var princ_amt = parseInt(loan_amt) - parseInt(int_amt); // Calculate principal amt by subracting interest amt from loan amt
    $('#principal_amt_cal').val(princ_amt);

    var tot_amt = parseInt(princ_amt) + parseFloat(int_amt); //Calculate total amount from principal/loan amt and interest rate
    $('#tot_amt_cal').val(parseInt(tot_amt).toFixed(0));

    var due_amt = parseInt(tot_amt) / parseInt(due_period);//To calculate due amt by dividing total amount and due period given on loan info
    $('#due_amt_cal').val(parseInt(due_amt).toFixed(0));

    var doc_type = $('.min-max-doc').text(); //Scheme may have document charge in rupees or percentage . so getting symbol from span
    if(doc_type.includes('₹')){
        var doc_charge = parseInt(doc_charge) ; //Get document charge from loan info and directly show the document charge provided because of it is in rupees
    }else if(doc_type.includes('%')){
        var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    }
    $('#doc_charge_cal').val(parseInt(doc_charge).toFixed(0));

    var proc_type = $('.min-max-proc').text(); //Scheme may have Processing fee in rupees or percentage . so getting symbol from span
    if(proc_type.includes('₹')){
        var proc_fee =parseInt(proc_fee);//Get processing fee from loan info and directly show the Processing Fee provided because of it is in rupees
    }else if(proc_type.includes('%')){
        var proc_fee = parseInt(loan_amt) * (parseInt(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    }
    $('#proc_fee_cal').val(parseInt(proc_fee).toFixed(0));

    var net_cash = parseInt(princ_amt) - parseInt(doc_charge) - parseInt(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(parseInt(net_cash).toFixed(0));
}

//To Get Loan Calculation for Weekly Scheme method
function getLoanWeekly() {
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();

    $('#loan_amt_cal').val(parseInt(loan_amt).toFixed(0)); //get loan amt from loan info card

    var int_amt = (parseInt(loan_amt) * (parseFloat(int_rate)/100)).toFixed(0) ; //Calculate interest rate 
    var roundedInterest = Math.ceil(int_amt / 5) * 5;
    if (roundedInterest < int_amt) {
        roundedInterest += 5;
    }
    $('.int-diff').text('* (Difference: +' + parseInt(roundedInterest - int_amt) + ')'); //To show the difference amount
    $('#int_amt_cal').val(parseInt(roundedInterest));

    var princ_amt = parseInt(loan_amt) - parseInt(int_amt); // Calculate principal amt by subracting interest amt from loan amt
    $('#principal_amt_cal').val(parseInt(princ_amt).toFixed(0)); 

    var tot_amt = parseInt(princ_amt) + parseFloat(int_amt); //Calculate total amount from principal/loan amt and interest rate
    $('#tot_amt_cal').val(parseInt(tot_amt).toFixed(0));

    var due_amt = parseInt(tot_amt) / parseInt(due_period);//To calculate due amt by dividing total amount and due period given on loan info
    $('#due_amt_cal').val(parseInt(due_amt).toFixed(0));

    var doc_type = $('.min-max-doc').text(); //Scheme may have document charge in rupees or percentage . so getting symbol from span
    if(doc_type.includes('₹')){ 
        var doc_charge = parseInt(doc_charge) ; //Get document charge from loan info and directly show the document charge provided because of it is in rupees
    }else if(doc_type.includes('%')){
        var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    }
    $('#doc_charge_cal').val(parseInt(doc_charge).toFixed(0));

    var proc_type = $('.min-max-proc').text();//Scheme may have Processing fee in rupees or percentage . so getting symbol from span
    if(proc_type.includes('₹')){
        var proc_fee =parseInt(proc_fee);//Get processing fee from loan info and directly show the Processing Fee provided because of it is in rupees
    }else if(proc_type.includes('%')){
        var proc_fee = parseInt(loan_amt) * (parseInt(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    }
    $('#proc_fee_cal').val(parseInt(proc_fee).toFixed(0));

    var net_cash = parseInt(princ_amt) - parseInt(doc_charge) - parseInt(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(parseInt(net_cash).toFixed(0));
}

//To Get Loan Calculation for Daily Scheme method
function getLoanDaily() {
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();

    $('#loan_amt_cal').val(parseInt(loan_amt).toFixed(0)); //get loan amt from loan info card

    var int_amt = (parseInt(loan_amt) * (parseFloat(int_rate)/100)).toFixed(0) ; //Calculate interest rate 
    var roundedInterest = Math.ceil(int_amt / 5) * 5;
    if (roundedInterest < int_amt) {
        roundedInterest += 5;
    }
    $('.int-diff').text('* (Difference: +' + parseInt(roundedInterest - int_amt) + ')'); //To show the difference amount
    $('#int_amt_cal').val(parseInt(roundedInterest));

    var princ_amt = parseInt(loan_amt) - parseInt(int_amt); // Calculate principal amt by subracting interest amt from loan amt
    $('#principal_amt_cal').val(parseInt(princ_amt).toFixed(0)); 

    var tot_amt = parseInt(princ_amt) + parseFloat(int_amt); //Calculate total amount from principal/loan amt and interest rate
    $('#tot_amt_cal').val(parseInt(tot_amt).toFixed(0));

    var due_amt = parseInt(tot_amt) / parseInt(due_period);//To calculate due amt by dividing total amount and due period given on loan info
    $('#due_amt_cal').val(parseInt(due_amt).toFixed(0));

    var doc_type = $('.min-max-doc').text(); //Scheme may have document charge in rupees or percentage . so getting symbol from span
    if(doc_type.includes('₹')){ 
        var doc_charge = parseInt(doc_charge) ; //Get document charge from loan info and directly show the document charge provided because of it is in rupees
    }else if(doc_type.includes('%')){
        var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    }
    $('#doc_charge_cal').val(parseInt(doc_charge).toFixed(0));

    var proc_type = $('.min-max-proc').text();//Scheme may have Processing fee in rupees or percentage . so getting symbol from span
    if(proc_type.includes('₹')){
        var proc_fee =parseInt(proc_fee);//Get processing fee from loan info and directly show the Processing Fee provided because of it is in rupees
    }else if(proc_type.includes('%')){
        var proc_fee = parseInt(loan_amt) * (parseInt(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    }
    $('#proc_fee_cal').val(parseInt(proc_fee).toFixed(0));

    var net_cash = parseInt(princ_amt) - parseInt(doc_charge) - parseInt(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(parseInt(net_cash).toFixed(0));
}

//Validation for Loan calculation
function loan_calc_validation() {
    var cus_id_loan = $('#cus_id_loan').val(); //if this is empty means , customer profile is not submitted yet
    var loan_category = $('#loan_category').val(); var sub_category = $('#sub_category').val(); var tot_value = $('#tot_value').val(); var ad_amt = $('#ad_amt').val();
    var loan_amt = $('#loan_amt').val(); var due_type = $('#due_type').val();
    var profit_type = $('#profit_type').val(); var due_method_scheme = $('#due_method_scheme').val(); var day_scheme = $('#day_scheme').val(); var scheme_name = $('#scheme_name').val();
    var profit_method = $('#profit_method').val(); var int_rate = $('#int_rate').val(); var due_period = $('#due_period').val(); var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val(); var loan_amt_cal = $('#loan_amt_cal').val(); var principal_amt_cal = $('#principal_amt_cal').val(); var int_amt_cal = $('#int_amt_cal').val();
    var tot_amt_cal = $('#tot_amt_cal').val(); var due_amt_cal = $('#due_amt_cal').val(); var doc_charge_cal = $('#doc_charge_cal').val(); var proc_fee_cal = $('#proc_fee_cal').val();
    var net_cash_cal = $('#net_cash_cal').val(); var due_start_from = $('#due_start_from').val(); var maturity_month = $('#maturity_month').val(); var collection_method = $('#collection_method').val();

    if (cus_id_loan == '') {
        Swal.fire({
            timerProgressBar: true,
            timer: 2000,
            title: 'Please Complete Customer Profile!',
            icon: 'error',
            showConfirmButton: true,
            confirmButtonColor: '#009688'
        });
        event.preventDefault();
    }

    if (loan_category == '') {
        $('#loancategoryCheck').show();
        event.preventDefault();
    } else {
        $('#loancategoryCheck').hide();
    }

    if (sub_category == '') {
        $('#subcategoryCheck').show();
        event.preventDefault();
    } else {
        $('#subcategoryCheck').hide();
    }

    if (tot_value == '' && $('.advance_yes').css('display') != "none") {
        $('#total_valueCheck').show();
        event.preventDefault();
    } else {
        $('#total_valueCheck').hide();
    }

    if (ad_amt == '' && $('.advance_yes').css('display') != "none") {
        $('#ad_amtCheck').show();
        event.preventDefault();
    } else {
        $('#ad_amtCheck').hide();
    }

    if (loan_amt == '') {
        $('#loan_amtCheck').show();
        event.preventDefault();
    } else {
        $('#loan_amtCheck').hide();
    }

    if (profit_type == '') {
        $('#profit_typeCheck').show();
        event.preventDefault();
    } else {
        $('#profit_typeCheck').hide();
    }

    if (profit_method == '' && due_type == 'EMI') {
        $('#profit_methodCheck').show();
        event.preventDefault();
    } else {
        $('#profit_methodCheck').hide();
    }

    if (due_method_scheme == '' && $('.scheme').css('display') != 'none') {
        $('#due_method_schemeCheck').show();
        event.preventDefault();
    } else {
        $('#due_method_schemeCheck').hide();
    }

    if (day_scheme == '' && $('.day_scheme').css('display') != 'none') {
        $('#day_schemeCheck').show();
        event.preventDefault();
    } else {
        $('#day_schemeCheck').hide();
    }

    if (scheme_name == '' && $('.scheme').css('display') != 'none') {
        $('#scheme_nameCheck').show();
        event.preventDefault();
    } else {
        $('#scheme_nameCheck').hide();
    }

    if (int_rate == '') {
        $('#int_rateCheck').show();
        event.preventDefault();
    } else {
        $('#int_rateCheck').hide();
    }

    if (due_period == '') {
        $('#due_periodCheck').show();
        event.preventDefault();
    } else {
        $('#due_periodCheck').hide();
    }

    if (doc_charge == '') {
        $('#doc_chargeCheck').show();
        event.preventDefault();
    } else {
        $('#doc_chargeCheck').hide();
    }

    if (proc_fee == '') {
        $('#proc_feeCheck').show();
        event.preventDefault();
    } else {
        $('#proc_feeCheck').hide();
    }

    if (due_start_from == '') {
        $('#due_start_fromCheck').show();
        event.preventDefault();
    } else {
        $('#due_start_fromCheck').hide();
    }

    if (maturity_month == '') {
        $('#maturity_monthCheck').show();
        event.preventDefault();
    } else {
        $('#maturity_monthCheck').hide();
    }

    if (collection_method == '') {
        $('#collection_methodCheck').show();
        event.preventDefault();
    } else {
        $('#collection_methodCheck').hide();
    }



}

//////////////////////////////////////////////////////////////////// Loan Calculation Functions End ///////////////////////////////////////////////////////////////////////////////