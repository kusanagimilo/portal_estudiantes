<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Campos
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';

class Campos {

    public function ListaCampos() {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_campo,nombre_campo FROM campos";
        $resul = $obj_conexion->ResultSet($sql, $link);

        $i = 0;
        foreach ($resul as $key => $value) {
            $arreglo_retorno[$i]['id_campo'] = $value['id_campo'];
            $arreglo_retorno[$i]['nombre_campo'] = utf8_encode($value['nombre_campo']);
            $i++;
        }




        $json = json_encode($arreglo_retorno);

        return $json;
    }

}
