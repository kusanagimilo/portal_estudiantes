<br>

<?php
session_start();
include_once '../Modelo/Caso.php';
$obj_caso = new Caso();
$usuario = $_SESSION['Usuario'];

$arreglo_caosos = $obj_caso->VerCasosDisponibles();
foreach ($arreglo_caosos as $key => $value) {

    $arreglo_documentos = $obj_caso->TiposProcesoDocus($value['id_tipo_proceso']);
    ?>

    <div class="col-sm-6 col-md-4"> 
        <div class="thumbnail"> 
            <img style="width: 200px; height: 200px;" alt="100%x200" src="lib/Documentos/<?php echo $value['icono'] ?>" data-holder-rendered="true" > 
            <div class="caption">
                <br>
                <center><b><?php echo utf8_encode($value['tipo_proceso']); ?></b></center>
                <br>
                <center>
                    <p>
                        <input type="button" name="ver_doc" value="Ver documentos"  class="btn btn-info" onclick="DialogCasoDocs(<?php echo $value['id_tipo_proceso']; ?>)"> 
                        &nbsp;<input type="button" name="cre_caso" value="Crear caso" onclick="DialogCrearCaso(<?php echo $value['id_tipo_proceso']; ?>)" class="btn btn-primary"> 


                    </p>
                </center>
                <br>
                <div id="diag_documentos_<?php echo $value['id_tipo_proceso']; ?>" style="display: none">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Documento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($arreglo_documentos as $key2 => $value2) {

                                if ($usuario['rol'] == 'Estudiante') {

                                    if ($value2['nombre'] != 'Formato Acta Retiro Temporal' && $value2['nombre'] != 'Formato Acta Retiro Definitivo' && $value2['nombre'] != 'Formato Excusa' && $value2['nombre'] != 'Formato Supletorio' && $value2['nombre'] != 'Carta Presentación a Empresa') {
                                        ?>
                                        <tr><td><a href="<?php echo $value2['url']; ?>" target="_blank"><?php echo $value2['nombre']; ?></a></td></tr>

                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td><a href="<?php echo $value2['url']; ?>" target="_blank"><?php echo $value2['nombre']; ?></a></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        
                    </table>


                </div>
            </div> 
        </div> 
    </div>





<?php } ?>

<div id="dialog_n_caso"></div>








