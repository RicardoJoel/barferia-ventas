$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

const preRec = $('#_method').val() ? '../' : '';

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

        // Remove the formatting to get integer data for summation
        var getVal = function (str) {
            return $('#'+$($.parseHTML(str)).prop('id')).val()*1;
        };

        // Total enviados
        totEnv = api.column(1).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total recibidos
        totRec = api.column(3).data().reduce( function (a, b) {
                return intVal(a) + getVal(b);
            },0);
        // Total devueltos
        totDev = api.column(4).data().reduce( function (a, b) {
                return intVal(a) + getVal(b);
            },0);

        // Update footer enviados
        $(api.column(1).footer()).html(intVal(totEnv));
        // Update footer recibidos
        $(api.column(3).footer()).html(intVal(totRec));
        // Update footer devueltos
        $(api.column(4).footer()).html(intVal(totDev));
    }
});

$(function() {
    $('tbody input:not([type=checkbox])').change(function () {
        var id = $(this).prop('id').slice(3);
        guardar(id);
    });

    $('tbody input[type=checkbox]').change(function () {
        var id = $(this).prop('id').slice(3);
        var chk = $(this).prop('checked');
        $('#rec'+id).prop('disabled',chk).val($('#qty'+id).text());
        $('#ret'+id).prop('disabled',chk).val(0);
        $('#obs'+id).prop('disabled',chk).val('');
        
        var res = true;
        $('tbody input[type=checkbox]').each(function () {
            res &= $(this).prop('checked');
        });
        $('#chkfoot').prop('checked',res);
        guardar(id);
    });

    $('#chkfoot').change(function () {
        var chk = $(this).prop('checked');
        $('tbody input[type=checkbox]').each(function () {
            $(this).prop('checked',chk);
            var id = $(this).prop('id').slice(3);
            $('#rec'+id).prop('disabled',chk).val($('#qty'+id).text());
            $('#ret'+id).prop('disabled',chk).val(0);
            $('#obs'+id).prop('disabled',chk).val('');
        });
        tblDet.draw();
    });

    function guardar(id) {
        /*$('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });*/
        $.post(preRec + '../../recdetails.update', {
            idx: id,
            checked: $('#chk'+id).prop('checked') ? 1 : 0,
            received: $('#rec'+id).val(),
            returned: $('#ret'+id).val(),
            observation: $('#obs'+id).val(),
        })
        .done(function() {
            //$('body').loadingModal('destroy');
            tblDet.draw();
            $('#det_fail_div').css('display','none');
            $('#mdl-detail').modal('hide');
        })
        .fail(function(msg) {
            //$('body').loadingModal('destroy');
            var message = '<p><b>¡Atención!</b></p><ul>';
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            $('#det_fail_msg').html(message + '</ul>');
            $('#det_fail_div').css('display','block');
        });
    }
});