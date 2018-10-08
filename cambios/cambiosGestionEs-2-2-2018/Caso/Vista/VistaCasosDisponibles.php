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

                <b><?php echo utf8_encode($value['tipo_proceso']); ?></b>
                <br>
                <br>

                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <b><a style="color:blue;" data-toggle="collapse" href="#collapse_<?php echo $value['id_tipo_proceso']; ?>">Click aqui para ver documentos asociados</a></b>
                            </h4>
                        </div>
                        <div id="collapse_<?php echo $value['id_tipo_proceso']; ?>" class="panel-collapse collapse" >
                            <ul >
                                <?php
                                foreach ($arreglo_documentos as $key2 => $value2) {

                                    if ($usuario['rol'] == 'Estudiante') {

                                        if ($value2['nombre'] != 'Formato Acta Retiro Temporal' && $value2['nombre'] != 'Formato Acta Retiro Definitivo' && $value2['nombre'] != 'Formato Excusa' && $value2['nombre'] != 'Formato Supletorio' && $value2['nombre'] != 'Carta Presentación a Empresa') {
                                            ?>
                                            <li><a href="<?php echo $value2['url']; ?>" target="_blank"><?php echo $value2['nombre']; ?></a></li>

                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <li><a href="<?php echo $value2['url']; ?>" target="_blank"><?php echo $value2['nombre']; ?></a></li>

                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>




                <p>
                    <input type="button" name="cre_caso" value="Crear caso" onclick="DialogCrearCaso(<?php echo $value['id_tipo_proceso']; ?>)" class="btn btn-primary"> 

                </p>
                <br>

            </div> 
        </div> 
    </div>





<?php } ?>

<div id="dialog_n_caso"></div>








