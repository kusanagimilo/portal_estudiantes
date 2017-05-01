<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoProceso
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';

class TipoProceso {

    public function AlmacenarTipoProceso($data, $files_data) {
        //return var_dump($files_data['icono']);

        date_default_timezone_set('America/Bogota');

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        //$arreglo_sesion['id_usuario'] = 1;
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $arreglo_docs = array();

        $arreglo_campos = explode(',', $data['campos']);


        if (count($files_data) > 1) {


            for ($index = 0; $index < count($files_data['archivos']['name']); $index++) {

                if ($files_data['archivos']['error'][$index] == 0) {


                    $name = $files_data['archivos']['name'][$index];
                    $tipo_documento = $files_data['archivos']['type'][$index];

                    $tamanio_doc = $files_data['archivos']['size'][$index];
                    $move = move_uploaded_file($files_data['archivos']['tmp_name'][$index], '../../Documentos/' . $name);

                    if ($move) {

                        $arreglo_in = array(":extension" => $tipo_documento,
                            ":nombre" => $data['nombres_ar'][$index],
                            ":url" => "lib/Documentos/$name",
                            ":id_usr_creo" => $arreglo_sesion['id_usuario']);


                        $sql_insert = "INSERT INTO documento(extension,nombre,url,id_usr_creo)
                                   VALUES (:extension,:nombre,:url,:id_usr_creo)";
                        $result = $link->prepare($sql_insert);
                        $ejecucion = $result->execute($arreglo_in);


                        if ($ejecucion) {
                            $ultimo_id_doc = $link->lastInsertId();
                            $arreglo_docs[$index] = $ultimo_id_doc;
                        } else {
                            return 2;
                        }
                    } else {
                        return 2;
                    }
                } else {
                    return 2;
                }
            }
        }
        // return var_dump(count($files_data));


        /* almacena tipo de proceso */

        if ($files_data['icono']['error'] == UPLOAD_ERR_OK) {
            $name_ico = "ico_" . $files_data['icono']['name'];
            $move_ico = move_uploaded_file($files_data['icono']['tmp_name'], '../../Documentos/' . $name_ico);
            if ($move_ico) {

                $arreglo_tipo_proceso = array(":tipo_proceso" => $data['tipo_proceso'],
                    ":icono" => $name_ico,
                    ":id_usr_creo" => $arreglo_sesion['id_usuario'],
                    ":fecha_creacion" => date('Y-m-d h:i:s'),
                    ":estado" => 'AC');

                $sql_tipo_proceso = "INSERT INTO tipo_proceso(tipo_proceso,icono,id_usr_creo,fecha_creacion,estado)
                                   VALUES (:tipo_proceso,:icono,:id_usr_creo,:fecha_creacion,:estado)";
                $result_tipo_proceso = $link->prepare($sql_tipo_proceso);
                $ejecucion_tipo_proceso = $result_tipo_proceso->execute($arreglo_tipo_proceso);

                if ($ejecucion_tipo_proceso) {

                    $ultimo_id_tipo_proceso = $link->lastInsertId();

                    for ($index1 = 0; $index1 < count($arreglo_docs); $index1++) {

                        $arreglo_tipo_proceso_doc = array(":id_tipo_proceso" => $ultimo_id_tipo_proceso,
                            ":id_documento" => $arreglo_docs[$index1],
                            ":id_usr_creo" => $arreglo_sesion['id_usuario']);

                        $sql_tipo_proceso_doc = "INSERT INTO documento_tipo_proceso(id_tipo_proceso,id_documento,id_usr_creo)
                                   VALUES (:id_tipo_proceso,:id_documento,:id_usr_creo)";
                        $result_tipo_proceso_doc = $link->prepare($sql_tipo_proceso_doc);
                        $ejecucion_tipo_proceso_doc = $result_tipo_proceso_doc->execute($arreglo_tipo_proceso_doc);

                        if (!$ejecucion_tipo_proceso_doc) {
                            return 2;
                        }
                    }

                    for ($index2 = 0; $index2 < count($arreglo_campos); $index2++) {
                        $arreglo_tipo_proceso_campo = array(":id_tipo_proceso" => $ultimo_id_tipo_proceso,
                            ":id_campo" => $arreglo_campos[$index2],
                            ":id_usr_creo" => $arreglo_sesion['id_usuario']);

                        $sql_tipo_proceso_campo = "INSERT INTO tipo_proceso_campo(id_tipo_proceso,id_campo,id_usr_creo)
                                           VALUES(:id_tipo_proceso,:id_campo,:id_usr_creo)";
                        $resul_tipo_proceso_campo = $link->prepare($sql_tipo_proceso_campo);
                        $ejecucion_tipo_proceso_campo = $resul_tipo_proceso_campo->execute($arreglo_tipo_proceso_campo);
                        if (!$ejecucion_tipo_proceso_campo) {
                            return 2;
                        }
                    }


                    return 1;
                } else {
                    return 2;
                }
            } else {
                return 2;
            }
        } else {
            return 2;
        }
    }

    public function VerTipoProceso() {
        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_tipo_proceso,tipo_proceso FROM tipo_proceso WHERE estado = 'AC'";
        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {

            $arreglo_interior = array(utf8_encode($value['tipo_proceso']),
                "<input type='button' value='Editar' class='btn btn-default' onclick='DialogEditarTipoProceso(" . $value['id_tipo_proceso'] . ")'>",
                "<input type='button' value='Eliminar' class='btn btn-danger' onclick='elimina_tipop(" . $value['id_tipo_proceso'] . ")'>");

            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function ListaTipoProceso() {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_tipo_proceso,tipo_proceso FROM tipo_proceso WHERE estado = 'AC'";
        $resul = $obj_conexion->ResultSet($sql, $link);

        $i = 0;
        foreach ($resul as $key => $value) {
            $arreglo_retorno[$i]['id_tipo_proceso'] = $value['id_tipo_proceso'];
            $arreglo_retorno[$i]['tipo_proceso'] = utf8_encode($value['tipo_proceso']);
            $i++;
        }




        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function EliminaTipoProceso($data) {
        session_start();
        $arreglo_usuario = $_SESSION['Usuario'];

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();


        $arreglo_up = array(":id_usr_modifico" => $arreglo_usuario['id_usuario'],
            ":id_tipo_proceso" => $data['tipo_proceso'],
            ":estado" => 'EL');

        $sql = "UPDATE tipo_proceso SET estado=:estado,id_usr_modifico=:id_usr_modifico
                WHERE id_tipo_proceso=:id_tipo_proceso";
        $result = $link->prepare($sql);
        $ejecucion = $result->execute($arreglo_up);
        if ($ejecucion) {
            return 1;
        } else {
            return 3;
        }
    }

    public function MostrarInfoEditTipoProceso($data) {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_tipo_proceso = "SELECT id_tipo_proceso,icono,tipo_proceso
                             FROM tipo_proceso
                             WHERE id_tipo_proceso = '" . $data['tipo_proceso'] . "'";

        $resul = $obj_conexion->ResultSet($sql_tipo_proceso, $link);


        $arreglo_retorno['id_tipo_proceso'] = $resul[0]['id_tipo_proceso'];
        $arreglo_retorno['icono'] = $resul[0]['icono'];
        $arreglo_retorno['tipo_proceso'] = $resul[0]['tipo_proceso'];


        $arreglo_docs = array();

        $sql_documentos = "SELECT doc.id_documento,doc.nombre,doc.url,docp.id_documento_tipo_proceso
                           FROM documento_tipo_proceso docp
                           INNER JOIN documento doc ON doc.id_documento = docp.id_documento
                           WHERE docp.id_tipo_proceso = '" . $data['tipo_proceso'] . "'";

        $resul_documentos = $obj_conexion->ResultSet($sql_documentos, $link);

        $i = 0;

        foreach ($resul_documentos as $key => $value) {

            $arreglo_docs[$i]['id_documento'] = $value['id_documento'];
            $arreglo_docs[$i]['nombre'] = $value['nombre'];
            $arreglo_docs[$i]['url'] = $value['url'];
            $arreglo_docs[$i]['id_documento_tipo_proceso'] = $value['id_documento_tipo_proceso'];

            $i++;
        }

        $arreglo_retorno['documentos'] = $arreglo_docs;
        $json = json_encode($arreglo_retorno);
        return $json;
    }

    public function EliminarDocumentoTp($data) {
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $arreglo_elimina_documento = array(":id_documento" => $data['id_documento']);
        $arreglo_elimina_documento_proceso = array(":id_documento_tipo_proceso" => $data['id_documento_tipo_proceso']);


        $sql_elimina_documento = "DELETE FROM documento WHERE id_documento =:id_documento";
        $sql_elimina_documento_proceso = "DELETE FROM documento_tipo_proceso WHERE id_documento_tipo_proceso=:id_documento_tipo_proceso";


        $resul1 = $link->prepare($sql_elimina_documento);
        $ejecucion1 = $resul1->execute($arreglo_elimina_documento);

        if ($ejecucion1) {

            $resul2 = $link->prepare($sql_elimina_documento_proceso);
            $ejecucion2 = $resul2->execute($arreglo_elimina_documento_proceso);

            if ($ejecucion2) {
                return "bien";
            } else {
                return "mal";
            }
        } else {
            return "mal";
        }
    }

    public function AnadirDocumentoTp($data, $files_data) {



        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        if ($files_data['documento']['error'] == UPLOAD_ERR_OK) {

            $sql_id_doc_mas = "SELECT MAX(id_documento)+1 AS 'id_mas_uno' FROM documento";
            $resul = $obj_conexion->ResultSet($sql_id_doc_mas, $link);

            $complemento_doc = $resul[0]['id_mas_uno'];


            $name_doc = $complemento_doc . "_" . $files_data['documento']['name'];
            $tipo_documento = $files_data['documento']['type'];
            $move_doc = move_uploaded_file($files_data['documento']['tmp_name'], '../../Documentos/' . $name_doc);


            if ($move_doc) {


                $arreglo_in = array(":extension" => $tipo_documento,
                    ":nombre" => $name_doc,
                    ":url" => "lib/Documentos/$name_doc",
                    ":id_usr_creo" => $arreglo_sesion['id_usuario']);


                $sql_insert = "INSERT INTO documento(extension,nombre,url,id_usr_creo)
                                   VALUES (:extension,:nombre,:url,:id_usr_creo)";
                $result = $link->prepare($sql_insert);
                $ejecucion = $result->execute($arreglo_in);

                if ($ejecucion) {

                    $ultimo_id_doc = $link->lastInsertId();
                    $arreglo_tipo_proceso_doc = array(":id_tipo_proceso" => $data['id_tipo_proceso'],
                        ":id_documento" => $ultimo_id_doc,
                        ":id_usr_creo" => $arreglo_sesion['id_usuario']);

                    $sql_tipo_proceso_doc = "INSERT INTO documento_tipo_proceso(id_tipo_proceso,id_documento,id_usr_creo)
                                   VALUES (:id_tipo_proceso,:id_documento,:id_usr_creo)";
                    $result_tipo_proceso_doc = $link->prepare($sql_tipo_proceso_doc);
                    $ejecucion_tipo_proceso_doc = $result_tipo_proceso_doc->execute($arreglo_tipo_proceso_doc);

                    if (!$ejecucion_tipo_proceso_doc) {
                        return 2;
                    } else {
                        return 1;
                    }


                    return 1;
                } else {
                    return 2;
                }
            } else {
                return 2;
            }
        } else {
            return 2;
        }
    }

    public function ModificarTp($data, $files_data) {


        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        if ($files_data['icono']['error'] == UPLOAD_ERR_OK) {
            $name_ico = "ico_" . $files_data['icono']['name'];
            $move_ico = move_uploaded_file($files_data['icono']['tmp_name'], '../../Documentos/' . $name_ico);
            if ($move_ico) {

                $arreglo_tipo_proceso = array(":tipo_proceso" => $data['tipo_proceso'],
                    ":icono" => $name_ico,
                    ":id_usr_modifico" => $arreglo_sesion['id_usuario'],
                    ":fecha_modificacion" => date('Y-m-d h:i:s'),
                    ":estado" => 'AC',
                    ":id_tipo_proceso" => $data['id_tipo_proceso']);

                // return var_dump($arreglo_tipo_proceso);

                $sql_tipo_proceso = "UPDATE tipo_proceso SET
                                     tipo_proceso=:tipo_proceso,
                                     icono=:icono,
                                     id_usr_modifico=:id_usr_modifico,
                                     fecha_modificacion=:fecha_modificacion,
                                     estado=:estado
                                     WHERE id_tipo_proceso=:id_tipo_proceso";

                $result_tipo_proceso = $link->prepare($sql_tipo_proceso);
                $ejecucion_tipo_proceso = $result_tipo_proceso->execute($arreglo_tipo_proceso);

                if ($ejecucion_tipo_proceso) {
                    return 1;
                } else {
                    return 2;
                }
            } else {
                return 2;
            }
        } else {
            return 2;
        }
    }

}
