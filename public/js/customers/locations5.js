$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

$('#loc_ubigeo').editableSelect();

var tblLoc = $('#tbl-locations').DataTable({
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
    }
});

let preLoc = $('#_method').val() ? '../' : '';

$(function() {
    $('#loc_form').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post($(this).attr('action'), $(this).serialize())
        .done(function(data) {
            $('body').loadingModal('destroy');
            tblLoc.clear().draw();
            var dataSet = [];
            $(JSON.parse(data)).each(function(index) {
                dataSet.push([
                    this.address,
                    this.ubigeo,
                    this.ref,
                    '<center><a name="' + index + '" onclick="editLoc(this)"><i class="fa fa-edit"></i></a></center>',
                    '<center><a name="' + index + '" onclick="removeLoc(this)"><i class="fa fa-trash"></i></a></center>'
                ]);
            });
            tblLoc.rows.add(dataSet).draw();
            clearFormLoc();
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            var message = '<p><b>¡Atención!</b></p><ul>';
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            $('#loc_fail_msg').html(message + '</ul>');
            $('#loc_fail_div').css('display','block');
        });
    });
});

function editLoc(e) {
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: preLoc + '../locations/' + e.name + '/edit',
        success: function(data) {
            $('body').loadingModal('destroy');
            var item = JSON.parse(data);
            $('#loc_id').val(item.id);
            $('#loc_address').val(item.address);
            $('#loc_ubigeo').val(item.ubigeo);
            $('#loc_ref').val(item.ref);
            $('#loc_lat').val(item.lat);
            $('#loc_lng').val(item.lng);
            $('#loc_method').val('PATCH');
            $('#loc_submit').html('<i class="fa fa-refresh"></i>&nbsp;Actualizar');
            $('#loc_form').attr('action',preLoc + '../locations/' + e.name);
            $('#loc_fail_div').css('display','none');
            setMarket(item.lat, item.lng, item.address);
        },
        error: function(msg) {
            $('body').loadingModal('destroy');
            $('#loc_fail_msg').text(JSON.stringify(msg.responseJSON['errors']));
            $('#loc_fail_div').css('display', 'block');
        }
    });
}

function removeLoc(e) {
	if (confirm('¿Realmente deseas eliminar el lugar de entrega seleccionado?')) {
		$('body').loadingModal({
			text:'Un momento, por favor...',
			animation:'wanderingCubes'
		});
		$.ajax({
			type: 'delete',
			url: preLoc + '../locations/' + e.name,
			success: function(data) {
				$('body').loadingModal('destroy');
				tblLoc.clear().draw();
				var dataSet = [];			
				$(JSON.parse(data)).each(function(index) {
					dataSet.push([
                        this.address,
                        this.ubigeo,
                        this.ref,
                        '<center><a name="' + index + '" onclick="editLoc(this)"><i class="fa fa-edit"></i></a></center>',
                        '<center><a name="' + index + '" onclick="removeLoc(this)"><i class="fa fa-trash"></i></a></center>'
                    ]);
				});
				tblLoc.rows.add(dataSet).draw();
                $('#loc_fail_div').css('display','none');
                clearFormLoc();
			},
			error: function(msg) {
                $('body').loadingModal('destroy');
                $('#loc_fail_msg').text(JSON.stringify(msg.responseJSON['errors']));
                $('#loc_fail_div').css('display', 'block');
			}
		});
	}
}

function clearFormLoc() {
    $('#loc_id').val('');
    $('#loc_address').val('');
    $('#loc_ubigeo').val('');
    $('#loc_ref').val('');
    $('#loc_lat').val('');
    $('#loc_lng').val('');
    $('#loc_method').val('');
    $('#loc_submit').html('<i class="fa fa-plus"></i>&nbsp;Agregar');
    $('#loc_form').attr('action',preLoc + '../locations');
    $('#loc_fail_div').css('display','none');
    clearMap();
}