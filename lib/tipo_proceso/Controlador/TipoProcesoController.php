<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../Modelo/TipoProceso.php';
$obj_tipo_proceso = new TipoProceso();
$opcion = $_POST['opcion'];

if ($opcion == 'CrearTipoProceso') {
    $retorno = $obj_tipo_proceso->AlmacenarTipoProceso($_POST, $_FILES);
    echo $retorno;
}if ($opcion == 'GridTipoProceso') {
    $retorno = $obj_tipo_proceso->VerTipoProceso();
    echo $retorno;
}if ($opcion == 'ListaTipoProceso') {
    $retorno = $obj_tipo_proceso->ListaTipoProceso();
    echo $retorno;
}if ($opcion == 'EliminaTipoProceso') {
    $retorno = $obj_tipo_proceso->EliminaTipoProceso($_POST);
    echo $retorno;
}if ($opcion == 'MostrarInfoEditTipoProceso') {
    $retorno = $obj_tipo_proceso->MostrarInfoEditTipoProceso($_POST);
    echo $retorno;
}if ($opcion == 'EliminarDocumentoTp') {
    $retorno = $obj_tipo_proceso->EliminarDocumentoTp($_POST);
    echo $retorno;
}if ($opcion == 'AnadirDocumentoTp') {
    $retorno = $obj_tipo_proceso->AnadirDocumentoTp($_POST, $_FILES);
    echo $retorno;
}if ($opcion == 'ModificarTp') {
    $retorno = $obj_tipo_proceso->ModificarTp($_POST, $_FILES);
    echo $retorno;
}
