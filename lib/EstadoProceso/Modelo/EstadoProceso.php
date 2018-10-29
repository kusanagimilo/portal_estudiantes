<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstadoProceso
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';

class EstadoProceso {

    public function AlmacenarEstadoProceso($data) {
        date_default_timezone_set('America/Bogota');

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

//        $arreglo_sesion['id_usuario'] = 1;
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();



        $sql_revisa_existe = "SELECT id_estado_proceso FROM estado_proceso  WHERE estado_proceso = '" . trim(utf8_decode($data['estado'])) . "'";
        $numero_filas = $obj_conexion->NumeroFilas($sql_revisa_existe, $link);





        if ($numero_filas > 0) {
            return 2;
        } else {
            $arreglo_in = array(":estado_proceso" => utf8_decode($data['estado']),
                ":id_usr_creo" => $arreglo_sesion['id_usuario'],
                ":fecha_creacion" => date('Y-m-d h:i:s'),
                ":estado" => 'AC');


            $sql_insert = "INSERT INTO estado_proceso(
            estado_proceso,id_usr_creo,fecha_creacion,estado)
            VALUES (:estado_proceso,:id_usr_creo,:fecha_creacion,:estado);";

            $result = $link->prepare($sql_insert);
            $ejecucion = $result->execute($arreglo_in);



            if ($ejecucion) {
                return 1;
            } else {
                return 3;
            }
        }
    }

    public function VerEstados() {
        $arreglo_retorno = array();


        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_estado_proceso,estado_proceso,estado FROM estado_proceso WHERE estado != 'EL'";


        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {
            if ($value['estado'] == 'AC') {
                $estado = "Activo";
            } else {
                $estado = "Inactivo";
            }
            $arreglo_interior = array(utf8_encode($value['estado_proceso']),
                $estado,
                "<input type='button'  value='Razones por estado' onclick='DialogRazonEstado(" . $value['id_estado_proceso'] . ")' class='btn btn-primary'>
                <input type='button'  value='Modificar' onclick='DialogModEstado(" . $value['id_estado_proceso'] . ")' class='btn btn-default'>
                 <input type='button' value='Eliminar' onclick='EliminarEstado(" . $value['id_estado_proceso'] . ")' class='btn btn-danger'>");
            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function ListaEstados() {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_estado_proceso,estado_proceso FROM estado_proceso WHERE id_estado_proceso != 0 AND estado = 'AC'";
        $resul = $obj_conexion->ResultSet($sql, $link);

        $i = 0;
        foreach ($resul as $key => $value) {
            $arreglo_retorno[$i]['id_estado_proceso'] = $value['id_estado_proceso'];
            $arreglo_retorno[$i]['estado_proceso'] = utf8_encode($value['estado_proceso']);
            $i++;
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function InformacionModiEstado($data) {
        $arreglo_retorno = array();


        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT * FROM estado_proceso WHERE id_estado_proceso = " . $data['estado'] . "";
        $resul = $obj_conexion->ResultSet($sql, $link);

        $arreglo_retorno['id_estado_proceso'] = $resul[0]['id_estado_proceso'];
        $arreglo_retorno['estado_proceso'] = $resul[0]['estado_proceso'];
        $arreglo_retorno['estado'] = $resul[0]['estado'];

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function ModificarEstadoProceso($data) {
        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        //$arreglo_sesion['id_usuario'] = 1;
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();


        $sql_revisa_existe = "SELECT id_estado_proceso FROM estado_proceso WHERE estado_proceso = '" . trim($data['estado_proceso']) . "'
                              AND id_estado_proceso != " . $data['id_estado_proceso'] . "";

        //RETURN $sql_revisa_existe;

        $numero_filas = $obj_conexion->NumeroFilas($sql_revisa_existe, $link);

        if ($numero_filas > 0) {
            return 2;
        } else {


            $arreglo_update = array(":estado" => $data['estado'],
                ":estado_proceso" => $data['estado_proceso'],
                ":id_estado_proceso" => $data['id_estado_proceso'],
                ":id_usr_modifico" => $arreglo_sesion['id_usuario']);


            $update = "UPDATE estado_proceso
                   SET  estado= :estado,
                   estado_proceso = :estado_proceso,
                   id_usr_modifico=:id_usr_modifico
                   WHERE id_estado_proceso = :id_estado_proceso";

            $resul = $link->prepare($update);
            $resul->execute($arreglo_update);

            if ($resul) {
                return 1;
            } else {
                return 3;
            }
        }
    }

    public function EliminarEstado($data) {
        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        //$arreglo_sesion['id_usuario'] = 1;
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();



        $arreglo_update = array(":estado" => 'EL',
            ":id_estado_proceso" => $data['id_estado_proceso'],
            ":id_usr_modifico" => $arreglo_sesion['id_usuario']);


        $update = "UPDATE estado_proceso
                   SET  estado= :estado,
                   id_usr_modifico=:id_usr_modifico
                   WHERE id_estado_proceso = :id_estado_proceso";

        $resul = $link->prepare($update);
        $resul->execute($arreglo_update);

        if ($resul) {
            return 1;
        } else {
            return 3;
        }
    }

}
