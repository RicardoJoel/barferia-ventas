let preCst = $('#_method').val() ? '../' : '';

$("#mobile").inputmask({"mask":"999 999 999"});
$("#phone").inputmask({"mask":"99 999 9999"});

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
        url: preCst + '../documentType/' + $('#document_type_id').val(),
        success: function(data) {
            let value = $('#document').val();
            $('#document')
                .prop('disabled',false)
                .prop('maxlength',data.length)
                .attr('onkeypress','return check' + (data.is_number ? 'Number' : 'AlNum') + '(event)')
                .val((data.is_number ? getNumbersInString(value) : value).substr(0, data.length));
            $('#doc_pattern').val(data.is_exact ? '[0-9]{' + data.length + '}' : '[A-Za-z0-9]{1,' + data.length + '}');
            $('body').loadingModal('destroy');
        },
        error: function(msg) {
            $('body').loadingModal('destroy');
            alert(JSON.stringify(msg.responseJSON['errors']));
        }
    });
}