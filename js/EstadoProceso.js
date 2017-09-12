function GridEstados() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/EstadoProceso/Controlador/EstadoProcesoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'GridEstados'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}
function CargarVistaEstados() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/EstadoProceso/Vista/VistaEstados.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}

function DialogCrearEstado() {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/EstadoProceso/Vista/FormEstadoProceso.php',
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_n_estado").html(data);
    $("#dialog_n_estado").dialog({
        width: '500',
        height: '500',
        title: 'Crear estado',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_n_estado").dialog('close');
                $("#dialog_n_estado").dialog('destroy');
                $("#dialog_n_estado").html("");
            }
        }
    });

}

function AlmacenarEstado()
{
    var data;
    $.ajax({
        type: "POST",
        url: "lib/EstadoProceso/Controlador/EstadoProcesoController.php",
        async: false,
        data: {
            opcion: 'AlmacenarEstado',
            estado: $("#estado").val()
        },
        success: function (retu) {
            data = retu;
        }
    });

    if (data == 1) {

        alert("Se ingreso correctamente el estado");
        $("#dialog_n_estado").dialog('close');
        $("#dialog_n_estado").dialog('destroy');
        $("#dialog_n_estado").html("");
        CargarVistaEstados();


    } else if (data == 2)
    {
        alert("Este estado ya existe cambielo");
    } else
    {
        alert("No se logro ingresar el estado, comuniquese con soporte");
    }
}
function ListEstadoProceso() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/EstadoProceso/Controlador/EstadoProcesoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'ListaEstados'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;
}

function InformacionModiEstado(estado) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/EstadoProceso/Controlador/EstadoProcesoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'InformacionModiEstado',
            estado: estado
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}

function DialogModEstado(estado) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/EstadoProceso/Vista/FormModificarEstado.php',
        async: false,
        data: {
            estado: estado
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#modi_estados").html(data);
    $("#modi_estados").dialog({
        width: '500',
        height: '500',
        title: 'Modificar estado',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#modi_estados").dialog('close');
                $("#modi_estados").dialog('destroy');
                $("#modi_estados").html("");
            }
        }
    });
}

function ModificarEstadoProceso(id_estado_proceso) {
    var confirma = confirm('Esta seguro de modificar este estado');

    if (confirma) {
        var data;
        $.ajax({
            type: "POST",
            url: "lib/EstadoProceso/Controlador/EstadoProcesoController.php",
            async: false,
            data: {
                opcion: 'ModificarEstadoProceso',
                id_estado_proceso: id_estado_proceso,
                estado_proceso: $("#estado_proceso_m").val(),
                estado: $("#estado_estado_m").val()
            },
            success: function (retu) {
                data = retu;
            }
        });

        if (data == 1) {
            alert("Se modifico correctamente el estado");
            $("#modi_estados").dialog('close');
            $("#modi_estados").dialog('destroy');
            $("#modi_estados").html("");
            CargarVistaEstados();

        } else if (data == 2)
        {
            alert("Este estado ya existe cambielo");
        } else
        {
            alert("No se logro ingresar el estado, comuniquese con soporte");
        }

    }
}