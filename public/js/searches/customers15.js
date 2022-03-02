var tblCust = $('#tbl-customers').DataTable({
    lengthChange: false,
    searching: false,
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
        targets: [6, 7],
        visible: false
    },{
        targets: [0, 2, 3, 5],
        className: "text-center"
    }]
});

$(function() {
    $('#tbl-customers tbody').on('click', 'tr', function() {
        if (edit) return;
        var data = tblCust.row(this).data();
        $('#ubic_cust_id').val(data[7]);
        $('#ubic_cust_doc').val(data[2]);
        $('#ubic_cust_code').val(data[0]);
        $('#ubic_cust_email').val(data[4]);
        $('#ubic_cust_phone').val(data[6]);
        $('#ubic_cust_mobile').val(data[3]);
        $('#ubic_cust_name').val(data[8]);
        $('#ubic_cust_lastname').val(data[9]);
        $('#ubic_cust_fullname').val(data[1]);
        $('#btn-edit').attr('name',data[7]);
        $('#frm-sch-ubic').submit();
        $('#mdl-sch-cust').modal('hide');
        $('#mdl-sch-ubic').modal('show');
    });

    $("#customer_doc").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            var doc = $.trim($('#customer_doc').val());
            if (doc)
                searchCustomer('../customers.getByDocument/' + doc);
            else
                openSearchCust();
        }
    }).change(function() {
        $('#customer_id').val('');
    });

    $("#customer_mobile").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            var mob = $.trim($('#customer_mobile').val());
            if (mob)
                searchCustomer('../customers.getByMobile/' + mob);
            else
                openSearchCust();
        }
    });
 
    $("#btn-sch-cust").click(function () {
        var doc = $.trim($('#customer_doc').val());
        var mob = $.trim($('#customer_mobile').val());
        if (doc)
            searchCustomer('../customers.getByDocument/' + doc);
        else if (mob)
            searchCustomer('../customers.getByMobile/' + mob);
        else
            openSearchCust();
    });

    $('#frm-sch-cust').submit(function(e) {
        e.preventDefault();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            data: $(this).serialize(),
            url: $(this).attr('action'),
            success: function(data) {
                $('body').loadingModal('destroy');
                tblCust.clear().draw();
                var dataSet = [];
                $(JSON.parse(data)).each(function() {
                    dataSet.push([
                        this.code,
                        this.fullname,
                        this.document,
                        this.mobile,
                        this.email,
                        '<a name="' + this.id + '" onclick="editCustomer(this)"><i class="fa fa-edit"></i></a>',
                        this.phone,
                        this.id,
                        this.name,
                        this.lastname,
                    ]);
                });
                tblCust.rows.add(dataSet).draw();
                $('#fail-div-cust').css('display','none');
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                $('#fail-msg-cust').text(JSON.stringify(msg));
                $('#fail-div-cust').css('display','block');
            }
        });
    });

    function searchCustomer(route) {
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: preSal + route,
            success: function(data) {
                $('body').loadingModal('destroy');
                if (data) {
                    $('#ubic_cust_id').val(data.id);
                    $('#ubic_cust_doc').val(data.document);
                    $('#ubic_cust_code').val(data.code);
                    $('#ubic_cust_email').val(data.email);
                    $('#ubic_cust_phone').val(data.phone);
                    $('#ubic_cust_mobile').val(data.mobile);
                    $('#ubic_cust_name').val(data.name);
                    $('#ubic_cust_lastname').val(data.lastname);
                    $('#ubic_cust_fullname').val(data.fullname);
                    $('#btn-edit').attr('name',data.id);
                    $('#frm-sch-ubic').submit();
                    $('#mdl-sch-ubic').modal('show');
                }
                else {
                    $('#customer_id').val('');
                    /*$('#customer_doc').val('');
                    $('#customer_name').val('');
                    $('#customer_lastname').val('');
                    $('#customer_mobile').val('');
                    $('#customer_email').val('');
                    $('#customer_phone').val('');*/
                    $('#mdl-notfound').modal('show');
                }
                $('#customer_fail_div').css('display','none');
            },
            error: function(msg) {
                $('body').loadingModal('destroy');
                $('#customer_fail_msg').html(JSON.stringify(msg));
                $('#customer_fail_div').css('display','block');
            }
        });
    }

    function openSearchCust() {
        $('#mdl-sch-cust').modal('show');
        clearFormCust();
    }
});

function clearFormCust() {
    $('#cust_code').val('');
    $('#cust_name').val('');
    $('#cust_doc').val('');
    $('#cust_mob').val('');
    $('#fail-div-cust').css('display','none');
    $('#info-div-cust').css('display','none');
    tblCust.clear().draw();
}

function clearDataCust() {
    $('#customer_id').val('');
    $('#customer_doc').val('');
    $('#customer_name').val('');
    $('#customer_lastname').val('');
    $('#customer_email').val('');
    $('#customer_phone').val('');
    $('#customer_mobile').val('');
    $('#address').val('');
    $('#ubigeo').val('');
    $('#reference').val('');
    $('#location_id').val('');
    $('#customer_fail-div').css('display','none');
}