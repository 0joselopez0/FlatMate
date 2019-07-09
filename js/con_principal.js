    
//Datos Users
var idconectado;
    $.ajax({
        type: "POST",
        url: 'php/gestor_usuarios.php',
        data: {
            pideid: 'a'
        },
        success: function (response) {
            idconectado = response;
            console.log(idconectado);


        }
    });


    $.ajax({
        type: "POST",
        url: 'php/contenedorprincipal.php',
        data: {
            cargausername: 'a'
        },
        success: function (response) {
            $('#user_conectado').text(response);
        }
    });

//Animaciones barra superior

    $('.contenedorseccion').load('seccionhome.html');
    previouslyClicked = $(".botonseccion").eq(0); 
    $(".botonseccion").click(function () {
        previouslyClicked.removeClass("botonseccionup").addClass("botonsecciondown");
        previouslyClicked.children().addClass('logonotselected');
        $(this).removeClass("botonsecciondown");
        $(this).addClass("botonseccionup");
        $(this).children().removeClass("logonotselected");
        if ($(".botonseccionup").attr('id') == 'h') {
            $('.contenedorseccion').hide().load('seccionhome.html').fadeIn('1000');
        } else if ($(".botonseccionup").attr('id') == 't') {
            $('.contenedorseccion').hide().load('secciontareas.html').fadeIn('1000');
        } else if ($(".botonseccionup").attr('id') == 'b') {
            $('.contenedorseccion').hide().load('seccionbote.html').fadeIn('1000');
        } else if ($(".botonseccionup").attr('id') == 'i') {
            $('.contenedorseccion').hide().load('seccioninventario.html').fadeIn('1000');
        } else if ($(".botonseccionup").attr('id') == 'n') {
            $('.contenedorseccion').hide().load('seccionnevera.html').fadeIn('1000');
        } else if ($(".botonseccionup").attr('id') == 'c') {
            $('.contenedorseccion').hide().load('seccionchat.html').fadeIn('1000');
        }
        previouslyClicked = $(this);
    });

//Script de cerrar sesion
    function cerrarsesion() {
        $.ajax({
            type: "POST",
            url: 'php/contenedorprincipal.php',
            data: {
                cierrasesion: 'a'
            },
            success: function (response) {
                window.location.href = "index.html"
            }
        });
    }
    $('.opcionesconf').hide();
    $('.opcionesperfil').hide();
    $('.opcionespiso').hide();
    $('.opcionesaplicacion').hide();

    function despliegaopcionesconf() {

        $('.opcionesconf').toggle('slow');

    }

    function despliegaopcionesperfil() {
        $('.opcionesperfil').toggle('slow');
        $('.opcionesaplicacion').hide('slow');
        $('.opcionespiso').hide('slow');
    }

    function despliegaopcionespiso() {
        $('.opcionespiso').toggle('slow');
        $('.opcionesaplicacion').hide('slow');
        $('.opcionesperfil').hide('slow');
    }

    function despliegaopcionesaplicacion() {
        $('.opcionesaplicacion').toggle('slow');
        $('.opcionesperfil').hide('slow');
        $('.opcionespiso').hide('slow');
    }
