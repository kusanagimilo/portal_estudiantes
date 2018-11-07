<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Modelo/RazonEstado.php';
$obj_razon_estado = new RazonEstado();
$opcion = $_POST['opcion'];

if ($opcion == 'AlmacenarRazonEstado') {
    $retorno = $obj_razon_estado->AlmacenarRazonEstado($_POST);
    echo $retorno;
}if ($opcion == 'RazonesPorEstado') {
    $retorno = $obj_razon_estado->RazonesPorEstado($_POST);
    echo $retorno;
}if ($opcion == 'ListRazonEstado') {
    $retorno = $obj_razon_estado->ListRazonEstado($_POST);
    echo $retorno;
}if ($opcion == 'EliminarRazon') {
    $retorno = $obj_razon_estado->EliminarRazon($_POST);
    echo $retorno;
}
