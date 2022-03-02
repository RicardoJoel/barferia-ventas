$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

const preProd = $('#_method').val() ? '../' : '';

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
        totIni = api.column(2).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total producción
        totPro = api.column(3).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total descarte
        totDes = api.column(4).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total stock final
        totFin = api.column(5).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);

        // Update footer stock inicial
        $(api.column(2).footer()).html(intVal(totIni));
        // Update footer producción
        $(api.column(3).footer()).html(intVal(totPro));
        // Update footer removed
        $(api.column(4).footer()).html(intVal(totDes));
        // Update foo4er stock final
        $(api.column(5).footer()).html(intVal(totFin));
    }
});

$(function() {
    $('#tbl-details tbody').on('click', 'tr', function() {
        var row = tblDet.row(this);
        var data = row.data();
        $('#det_idx').val(row[0]);
        $('#det_product').val(data[0]);
        $('#det_batch').val(data[1]);
        $('#det_openstock').val(data[2]);
        $('#det_quantity').val(data[3]);
        $('#det_removed').val(data[4]);
        $('#det_finalstock').val(data[5]);
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
                    this.batch,
                    this.openstock,
                    this.quantity,
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
        var quantity = $('#det_quantity').val();
        var removed = $('#det_removed').val();
        $('#det_finalstock').val(intVal(openstock) + intVal(quantity) - intVal(removed));
    });

    $('#center_id').change(function () {
        var id = $(this).val();
        if (!id) return;
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post(preProd + '../proddetails.change/' + id)
        .done(function(data) {
            $('body').loadingModal('destroy');
            tblDet.clear().draw();
            var dataSet = [];
            $(JSON.parse(data)).each(function() {
                dataSet.push([
                    this.product,
                    this.batch,
                    this.openstock,
                    this.quantity,
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
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            $('#det_fail_msg').html(message + '</ul>');
            $('#det_fail_div').css('display','block');
        });
    });
});