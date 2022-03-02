$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

const preDist = $('#_method').val() ? '../' : '';

let tblDet = $('#tbl-details').DataTable({
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
        targets: 8,
        visible: false
    }],
    footerCallback: function () {
        var api = this.api();

        // Total stock inicial origen
        iniOrg = api.column(1).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total stock inicial destino
        iniDst = api.column(2).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total enviados
        totEnv = api.column(3).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total recibidos
        totRec = api.column(4).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total devueltos
        totDev = api.column(5).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total stock final origin
        finOrg = api.column(6).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total stock final destino
        finDst = api.column(7).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);

        // Update footer stock inicial origen
        $(api.column(1).footer()).html(intVal(iniOrg));
        // Update footer stock inicial destino
        $(api.column(2).footer()).html(intVal(iniDst));
        // Update footer enviados
        $(api.column(3).footer()).html(intVal(totEnv));
        // Update footer recibidos
        $(api.column(4).footer()).html(intVal(totRec));
        // Update footer devueltos
        $(api.column(5).footer()).html(intVal(totDev));
        // Update footer stock final origin
        $(api.column(6).footer()).html(intVal(finOrg));
        // Update footer stock final destino
        $(api.column(7).footer()).html(intVal(finDst));
    }
});

$(function() {
    $('#tbl-details tbody').on('click', 'tr', function() {
        var row = tblDet.row(this);
        var data = row.data();
        $('#det_idx').val(row[0]);
        $('#det_product').val(data[0]);
        $('#det_openstock').val(data[1]);
        $('#det_opendestiny').val(data[2]);
        $('#det_quantity').val(data[3]);
        $('#det_received').val(data[4]);
        $('#det_returned').val(data[5]);
        $('#det_finalstock').val(data[6]);
        $('#det_finaldestiny').val(data[7]);
        $('#det_observation').val(data[8]);
        $('#det_destiny').val($('#destiny_id option:selected').text());
        $('#det_fail_div').css('display','none');
        $('#mdl-detail').modal('show');
    });
    
    $('#det_form').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post($(this).attr('action'), $(this).serialize())
        .done(function(data) {
            $('body').loadingModal('destroy');
            tblDet.clear().draw();
            var dataSet = [];
            $(JSON.parse(data)).each(function() {
                dataSet.push([
                    this.product,
                    this.openstock,
                    this.opendestiny,
                    this.quantity,
                    this.received,
                    this.returned,
                    this.finalstock,
                    this.finaldestiny,
                    this.observation
                ]);
            });
            tblDet.rows.add(dataSet).draw();
            $('#det_fail_div').css('display','none');
            $('#mdl-detail').modal('hide');
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            var message = '<p><b>¡Atención!</b></p><ul>';
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            $('#det_fail_msg').html(message + '</ul>');
            $('#det_fail_div').css('display','block');
        });
    });

    $('#mdl-detail input').click(function () {
        $(this).select();
    });

    $('#mdl-detail input').change(function () {
        var openstock = $('#det_openstock').val();
        var opendestiny = $('#det_opendestiny').val();
        var quantity = $('#det_quantity').val();
        var received = $('#det_received').val();
        var returned = $('#det_returned').val();
        $('#det_finalstock').val(intVal(openstock) - intVal(quantity) + intVal(returned));
        $('#det_finaldestiny').val(intVal(opendestiny) + intVal(received));
    });

    $('#origin_id').change(function () {
        changeCenters();
    });

    $('#destiny_id').change(function () {
        changeCenters();
    });

    function changeCenters() {
        var org = $('#origin_id').val();
        var dst = $('#destiny_id').val();
        if (!org || !dst) return;
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post(preDist + '../distdetails.change/' + org + '/' + dst)
        .done(function(data) {
            $('body').loadingModal('destroy');
            tblDet.clear().draw();
            var dataSet = [];
            $(JSON.parse(data)).each(function() {
                dataSet.push([
                    this.product,
                    this.openstock,
                    this.opendestiny,
                    this.quantity,
                    this.received,
                    this.returned,
                    this.finalstock,
                    this.finaldestiny,
                    this.observation
                ]);
            });
            tblDet.rows.add(dataSet).draw();
            $('#det_fail_div').css('display','none');
            $('#mdl-detail').modal('hide');
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            var message = '<p><b>¡Atención!</b></p><ul>';
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            $('#det_fail_msg').html(message + '</ul>');
            $('#det_fail_div').css('display','block');
        });
    }
});