<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Noticia
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';

class Noticia {

    public function CrearNoticia($data) {
        date_default_timezone_set('America/Bogota');
        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $arreglo_in = array(":titulo_noticia" => utf8_decode($data['titulo_noticia']),
            ":contenido" => $data['contenido_noticia'],
            ":id_usr_creo" => $arreglo_sesion['id_usuario'],
            ":fecha_creacion" => date('Y-m-d h:i:s'));



        $sql_insert = "INSERT INTO noticia(
            titulo_noticia,contenido,id_usr_creo,fecha_creacion)
            VALUES (:titulo_noticia,:contenido,:id_usr_creo,:fecha_creacion);";

        $result = $link->prepare($sql_insert);
        $ejecucion = $result->execute($arreglo_in);



        if ($ejecucion) {
            return 1;
        } else {
            return 3;
        }
    }

    public function VerNoticia($noticia) {

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();


        $sql = "SELECT no.id_noticia,no.titulo_noticia,no.contenido,no.fecha_creacion,us.nombres,us.apellidos 
            FROM noticia no 
            INNER JOIN usuario us ON us.id_usuario = no.id_usr_creo
            WHERE no.id_noticia = '" . $noticia . "'";

        $resul = $obj_conexion->ResultSet($sql, $link);


        return $resul;
    }

    public function ListNoticias() {
        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_noticia,titulo_noticia,fecha_creacion from noticia";

        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {

            $arreglo_interior = array(utf8_encode($value['titulo_noticia']),
                $value['fecha_creacion'],
                "<input type='button' onclick='EliminarNoticia(" . $value['id_noticia'] . ")' class='btn btn-default' value='Eliminar noticia'>");
            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function EliminarNoticia($data) {

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $arreglo_elimina_noticia = array(":id_noticia" => $data['noticia']);
        $sql_elimina_documento = "DELETE FROM noticia WHERE id_noticia =:id_noticia";



        $resul = $link->prepare($sql_elimina_documento);
        $ejecucion = $resul->execute($arreglo_elimina_noticia);

        if ($ejecucion) {

            return 1;
        } else {
            return 3;
        }
    }

}
