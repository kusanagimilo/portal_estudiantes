<?php
$id_tipo_proceso = $_POST['tipo_proceso'];
?>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Editar tipo de proceso</h3>
    </div>

    <div class="panel-body" >
        <form enctype='multipart/form-data' method='post' name='fileinfo' id='formula'> 
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Ingrese el nombre del tipo de proceso</td>
                    <td><input type="text" id="tipo_proceso" name="tipo_proceso"></td>
                </tr>
                <tr>
                    <td>Ingrese el icono de el tipo de proceso</td>
                    <td>
                        <input type="file" name="icono" id="icono" ><br>
                        <div id="img_ico"></div>
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                <center>
                    <input type="file" name="documento" id="documento"><input type="button" onclick="AnadirDocumentoTp(<?php echo $id_tipo_proceso; ?>)" value="Añadir archivo" class="btn btn-default">
                </center>
                </td>
                </tr>
                <tr>

                    <td colspan="2" >

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th colspan="3">Archivos añadidos</th>
                                </tr>
                                <tr>
                                    <th>Nombre archivo</th>
                                    <th>Archivo</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="arch_anid">

                            </tbody>
                        </table>

                    </td>

                </tr>


                <td colspan="2">
                <center>
                    <!--<input type="button" value="Guardar" class="btn btn-success" onclick="">-->
                    <input type="button" value="Guardar" onclick="ModificarTp(<?php echo $id_tipo_proceso; ?>)" id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success"  />
                </center>
                </td>

            </table>
            <div id="cont_orden" style="display: none">

            </div>
        </form>
    </div>
</div>

<script>
    var json = MostrarInfoEditTipoProceso(<?php echo $id_tipo_proceso; ?>);

    $("#tipo_proceso").val(json.tipo_proceso);

    $("#img_ico").html("<center><b>Icono seleccionado</b>: <img height='42' width='42' src='lib/Documentos/" + json.icono + "'></center>");

    var string = "";
    $.each(json.documentos, function (key, data) {

        string = "<tr id='tra_" + data.id_documento + "'>" +
                "<td>" + data.nombre + "</td>" +
                "<td><a href='" + data.url + "' target='_blank'>" + data.nombre + "</a></td>" +
                "<td><input onclick='EliminarDocumentoTp(" + data.id_documento_tipo_proceso + "," + data.id_documento + "," + json.id_tipo_proceso + ")' type='button' value='Eliminar' class='btn btn-danger'></td>" +
                "</tr>";
        $("#arch_anid").append(string);
    });
</script>