<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Modelo/Campos.php';
$obj_campos = new Campos();
$opcion = $_POST['opcion'];

if ($opcion == 'ListaCampos') {
    $retorno = $obj_campos->ListaCampos();
    echo $retorno;
}
