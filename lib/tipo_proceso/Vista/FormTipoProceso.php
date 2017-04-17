<script>
    $('#formula').validate({
        rules: {
            tipo_proceso: {required: true},
            campos_tipo_pro: {required: true}

        },
        messages: {
            tipo_proceso: {required: 'Ingrese el nombre del tipo de proceso.'},
            campos_tipo_pro: {required: 'Ingrese los campos del tipo de proceso.'},
            icono: {required: 'Ingrese el icono.'}

        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            AlmacenarTipoProceso();
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Nuevo tipo de proceso</h3>
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
                    <td><input type="file" name="icono" id="icono" ></td>
                </tr>

                <tr>
                    <td colspan="2">
                <center>
                    Seleccione los campos para este tipo de proceso : <br>
                    <br>

                    <select id="campos_tipo_pro" name="campos_tipo_pro" multiple="multiple">

                    </select>
                </center>
                </td>
                </tr>


                <tr>
                    <td colspan="2">
                <center>
                    <input type="button" name="agrega_arc" onclick="AgregarArchivo()" value="Añadir archivo" class="btn btn-default" >
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
                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Guardar</button>
                </center>
                </td>
                </tr>
            </table>
            <div id="cont_orden" style="display: none">

            </div>
        </form>
    </div>
</div>
<script>
    var retornojson = ListaCampos();

    $.each(retornojson, function (key, data) {
        //console.log(data.id_tipo_proceso);
        $("#campos_tipo_pro").append("<option value='" + data.id_campo + "'>" + data.nombre_campo + "</option>");
    });

    $('#campos_tipo_pro').multiSelect({
        
        keepOrder: true,
        afterSelect: function (values) {
            $("#cont_orden").append("<input type='hidden' value='" + values + "' id='orden' name='orden[]' class='orden_" + values + "'>");
        },
        afterDeselect: function (values) {
            $(".orden_" + values + "").remove();
        }
    });

</script>



