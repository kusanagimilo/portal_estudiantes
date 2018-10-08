<?php
include '../../config/BD.php';
@include '../Modelo/Forms.php';


$id_tipo_proceso = $_POST['id_tipo_proceso'];

$obj_forms = new Forms();

$formulario = $obj_forms->MostrarForm($id_tipo_proceso);
//echo "<pre>";
//var_dump($formulario);
//echo "</pre>";

if ($formulario[0]['tipo_proceso'] != "CARTA DE PRESENTACION A EMPRESA") {


    $validaciones = "";
    ?>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">Tipo proceso : <?php echo @$formulario[0]['tipo_proceso']; ?></h3>
        </div>

        <div class="panel-body" >
            <form id="frm_forms" enctype='multipart/form-data' method='post' >
                <input type="hidden" name="opcion" id="opcion" value="AlmacenarDatos">
                <input type="hidden" name="tipo_proceso" id="tipo_proceso" value="<?php echo $id_tipo_proceso; ?>">
                <table class="table table-bordered table-striped">

                    <?php foreach ($formulario as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo utf8_encode($value['nombre_campo']) ?></td>

                            <?php
                            if ($value['tipo_campo'] == 'TEXTO') {

                                $validaciones .= "" . $value['campo_identi'] . ": {required: true},";
                                ?>

                                <?php if ($value['campo_identi'] == 'id_javeriana') {
                                    ?>

                                    <td><input type="text" onKeyPress="return soloNumeros(event)" maxlength="11" name="<?php echo $value['campo_identi'] ?>" id="<?php echo $value['campo_identi'] ?>" ></td>
                                <?php } else { ?>

                                    <td><input type="text" name="<?php echo $value['campo_identi'] ?>" id="<?php echo $value['campo_identi'] ?>" ></td>

                                <?php } ?>

                                <?php
                            } else if ($value['tipo_campo'] == 'LISTA') {

                                $opciones_lista = explode(';', $value['opciones']);

                                if ($value['campo_identi'] == 'motivo_inasistencia') {

                                    $validaciones .= "" . $value['campo_identi'] . ": {required: true},";
                                    $cam_iden = '"' . $value['campo_identi'] . '"';

                                    $lista = "<select  style='width:100px;' onchange='MostrarOtro($cam_iden)' id='" . $value['campo_identi'] . "' name='" . $value['campo_identi'] . "'>
                                                                <option value=''>-seleccione-</option>";
                                } else if ($value['campo_identi'] == 'medio_cumplio_requisito') {
                                    $validaciones .= "" . $value['campo_identi'] . ": {required: true},";
                                    $cam_iden = '"' . $value['campo_identi'] . '"';
                                    $lista = "<select  style='width:100px;' onchange='MostrarOtro($cam_iden)' id='" . $value['campo_identi'] . "' name='" . $value['campo_identi'] . "'>
                                                                <option value=''>-seleccione-</option>";
                                } else {
                                    $validaciones .= "" . $value['campo_identi'] . ": {required: true},";
                                    $lista = "<select  style='width:100px;' id='" . $value['campo_identi'] . "' name='" . $value['campo_identi'] . "'>
                                                                <option value=''>-seleccione-</option>";
                                }


                                for ($index = 0; $index < count($opciones_lista); $index++) {
                                    $lista .= "<option value='" . utf8_encode($opciones_lista[$index]) . "'>" . utf8_encode($opciones_lista[$index]) . "</option>";
                                }


                                $lista .= "</select>";
                                ?>
                                <td>
                                    <?php
                                    echo $lista;
                                    if ($value['campo_identi'] == 'motivo_inasistencia') {

                                        echo "<br><div id='cont_otro'></div>";
                                    } else if ($value['campo_identi'] == 'medio_cumplio_requisito') {

                                        echo "<br><div id='des_ingles'></div>";
                                    }
                                    ?>

                                </td>

                                <?php
                            } else if ($value['tipo_campo'] == 'FECHA') {

                                $validaciones .= "" . $value['campo_identi'] . ": {required: true},";
                                ?>


                                <td><input  type="text" name="<?php echo $value['campo_identi'] ?>" id="<?php echo $value['campo_identi'] ?>"></td>
                            <script>
                                $("#<?php echo $value['campo_identi'] ?>").datepicker({dateFormat: 'yy-mm-dd'});
                            </script>
                            <?php
                        } else if ($value['tipo_campo'] == 'HORA') {
                            $hora = "<select  id='h_" . $value['campo_identi'] . "' name='h_" . $value['campo_identi'] . "'>";
                            for ($index1 = 0; $index1 < 24; $index1++) {
                                if ($index1 < 10) {
                                    $hora .= "<option value='0" . $index1 . "'>" . "0" . $index1 . "</option>";
                                } else {
                                    $hora .= "<option value='" . $index1 . "'>" . $index1 . "</option>";
                                }
                            }
                            $hora .= "</select>";

                            $minutos = "<select  id='m_" . $value['campo_identi'] . "' name='m_" . $value['campo_identi'] . "'>";
                            for ($index2 = 0; $index2 < 60; $index2++) {
                                if ($index2 < 10) {
                                    $minutos .= "<option value='0" . $index2 . "'>" . "0" . $index2 . "</option>";
                                } else {
                                    $minutos .= "<option value='" . $index2 . "'>" . $index2 . "</option>";
                                }
                            }
                            $minutos .= "</select>";
                            ?>

                            <td><?php echo $hora . " : " . $minutos; ?></td> 
                            <?php
                        } else if ($value['tipo_campo'] == 'DESDE_HASTA') {
                            $opciones_desde_h = explode('-', $value['opciones']);
                            $desde = (int) $opciones_desde_h[0];
                            $hasta = (int) $opciones_desde_h[1];



                            $lista = "<select  id='" . $value['campo_identi'] . "' name='" . $value['campo_identi'] . "'>
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

                            $validaciones .= "" . $value['campo_identi'] . ": {required: true},";
                            ?>

                            <td>
                                <textarea  name="<?php echo $value['campo_identi'] ?>" id="<?php echo $value['campo_identi'] ?>">
                                </textarea>
                            </td>

                            <?php
                        } else if ($value['tipo_campo'] == 'CHECKBOX') {
                            $opciones_chk = explode(';', $value['opciones']);



                            $chk = "";

                            for ($index4 = 0; $index4 < count($opciones_chk); $index4++) {
                                $chk .= "<input type='checkbox' name='" . $value['campo_identi'] . "[]' id='" . $value['campo_identi'] . "' value='" . utf8_encode($opciones_chk[$index4]) . "'> " . utf8_encode($opciones_chk[$index4]) . "<br>";
                            }
                            ?>

                            <td>
                                <?php echo $chk; ?>
                            </td>

                            <?php
                        }
                        ?>
                        </tr>

                    <?php } ?>
                    <tr>
                        <td>ADJUNTAR ARCHIVO</td>
                        <td><input type="file" name="archivo" id="archivo" ></td>
                    </tr>




                    <tr>
                        <td colspan="2"><center>

                        <input type="submit" class="btn btn-default" value="Almacenar caso" >
                    </center>
                    </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <script>
        $("#frm_forms").validate({
            rules: {
    <?php echo $validaciones; ?>
            },
            invalidHandler: function () {

                alert('Hay información en el formulario sin diligenciar por favor completarla');
                return false;
            },
            submitHandler: function (form) {
                AlmacenarForm();
            }
        });
    </script>

    <?php
} else {
    include_once 'FormularioCartaPresentacion.php';
    echo "<input type='hidden' name='tipo_proceso' id='tipo_proceso' value='$id_tipo_proceso'>";
}
?>
