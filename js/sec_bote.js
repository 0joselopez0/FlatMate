  $('#recibo').hide();
  cargainfobote();
  var dinerosconectados = [];
  var dinerosyusers = [];

  function cargainfobote() {
      $('#espacioparaanadirfondos').hide();
      $('#espacioparaextraerfondos').hide();
      $('.dinerodiversificado').empty();
      $.ajax({
          type: "POST",
          url: 'php/bote.php',
          data: {
              cargabote: 'a'
          },
          success: function (response) {
              var infobote = JSON.parse(response);
              console.log(infobote);
              dinerodelconectado = infobote[1].dineroconectado;
              if (infobote[0].Tipodebote == 1) {
                  $('#tipodebote').text('Bote físico')
                  $('#logobotegrande').attr("src", "img/cerdito.png");
              }
              var cantidadtotal = 0;

              for (i = 1; i < infobote.length; i++) {
                  cantidadtotal = cantidadtotal + parseFloat(infobote[i].Dinero);
                  $('.dinerodiversificado').append('<p><strong>' + infobote[i].Username + '</strong> -> <strong>' + infobote[i].Dinero + '€</strong> </p>');
                  dinerosconectados.push(parseFloat(infobote[i].Dinero));
                  obj = {};
                  tempuser = infobote[i].Username;
                  tempdiners = infobote[i].Dinero;
                  obj[tempuser] = tempdiners;
                  dinerosyusers.push(obj);
              }
              $('#cantidad').text(cantidadtotal + '€');
          }
      });

  }



  function anadirfondos() {
      $('#espacioparaanadirfondos').fadeIn('normal');
  }

  function completaringreso() {
      var aingresar = parseFloat($('#fondosparaanadir').val());
      $.ajax({
          type: "POST",
          url: 'php/bote.php',
          data: {
              ingreso: aingresar
          },
          success: function (response) {
              console.log(response);
              cargainfobote();

          }
      });

  }

  function extraerdinero() {
      $('#espacioparaextraerfondos').show();

      console.log(dinerosyusers);
  }

  function completarextraccion() {
      var dinerototal = 0;
      console.log("entra");
      var verificapasta = true;
      for (i = 0; i < dinerosconectados.length; i++) {
          dinerototal = dinerototal + parseFloat(dinerosconectados[i]);
          if (parseFloat($('#fondosparaextraer').val()) / dinerosconectados.length > dinerosconectados[i]) {
              alert("No puedes sacar más de " + dinerosconectados[i] + " €. Comunica al compañero con dicha cantidad el ingreso oportuno.");
              return;
          }

      }


      var dineroextraido = parseFloat($('#fondosparaextraer').val());
      $.ajax({
          type: "POST",
          url: 'php/bote.php',
          data: {
              extraccion: dineroextraido
          },
          success: function (response) {

              cargainfobote();

          }
      });

  }

  function adjuntarimagen() {
      $('#recibo').show();
  }
