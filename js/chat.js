 var mensajes;
 var elegido;
 $.ajax({
     type: "POST",
     url: 'php/chat.php',
     data: {
         cargarchats: 'a'
     },
     success: function (response) {
         mensajes = JSON.parse(response);

         var diferencia = 0;
         for (i in mensajes) {
             if (mensajes[i].Destino == idconectado && mensajes[i].Remitente != idconectado) {
                 if (mensajes[i].Destino != diferencia && mensajes[i].Remitente != diferencia) {
                     if (mensajes[i].Destino != idconectado) {
                         $('#chats').append('<div class="row"> <div class="col"><img src="img/iconouser.png"></div><div class="col"><strong>' + mensajes[i].Destino + '</strong></div><div class="col"><button class="botontipopeque2" onclick="cargaventanadelchat(' + mensajes[i].Destino + ')" ><img class="insideboton" src="img/logochat.png"></button></div></div>');

                     } else if (mensajes[i].Remitente != idconectado) {
                         $('#chats').append('<div class="row"> <div class="col"><img src="img/iconouser.png"></div><div  class="col"><strong>' + mensajes[i].Remitente + '</strong></div><div class="col"><button onclick="cargaventanadelchat(' + mensajes[i].Remitente + ')" class="botontipopeque2"><img class="insideboton" src="img/logochat.png"></button></div></div>');

                     }

                 }
                 diferencia = mensajes[i].Destino;

             }

         }
     }
 });

 function cargaventanadelchat(a) {
     elegido = a;
     $('body').load('contenidos/chat.html');
 }
