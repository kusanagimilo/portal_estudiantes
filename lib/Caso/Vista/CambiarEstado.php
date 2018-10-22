<?php 
$id_caso = $_POST['id_caso'];
?>
<script>
    $('#form_cambiar_estado').validate({
        rules: {
            estado_proceso_l: {required: true}

        },
        messages: {
            estado_proceso_l: {required: 'seleccione un estado'}

        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
           CambiarEstado(<?php echo $id_caso;?>);
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Cambiar estado caso</h3>
    </div>

    <div class="panel-body" >
        <form method='post' name='form_cambiar_estado' id='form_cambiar_estado'> 
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Nuevo estado para el caso</td>
                    <td>
                        <select id="estado_proceso_l" name="estado_proceso_l">
                            <option value="">-seleccione-</option>
                        </select>
                    </td>
                </tr>
               

                <td colspan="2"><center>

                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Guardar</button>
                </center></td>
                </tr>
            </table>
        </form>
    </div>
</div>




<script>
    var retornojson = ListEstadoProceso();
    
    $.each(retornojson, function (key, data) {
        //console.log(data.id_tipo_proceso);
        $("#estado_proceso_l").append("<option value='" + data.id_estado_proceso + "'>" + data.estado_proceso + "</option>");
    });

</script>

