function VerNoticias() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Noticia/Vista/VistaNoticias.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);
}

function GridNoticias() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Noticia/Controlador/NoticiaController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'GridNoticias'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}

function CrearNoticia() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Noticia/Vista/FormNoticia.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);
}


function EliminarNoticia(noticia) {

    var des = confirm("Esta seguro que desea realizar esta operacion");

    if (des) {
        var data;
        $.ajax({
            type: "POST",
            url: "lib/Noticia/Controlador/NoticiaController.php",
            async: false,
            dataType: 'json',
            data: {
                opcion: 'EliminarNoticia',
                noticia: noticia
            },
            success: function (retu) {
                data = retu;
            }
        });

        if (data == 1) {
            alert("Se elimino la noticia");
            VerNoticias();
        } else if (data == 3) {
            alert("Error al realizar la operacion");
        }
    }


}