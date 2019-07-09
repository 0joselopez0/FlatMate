    $.ajax({
        type: "POST",
        url: 'php/tareas.php',
        data: {
            cargatareas: 'a'
        },
        success: function (response) {
            console.log(response);
        }
    });

    $.ajax({
        type: "POST",
        url: 'php/tareas.php',
        data: {
            cargatareasuseractivo: 'a'
        },
        success: function (response) {

            parseado = JSON.parse(response);
            $('#desde').text(parseado[0].desde);
            $('#hasta').text(parseado[0].hasta);
            for (i in parseado) {
                $('.tareaspropias').append(' <div class="row tareasingular "><div class="col"><p>' + parseado[i].Tarea + '</p></div><div class="col p-2 text-right"><button class="botontipopeque">V</button></div></div>')

            }
        }
    });
