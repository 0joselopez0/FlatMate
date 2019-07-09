function logear() {

    var usuario_de_logeo = $('#usuario_logeando').val();
    var pass_de_logeo = $('#pass_logeando').val();
    $.ajax({
        type: "POST",
        url: 'php/gestor_usuarios.php',
        data: {
            usuariologeo: usuario_de_logeo,
            passlogeo: pass_de_logeo
        },
        success: function (response) {
            $('#serverresponse').empty();
            if (response == 'Entra al sistema') {

                window.location.href = 'contenedorprincipal.html'
            } else {
                $('#serverresponse').text(response);
            }


        }
    });



}

function registrarse() {
    $('#ocultismo').hide('fast');
    $('#ocultismo').empty();
    $('#ocultismo').append('<input class="inputlogin" type="text" id="usuario_registrando" placeholder="Usuario"><input class="inputlogin" type="text" id="mail_registrando" placeholder="Email" ><input placeholder="Contraseña" class="inputlogin" type="password" id="pass_registrando"><p id="serverresponse"></p><button id="registro" class="fuenteguapa butontext" onclick="registro()">Registrarse</button><button id="back" class=" fuenteguapa butontext" onclick="back()"><</button>');
    $('#ocultismo').show('fast');
}

function registro() {
    var usuario_de_registro = $('#usuario_registrando').val();
    var pass_de_registro = $('#pass_registrando').val();
    var mail_de_registro = $('#mail_registrando').val();
    $.ajax({
        type: "POST",
        url: 'php/gestor_usuarios.php',
        data: {
            usuarioregistro: usuario_de_registro,
            passregistro: pass_de_registro,
            mailregistro: mail_de_registro
        },
        success: function (response) {
            $('#serverresponse').empty();
            $('#serverresponse').text(response);

        }
    });
}

function back() {
    $('#ocultismo').hide('fast');
    $('#ocultismo').empty();
    $('#ocultismo').append(' <input class="inputlogin" type="text" id="usuario_logeando" placeholder="Usuario"><input class="inputlogin" type="password" id="pass_logeando" placeholder="Contraseña"><p id="serverresponse"></p><button id="logearse" class="fuenteguapa butontext" onclick="logear()">Entrar</button><button id="registrarse" class=" fuenteguapa butontext" onclick="registrarse()">Registro</button>');
    $('#ocultismo').show('fast');
}
