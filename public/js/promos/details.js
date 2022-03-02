$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

const prePro = $('#_method').val() ? '../' : '';

let tblDtl = $('#tbl-details').DataTable({
    lengthChange: false,
    searching: false,
    paginate: false,
    ordering: false,
    bInfo : false,
	language: {
        'decimal': '',
        'emptyTable': 'No hay información para mostrar',
        'info': 'Mostrando _START_ a _END_ de _TOTAL_ entradas',
        'infoDtlty': 'Mostrando 0 to 0 of 0 entradas',
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

        // Total over all pages
        total = api.column(3).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);

        // Update footer
        $( api.column(3).footer() ).html(
            parseFloat(total).toFixed(2)
        );

        calFinalPrice();
    }
});

$(function() {
    $('#det_form').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post($(this).attr('action'), $(this).serialize())
        .done(function(data) {
            $('body').loadingModal('destroy');
            tblDtl.clear().draw();
            var dataSet = [];
            $(JSON.parse(data)).each(function(index) {
                dataSet.push([
                    this.product,
                    '<center>' + parseFloat(this.price).toFixed(2) + '</center>',
                    '<center>' + this.quantity + '</center>',
                    '<center>' + parseFloat(this.subtotal).toFixed(2) + '</center>',
                    '<center><a name="' + index + '" onclick="removeDetail(this)"><i class="fa fa-trash"></i></a></center>'
                ]);
            });
            tblDtl.rows.add(dataSet).draw();
            $('#det_fail_div').css('display','none');
            clearFormDtl();
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            var message = '<b>¡Atención!</b><ul>';
            $.each(msg.responseJSON['errors'], function() {
                message += addItem(this);
            });
            $('#det_fail_msg').html(message + '</ul>');
            $('#det_fail_div').css('display','block');
        });
	});

    $('#det_product_id').change(function() {
        var prod = $(this).val();
        if (!prod) return;
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: prePro + '../products.getById/' + prod,
            success: function(data) {
                $('body').loadingModal('destroy');
                $('#det_price').val(data ? parseFloat(data.price).toFixed(2) : '');
                $('#det_fail_div').css('display','none');
                calSubTotal();
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                $('#det_fail_msg').html(JSON.stringify(msg));
                $('#det_fail_div').css('display','block');
            }
        });
    });

    $('#det_quantity').change(function() {
        calSubTotal();
    });

    function calSubTotal() {
        var price = $('#det_price').val();
        var quant = $('#det_quantity').val();
        $('#det_subtotal').val(parseFloat(price * quant).toFixed(2));
    }

    $('#aux_type').change(function () {
        $('#type').val($(this).val());
        calFinalPrice();
    });

    $('#aux_amount').change(function () {
        $('#amount').val($(this).val());
        calFinalPrice();
    });
});

function removeDetail(e) {
	if (confirm('¿Realmente deseas quitar el producto seleccionado?')) {
		$('body').loadingModal({
			text:'Un momento, por favor...',
			animation:'wanderingCubes'
		});
		$.ajax({
			type: 'delete',
			url: prePro + '../promdetails/' + e.name,
			success: function(data) {
                $('body').loadingModal('destroy');
                tblDtl.clear().draw();
                var dataSet = [];
                $(JSON.parse(data)).each(function(index) {
                    dataSet.push([
                        this.product,
                        '<center>' + parseFloat(this.price).toFixed(2) + '</center>',
                        '<center>' + this.quantity + '</center>',
                        '<center>' + parseFloat(this.subtotal).toFixed(2) + '</center>',
                        '<center><a name="' + index + '" onclick="removeDetail(this)"><i class="fa fa-trash"></i></a></center>'
                    ]);
                });
                tblDtl.rows.add(dataSet).draw();
                $('#det_fail_div').css('display','none');
                clearFormDtl();
			},
			error: function(msg) {
                $('body').loadingModal('destroy');
                $('#det_fail_msg').html(JSON.stringify(msg));
                $('#det_fail_div').css('display','block');
			}
		});
	}
}

function clearFormDtl() {
    $('#det_id').val('');
    $('#det_product_id').val('');
    $('#det_price').val('');
    $('#det_quantity').val(1);
    $('#det_subtotal').val('');
    $('#det_fail_div').css('display','none');
}

function calFinalPrice() {
    var type = $('#aux_type').val();
    var amount = intVal($('#aux_amount').val());
    var price = (type == 'M') ? amount : total * (1 - amount/100);
    $('#aux_total').val(parseFloat(total).toFixed(2));
    $('#aux_discount').val(parseFloat(total - price).toFixed(2));
    $('#aux_price').val(parseFloat(price).toFixed(2));
}