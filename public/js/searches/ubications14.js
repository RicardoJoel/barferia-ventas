let tblUbi = $('#tbl-ubications').DataTable({
    lengthChange: false,
    searching: false,
    language: {
        'decimal': '',
        'emptyTable': 'No hay información para mostrar',
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
        targets: [3, 4, 5],
        visible: false
    }]
});

let tblClr = $('#tbl-closest-rmv').DataTable({
    lengthChange: false,
    searching: false,
    paginate: false,
    ordering: false,
    bInfo : false,
	language: {
		'decimal': '',
		'emptyTable': 'No hay información para mostrar',
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
    $('#tbl-ubications tbody').on('click', 'tr', function() {
        var data = tblUbi.row(this).data();
        prev_center_id = $('#center_id').val();
        prev_manager = $('#center_manager').val();
        prev_mobile = $('#center_mobile').val();
        $('#customer_id').val($('#ubic_cust_id').val());
        $('#customer_doc').val($('#ubic_cust_doc').val());
        $('#customer_name').val($('#ubic_cust_name').val());
        $('#customer_lastname').val($('#ubic_cust_lastname').val());
        $('#customer_code').val($('#ubic_cust_code').val());
        $('#customer_email').val($('#ubic_cust_email').val());
        $('#customer_phone').val($('#ubic_cust_phone').val());
        $('#customer_mobile').val(mobile($('#ubic_cust_mobile').val()));
        $('#address').val(data[0]);
        $('#ubigeo').val(data[1]);
        $('#reference').val(data[2]);
        $('#latitude').val(data[3]);
        $('#longitude').val(data[4]);
        $('#location_id').val(data[5]);
        //Getting closest distribution center
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: preSal + '../centers.getClosest/' + data[3] + '/' + data[4],
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
    });

    $('#frm-sch-ubic').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            data: $(this).serialize(),
            url: $(this).attr('action'),
            success: function(data) {
                $('body').loadingModal('destroy');
                tblUbi.clear().draw();
                var dataSet = [];
                $(JSON.parse(data)).each(function() {
                    dataSet.push([
                        this.address,
                        this.ubigeo,
                        this.ref,
                        this.lat,
                        this.lng,
                        this.id
                    ]);
                });
                tblUbi.rows.add(dataSet).draw();
                $('#fail-div-ubic').css('display','none');
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                $('#fail-msg-ubic').text(JSON.stringify(msg));
                $('#fail-div-ubic').css('display','block');
            }
        });
    });

    $('#mdl-closest').on('hidden.bs.modal', function () {
        setPreValues();
	});
});

function clearFormUbic() {
    $('#ubic_address').val('');
    $('#ubic_ubigeo').val('');
    $('#fail-div-ubic').css('display','none');
    tblUbi.clear().draw();
}

function sendOnlyCust() {
    $('#customer_id').val($('#ubic_cust_id').val());
    $('#customer_doc').val($('#ubic_cust_doc').val());
    $('#customer_name').val($('#ubic_cust_name').val());
    $('#customer_lastname').val($('#ubic_cust_lastname').val());
    $('#customer_email').val($('#ubic_cust_email').val());
    $('#customer_phone').val($('#ubic_cust_phone').val());
    $('#customer_mobile').val(mobile($('#ubic_cust_mobile').val()));
    $('#address').val('');
    $('#ubigeo').val('');
    $('#reference').val('');
    $('#latitude').val('');
    $('#longitude').val('');
    $('#location_id').val('');
    $('#mdl-sch-ubic').modal('hide');
}

function mobile(str) {
    return str ? str.slice(-11) : '';
}