<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../Modelo/Reportes.php';
$obj_reportes = new Reportes();
$opcion = $_POST['opcion'];

if ($opcion == 'InfoGraficaTipoProceso') {
    $retorno = $obj_reportes->InfoGraficaTipoProceso();
    echo $retorno;
}

