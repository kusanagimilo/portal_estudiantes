<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RazonEstado
 *
 * @author Turret
 */
date_default_timezone_set('America/Bogota');
include_once '../../config/BD.php';

class RazonEstado {

    public function AlmacenarRazonEstado($data) {

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_revisa_razon_estado = "select id_razon_estado FROM razon_estado WHERE id_estado_proceso = '" . $data['estado_proceso'] . "'
                                    AND razon = '" . trim(utf8_decode($data['razon'])) . "'";


        $numero_filas = $obj_conexion->NumeroFilas($sql_revisa_razon_estado, $link);

        if ($numero_filas > 0) {
            return 2;
        } else {
            $arreglo_in = array(":id_estado_proceso" => $data['estado_proceso'],
                ":razon" => utf8_decode($data['razon']),
                ":id_usuario_creo" => $arreglo_sesion['id_usuario'],
                ":fecha_creacion" => date('Y-m-d h:i:s'),
                ":estado" => 'AC');



            $sql_insert = "INSERT INTO razon_estado(
            id_estado_proceso,razon,id_usuario_creo,fecha_creacion,estado)
            VALUES (:id_estado_proceso,:razon,:id_usuario_creo,:fecha_creacion,:estado);";

            $result = $link->prepare($sql_insert);



            $ejecucion = $result->execute($arreglo_in);

            if ($ejecucion) {
                return 1;
            } else {
                return 3;
            }
        }
    }

    public function RazonesPorEstado($data) {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_razon_estado,id_estado_proceso,razon
                FROM razon_estado
                WHERE id_estado_proceso = " . $data['estado_proceso'] . "
                AND estado = 'AC'";
        

        $resul = $obj_conexion->ResultSet($sql, $link);


        $i = 0;
        foreach ($resul as $key => $value) {
            $arreglo_retorno[$i]['id_razon_estado'] = $value['id_razon_estado'];
            $arreglo_retorno[$i]['id_estado_proceso'] = $value['id_estado_proceso'];
            $arreglo_retorno[$i]['razon'] = utf8_encode($value['razon']);
            $i++;
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

}
