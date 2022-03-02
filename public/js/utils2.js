function checkAccount(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    // Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) return true;

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[0-9-]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function checkNumber(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    // Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) return true;

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function checkPhone(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    // Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) return true;

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[0-9()+#-]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function checkAlpha(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    // Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) return true;

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function checkAlNum(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    // Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) return true;

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function checkEmail(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    // Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) return true;

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z0-9_.-@]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function checkName(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    // Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) return true;

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z ÑñáéíóúÜü-]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function validateEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return 1 <= email.length && email.length <= 50 && regex.test(email);
}

//Devuelve un caracter en mayúscula
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

//Formato fecha
function dateFormat(str) {
    if (!str) return '';
    var ano = str.substr(0,4);
    var mes = str.substr(5,2);
    var dia = str.substr(8,2);
    return dia + '/' + mes + '/' + ano;
}

//Agrega un item a la lista
function addItem(item) {
    return item ? ('<li>' + item + '</li>') : '';
}

//Extrae solo números de una cadena de texto
function getNumbersInString(string) {
    var tmp = string.split('');

    var map = tmp.map(function(current) {
        if (!isNaN(parseInt(current))) return current;
    });
    
    var numbers = map.filter(function(value) {
        return value != undefined;
    });

    return numbers.join('');
}

//Muestra u oculta una sección del formulario
function showForm(idx) {
	if ($('#div-' + idx).css('display') == 'none') {
		$('#div-' + idx).css('display','block');
		$('#icn-' + idx).html('<i class="fa fa-minus fa-icon"></i>');
	}
	else {
		$('#div-' + idx).css('display','none');
		$('#icn-' + idx).html('<i class="fa fa-plus fa-icon"></i>');
	}
}

//Efecto desplasado pantalla
function animacion() {
    var pos = $('#subtitle').offset().top - 15;
    $('html, body').animate({
        scrollTop: pos
    }, 750);
}

function intVal(str) {
    return typeof str === 'string' ? str.replace(/[<center>,</center>]/g, '')*1 :
           typeof str === 'number' ? str : 0;
}