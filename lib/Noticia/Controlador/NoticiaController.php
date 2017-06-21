<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../Modelo/Noticia.php';
$obj_noticia = new Noticia();
$opcion = $_POST['opcion'];

if ($opcion == 'NuevaNoticia') {


    $retorno = $obj_noticia->CrearNoticia($_POST);


    if ($retorno == 1) {
        echo "<script>" .
        "alert('Ingreso correctamente la noticia');" .
        "window.location.assign('../../../aplicacion.php')" .
        "</script>";
    } else if ($retorno == 3) {
        echo "<script>" .
        "alert('Ocurrio un error al ingresar la noticia');" .
        "window.location.assign('../../../aplicacion.php')" .
        "</script>";
    }
} else if ($opcion == 'VerNoticia') {
    $retorno = $obj_noticia->VerNoticia($_POST);
    return $retorno;
} else if ($opcion == 'GridNoticias') {
    $retorno = $obj_noticia->ListNoticias();
    echo $retorno;
} else if ($opcion == 'EliminarNoticia') {
    $retorno = $obj_noticia->EliminarNoticia($_POST);
    echo $retorno;
}




