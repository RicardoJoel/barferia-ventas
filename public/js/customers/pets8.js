$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

$('#pet_race').editableSelect();

$('#pet_species').change(function() {
    fillRaces();
});

var tblPet = $('#tbl-pets').DataTable({
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

let prePet = $('#_method').val() ? '../' : '';

$(function() {
    $('#pet_form').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post($(this).attr('action'), $(this).serialize())
        .done(function(data) {
            $('body').loadingModal('destroy');
            tblPet.clear().draw();
            var dataSet = [];
            $(JSON.parse(data)).each(function(index) {
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
            clearFormPet();
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            var message = '<p><b>¡Atención!</b></p><ul>';
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            $('#pet_fail_msg').html(message + '</ul>');
            $('#pet_fail_div').css('display','block');
        });
    });
});

function editPet(e) {
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: prePet + '../pets/' + e.name + '/edit',
        success: function(data) {
            $('body').loadingModal('destroy');
            var item = JSON.parse(data);
            $('#pet_id').val(item.id);
            $('#pet_name').val(item.name);
            $('#pet_species').val(item.species);
            fillRaces();
            $('#pet_gender').val(item.gender);
            $('#pet_race').val(item.race);
            $('#pet_birthdate').val(item.birthdate);
            $('#pet_observation').val(item.observation);
            $('#pet_method').val('PATCH');
            $('#pet_submit').html('<i class="fa fa-refresh"></i>&nbsp;Actualizar');
            $('#pet_form').attr('action',prePet + '../pets/' + e.name);
            $('#pet_fail_div').css('display','none');
        },
        error: function(msg) {
            $('body').loadingModal('destroy');
            $('#pet_fail_msg').text(JSON.stringify(msg.responseJSON['errors']));
            $('#pet_fail_div').css('display', 'block');
        }
    });
}

function removePet(e) {
	if (confirm('¿Realmente deseas eliminar la mascota seleccionada?')) {
		$('body').loadingModal({
			text:'Un momento, por favor...',
			animation:'wanderingCubes'
		});
		$.ajax({
			type: 'delete',
			url: prePet + '../pets/' + e.name,
			success: function(data) {
				$('body').loadingModal('destroy');
				tblPet.clear().draw();
				var dataSet = [];			
				$(JSON.parse(data)).each(function(index) {
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
                $('#pet_fail_div').css('display','none');
                clearFormPet();
			},
			error: function(msg) {
                $('body').loadingModal('destroy');
                $('#pet_fail_msg').text(JSON.stringify(msg.responseJSON['errors']));
                $('#pet_fail_div').css('display', 'block');
			}
		});
	}
}

function clearFormPet() {
    $('#pet_id').val('');
    $('#pet_name').val('');
    $('#pet_species').val('Perro');
    fillRaces();
    $('body').loadingModal('destroy');
    $('#pet_gender').val('Macho');
    $('#pet_race').val('');
    $('#pet_birthdate').val('');
    $('#pet_observation').val('');
    $('#pet_method').val('');
    $('#pet_submit').html('<i class="fa fa-plus"></i>&nbsp;Agregar');
    $('#pet_form').attr('action',prePet + '../pets');
    $('#pet_fail_div').css('display','none');
}

function fillRaces() {
    var species = $('#pet_species').val();
    if (species) {
        $.ajax({
            type: 'get',
            url: prePet + '../races.getByType/' + species[0],
            async: false,
            success: function(data) {
                $('#pet_race').editableSelect('clear');
                $('#pet_race').val('');
                $(data).each(function() {
                    var item = this;
                    $('#pet_race').editableSelect('add', function(){
                        $(this).val(item.id);
                        $(this).text(item.name);
                    });
                });
            },
            error: function(msg) {
                $('#pet_fail_msg').html(JSON.stringify(msg));
                $('#pet_fail_div').css('display','block');
            }
        });
    }
}