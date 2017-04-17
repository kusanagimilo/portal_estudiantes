/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function AlmacenarForm()
{
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
    if (tipo_otro = 'motivo_inasistencia') {

        if ($("#" + tipo_otro + "").val() == 'OTRO') {
            $("#cont_otro").html("Otro motivo excusa : <input type='text' name='otro_motivo_excusa' id='otro_motivo_excusa'>");
        } else {
            $("#cont_otro").html("");
        }

    } else {

        $("#cont_otro").html("");

    }
}