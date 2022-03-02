$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

let tblDep = $('#tbl-dependents').DataTable({
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

let preDep = $('#_method').val() ? '../' : '';

$(function() {
    $('#dependent_form').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post($(this).attr('action'), $(this).serialize())
        .done(function(data) {
            $('body').loadingModal('destroy');
            tblDep.clear().draw();
            var dataSet = [];
            $(JSON.parse(data)).each(function(index) {
                dataSet.push([
                    this.lastname + ', ' + this.name,
                    this.type ?? '',
                    this.document_type ?? '',
                    '<center>' + (this.document ?? '') + '</center>',
                    '<center>' + (this.gender ?? '') + '</center>',
                    '<center>' + (this.birthdate ? moment(this.birthdate).format('L') : '') + '</center>',
					'<center><a name="' + index + '" onclick="editDependent(this)"><i class="fa fa-edit"></i></a></center>',
                    '<center><a name="' + index + '" onclick="removeDependent(this)"><i class="fa fa-trash"></i></a></center>'
                ]);
            });
            tblDep.rows.add(dataSet).draw();
            clearForm();
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            var message = '<p><b>¡Atención!</b></p><ul>';
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            $('#dependent_fail_msg').html(message + '</ul>');
            $('#dependent_fail_div').css('display','block');
        });
    });
});

function editDependent(e) {
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: preDep + '../dependents/' + e.name + '/edit',
        success: function(data) {
            $('body').loadingModal('destroy');
            var item = JSON.parse(data);
            $('#dependent_id').val(item.id);
            $('#dependent_name').val(item.name);
            $('#dependent_lastname').val(item.lastname);
            $('#dependent_type_id').val(item.type_id);
            $('#dependent_document_type_id').val(item.document_type_id);
            $('#dependent_document').val(item.document);
            $('#dependent_gender_id').val(item.gender_id);
            $('#dependent_birthdate').val(item.birthdate);
            $('#dependent_method').val('PATCH');
            $('#dependent_submit').html('<i class="fa fa-refresh"></i>&nbsp;Actualizar');
            $('#dependent_form').attr('action',preDep + '../dependents/' + e.name);
            $('#dependent_fail_div').css('display','none');
            setDepDocFormat();
        },
        error: function(msg) {
            $('body').loadingModal('destroy');
            $('#dependent_fail_msg').text(JSON.stringify(msg.responseJSON['errors']));
            $('#dependent_fail_div').css('display', 'block');
        }
    });
}

function removeDependent(e) {
	if (confirm('¿Realmente deseas eliminar el dependiente seleccionado?')) {
		$('body').loadingModal({
			text:'Un momento, por favor...',
			animation:'wanderingCubes'
		});
		$.ajax({
			type: 'delete',
			url: preDep + '../dependents/' + e.name,
			success: function(data) {
				$('body').loadingModal('destroy');
				tblDep.clear().draw();
				var dataSet = [];			
				$(JSON.parse(data)).each(function(index) {
					dataSet.push([
                        this.lastname + ', ' + this.name,
                        this.type ?? '',
                        this.document_type ?? '',
                        '<center>' + (this.document ?? '') + '</center>',
                        '<center>' + (this.gender ?? '') + '</center>',
                        '<center>' + (this.birthdate ? moment(this.birthdate).format('d/m/Y') : '') + '</center>',
                        '<center><a name="' + index + '" onclick="editDependent(this)"><i class="fa fa-edit"></i></a></center>',
                        '<center><a name="' + index + '" onclick="removeDependent(this)"><i class="fa fa-trash"></i></a></center>'
                    ]);
				});
				tblDep.rows.add(dataSet).draw();
                $('#dependent_fail_div').css('display','none');
                clearForm();
			},
			error: function(msg) {
                $('body').loadingModal('destroy');
                $('#dependent_fail_msg').text(JSON.stringify(msg.responseJSON['errors']));
                $('#dependent_fail_div').css('display', 'block');
			}
		});
	}
}

function clearForm() {
    $('#dependent_id').val('');
    $('#dependent_name').val('');
    $('#dependent_lastname').val('');
    $('#dependent_type_id').val('');
    $('#dependent_document_type_id').val('');
    $('#dependent_document').val('');
    $('#dependent_gender_id').val('');
    $('#dependent_birthdate').val('');
    $('#dependent_method').val('');
    $('#dependent_submit').html('<i class="fa fa-plus"></i>&nbsp;Agregar');
    $('#dependent_form').attr('action',preDep + '../dependents');
    $('#dependent_fail_div').css('display','none');
}