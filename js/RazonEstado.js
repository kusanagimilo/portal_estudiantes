/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function DialogRazonEstado(estado_proceso) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/RazonEstado/Vista/RazonesEstado.php',
        async: false,
        data: {
            estado_proceso: estado_proceso
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_razon_estado").html(data);
    $("#dialog_razon_estado").dialog({
        width: '500',
        height: '500',
        title: 'Razones por estado',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_razon_estado").dialog('close');
                $("#dialog_razon_estado").dialog('destroy');
                $("#dialog_razon_estado").html("");
            }
        }
    });
}
function AlmacenarRazonEstado(estado_proceso) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/RazonEstado/Controlador/RazonEstadoController.php",
        async: false,
        data: {
            opcion: 'AlmacenarRazonEstado',
            estado_proceso: estado_proceso,
            razon: $("#razon").val()
        },
        success: function (retu) {
            data = retu;
        }
    });

    if (data == 1) {
        alert("Se ingreso correctamente la razon");
        RazonesPorEstado(estado_proceso);
    } else if (data == 2)
    {
        alert("Esta razon ya existe para este estado");
    } else
    {
        alert("No se logro almacenar la razon");
    }
}

function RazonesPorEstado(estado_proceso) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/RazonEstado/Controlador/RazonEstadoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'RazonesPorEstado',
            estado_proceso: estado_proceso
        },
        success: function (retu) {
            data = retu;
        }
    });
    var html = "";
    $.each(data, function (key, data2) {
        //console.log(data.id_tipo_proceso);
        html += "<tr id='razon_" + data2.id_razon_estado + "'>" +
                "<td>" + data2.razon + "</td>" +
                "<td><input type='button' class='btn btn-danger' value='Eliminar'></td>" +
                "</tr>";

    });
    $("#razones_estados_add").html(html);
}

function ListRazonEstado(input_estado_proceso, input_razon_estado) {

    $("#input_razon_estado").html("");

    var estado_proceso = $("#" + input_estado_proceso + "").val();

    var data;
    $.ajax({
        type: "POST",
        url: "lib/RazonEstado/Controlador/RazonEstadoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'ListRazonEstado',
            estado_proceso: estado_proceso
        },
        success: function (retu) {
            data = retu;
        }
    });
    var html = "<option value=''>--seleccione--</option>";
    $.each(data, function (key, data2) {
        html += "<option value='" + data2.id_razon_estado + "'>" + data2.razon + "</option>";

    });
    $("#" + input_razon_estado + "").html(html);


}