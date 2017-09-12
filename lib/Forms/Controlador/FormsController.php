<?php

include '../Modelo/Forms.php';
$obj_forms = new Forms();
$opcion = $_POST['opcion'];

if ($opcion == 'AlmacenarDatos') {
    $retorno = $obj_forms->AlmacenarFormulario($_POST);
    echo $retorno;
}if ($opcion == 'AlmacenarDatosAdmin') {
    $retorno = $obj_forms->AlmacenarFormularioAdmin($_POST);
    echo $retorno;
}if ($opcion == 'AlmacenaCartaPresentacion') {
    $retorno = $obj_forms->AlmacenaCartaPresentacion($_POST);
    echo $retorno;
}