<br>

<?php
include_once '../Modelo/Caso.php';
$obj_caso = new Caso();

$arreglo_caosos = $obj_caso->VerCasosDisponibles();
foreach ($arreglo_caosos as $key => $value) {

    $arreglo_documentos = $obj_caso->TiposProcesoDocus($value['id_tipo_proceso']);
    ?>

    <div class="col-sm-6 col-md-4"> 
        <div class="thumbnail"> 
            <img style="width: 200px; height: 200px;" alt="100%x200" src="lib/Documentos/<?php echo $value['icono'] ?>" data-holder-rendered="true" > 
            <div class="caption"> <h3><?php echo utf8_encode($value['tipo_proceso']); ?></h3> 

                <ul >
                    <?php foreach ($arreglo_documentos as $key2 => $value2) {
                        ?>
                        <li><a href="<?php echo $value2['url']; ?>" target="_blank"><?php echo $value2['nombre']; ?></a></li>

                    <?php }
                    ?>
                </ul>


                <p>
                    <input type="button" name="cre_caso" value="Crear caso" onclick="DialogCrearCaso(<?php echo $value['id_tipo_proceso']; ?>)" class="btn btn-primary"> 

                </p> 
            </div> 
        </div> 
    </div>





<?php } ?>

<div id="dialog_n_caso"></div>








