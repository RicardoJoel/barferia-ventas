const preUsr = $('#_method').val() ? '../' : '';

$("#mobile").inputmask({"mask":"999 999 999"});
$("#phone").inputmask({"mask":"99 999 9999"});
$("#bank_account").inputmask({"mask":"9999-9999-99999999999"});
$("#cci").inputmask({"mask":"999-999-999999999999-99"});
$("#cts_account").inputmask({"mask":"9999-9999-99999999999"});
$("#contact_mobile").inputmask({"mask":"999 999 999"});
$("#contact_phone").inputmask({"mask":"99 999 9999"});

$('#ubigeo').editableSelect();
var other = $('#other_ubigeo').val();
if (other) $('#ubigeo').val(other);

$('#contact_ubigeo').editableSelect();
var contact_other = $('#contact_other_ubigeo').val();
if (contact_other) $('#contact_ubigeo').val(contact_other);

$('#profile_id').change(function() {
    setCenter();
});

if ($('#profile_id').val()) {
    setCenter();
}

function setCenter() {
    if ($('#profile_id').val() != 5)
        $('#center_id').prop('disabled',true).val('');
    else
        $('#center_id').prop('disabled',false);
}

$('#bank_id').change(function() {
    setBankAccount();
});

if ($('#bank_id').val()) {
    setBankAccount();
}

function setBankAccount() {
    $('#bank_account').prop('disabled',false);
    $('#cci').prop('disabled',false);
}

$('#cts_id').change(function() {
    setCTSAccount();
});

if ($('#cts_id').val()) {
    setCTSAccount();
}

function setCTSAccount() {
    if ($('#cts_id').val()) {
        $('#cts_account').prop('disabled',false);
    }
    else {
        $('#cts_account').prop('disabled',true);
        $('#cts_account').val('');
    }
}

$('#afp_id').change(function() {
    setCommission();
});

if ($('#afp_id').val()) {
    setCommission();
}

function setCommission() {
    if ($('#afp_id').val()) {
        $('#commission_id').prop('disabled',false);
        $('#cuspp').prop('disabled',false);
    }
    else {
        $('#commission_id').prop('disabled',true);
        $('#cuspp').prop('disabled',true);
        $('#commission_id').val('');
        $('#cuspp').val('');
    }
}

$('#commission_id').change(function() {
    setCUSPP();
});

if ($('#commission_id').val()) {
    setCUSPP();
}

function setCUSPP() {
    $('#cuspp').prop('disabled',false);
}

$('#document_type_id').change(function() {
    setDocFormat();
});

if ($('#document_type_id').val()) {
    setDocFormat();
}

function setDocFormat() {
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: preUsr + '../documentType/' + $('#document_type_id').val(),
        success: function(data) {
            $('body').loadingModal('destroy');
            var value = $('#document').val();
            $('#document')
                .prop('disabled',false)
                .prop('maxlength',data.length)
                .attr('onkeypress','return check' + (data.is_number ? 'Number' : 'AlNum') + '(event)')
                .val((data.is_number ? getNumbersInString(value) : value).substr(0, data.length));
            $('#doc_pattern').val(data.is_exact ? '[0-9]{' + data.length + '}' : '[A-Za-z0-9]{1,' + data.length + '}');
        },
        error: function(msg) {
            $('body').loadingModal('destroy');
            alert(JSON.stringify(msg.responseJSON['errors']));
        }
    });
}

$('#dependent_document_type_id').change(function() {
    setDepDocFormat();
});

if ($('#dependent_document_type_id').val()) {
    setDepDocFormat();
}

function setDepDocFormat() {
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: preUsr + '../documentType/' + $('#dependent_document_type_id').val(),
        success: function(data) {
            $('body').loadingModal('destroy');
            var value = $('#dependent_document').val();
            $('#dependent_document')
                .prop('disabled',false)
                .prop('maxlength',data.length)
                .attr('onkeypress','return check' + (data.is_number ? 'Number' : 'AlNum') + '(event)')
                .val((data.is_number ? getNumbersInString(value) : value).substr(0, data.length));
            $('#dependent_doc_pattern').val(data.is_exact ? '[0-9]{' + data.length + '}' : '[A-Za-z0-9]{1,' + data.length + '}');
        },
        error: function(msg) {
            $('body').loadingModal('destroy');
            alert(JSON.stringify(msg.responseJSON['errors']));
        }
    });
}