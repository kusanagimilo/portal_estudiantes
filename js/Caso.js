function CargarCasosDisponi() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Vista/VistaCasosDisponibles.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}

function DialogCrearCaso(id_tipo_proceso) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/Forms/Vista/FormularioInter.php',
        async: false,
        data: {
            id_tipo_proceso: id_tipo_proceso

        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_n_caso").html(data);
    $("#dialog_n_caso").dialog({
        width: '500',
        height: '500',
        title: 'Crear Caso',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_n_caso").dialog('close');
                $("#dialog_n_caso").dialog('destroy');
                $("#dialog_n_caso").html("");
            }
        }
    });

}

function VerTotCasos() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Vista/VerTotalCasos.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}

function GridCasos() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Controlador/CasoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'GridCasos'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}

function DialogTablaInformacionCaso(id_caso) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/Caso/Vista/TablaInformacion.php',
        async: false,
        data: {
            id_caso: id_caso

        },
        success: function (retu) {
            data = retu;
        }
    });



    $("#dialog_tab_caso").html(data);
    $("#dialog_tab_caso").dialog({
        width: '500',
        height: '500',
        title: 'Informacion caso',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_tab_caso").dialog('close');
                $("#dialog_tab_caso").dialog('destroy');
                $("#dialog_tab_caso").html("");
            }
        }
    });

}

function TablaCaso(id_caso) {
    var data_r;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Controlador/CasoController.php",
        async: false,
        data: {
            opcion: 'TablaInformacionCaso',
            id_caso: id_caso
        },
        success: function (retu) {
            data_r = retu;
        }
    });

    return data_r;
}

function VerMisCasos() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Vista/VerCasosUsuarios.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}
function VerCasosUsuario() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Controlador/CasoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'VerCasosUsuario'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}
function DialogCambiarEstado(id_caso) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/Caso/Vista/CambiarEstado.php',
        async: false,
        data: {
            id_caso: id_caso
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#diag_cam_caso").html(data);
    $("#diag_cam_caso").dialog({
        width: '500',
        height: '500',
        title: 'Cambiar estado caso',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#diag_cam_caso").dialog('close');
                $("#diag_cam_caso").dialog('destroy');
                $("#diag_cam_caso").html("");
            }
        }
    });

}

function CambiarEstado(id_caso) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Controlador/CasoController.php",
        async: false,
        data: {
            id_caso: id_caso,
            id_estado: $("#estado_proceso_l").val(),
            opcion: 'CambiarEstado'
        },
        success: function (retu) {
            data = retu;
        }
    });

    if (data == 1) {
        alert("Se cambio de caso correctamente");
        $("#diag_cam_caso").dialog('close');
        $("#diag_cam_caso").dialog('destroy');
        $("#diag_cam_caso").html("");
        VerTotCasos();
    } else if (data == 2) {
        alert("No se pudo cambiar el estado comuniquiese con soporte");
    }

}

function DialogMostrarAdjuntos(id_caso, estado) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/Caso/Vista/DocumentosAgregadosCaso.php',
        async: false,
        data: {
            id_caso: id_caso,
            estado: estado
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#mostrar_adjuntos").html(data);
    $("#mostrar_adjuntos").dialog({
        width: '500',
        height: '500',
        title: 'Crear Caso',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#mostrar_adjuntos").dialog('close');
                $("#mostrar_adjuntos").dialog('destroy');
                $("#mostrar_adjuntos").html("");
            }
        }
    });

}

function DocumentosAgregadosCaso(id_caso) {

    $("#documentos_anexados").html("");

    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Controlador/CasoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'DocumentosAgregadosCaso',
            id_caso: id_caso
        },
        success: function (retu) {
            data = retu;
        }
    });


//    console.log(data);
//    
//    return false;


    var tabla = "";

    $.each(data, function (keyp, data_json) {

        tabla = "<table class='table table-bordered table-striped'>" +
                "<thead>" +
                "<tr>" +
                "<th colspan='3'>Documentos Agregados por : " + data_json.usuario_nombres + "</th>" +
                "</tr>" +
                "<tr>" +
                "<th>Nombre documento</th><th>Ver doc</th><th>Fecha ingreso</th>" +
                "</tr>" +
                "</thead>" +
                "<tbody>";
        $.each(data_json.documentos, function (key2, data_json2) {
            tabla += "<tr>" +
                    "<td>" + data_json2.nombre + "</td>" +
                    "<td><a  target='_blank' href='" + data_json2.url + "'>Ver documento</a></td>" +
                    "<td>" + data_json2.fecha_creacion + "</td>" +
                    "</tr>";
        });

        tabla += "</tbody></table>";

        $("#documentos_anexados").append(tabla);

    });


}


function AlmacenaCasoAr(id_caso) {

    var retorno_archi = AlmacenarArchivoCaso(id_caso);

    if (retorno_archi == 1) {
        alert("Se adjunto correctamente el archivo");
        DocumentosAgregadosCaso(id_caso);
        $("#formula")[0].reset();

    } else if (retorno == 2) {
        alert("Ocurrio algun error al tratar de adjuntar el archivo");

    }
}

function InfoAdmin(tipo_proceso,id_caso,id_dato) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/Forms/Vista/FormAdmin.php',
        async: false,
        data: {
            id_tipo_proceso:tipo_proceso,
            id_caso: id_caso,
            id_dato:id_dato

        },
        success: function (retu) {
            data = retu;
        }
    });



    $("#dialog_tab_caso_admin").html(data);
    $("#dialog_tab_caso_admin").dialog({
        width: '500',
        height: '500',
        title: 'Completar info admin',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_tab_caso_admin").dialog('close');
                $("#dialog_tab_caso_admin").dialog('destroy');
                $("#dialog_tab_caso_admin").html("");
            }
        }
    });

}
function TablaCasoAdmin(id_caso) {
    var data_r;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Controlador/CasoController.php",
        async: false,
        data: {
            opcion: 'TablaInformacionCasoAdmin',
            id_caso: id_caso
        },
        success: function (retu) {
            data_r = retu;
        }
    });

    return data_r;
}