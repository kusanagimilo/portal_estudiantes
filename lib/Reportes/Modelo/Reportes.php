<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportes
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';

class Reportes {

    public function InfoGraficaTipoProceso() {
        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT tip.id_tipo_proceso,tip.tipo_proceso,COUNT(*) AS 'conteo'
                FROM caso ca INNER JOIN tipo_proceso tip ON tip.id_tipo_proceso = ca.id_tipo_proceso 
                GROUP BY tip.id_tipo_proceso";
        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {

            $arreglo_interior = array(utf8_encode($value['tipo_proceso']),
                $value['conteo']);

            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

}
