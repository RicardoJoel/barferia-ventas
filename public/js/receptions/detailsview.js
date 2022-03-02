$('#tbl-details').DataTable({
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

        // Total enviados
        totEnv = api.column(1).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total recibidos
        totRec = api.column(3).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);
        // Total devueltos
        totDev = api.column(4).data().reduce( function (a, b) {
                return intVal(a) + intVal(b);
            },0);

        // Update footer enviados
        $(api.column(1).footer()).html(intVal(totEnv));
        // Update footer recibidos
        $(api.column(3).footer()).html(intVal(totRec));
        // Update footer devueltos
        $(api.column(4).footer()).html(intVal(totDev));
    }
});