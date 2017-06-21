<?php
$noticia = $_POST['noticia'];

if ($noticia != null || $noticia != "") {

    include 'lib/config/BD.php';
    @include_once 'lib/Noticia/Modelo/Noticia.php';
    $obj_noticia = new Noticia();
    $arreglo_noticia = $obj_noticia->VerNoticia($noticia);

    //var_dump($arreglo_noticia);
    ?>

    <div class="panel panel-info">
        <div class="panel-heading"> 
            <h3 class="panel-title"><?php echo $arreglo_noticia[0]['titulo_noticia']; ?></h3> 
        </div>
        <div class="panel-body">
            <?php echo $arreglo_noticia[0]['contenido']; ?>
        </div>
        <div class="panel-footer">
            <span class="label label-primary">Publicada por : <?php echo $arreglo_noticia[0]['nombres'] . ' ' . $arreglo_noticia[0]['apellidos']; ?></span> 
            <span class="label label-warning">El <?php echo $arreglo_noticia[0]['fecha_creacion']; ?></span>
        </div>
    </div>
<?php } ?>
