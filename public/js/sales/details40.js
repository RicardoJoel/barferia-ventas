$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

const preSal = $('#_method').val() ? '../' : '';

let items, choices, remove = false, accept = false, indexes; 
var prev_center_id, prev_manager, prev_mobile;

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

        var discount = intVal($('#aux_discount').val());
        var paidout = intVal($('#aux_paidout').val());
        var delivery = intVal($('#aux_delivery').val());

        $('#aux_total').val(parseFloat(total).toFixed(2));
        $('#aux_debt').val(parseFloat(total - discount - paidout).toFixed(2));
        $('#aux_debt_deliv').val(parseFloat(total - discount - paidout + delivery).toFixed(2));
    }
});

let tblPro = $('#tbl-promo-choices').DataTable({
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

let tblDet = $('#tbl-detail-choices').DataTable({
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

let tblCtr = $('#tbl-centers').DataTable({
    lengthChange: false,
    searching: false,
    paginate: false,
    ordering: false,
    bInfo : false,
	language: {
		'decimal': '',
		'emptyTable': 'Ningún local cuenta con stock suficiente.',
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
        targets: [1,2],
        className: "text-center"
    },{
        targets: 3,
        visible: false
    }]
});

let tblRmv = $('#tbl-removed').DataTable({
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
    $('#tbl-details tbody').on('click', 'tr', function() {
        if (remove) return;
        var data = tblDtl.row(this).data();
        if (!data) return;
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: preSal + '../saledetails.getByCode/' + data[0].slice(-8),
            success: function(data) {
                $('body').loadingModal('destroy');
                $('#txt-detail-name').text(data.product);
                $('#txt-detail-items').text(data.items);
                $('#txt-detail-price').text(parseFloat(data.price).toFixed(2));
                $('#txt-detail-quantity').text(data.quantity);
                $('#txt-detail-subtotal').text(parseFloat(data.subtotal).toFixed(2));
                tblDet.clear().draw();
                var dataSet = [];
                $(data.choices).each(function() {
                    dataSet.push([
                        this.product,
                        this.code,
                        this.quantity
                    ]);
                });
                tblDet.rows.add(dataSet).draw();
                if ('display',data.code[0] == 'P') {
                    $('#div-items').css('display','none');
                    $('#div-choices').css('display','none');
                }
                else {
                    $('#div-items').css('display','block');
                    $('#div-choices').css('display','block');
                }
                $('#det_fail_div').css('display','none');
                $('#mdl-detail').modal('show');
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                $('#det_fail_msg').text(JSON.stringify(msg));
                $('#det_fail_div').css('display','block');
            }
        });
    });

    $('#tbl-centers tbody').on('click', 'tr', function() {
        var data = tblCtr.row(this).data();
        prev_center_id = $('#center_id').val();
        prev_manager = $('#center_manager').val();
        prev_mobile = $('#center_mobile').val();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: preSal + '../centers.getById/' + data[3],
            success: function(data) {
                $('body').loadingModal('destroy');
                $('#center_id').val(data.center.id);
                $('#center_manager').val(data.center.manager);
                $('#center_mobile').val(data.center.mobile);
                tblRmv.clear().draw();
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
                    tblRmv.rows.add(dataSet).draw();
                    $('#mdl-removed').modal('show');
                }
                else if ($('#det_product_code').val()) {
                    $('#det_form').submit();
                }
                $('#mdl-centers').modal('hide');
                $('#det_fail_div').css('display','none');
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                /*var message = '<b>¡Atención!</b><ul>';
                $.each(msg.responseJSON['errors'], function() { message += addItem(this); });
                $('#det_fail_msg').html(message + '</ul>');*/
                $('#det_fail_msg').html(JSON.stringify(msg));
                $('#det_fail_div').css('display','block');
            }
        });
    });

    $('#det_form').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.post($(this).attr('action'), {
			det_center_id   : $('#center_id').val(),
			det_product_code: $('#det_product_code').val(),
			det_quantity    : $('#det_quantity').val(),
            lat_destiny     : $('#latitude').val(),
            lng_destiny     : $('#longitude').val(),
			choices         : choices
		})
        .done(function(data) {
            $('body').loadingModal('destroy');
            if (data.centers) {
                $('#txt_stock_message').text(data.message);
                tblCtr.clear().draw();
                var dataSet = [];
                $(data.centers).each(function() {
                    dataSet.push([
                        this.center,
                        getDistance(this.distance),
                        this.stock,
                        this.id
                    ]);
                });
                tblCtr.rows.add(dataSet).draw();
                $('#mdl-centers').modal('show');
            }
            else {
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
            }
        })
        .fail(function(msg) {
            $('body').loadingModal('destroy');
            /*var message = '<b>¡Atención!</b><ul>';
            $.each(msg.responseJSON['errors'], function() { message += addItem(this); });
            $('#det_fail_msg').html(message + '</ul>');*/
            $('#det_fail_msg').html(JSON.stringify(msg));
            $('#det_fail_div').css('display','block');
        });
	});

    $('#det_product_code').change(function() {
        var code = $(this).val();
        if (!code) return;
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: preSal + '../products.getByCode/' + code,
            success: function(data) {
                $('body').loadingModal('destroy');
                $('#det_price').val(data.price ? parseFloat(data.price).toFixed(2) : '');
                $('#det_fail_div').css('display','none');
                calSubTotal();
                choices = [];
                if (data.code[0] === 'P') return;
                $('#txt-promo-name').text(data.product);
                $('#txt-promo-items').text(data.items);
                $('#txt-promo-price').text(parseFloat(data.price).toFixed(2));
                tblPro.clear().draw();
                var dataSet = [];
                if (data.specified) {
                    $('#btn-promo-acept').prop('disabled',false);
                    $(data.details).each(function() {
                        dataSet.push([
                            this.product,
                            this.code,
                            this.quantity
                        ]);
                    });
                }
                else {
                    $('#btn-promo-acept').prop('disabled',true);
                    items = data.items;
                    $(data.choices).each(function() {
                        dataSet.push([
                            this.product,
                            this.code,
                            '<input type="number" class="qtty" name="'+this.code+'" onchange="setMax(this)" value="0" min="0" max="'+items+'">'
                        ]);
                        choices.push({
                            product: this.product,
                            code: this.code,
                            quantity: 0
                        });
                    });
                }
                tblPro.rows.add(dataSet).draw();
                $('#mdl-promo').modal('show');
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                $('#det_fail_msg').html(JSON.stringify(msg));
                $('#det_fail_div').css('display','block');
            }
        });
    });
    
    $('#center_id').on('focus', function () {
        // Store the current value on focus and on change
        prev_center_id = this.value;
        prev_manager = $('#center_manager').val();
        prev_mobile = $('#center_mobile').val();
    }).change(function() {
        // Do something with the previous value after the change
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: preSal + '../centers.getById/' + this.value,
            success: function(data) {
                $('body').loadingModal('destroy');
                $('#center_manager').val(data.center.manager);
                $('#center_mobile').val(data.center.mobile);
                tblRmv.clear().draw();
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
                    tblRmv.rows.add(dataSet).draw();
                    $('#mdl-removed').modal('show');
                }
                $('#det_fail_div').css('display','none');
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                var message = '<b>¡Atención!</b><ul>';
                $.each(msg.responseJSON['errors'], function() { message += addItem(this); });
                $('#det_fail_msg').html(message + '</ul>');
                //$('#det_fail_msg').html(JSON.stringify(msg));
                $('#det_fail_div').css('display','block');
            }
        });
    });

    updateMethod();

    $('#aux_method_id').change(function () {
        updateMethod();
    });

    $('#aux_discount').change(function () {
        $('#discount').val($(this).val());
        updateResumen();
    });
    
    $('#aux_paidout').change(function () {
        $('#paidout').val($(this).val());
        updateResumen();
    });

    $('#aux_delivery').change(function () {
        $('#delivery').val($(this).val());
        updateResumen();
    });

    $('#det_quantity').change(function () {
        calSubTotal();
    });

    $('#mdl-removed').on('hidden.bs.modal', function () {
        setPreValues();
	});

    function calSubTotal() {
        var price = $('#det_price').val();
        var quant = $('#det_quantity').val();
        $('#det_subtotal').val(parseFloat(price * quant).toFixed(2));
    }
    
    function updateResumen() {
        var total = intVal($('#aux_total').val());
        var discount = intVal($('#aux_discount').val());
        var paidout = intVal($('#aux_paidout').val());
        var delivery = intVal($('#aux_delivery').val());
        var debt = total - discount - paidout;

        $('#aux_debt').val(parseFloat(debt).toFixed(2));
        $('#aux_debt_deliv').val(parseFloat(debt + delivery).toFixed(2));
    }

    function updateMethod() {
        $('#payment_method_id').val($('#aux_method_id').val());
    }
});

function removeDetails() {
    accept = true;
    if (!indexes) return;
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.post(preSal + '../saledetails.removeDetails', {indexes: indexes})
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
        //Agrego el producto seleccionado
        if ($('#det_product_code').val()) $('#det_form').submit();
    })
    .fail(function(msg) {
        $('body').loadingModal('destroy');
        var message = '<b>¡Atención!</b><ul>';
        $.each(msg.responseJSON['errors'], function() { message += addItem(this); });
        $('#det_fail_msg').html(message + '</ul>');
        //$('#det_fail_msg').html(JSON.stringify(msg));
        $('#det_fail_div').css('display','block');
    });
}

function setPreValues() {
    if (!accept) {
        $('#center_id').val(prev_center_id);
        $('#center_manager').val(prev_manager);
        $('#center_mobile').val(prev_mobile);
    }
    accept = false;
}

function removeDetail(e) {
    remove = true;
	if (confirm('¿Realmente deseas quitar el producto seleccionado?')) {
		$('body').loadingModal({
			text:'Un momento, por favor...',
			animation:'wanderingCubes'
		});
		$.ajax({
			type: 'delete',
			url: preSal + '../saledetails/' + e.name,
            async: false,
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
    remove = false;
}

function clearFormDtl() {
    $('#det_id').val('');
    $('#det_product_code').val('');
    $('#det_price').val('');
    $('#det_quantity').val(1);
    $('#det_subtotal').val('');
    $('#det_fail_div').css('display','none');
}

function setMax(e) {
    var sum = tot = 0;
    var idx = choices.findIndex((obj => obj.code == e.name));
    choices[idx].quantity = e.value;
    
    $('.qtty').each(function() {
        sum += intVal(this.value);
    });

    $('.qtty').each(function() {
        var max = intVal(this.value) + intVal(items) - intVal(sum);
        $(this).prop('max',max);
        $(this).prop('disabled',!max);
        tot += intVal(this.value);
    });

    $('#btn-promo-acept').prop('disabled',tot != items);
}

function getDistance(dist) {
    return dist ? 'A ' + parseFloat(dist/1000).toFixed(1) + ' km' : 'Sin definir';
}