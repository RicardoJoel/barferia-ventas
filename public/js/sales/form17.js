$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#customer_mobile").inputmask({"mask":"999 999 999"});
$("#customer_phone").inputmask({"mask":"99 999 9999"});
$("#new_mobile").inputmask({"mask":"999 999 999"});
$("#cust_mob").inputmask({"mask":"999 999 999"});

$('#ubic_ubigeo').editableSelect();

var other = $('#other_ubigeo').val();
if (other) $('#ubigeo').val(other);

var edit = false;

let tblStk = $('#tbl-stock').DataTable({
    lengthChange: false,
    searching: false,
    paginate: false,
    ordering: false,
    bInfo : false,
	language: {
		'decimal': '',
		'emptyTable': 'No se encontraron productos.',
		'info': 'Mostrando _START_ a _END_ de _TOTAL_ entradas',
		'infoEmpty': 'Mostrando 0 to 0 of 0 entradas',
		'infoFiltered': '(Filtrado de _MAX_ total entradas)',
		'infoPostFix': '',
		'thousands': ',',
		'lengthMenu': 'Mostrar _MENU_ entradas',
		'loadingRecords': 'Cargando...',
		'processing': 'Procesando...',
		'search': 'Buscar ',
		'zeroRecords': 'Sin resultados encontrados',
		'paginate': {
			'first': 'Primero',
			'last': 'Último',
			'next': 'Siguiente',
			'previous': 'Anterior'
		}
    },
    columnDefs: [{
        targets: [1, 2],
        className: "text-center"
    }]
});

$(function() {
    $('#btn-submit').click(function() {
        var form = $('#frm-customer');
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post(form.attr('action'), form.serialize())
        .done(function(data) {
            $('body').loadingModal('destroy');
            tblCust.clear().draw();
            var dataSet = [];
            $(data.object).each(function() {
                dataSet.push([
                    this.code,
                    this.name,
                    this.document,
                    this.mobile,
                    this.email,
                    '<a name="' + this.id + '" onclick="editCustomer(this)"><i class="fa fa-edit"></i></a>',
                    this.phone,
                    this.id,
                ]);
            });
            tblCust.rows.add(dataSet).draw();
            $('#info-msg-cust').html('<p><b>¡Excelente!</b> ' + data.message + '</p>');
            $('#info-div-cust').css('display','block');
            $('#mdl-new-cust').modal('hide');
            $('#mdl-sch-cust').modal('show');
            //clearFormLoc();
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
			var message = '<p><b>¡Atención!</b> Revisa los campos obligatorios.</p><br><ul>';
			$.each(msg.responseJSON['errors'], function() { message += addItem(this); });
            $('#fail-msg-form').html(message + '</ul>');
            $('#fail-div-form').css('display','block');
            $("#modal-body").scrollTop(0);
        });
    });

    $('#mdl-new-cust').on('hidden.bs.modal', function () {
    });

    $('#mdl-new-cust').on('shown.bs.modal', function () {
        $('#modal-body').scrollTop(0);
        $('#fail-div-form').css('display','none');
    });

    $('#mdl-sch-cust').on('hidden.bs.modal', function () {
        $('#fail-div-cust').css('display','none');
        $('#info-div-cust').css('display','none');
    });
});

function editCustomer(e) {
    edit = true; 
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: preSal + '../customers.getFromSale/' + e.name,
        success: function(data) {
            $('body').loadingModal('destroy');
            var item = JSON.parse(data);
            $('#id').val(item.id);
            $('#code').val(item.code);
            $('#name').val(item.name);
            $('#lastname').val(item.lastname);
            $('#birthdate').val(item.birthdate);
            $('#document_type_id').val(item.document_type_id);
            $('#document').val(item.document);
            $('#email').val(item.email);
            $('#country_id').val(item.country_id);
            $('#mobile').val(item.mobile);
            $('#phone').val(item.phone);
            if (item.document_type_id) setDocFormat();
            tblLoc.clear().draw();
            var dataSet = [];
            $(item.locations).each(function(index) {
                dataSet.push([
                    this.address,
                    this.ubigeo,
                    this.ref,
                    '<center><a name="' + index + '" onclick="editLoc(this)"><i class="fa fa-edit"></i></a></center>',
                    '<center><a name="' + index + '" onclick="removeLoc(this)"><i class="fa fa-trash"></i></a></center>'
                ]);
            });
            tblLoc.rows.add(dataSet).draw();
            tblPet.clear().draw();
            dataSet = [];
            $(item.pets).each(function(index) {
                dataSet.push([
                    this.name ?? '',
                    '<center>' + (this.species ?? '') + ' / ' + (this.gender ?? '') + '</center>',
                    this.race ?? '',
                    '<center>' + (this.birthdate ? moment(this.birthdate).format('L') : '') + '</center>',
                    this.observation ?? '',
                    '<center><a name="' + index + '" onclick="editPet(this)"><i class="fa fa-edit"></i></a></center>',
                    '<center><a name="' + index + '" onclick="removePet(this)"><i class="fa fa-trash"></i></a></center>'
                ]);
            });
            tblPet.rows.add(dataSet).draw();
            //Personalizacion del modal
            $('.cust').css('display','inline-block');
            $('.ubic').css('display','none');
            $('#modal-title').text('Editar cliente');
            $('#btn-submit').html('<i class="fa fa-save"></i>&nbsp;Guardar');
            $('#frm-customer').attr('action',preSal + '../customers.updateFromSale');
            $('#mdl-sch-cust').modal('hide');
            $('#mdl-new-cust').modal('show');
            edit = false;
        },
        error: function(msg) {
            $('body').loadingModal('destroy');
            $('#fail-div-cust').text(JSON.stringify(msg.responseJSON['errors']));
            $('#fail-div-cust').css('display','block');
            edit = false;
        }
    });
}

function showModalCust() {
    $('#id').val('');
    $('#code').val('');
    $('#name').val('');
    $('#lastname').val('');
    $('#birthdate').val('');
    $('#document_type_id').val(1);
    $('#document').val('');
    $('#email').val('');
    $('#country_id').val(164);
    $('#mobile').val('');
    $('#phone').val('');
    tblLoc.clear().draw();
    tblPet.clear().draw();
    //Personalizacion del modal
    $('.cust').css('display','inline-block');
    $('.ubic').css('display','none');
    $('#modal-title').text('Nuevo cliente');
    $('#btn-submit').html('<i class="fa fa-save"></i>&nbsp;Registrar');
    $('#frm-customer').attr('action',preSal + '../customers.storeFromSale');
    $('#mdl-new-cust').modal('show');
}

function showModalLoc() {
    var add = $('#address').val();
    var ubi = $('#ubigeo').val();
    var ref = $('#reference').val();
    var lat = $('#latitude').val();
    var lng = $('#longitude').val();
    $('#loc_address').val(add);
    $('#loc_ubigeo').val(ubi);
    $('#loc_ref').val(ref);
    $('#loc_lat').val(lat);
    $('#loc_lng').val(lng);
    if (add) setMarket(lat, lng, add);
    else clearMap();
    $('.cust').css('display','none');
    $('.ubic').css('display','inline-block');
    $('#modal-title').text('Destino');
    $('#mdl-new-cust').modal('show');
}

function showModalStock() {
    $('#stock-title').text('Stock actual • ' + $('#center_id option:selected').text());
    refreshStock();
}

function refreshStock() {
    var center_id = $('#center_id').val();
    if (center_id) {
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: preSal + '../stocks.getByCenterId/' + center_id,
            success: function(data) {
                $('body').loadingModal('destroy');
                tblStk.clear().draw();
                var dataSet = [];
                $(data).each(function() {
                    dataSet.push([
                        this.product,
                        this.code,
                        this.quantity
                    ]);
                });
                tblStk.rows.add(dataSet).draw();
                $('#det_fail_div').css('display','none');
                $('#mdl-stock').modal('show');
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                /*var message = '<b>¡Atención!</b><ul>';
                $.each(msg.responseJSON['errors'], function() { message += addItem(this); });
                $('#det_fail_msg').html(message + '</ul>');*/
                $('#det_fail_msg').html(JSON.stringify(msg));
                $('#det_fail_div').css('display','block');
            }
        });
    }
}

function passLocation() {
    var add = $('#loc_address').val();
    var ubi = $('#loc_ubigeo').val();
    var ref = $('#loc_ref').val();
    var lat = $('#loc_lat').val();
    var lng = $('#loc_lng').val();
    $('#address').val(add);
    $('#ubigeo').val(ubi);
    $('#reference').val(ref);
    $('#latitude').val(lat);
    $('#longitude').val(lng);
    $('#location_id').val('');
    //Getting closest distribution center
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: preSal + '../centers.getClosest/' + lat + '/' + lng,
        success: function(data) {
            $('body').loadingModal('destroy');
            $('#center_id').val(data.center.id);
            $('#det_center_id').val(data.center.id);
            $('#center_name').text(data.center.name);
            $('#center_manager').val(data.center.manager);
            $('#center_mobile').val(data.center.mobile);
            tblClr.clear().draw();
            if (data.removed.length) {
                var dataSet = []; indexes = [];
                $(data.removed).each(function() {
                    indexes.push(this.index);
                    dataSet.push([
                        this.product,
                        this.code,
                        this.quantity
                    ]);
                })
                tblClr.rows.add(dataSet).draw();
            }
            $('#div-closest-rmv').css('display',data.removed.length ? 'block' : 'none');
            $('#mdl-sch-ubic').modal('hide');
            $('#mdl-closest').modal('show');
            $('#fail-div-ubic').css('display','none');
        },
        error: function(msg) {
            $('body').loadingModal('destroy');
            $('#fail-msg-ubic').text(JSON.stringify(msg));
            $('#fail-div-ubic').css('display','block');
        }
    });
}