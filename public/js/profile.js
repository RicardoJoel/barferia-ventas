$("#mobile").inputmask({"mask":"999 999 999"});
$("#phone").inputmask({"mask":"99 999 9999"});
$("#contact_mobile").inputmask({"mask":"999 999 999"});
$("#contact_phone").inputmask({"mask":"99 999 9999"});

$('#ubigeo').editableSelect();
var other = $('#other_ubigeo').val();
if (other) $('#ubigeo').val(other);

$('#contact_ubigeo').editableSelect();
var contact_other = $('#contact_other_ubigeo').val();
if (contact_other) $('#contact_ubigeo').val(contact_other);