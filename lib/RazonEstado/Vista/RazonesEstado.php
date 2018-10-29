<?php
$estado_proceso = $_POST['estado_proceso'];
?>

<script>
    $('#frm_razon_estado_proceso').validate({
        rules: {
            razon: {required: true}

        },
        messages: {
            razon: {required: 'Ingrese la razon para el estado.'}

        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            AlmacenarRazonEstado(<?php echo $estado_proceso; ?>);
        }
    });
</script>



<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Razones por estado</h3>
    </div>

    <div class="panel-body" >


        <form id="frm_razon_estado_proceso">
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Razon : </td>
                    <td><input type="text" class="form-control" id="razon" name="razon"></td>
                </tr>

                <tr>
                    <td colspan="2"><center>

                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Agregar razon al estado</button>
                </center>
                </td>
                </tr>

            </table>
        </form>



        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th colspan="2">Razones adicionadas</th>
                </tr>
                <tr>
                    <th>Razones</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody id="razones_estados_add">

            </tbody>
        </table>


    </div>
</div>
<script>
    RazonesPorEstado(<?php echo $estado_proceso; ?>);
</script>
