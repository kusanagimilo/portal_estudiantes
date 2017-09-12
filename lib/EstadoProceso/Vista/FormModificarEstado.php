<?php $id_estado = $_POST['estado']; ?>
<script>
    var informacion_estado = InformacionModiEstado(<?php echo $id_estado; ?>);

    $("#estado_proceso_m").val(informacion_estado.estado_proceso);
    $("#estado_estado_m").val(informacion_estado.estado);
    $('#frm_mod_estado').validate({
        rules: {
            estado_proceso_m: {required: true},
            estado_estado_m: {required: true}
        },
        messages: {
            estado_proceso_m: {required: 'Ingrese el nombre del estado.'},

        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            ModificarEstadoProceso(informacion_estado.id_estado_proceso);
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Modificar estado proceso</h3>
    </div>

    <div class="panel-body" >
        <form id="frm_mod_estado">
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Ingrese el nombre del estado</td>
                    <td><input type="text" id="estado_proceso_m" name="estado_proceso_m"></td>
                </tr>
                <tr>
                    <td>Estado rol</td>
                    <td>
                        <select id="estado_estado_m" name="estado_estado_m">
                            <option value="">-seleccione-</option>
                            <option value="AC">Activo</option>
                            <option value="IN">Inactivo</option>
                        </select>
                    </td>
                </tr>

                <td colspan="2"><center>

                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Modificar</button>
                </center></td>
                </tr>
            </table>
        </form>
    </div>
</div>

