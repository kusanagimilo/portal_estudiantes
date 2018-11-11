<?php

include '../Modelo/Caso.php';
$obj_caso = new Caso();
$opcion = $_POST['opcion'];

if ($opcion == 'GridCasos') {
    $retorno = $obj_caso->VerCasos();
    echo $retorno;
}
if ($opcion == 'TablaInformacionCaso') {
    $retorno = $obj_caso->TablaInformacionCaso($_POST);
    echo $retorno;
}
if ($opcion == 'VerCasosUsuario') {
    $retorno = $obj_caso->VerCasosUsuario($_POST);
    echo $retorno;
}if ($opcion == 'CambiarEstado') {
    $retorno = $obj_caso->CambiarEstado($_POST);
    echo $retorno;
}
if ($opcion == 'AdjuntarArchivoCaso') {
    $retorno = $obj_caso->AdjuntarArchivoCaso($_POST, $_FILES);
    echo $retorno;
}if ($opcion == 'DocumentosAgregadosCaso') {
    $retorno = $obj_caso->DocumentosAgregadosCaso($_POST);
    echo $retorno;
}if ($opcion == 'TablaInformacionCasoAdmin') {
    $retorno = $obj_caso->TablaInformacionCasoAdmin($_POST);
    echo $retorno;
}
if ($opcion == 'InformacionPlana') {
    $retorno = $obj_caso->InformacionPlana($_POST);
    echo $retorno;
}
if ($opcion == 'EstadoRazon') {
    $retorno = $obj_caso->EstadoRazon($_POST);
    echo $retorno;
}
