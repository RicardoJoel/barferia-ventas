$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

let tblVar = $('#tbl-variations').DataTable({
    lengthChange: false,
    searching: false,
    paginate: false,
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
    ordering: false
});

$(function() {
    $('#variation_form').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post($(this).attr('action'), $(this).serialize())
        .done(function(data) {
            $('body').loadingModal('destroy');
            tblVar.clear().draw();
            var dataSet = [];
            $(JSON.parse(data)).each(function() {
                dataSet.push([
                    '<center>' + (this.created_at ? moment(this.created_at).format('L') : '') + '</center>',
                    '<center>' + (this.type ?? '') + '</center>',
                    '<center>' + (this.start_at ? moment(this.start_at).format('L') : '') + '</center>',
                    '<center>' + (this.before ? parseFloat(this.before).toFixed(2) : '0.00')+ '</center>',
                    '<center>' + (this.amount ? parseFloat(this.amount).toFixed(2) : '0.00') + '</center>',
                    '<center>' + (this.after ? parseFloat(this.after).toFixed(2) : '0.00') + '</center>',
                    this.observation
                ]);
            });
            tblVar.rows.add(dataSet).draw();
            /* Ini: registro unico */
            $('#variation_type').prop('disabled',true);
            $('#variation_amount').prop('disabled',true);
            $('#variation_start_at').prop('disabled',true);
            $('#variation_observation').prop('disabled',true);
            $('#variation_submit').prop('disabled',true);
            /* Fin: registro unico */
            clearVarForm();
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            var message = '<p><b>¡Atención!</b></p><ul>';
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            $('#variation_fail_msg').html(message + '</ul>');
            $('#variation_fail_div').css('display','block');
        });
    });
});

function clearVarForm() {
    $('#variation_type').val('Aumento');
    $('#variation_amount').val('');
    $('#variation_start_at').val('');
    $('#variation_observation').val('');
    $('#variation_fail_div').css('display','none');
}