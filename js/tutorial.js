  function nombreydireccion() {
      $('#containertutorial').children().fadeOut('1000',
          function () {
              $('#containertutorial').load('tutorial/nombredireccion.html', function () {
                  $('#containertutorial').children().fadeIn('2000');
              });
          });

  }

  function mensualidadyfecha() {
      $('#containertutorial').children().fadeOut('1000',
          function () {
              $('#containertutorial').load('tutorial/mensualidadfecha.html', function () {
                  $('#containertutorial').children().fadeIn('2000');
              });
          });
  }

  function bote() {
      $('#containertutorial').children().fadeOut('1000',
          function () {
              $('#containertutorial').ready(function () {
                  $("#accordion").accordion();
              });
              $('#containertutorial').load('tutorial/bote.html', function () {
                  $('#containertutorial').children().fadeIn('2000');
              });
          });
  }

  function inventarioynevera() {
      $('#containertutorial').children().fadeOut('1000',
          function () {
              $('#containertutorial').ready(function () {
                  $("#accordion").accordion();
              });
              $('#containertutorial').load('tutorial/inventarionevera.html', function () {
                  $('#containertutorial').children().fadeIn('2000');
              });
          });
  }

  function conftareas() {
      $('#containertutorial').children().fadeOut('1000',
          function () {
              $('#containertutorial').ready(function () {
                  $("#accordion").accordion();
              });
              $('#containertutorial').load('tutorial/tareas.html', function () {
                  $('#containertutorial').children().fadeIn('2000');
              });
          });
  }

  function addtarea() {
      $('.dibujopaneltarea').parent().append('<div class="row"><div class="col-xs-10 m-1 "><input type="text" placeholder="Tarea"  class="cien tareaconf"></div><div class="col-xs-1 m-1 text-left p-0 digito"><input type="text" class="menos tarearepeticion" placeholder="Repeticion"></div><div class="col-xs-1 mt-1 ml-0 mr-0 p-0 text-left digito sinpadding"><input  class="aunmenos tareapeso" type="text" placeholder="Peso"></div><div class="col-xs-1 mt-1 ml-0 mr-0 p-0 text-left digito sinpadding"><button class="botontipo2" onclick="addtarea()">+</button></div></div>');
  }

  function resumentutorial() {
      $('#containertutorial').children().fadeOut('1000',
          function () {

              $('#containertutorial').load('tutorial/resumen.html', function () {

                  $('#containertutorial').children().fadeIn('2000');
                  $('#containertutorial').ready(anaderesumen());
              });
          });

  }
  var pisoconfigurado = [];
  var info = {}

  function agregarnombreydireccion() {

      info.nombrepiso = $('#nombreconf').val();
      info.dirpiso = $('#direccionconf').val();
      console.log(info);
      mensualidadyfecha();

  }

  function agregarmensualidadyfecha() {
      info.mensualidad = $('#mensualidadconf').val();
      info.fechadepago = $('#fechapagoconf').val();
      console.log(info);
      bote();
  }

  function agregarbote() {
      info.bote = $('.ui-accordion-header-active').text();
      console.log(info);
      inventarioynevera();
  }

  function agregarinventarioynevera() {
      info.inventarionevera = $('.ui-accordion-header-active').text();
      console.log(info);
      conftareas();
  }

  function agregartareas() {
      tareas = [];
      info.diadecomienzo = $("#diasemanatareas option:selected").text();

      for ($i = 0; $i < $('input.tareaconf').length; $i++) {
          tarea = {};
          tarea.nombre = $('input.tareaconf').eq($i).val();
          tarea.repeticiones = $('input.tarearepeticion').eq($i).val();
          tarea.peso = $('input.tareapeso').eq($i).val();

          tareas.push(tarea);
      }

      info.tareas = tareas;
      console.log(info);
      resumentutorial();

      //for(i in $('tareaconf')){
      //  tareas.nombre= $.map($('.tareaconf'), function(el){return el.valueM});
      //tareas.push(tarea);
      //}
      //console.log(tareas);
  }

  function anaderesumen() {

      $('#nombreresumen').append(info.nombrepiso);
      $('#direccionresumen').append(info.dirpiso);
      $('#mensualidadresumen').append(info.mensualidad);
      $('#fecharesumen').append(info.fechadepago);
      $('#boteresumen').append(info.bote);
      $('#almacenajeresumen').append(info.inventarionevera);
      $('#diacomienzoresumen').append(info.diadecomienzo);

      for (i in info.tareas) {
          $('#tareasresumen').append('<div class="row"><div class="col">' + info.tareas[i].nombre + '</div><div class="col">' + info.tareas[i].repeticiones + '</div><div class="col">' + info.tareas[i].peso + '</div></div>');
      }
  }

  function guardaconfiguracion() {
      var jsonaenviar = JSON.stringify(info);
      $.ajax({
          type: "POST",
          url: 'php/infopiso.php',
          data: {
              yaconfigurado: jsonaenviar
          },
          success: function (response) {
              console.log(response);
          }
      });
  }
