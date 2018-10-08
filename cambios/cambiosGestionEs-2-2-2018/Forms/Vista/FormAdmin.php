<?php
include '../../config/BD.php';
@include '../Modelo/Forms.php';


$id_tipo_proceso = $_POST['id_tipo_proceso'];
$id_caso = $_POST['id_caso'];
$id_dato = $_POST['id_dato'];

$obj_forms = new Forms();

$formulario = $obj_forms->MostrarFormAdmin($id_tipo_proceso);
//echo "<pre>";
//var_dump($formulario);
//echo "</pre>";
?>
<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Tipo proceso : <?php echo @$formulario[0]['tipo_proceso']; ?></h3>
    </div>

    <div class="panel-body" >




        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Click aqui para ver informacion del caso</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse" >
                    <div id="info_admin_cas"></div>
                </div>
            </div>
        </div>



        <form id="frm_forms_admin" enctype='multipart/form-data' method='post' >
            <input type="hidden" name="opcion" id="opcion" value="AlmacenarDatosAdmin">
            <input type="hidden" name="tipo_proceso" id="tipo_proceso" value="<?php echo $id_tipo_proceso; ?>">
            <input type="hidden" name="id_dato" id="id_dato" value="<?php echo $id_dato; ?>">
            <table class="table table-bordered table-striped">

                <?php foreach ($formulario as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $value['nombre_campo'] ?></td>

                        <?php if ($value['tipo_campo'] == 'TEXTO') { ?>

                            <td><input type="text" name="<?php echo $value['campo_identi'] ?>" id="<?php echo $value['campo_identi'] ?>"></td>
                            <?php
                        } else if ($value['tipo_campo'] == 'LISTA') {

                            $opciones_lista = explode(';', $value['opciones']);

                            $lista = "<select id='" . $value['campo_identi'] . "' name='" . $value['campo_identi'] . "'>
                                                                <option value=''>-seleccione-</option>";

                            for ($index = 0; $index < count($opciones_lista); $index++) {
                                $lista .= "<option value='" . utf8_encode($opciones_lista[$index]) . "'>" . utf8_encode($opciones_lista[$index]) . "</option>";
                            }


                            $lista .= "</select>";
                            ?>
                            <td>
                                <?php echo $lista; ?>
                            </td>

                        <?php } else if ($value['tipo_campo'] == 'FECHA') { ?>


                            <td><input type="text" name="<?php echo $value['campo_identi'] ?>" id="<?php echo $value['campo_identi'] ?>"></td>
                        <script>
                            $("#<?php echo $value['campo_identi'] ?>").datepicker({dateFormat: 'yy-mm-dd'});
                        </script>
                        <?php
                    } else if ($value['tipo_campo'] == 'HORA') {
                        $hora = "<select id='h_" . $value['campo_identi'] . "' name='h_" . $value['campo_identi'] . "'>";
                        for ($index1 = 0; $index1 < 24; $index1++) {
                            $hora .= "<option value='" . $index1 . "'>" . $index1 . "</option>";
                        }
                        $hora .= "</select>";

                        $minutos = "<select id='m_" . $value['campo_identi'] . "' name='m_" . $value['campo_identi'] . "'>";
                        for ($index2 = 0; $index2 < 61; $index2++) {
                            $minutos .= "<option value='" . $index2 . "'>" . $index2 . "</option>";
                        }
                        $minutos .= "</select>";
                        ?>

                        <td><?php echo $hora . " : " . $minutos; ?></td> 
                        <?php
                    } else if ($value['tipo_campo'] == 'DESDE_HASTA') {
                        $opciones_desde_h = explode('-', $value['opciones']);
                        $desde = (int) $opciones_desde_h[0];
                        $hasta = (int) $opciones_desde_h[1];



                        $lista = "<select id='" . $value['campo_identi'] . "' name='" . $value['campo_identi'] . "'>
                                                                <option value=''>-seleccione-</option>";

                        for ($index3 = $desde; $index3 < $hasta; $index3++) {
                            $lista .= "<option value='" . $index3 . "'>" . $index3 . "</option>";
                        }

                        $lista .= "</select>";
                        ?>
                        <td>
                            <?php echo $lista; ?>
                        </td>

                        <?php
                    } else if ($value['tipo_campo'] == 'TEXT_AREA') {
                        ?>

                        <td>
                            <textarea name="<?php echo $value['campo_identi'] ?>" id="<?php echo $value['campo_identi'] ?>">
                            </textarea>
                        </td>

                        <?php
                    }
                    ?>
                    </tr>

                <?php } ?>



                <tr>
                    <td colspan="2"><center>

                    <input type="button" class="btn btn-default" value="Almacenar info admin" onclick="AlmacenarFormAdmin()">
                </center>
                </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
    var retorno_caso_admin = TablaCasoAdmin(<?php echo $id_caso; ?>);
    $("#info_admin_cas").html(retorno_caso_admin);
</script>