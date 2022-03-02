$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

const preInv = $('#_method').val() ? '../' : '';

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
    footerCallback: function () {
        var api = this.api();

        // Total stock inicial
        totIni = api.column(1).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total entrada
        totEnt = api.column(2).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total salida
        totSal = api.column(3).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total devolución
        totDev = api.column(4).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total descarte
        totDes = api.column(5).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total stock final
        totFin = api.column(6).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);

        // Update footer stock inicial
        $(api.column(1).footer()).html(intVal(totIni));
        // Update footer entrada
        $(api.column(2).footer()).html(intVal(totEnt));
        // Update footer salida
        $(api.column(3).footer()).html(intVal(totSal));
        // Update footer devolución
        $(api.column(4).footer()).html(intVal(totDev));
        // Update footer descarte
        $(api.column(5).footer()).html(intVal(totDes));
        // Update footer stock final
        $(api.column(6).footer()).html(intVal(totFin));
    }
});

$(function() {
    $('#tbl-details tbody').on('click', 'tr', function() {
        var row = tblDet.row(this);
        var data = row.data();
        $('#det_idx').val(row[0]);
        $('#det_product').val(data[0]);
        $('#det_openstock').val(data[1]);
        $('#det_entry').val(data[2]);
        $('#det_exit').val(data[3]);
        $('#det_returned').val(data[4]);
        $('#det_removed').val(data[5]);
        $('#det_finalstock').val(data[6]);
        $('#det_center').val($('#center_id option:selected').text());
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
                    this.entry,
                    this.exit,
                    this.returned,
                    this.removed,
                    this.finalstock
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
        var entry = $('#det_entry').val();
        var exit = $('#det_exit').val();
        var returned = $('#det_returned').val();
        var removed = $('#det_removed').val();
        $('#det_finalstock').val(intVal(openstock) + intVal(entry) - intVal(exit) + intVal(returned) - intVal(removed));
    });

    $('#center_id').change(function () {
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post(preInv + '../invdetails.change/' + $(this).val())
        .done(function(data) {
            $('body').loadingModal('destroy');
            tblDet.clear().draw();
            var dataSet = [];
            $(JSON.parse(data)).each(function() {
                dataSet.push([
                    this.product,
                    this.openstock,
                    this.entry,
                    this.exit,
                    this.returned,
                    this.removed,
                    this.finalstock,
                ]);
            });
            tblDet.rows.add(dataSet).draw();
            $('#det_fail_div').css('display','none');
            $('#mdl-detail').modal('hide');
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            var message = '<p><b>¡Atención!</b></p><ul>';
            $.each(msg.responseJSON['errors'], function() { message += addItem(this); });
            $('#det_fail_msg').html(message + '</ul>');
            $('#det_fail_div').css('display','block');
        });
    });
});