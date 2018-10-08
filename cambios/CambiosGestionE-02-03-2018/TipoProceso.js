var contador = 0;

function DialogCrearTipoProceso() {
    var data;

    var data;
    $.ajax({
        type: "POST",
        url: "lib/tipo_proceso/Vista/FormTipoProceso.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_n_tipo_proceso").html(data);
    $("#dialog_n_tipo_proceso").dialog({
        width: '700',
        height: '600',
        title: 'Crear tipo proceso',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_n_tipo_proceso").dialog('close');
                $("#dialog_n_tipo_proceso").dialog('destroy');
                $("#dialog_n_tipo_proceso").html("");
            }
        }
    });

}



function AgregarArchivo() {

    contador++;

    var html = "<tr id='tra_" + contador + "'>" +
            "<td><input type='text' name='nombres_ar[]' id='nombres_ar'></td>" +
            "<td><input type='file' name='archivos[]' id='archivos'></td>" +
            "<td><input type='button' name='eliminar_btn_ar' class='btn btn-danger' value='Eliminar' onclick='EliminarTdArchivos(" + contador + ")'></td>" +
            "</tr>";
    $("#arch_anid").append(html);

}

function EliminarTdArchivos(id_td) {

    $("#tra_" + id_td + "").remove();

}

function AlmacenarTipoProceso() {

    var extensiones_permitidas = new Array(".jpg", ".pdf", ".png", ".docx", ".xlsx", ".doc", ".xls", ".msg");


    var formElement = document.getElementById("formula");
    var data = new FormData(formElement);
    var inputFileImage;
    var file;
    var errores = 0;
    var errores2 = 0;

    var campos = [];
    $('input[name^="orden"]').each(function () {
        campos.push($(this).val());
    });



    var nombres_archivos = [];
    $('input[name^="nombres_ar"]').each(function () {
        nombres_archivos.push($(this).val());
    });


    var j = 0;
    $('input[name^="archivos"]').each(function () {

        inputFileImage = document.getElementById($(this).attr("id"));
        extension = (inputFileImage.value.substring(inputFileImage.value.lastIndexOf("."))).toLowerCase();

        permitida = false;

        for (var i = 0; i < extensiones_permitidas.length; i++) {
            if (extensiones_permitidas[i] == extension) {
                permitida = true;
                break;
            }
        }

        //alert("archi_" + nombres_archivos[j]);

        if (!permitida) {
            errores = errores + 1;
        }
        j++;

    });

    //icono

    var icono = document.getElementById("icono");
    extension_icono = (icono.value.substring(icono.value.lastIndexOf("."))).toLowerCase();

    permitida_icono = false;

    for (var i = 0; i < extensiones_permitidas.length; i++) {
        if (extensiones_permitidas[i] == extension_icono) {
            permitida_icono = true;
            break;
        }
    }
    //alert("archi_" + nombres_archivos[j]);

    if (permitida_icono) {
        file = icono.files[0];
        data.append(icono, file);
    } else {
        errores2 = errores2 + 1;
    }





    if (errores == 0 && errores2 == 0) {

        data.append('opcion', 'CrearTipoProceso');
        data.append('tipo_proceso', $("#tipo_proceso").val());
        data.append('campos', campos);


        var url = "lib/tipo_proceso/Controlador/TipoProcesoController.php";
        var retorno;
        $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            data: data,
            async: false,
            processData: false,
            cache: false
        }).done(function (retu) {
            //console.log(retu);
            retorno = retu;
        });

        if (retorno == 1) {
            alert("Se ingreso correctamente el tipo de proceso ");
            $("#dialog_n_tipo_proceso").dialog('close');
            $("#dialog_n_tipo_proceso").dialog('destroy');
            $("#dialog_n_tipo_proceso").html("");
            CargarTipoProceso();


        } else if (retorno == 2) {
            alert("Ocurrio algun error al tratar de ingresar los documentos comuniquese con soporte tecnico");

        }
    } else {
        alert("Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join() + "\n O revise que todos los documentos esten anexos ");

    }


    //console.log(nombres_archivos[0]);

}

function GridTipoProceso() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/tipo_proceso/Controlador/TipoProcesoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'GridTipoProceso'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}
function CargarTipoProceso() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/tipo_proceso/Vista/VistaTipoProceso.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}
function ListaTipoProceso() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/tipo_proceso/Controlador/TipoProcesoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'ListaTipoProceso'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;
}



//    var j = 0;
//    $('input[name^="archivos"]').each(function () {
//
//        inputFileImage = document.getElementById($(this).attr("id"));
//        extension = (inputFileImage.value.substring(inputFileImage.value.lastIndexOf("."))).toLowerCase();
//
//        permitida = false;
//
//        for (var i = 0; i < extensiones_permitidas.length; i++) {
//            if (extensiones_permitidas[i] == extension) {
//                permitida = true;
//                break;
//            }
//        }
//
//        //alert("archi_" + nombres_archivos[j]);
//
//        if (permitida) {
//            file = inputFileImage.files[0];
//            data.append("archi_" + nombres_archivos[j], file);
//
//            //console.log($(this).attr("id"));
//            id_cambiante = "";
//            inputFileImage = "";
//            file = "";
//        } else {
//            errores = errores + 1;
//        }
//        j++;
//
//    });

function elimina_tipop(tipo_proceso) {

    var confirma = confirm("Esta seguro de realizar esta accion")
    if (confirma) {
        var data;
        $.ajax({
            type: "POST",
            url: "lib/tipo_proceso/Controlador/TipoProcesoController.php",
            async: false,
            dataType: 'json',
            data: {
                opcion: 'EliminaTipoProceso',
                tipo_proceso: tipo_proceso
            },
            success: function (retu) {
                data = retu;
            }
        });

        if (data == 1) {
            alert("se elimino con exito el tipo de proceso");
            CargarTipoProceso();
        } else {
            alert("no se logro eliminar el tipo de proceso");
        }
    }

}

function DialogEditarTipoProceso(tipo_proceso) {


    var data;
    $.ajax({
        type: "POST",
        url: "lib/tipo_proceso/Vista/EditarTipoProceso.php",
        async: false,
        data: {
            tipo_proceso: tipo_proceso
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_edt_tipo_proceso").html(data);
    $("#dialog_edt_tipo_proceso").dialog({
        width: '700',
        height: '600',
        title: 'Editar tipo proceso',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_edt_tipo_proceso").dialog('close');
                $("#dialog_edt_tipo_proceso").dialog('destroy');
                $("#dialog_edt_tipo_proceso").html("");
            }
        }
    });

}

function MostrarInfoEditTipoProceso(tipo_proceso) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/tipo_proceso/Controlador/TipoProcesoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'MostrarInfoEditTipoProceso',
            tipo_proceso: tipo_proceso
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}

function EliminarDocumentoTp(documento_tipo_proceso, id_documento, id_tipo_proceso) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/tipo_proceso/Controlador/TipoProcesoController.php",
        async: false,
        data: {
            opcion: 'EliminarDocumentoTp',
            id_documento: id_documento,
            id_documento_tipo_proceso: documento_tipo_proceso
        },
        success: function (retu) {
            data = retu;
        }
    });

    if (data == "bien") {
        alert("Se elimino el documento");
        RecargaTipoProceso(id_tipo_proceso);
    } else {
        alert("Ocurrio algun error al tratar de ingresar el documento comuniquese con soporte tecnico");
    }
}

function AnadirDocumentoTp(id_tipo_proceso) {

    var confirma = confirm("Desea agregar el documento, el documento quedara agregado al proceso");

    if (confirma) {


        var documento = document.getElementById("documento");
        if (documento.value == "") {
            alert("Agrege un documento");
        } else {

            var formElement = document.getElementById("formula");
            var data = new FormData(formElement);

            var file;
            var error = 0;

            var extensiones_permitidas = new Array(".jpg", ".pdf", ".png", ".docx", ".xlsx", ".doc", ".xls", ".msg");
            //icono


            var extension_documento = (documento.value.substring(documento.value.lastIndexOf("."))).toLowerCase();

            permitida_documento = false;

            for (var i = 0; i < extensiones_permitidas.length; i++) {
                if (extensiones_permitidas[i] == extension_documento) {
                    permitida_documento = true;
                    break;
                }
            }
            //alert("archi_" + nombres_archivos[j]);

            if (extensiones_permitidas) {
                file = documento.files[0];
                data.append('documento', file);
            } else {
                error = error + 1;
            }

            if (error == 0) {

                data.append('opcion', 'AnadirDocumentoTp');
                data.append('id_tipo_proceso', id_tipo_proceso);


                var url = "lib/tipo_proceso/Controlador/TipoProcesoController.php";
                var retorno;
                $.ajax({
                    url: url,
                    type: 'POST',
                    contentType: false,
                    data: data,
                    async: false,
                    processData: false,
                    cache: false
                }).done(function (retu) {
                    //console.log(retu);
                    retorno = retu;
                });


                if (retorno == 1) {
                    alert("Se ingreso correctamente el documento ");
                    RecargaTipoProceso(id_tipo_proceso);

                } else if (retorno == 2) {
                    alert("Ocurrio algun error al tratar de ingresar el documento comuniquese con soporte tecnico");

                }
            } else {
                alert("Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join() + "\n O revise que todos los documentos esten anexos ");

            }


        }
    }
}

function RecargaTipoProceso(tipo_proceso) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/tipo_proceso/Vista/EditarTipoProceso.php",
        async: false,
        data: {
            tipo_proceso: tipo_proceso
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_edt_tipo_proceso").html(data);
}

function ModificarTp(id_tipo_proceso) {

    var confirma = confirm("Desea modificar el tipo de proceso");

    if (confirma) {


        /*
         alert($("#icono").val());
         return false;
         */
        var formElement = document.getElementById("formula");
        var data = new FormData(formElement);
        var errores2 = 0;


        if ($("#icono").val() != "") {
            var extensiones_permitidas = new Array(".jpg", ".pdf", ".png", ".docx", ".xlsx", ".doc", ".xls", ".msg");
            var file;
            var icono = document.getElementById("icono");



            extension_icono = (icono.value.substring(icono.value.lastIndexOf("."))).toLowerCase();
            permitida_icono = false;

            for (var i = 0; i < extensiones_permitidas.length; i++) {
                if (extensiones_permitidas[i] == extension_icono) {
                    permitida_icono = true;
                    break;
                }
            }
            //alert("archi_" + nombres_archivos[j]);

            if (permitida_icono) {
                file = icono.files[0];
                data.append('icono', file);
            } else {
                errores2 = errores2 + 1;
            }

        } else {
            data.append('icono', 'mismo_icono');
        }


        if (errores2 == 0) {
            data.append('opcion', 'ModificarTp');
            data.append('tipo_proceso', $("#tipo_proceso").val());
            data.append('id_tipo_proceso', id_tipo_proceso);


            var url = "lib/tipo_proceso/Controlador/TipoProcesoController.php";
            var retorno;
            $.ajax({
                url: url,
                type: 'POST',
                contentType: false,
                data: data,
                async: false,
                processData: false,
                cache: false
            }).done(function (retu) {
                //console.log(retu);
                retorno = retu;
            });

            if (retorno == 1) {
                alert("Se ingreso modifico el tipo de proceso ");
                //RecargaTipoProceso(id_tipo_proceso);

                $("#dialog_edt_tipo_proceso").dialog('close');
                $("#dialog_edt_tipo_proceso").dialog('destroy');
                $("#dialog_edt_tipo_proceso").html("");
                CargarTipoProceso();
            } else if (retorno == 2) {
                alert("Ocurrio algun error al tratar de modificar, comuniquese con soporte tecnico");

            }
        } else {
            alert("Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join() + "\n O revise que todos los documentos esten anexos ");

        }
    }
}