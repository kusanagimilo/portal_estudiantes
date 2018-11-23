/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function AlmacenarForm()
{

    var confirma = confirm("Esta seguro de almacenar esta informacion");

    if (confirma) {

        $("#btn_almacenar_caso").remove();
        $("#contenedor_cargando").html("<center>ALMACENANDO EL CASO ESPERE POR FAVOR ...</center>");

        var data_r;
        $.ajax({
            type: "POST",
            url: "lib/Forms/Controlador/FormsController.php",
            async: false,
            data: $("#frm_forms").serialize(),
            success: function (retu) {
                data_r = retu;
            }
        });
        //console.log(data_r);
        //return false;

        if (data_r != 'mal') {

            if ($("#archivo").val() == "" || $("#archivo").val() == null) {
                alert("Se ingreso correctamente la informacion");
                $("#dialog_n_caso").dialog('close');
                $("#dialog_n_caso").dialog('destroy');
                $("#dialog_n_caso").html("");
            } else {

                var retorno_ar = AlmacenarArchivoCaso(data_r);
                if (retorno_ar == 1) {

                    alert("Se ingreso correctamente la informacion");
                    $("#dialog_n_caso").dialog('close');
                    $("#dialog_n_caso").dialog('destroy');
                    $("#dialog_n_caso").html("");
                } else {
                    alert("No se ingreso la informacion");
                }
            }
        } else {
            alert("No se ingreso la informacion");
        }
    }

}
function AlmacenarArchivoCaso(id_caso) {
    var archivo = document.getElementById("archivo");
    var extensiones_permitidas = new Array(".jpg", ".pdf", ".png", ".docx", ".xlsx", ".xls", ".doc", ".msg");
    var formElement = document.getElementById("frm_forms");
    var data = new FormData(formElement);
    var file;
    var errores = 0;
    var extension_archivo = (archivo.value.substring(archivo.value.lastIndexOf("."))).toLowerCase();
    var permitida_archivo = false;
    for (var i = 0; i < extensiones_permitidas.length; i++) {
        if (extensiones_permitidas[i] == extension_archivo) {
            permitida_archivo = true;
            break;
        }
    }
//alert("archi_" + nombres_archivos[j]);

    if (permitida_archivo) {
        file = archivo.files[0];
        data.append('archivo', file);
    } else {
        errores = errores + 1;
    }

    if (errores == 0) {

        data.append('opcion', 'AdjuntarArchivoCaso');
        data.append('id_caso', id_caso);
        var url = "lib/Caso/Controlador/CasoController.php";
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
        return retorno;
    } else {
        alert("Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join() + "\n O revise que todos los documentos esten anexos ");
    }
}
function AlmacenarFormAdmin()
{
    var data_r;
    $.ajax({
        type: "POST",
        url: "lib/Forms/Controlador/FormsController.php",
        async: false,
        data: $("#frm_forms_admin").serialize(),
        success: function (retu) {
            data_r = retu;
        }
    });
    if (data_r == 'bien') {

        alert("Se ingreso correctamente la informacion");
        $("#dialog_tab_caso_admin").dialog('close');
        $("#dialog_tab_caso_admin").dialog('destroy');
        $("#dialog_tab_caso_admin").html("");
    } else {
        alert("No se ingreso la informacion");
    }

}
function MostrarOtro(tipo_otro) {
    if (tipo_otro == 'motivo_inasistencia') {

        if ($("#" + tipo_otro + "").val() == 'OTRO') {
            $("#cont_otro").html("Otro motivo excusa : <input type='text' name='otro_motivo_excusa' id='otro_motivo_excusa'>");
        } else if ($("#" + tipo_otro + "").val() == 'INCONVENIENTE PERSONAL') {
            $("#cont_otro").html("Situacion fuerza mayor : <input type='text' name='situacion_fuerza_mayor' id='situacion_fuerza_mayor'>");
        } else {
            $("#cont_otro").html("");
        }

    } else if (tipo_otro == 'medio_cumplio_requisito') {


        if ($("#" + tipo_otro + "").val() == 'NIVELES CURSADOS EN LA UNIVERSIDAD') {


            var nivel_clasificacion = "<select id='nivel_clasificacion' name='nivel_clasificacion'>" +
                    "<option value='No supero ningun nivel'>No supero ningun nivel</option>";
            for (var i = 0, max = 8; i < max; i++) {
                nivel_clasificacion += "<option value='nivel " + i + "'>nivel " + i + "</option>";
            }
            nivel_clasificacion += "</select>";
            var chk_nivl_apro = "";
            for (var a = 0, max = 9; a < max; a++) {
                chk_nivl_apro += "<input type='checkbox' name='nivel_cursado_aprobado[]' id='nivel_cursado_aprobado' value='Nivel " + a + "'> Nivel " + a + "<br>";
            }



            $("#des_ingles").html("<hr><b>NIVEL DE CLASIFICACIÓN</b> : " + nivel_clasificacion + "<hr> NIVELES CURSADOS Y APROBADOS <br> " + chk_nivl_apro + "");
        } else {
            $("#des_ingles").html("");
        }
    } else {

        $("#cont_otro").html("");
    }
}

function DialogAdiconaAlumno() {
    var data;
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Forms/Vista/AdicionAlumno.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });
    $("#adicion_alumno").html(data);
    $("#adicion_alumno").dialog({
        width: '400',
        height: '400',
        title: 'Adicion alumno',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#adicion_alumno").dialog('close');
                $("#adicion_alumno").dialog('destroy');
                $("#adicion_alumno").html("");
            }
        }
    });
}

function AdicionarAlumno() {



    var html = "";
    var nombre_al = $("#nombre_al").val();
    var tipo_documento_al = $("#tipo_documento_al").val();
    var numero_documento_al = $("#numero_documento_al").val();
    var id_javeriana_al = $("#id_javeriana_al").val();
    var telefono_al = $("#telefono_al").val();
    var correo_electronico_al = $("#correo_electronico_al").val();


    if (nombre_al == "" || tipo_documento_al == "" || numero_documento_al == ""
            || id_javeriana_al == "" || telefono_al == "" || correo_electronico_al == "") {

        alert("Complete todos los campos para poder agregar el alumno");

    } else {
        html = "<tr id='alumno_" + numero_documento_al + "'>" +
                "<td>" + nombre_al + "</td>" +
                "<td><input type='button' onclick='RetirarAlumno(" + numero_documento_al + ")' value='Eliminar' class='btn btn-danger'>" +
                "<input type='hidden' value='" + nombre_al + "' id='nombres_alumnos' name='nombres_alumnos[]' >" +
                "<input type='hidden' value='" + tipo_documento_al + "' id='tipos_documentos_alumnos' name='tipos_documentos_alumnos[]' >" +
                "<input type='hidden' value='" + numero_documento_al + "' id='numeros_documentos_alumnos' name='numeros_documentos_alumnos[]' >" +
                "<input type='hidden' value='" + id_javeriana_al + "' id='ids_javeriana_alumnos' name='ids_javeriana_alumnos[]' >" +
                "<input type='hidden' value='" + telefono_al + "' id='telefonos_alumnos' name='telefonos_alumnos[]' >" +
                "<input type='hidden' value='" + correo_electronico_al + "' id='correos_alumnos' name='correos_alumnos[]' >" +
                "</td>";
        "</tr>";
        $("#add_alumnos").append(html);
        $("#adicion_alumno").dialog('close');
        $("#adicion_alumno").dialog('destroy');
        $("#adicion_alumno").html("");
    }
}

function RetirarAlumno(documento_alumno) {
    $("#alumno_" + documento_alumno + "").remove();
}


function AlmacenaCartaPresentacion() {
    var nombres_alumnos = [];
    $('input[name^="nombres_alumnos"]').each(function () {
        nombres_alumnos.push($(this).val());
    });
    var tipos_documentos_alumnos = [];
    $('input[name^="tipos_documentos_alumnos"]').each(function () {
        tipos_documentos_alumnos.push($(this).val());
    });
    var numeros_documentos_alumnos = [];
    $('input[name^="numeros_documentos_alumnos"]').each(function () {
        numeros_documentos_alumnos.push($(this).val());
    });
    var ids_javeriana_alumnos = [];
    $('input[name^="ids_javeriana_alumnos"]').each(function () {
        ids_javeriana_alumnos.push($(this).val());
    });
    var telefonos_alumnos = [];
    $('input[name^="telefonos_alumnos"]').each(function () {
        telefonos_alumnos.push($(this).val());
    });
    var correos_alumnos = [];
    $('input[name^="correos_alumnos"]').each(function () {
        correos_alumnos.push($(this).val());
    });
    var confirma = confirm("Esta seguro de realizar esta accion")
    if (confirma) {

        $("#btn_almacenar_caso").remove();
        $("#contenedor_cargando").html("<center>ALMACENANDO EL CASO ESPERE POR FAVOR ...</center>");

        var data_r;
        $.ajax({
            type: "POST",
            url: "lib/Forms/Controlador/FormsController.php",
            async: false,
            data: {
                opcion: 'AlmacenaCartaPresentacion',
                nombres_alumnos: nombres_alumnos,
                tipos_documentos_alumnos: tipos_documentos_alumnos,
                numeros_documentos_alumnos: numeros_documentos_alumnos,
                ids_javeriana_alumnos: ids_javeriana_alumnos,
                telefonos_alumnos: telefonos_alumnos,
                correos_alumnos: correos_alumnos,
                nombre_responsable_empresa: $("#nombre_responsable_empresa").val(),
                cargo_responsable_empresa: $("#cargo_responsable_empresa").val(),
                nombre_empresa: $("#nombre_empresa").val(),
                nombre_asignatura: $("#nombre_asignatura").val(),
                nombre_profesor: $("#nombre_profesor").val(),
                tipo_proceso: $("#tipo_proceso").val()

            },
            success: function (retu) {
                data_r = retu;
            }
        });


        if (data_r != 'mal') {

            if ($("#archivo").val() == "" || $("#archivo").val() == null) {
                alert("Se ingreso correctamente la informacion");
                $("#dialog_n_caso").dialog('close');
                $("#dialog_n_caso").dialog('destroy');
                $("#dialog_n_caso").html("");
            } else {

                var retorno_ar = AlmacenarArchivoCaso(data_r);
                if (retorno_ar == 1) {

                    alert("Se ingreso correctamente la informacion");
                    $("#dialog_n_caso").dialog('close');
                    $("#dialog_n_caso").dialog('destroy');
                    $("#dialog_n_caso").html("");
                } else {
                    alert("No se ingreso la informacion");
                }
            }
        } else {
            alert("No se ingreso la informacion");
        }


    }
}

function soloNumeros(e)
{
    var key = window.Event ? e.which : e.keyCode
    return ((key >= 48 && key <= 57) || (key == 8))
}