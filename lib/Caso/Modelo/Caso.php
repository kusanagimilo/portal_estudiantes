<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caso
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';
include_once '../../EnvioNotificacion.php';

class Caso {

    public function VerCasosDisponibles() {

        //session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();



        $sql = "SELECT rtip.id_rol_tipo_proceso,tip.id_tipo_proceso,tip.tipo_proceso,tip.icono,count(tip.id_tipo_proceso) AS 'num_docs',CHARACTER_LENGTH(tip.tipo_proceso) AS 'valor_nombre'
                FROM rol_tipo_proceso rtip
                INNER JOIN tipo_proceso tip ON rtip.id_tipo_proceso = tip.id_tipo_proceso
                INNER JOIN documento_tipo_proceso doct ON doct.id_tipo_proceso = tip.id_tipo_proceso 
                WHERE rtip.id_rol = " . $arreglo_sesion['id_rol'] . "
                AND tip.estado = 'AC'
                GROUP BY rtip.id_rol_tipo_proceso
                ORDER BY valor_nombre";

        $resul = $obj_conexion->ResultSet($sql, $link);

        return $resul;
    }

    public function TiposProcesoDocus($id_tipo_proceso) {


        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql = "select doc.id_documento,doc.nombre,doc.url
from documento_tipo_proceso tipd
inner join documento doc on doc.id_documento = tipd.id_documento 
where tipd.id_tipo_proceso = '" . $id_tipo_proceso . "'";
        $resul = $obj_conexion->ResultSet($sql, $link);

        return $resul;
    }

    public function CrearCaso($data) {

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $obj_notificacion = new EnvioNotificacion();
        $arreglo_caso = array(":id_tipo_proceso" => $data['id_tipo_proceso'],
            ":id_estado" => '1',
            ":id_usuario_creo" => $arreglo_sesion['id_usuario'],
            ":fecha_creacion" => date('Y-m-d h:i:s'),
            ":id_dato" => $data['id_dato']
        );

        $sql_insert_caso = "INSERT INTO caso(id_tipo_proceso,id_estado,id_usuario_creo,fecha_creacion,id_dato)VALUES
                            (:id_tipo_proceso,:id_estado,:id_usuario_creo,:fecha_creacion,:id_dato)";

        $result_caso = $link->prepare($sql_insert_caso);
        $ejecucion_caso = $result_caso->execute($arreglo_caso);

        $id_caso = $link->lastInsertId();

        if ($ejecucion_caso) {


            $arreglo_correos = array();

            array_push($arreglo_correos, $arreglo_sesion['correo']);
            /* carrera.ing.ind@javeriana.edu.co */
            array_push($arreglo_correos, 'jccruz08@misena.edu.co');

            $sql_data_ca = "SELECT cas.id_caso,tp.tipo_proceso,cas.fecha_creacion,us.nombres,us.apellidos
FROM caso cas
INNER JOIN tipo_proceso tp on tp.id_tipo_proceso = cas.id_tipo_proceso
INNER JOIN usuario us on us.id_usuario = cas.id_usuario_creo
WHERE id_caso =  " . $id_caso . "";
            $resul_data_ca = $obj_conexion->ResultSet($sql_data_ca, $link);

            $data_noti = array_unique($resul_data_ca);


            $rta_not = $obj_notificacion->EnviarCorreoCreacionCaso($data_noti, $arreglo_correos);

            //$rta_not = 1;
            if ($rta_not == 1) {
                return $id_caso;
            } else {
                return 'mal';
            }
        } else {
            return 'mal';
        }
    }

    public function VerCasos() {

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT tip.id_tipo_proceso,ca.id_dato,ca.id_caso,ca.fecha_creacion,us.nombres,us.apellidos,tip.tipo_proceso,esp.estado_proceso,ca.fecha_modificacion 
                FROM caso ca 
                INNER JOIN usuario us ON us.id_usuario = ca.id_usuario_creo 
                INNER JOIN tipo_proceso tip ON tip.id_tipo_proceso = ca.id_tipo_proceso 
                INNER JOIN estado_proceso esp ON esp.id_estado_proceso = ca.id_estado";
        $resul = $obj_conexion->ResultSet($sql, $link);

        //return $sql;

        foreach ($resul as $key => $value) {

            $botones = "";
            $estado = '"' . utf8_encode($value['estado_proceso']) . '"';
            $soporte = "";

            if ($value['tipo_proceso'] == 'RETIRO TEMPORAL') {
                $soporte = "<a href='lib/RetiroTemporal.php?caso=" . $value['id_caso'] . "'  class='btn btn-danger'><i class='icon-white icon-book'></i>RETIRO TEMPORAL</a>";
            } else if ($value['tipo_proceso'] == 'EXCUSA PARA PROFESORES') {
                $soporte = "<a target='_blank' href='lib/Excusa.php?caso=" . $value['id_caso'] . "'  class='btn btn-danger'><i class='icon-white icon-book'></i>EXCUSA</a>";
            } else if ($value['tipo_proceso'] == 'RETIRO DEFINITIVO') {
                $soporte = "<a href='lib/RetiroDefinitivo.php?caso=" . $value['id_caso'] . "'  class='btn btn-danger'><i class='icon-white icon-book'></i>RETIRO DEFINITIVO</a>";
            } else if ($value['tipo_proceso'] == 'CARTA DE PRESENTACION A EMPRESA') {
                $soporte = "<a href='lib/presentacion.php?caso=" . $value['id_caso'] . "' target='_blank' class='btn btn-danger'><i class='icon-white icon-book'></i>CARTA P</a>";
            } else {
                $soporte = "<a href='lib/pdf.php?caso=" . $value['id_caso'] . "'  class='btn btn-danger'><i class='icon-white icon-book'></i> PDF</a>";
            }

            $estado_proceso = strtoupper($value['estado_proceso']);
            $existe_finali = strpos($estado_proceso, 'FINALIZA');

            /* var_dump($existe_finali);
              die(); */




            if ($existe_finali !== false) {

                $estado = '"FINALIZA"';

                $botones = "<input type='button' value='Ver informacion caso' onclick='DialogTablaInformacionCaso(" . $value['id_caso'] . ")' class='btn btn-default'><br>
                            <input type='button' value='Ver archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'><br>" . $soporte;
            } else {
                if ($arreglo_sesion['rol'] == 'Estudiante') {
                    $botones = "<input type='button' value='Ver informacion caso' onclick='DialogTablaInformacionCaso(" . $value['id_caso'] . ")' class='btn btn-default'><br>
                            <input type='button' value='Ver archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'><br>
                            <input type='button' value='Cambiar estado' onclick='DialogCambiarEstado(" . $value['id_caso'] . ")' class='btn btn-default'><br>" . $soporte;
                } else {

                    $botones = " <input type='button' value='Completar info admin' onclick='InfoAdmin(" . $value['id_tipo_proceso'] . "," . $value['id_caso'] . "," . $value['id_dato'] . ")' class='btn btn-info'><br>
                            <input type='button' value='Ver informacion caso' onclick='DialogTablaInformacionCaso(" . $value['id_caso'] . ")' class='btn btn-default'><br>
                            <input type='button' value='Ver archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'><br>
                            <input type='button' value='Cambiar estado' onclick='DialogCambiarEstado(" . $value['id_caso'] . ")' class='btn btn-default'><br>" . $soporte;
                    //$botones = "<input type='button' value='Ver y adjuntar archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'><br>
                    //<input type='button' value='Cambiar estado' onclick='DialogCambiarEstado(" . $value['id_caso'] . ")' class='btn btn-default'>";
                }
            }


            $arreglo_interior = array($value['id_caso'],
                utf8_encode($value['tipo_proceso']),
                utf8_encode($value['estado_proceso']),
                utf8_encode($value['nombres']),
                utf8_encode($value['fecha_modificacion']),
                $botones);
            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function TablaInformacionCaso($data) {



        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_informacion = "SELECT cam.id_campo,cam.nombre_campo,cam.campo_identi,cas.id_caso,cas.id_dato,tipp.tipo_proceso,cas.fecha_creacion
FROM caso cas
INNER JOIN tipo_proceso tipp ON cas.id_tipo_proceso = tipp.id_tipo_proceso
INNER JOIN tipo_proceso_campo tipc ON tipc.id_tipo_proceso = tipp.id_tipo_proceso
INNER JOIN campos cam ON cam.id_campo = tipc.id_campo
WHERE cas.id_caso = '" . $data['id_caso'] . "'";




        $resul_info = $obj_conexion->ResultSet($sql_informacion, $link);

        $tipo_proceso_seleccionado = $resul_info[0]['tipo_proceso'];

        $id_dato;
        $sql_ver = "SELECT ";

        foreach ($resul_info as $key => $value) {

            if ($value['campo_identi'] == 'motivo_inasistencia') {
                $sql_ver .= "otro_motivo_excusa,situacion_fuerza_mayor,";
            } else if ($value['campo_identi'] == 'medio_cumplio_requisito') {
                $sql_ver .= "nivel_clasificacion,nivel_cursado_aprobado,";
            }

            $sql_ver .= $value['campo_identi'] . ",";
            $id_dato = $value['id_dato'];
        }
        $sql_ver = substr($sql_ver, 0, -1);
        $sql_ver .= " FROM dato WHERE id_dato = '" . $id_dato . "'";


        $resul_info2 = $obj_conexion->ResultSet($sql_ver, $link);


        if ($tipo_proceso_seleccionado != "CARTA DE PRESENTACION A EMPRESA") {

            $tabla = "<div id='contenido_caso' style='margin-left: 250px; float: left'>
                <table class='table table-bordered table-striped'>
                 <thead>
                    <tr>
                        <th colspan='2'><h5><b>" . $resul_info[0]['tipo_proceso'] . "</b></h5></th>
                    </tr>
                 </thead>
                 <tbody>
                 <tr>
                    <td>IDENTIFICACION CASO</td>
                    <td>" . $data['id_caso'] . "</td>
                 </tr>
                 <tr>
                    <td>FECHA DE CREACION CASO</td>
                    <td>" . $resul_info[0]['fecha_creacion'] . "</td>
                 </tr>";

            foreach ($resul_info as $key => $value) {
                $campo_identi = $value["campo_identi"];

                $tabla .= "<tr>
                        <td>" . utf8_encode($value['nombre_campo']) . "</td>
                        <td>" . utf8_encode($resul_info2[0][$campo_identi]) . "</td>
                    </tr>";



                //$tabla.= $value['nombre_campo']." : ".$resul_info2[0][$campo_identi];
            }

            if (@$resul_info2[0]['otro_motivo_excusa'] != NULL || @$resul_info2[0]['otro_motivo_excusa'] != "") {
                $tabla .= "<tr>
                        <td>OTRO</td>
                        <td>" . $resul_info2[0]['otro_motivo_excusa'] . "</td>
                    </tr>";
            }

            if (@$resul_info2[0]['situacion_fuerza_mayor'] != NULL || @$resul_info2[0]['situacion_fuerza_mayor'] != "") {
                $tabla .= "<tr>
                        <td>SITUACION DE FUERZA MAYOR</td>
                        <td>" . $resul_info2[0]['situacion_fuerza_mayor'] . "</td>
                    </tr>";
            }

            if (@$resul_info2[0]['nivel_clasificacion'] != NULL || @$resul_info2[0]['nivel_clasificacion'] != "") {
                $tabla .= "<tr>
                        <td>NIVEL DE CLASIFICACION</td>
                        <td>" . $resul_info2[0]['nivel_clasificacion'] . "</td>
                    </tr>";
            }

            if (@$resul_info2[0]['nivel_cursado_aprobado'] != NULL || @$resul_info2[0]['nivel_cursado_aprobado'] != "") {
                $tabla .= "<tr>
                        <td>NIVELES CURSADOS Y APROBADOS</td>
                        <td>" . $resul_info2[0]['nivel_cursado_aprobado'] . "</td>
                    </tr>";
            }

            $tabla .= "</tbody></table></div>";
        } else {


            $nombres_alumnos = explode("|", $resul_info2[0]['nombre']);
            $tipos_documentos_alumnos = explode("|", $resul_info2[0]['tipo_documento']);
            $numeros_documentos_alumnos = explode("|", $resul_info2[0]['numero_documento']);
            $ids_javeriana_alumnos = explode("|", $resul_info2[0]['id_javeriana']);
            $telefonos_alumnos = explode("|", $resul_info2[0]['telefono']);
            $correos_alumnos = explode("|", $resul_info2[0]['correo_electronico']);


            $tabla = "<div id='contenido_caso' style='margin-left: 50px; float: left'>
                <table class='table table-bordered table-striped'>
                 <thead>
                    <tr>
                        <th colspan='2'><h5><b>" . $resul_info[0]['tipo_proceso'] . "</b></h5></th>
                    </tr>
                 </thead>
                 <tbody>
                 <tr>
                    <td>IDENTIFICACION CASO</td>
                    <td>" . $data['id_caso'] . "</td>
                 </tr>
                 <tr>
                    <td>FECHA DE CREACION CASO</td>
                    <td>" . $resul_info[0]['fecha_creacion'] . "</td>
                 </tr>
                 <tr>
                    <td>NOMBRE RESPONSABLE EN LA EMPRESA</td>
                    <td>" . $resul_info2[0]['nombre_responsable_empresa'] . "</td>
                 </tr>
                 <tr>
                    <td>CARGO DEL RESPONSABLE EN LA EMPRESA</td>
                    <td>" . $resul_info2[0]['cargo_responsable_empresa'] . "</td>
                 </tr>
                 <tr>
                    <td>NOMBRE EMPRESA</td>
                    <td>" . $resul_info2[0]['nombre_empresa'] . "</td>
                 </tr>
                 <tr>
                    <td>NOMBRE PROFESOR</td>
                    <td>" . $resul_info2[0]['nombre_profesor'] . "</td>
                 </tr>
                 <tr>
                    <td>NOMBRE(S) ASIGNATURA(S)</td>
                    <td>" . $resul_info2[0]['nombre_asignatura'] . "</td>
                 </tr>
                 <tr>
                    <td colspan='2'>
                        
                        <table border='1'>
                        <thead>
                            <tr>
                                <th colspan='6'>ALUMNOS ASOCIADOS</th>
                            </tr>
                            <tr>
                                <th>Alumno</th>
                                <th>Tipo de documento</th>
                                <th>Numero documento</th>
                                <th>Id javeriana</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                            </tr>
                        </thead>
                        <tbody>

                 

                 ";

            for ($index = 0; $index < count($nombres_alumnos); $index++) {
                $tabla .= "<tr>
                            <td>" . $nombres_alumnos[$index] . "</td>
                            <td>" . $tipos_documentos_alumnos[$index] . "</td>
                            <td>" . $numeros_documentos_alumnos[$index] . "</td>
                            <td>" . $ids_javeriana_alumnos[$index] . "</td>
                            <td>" . $telefonos_alumnos[$index] . "</td>
                            <td>" . $correos_alumnos[$index] . "</td>
                         </tr>";
            }


            $tabla .= "
                    </tbody>
                    </table>
                 </td>
                 </tr>
                 </tbody></table></div>";
        }

        return $tabla;
    }

    public function VerCasosUsuario() {

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];



        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT ca.id_caso,ca.fecha_creacion,us.nombres,us.apellidos,tip.tipo_proceso,esp.estado_proceso,ca.fecha_modificacion 
                FROM caso ca 
                INNER JOIN usuario us ON us.id_usuario = ca.id_usuario_creo 
                INNER JOIN tipo_proceso tip ON tip.id_tipo_proceso = ca.id_tipo_proceso 
                INNER JOIN estado_proceso esp ON esp.id_estado_proceso = ca.id_estado
                WHERE ca.id_usuario_creo = " . $arreglo_sesion['id_usuario'] . "";
        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {
            $estado = '"' . utf8_encode($value['estado_proceso']) . '"';

            $botones = "";

            $estado_proceso = strtoupper($value['estado_proceso']);
            $existe_finali = strpos($estado_proceso, 'FINALIZA');

            if ($existe_finali !== false) {

                $estado = '"FINALIZA"';
                $botones = "<input type='button' value='Ver informacion caso' onclick='DialogTablaInformacionCaso(" . $value['id_caso'] . ")' class='btn btn-default'>
                            <input type='button' value='Ver archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'><br>
                            <a href='lib/pdf.php?caso=" . $value['id_caso'] . "'  class='btn btn-danger'><i class='icon-white icon-book'></i> PDF</a>";
            } else {
                $botones = "<input type='button' value='Ver informacion caso' onclick='DialogTablaInformacionCaso(" . $value['id_caso'] . ")' class='btn btn-default'>
                            <input type='button' value='Ver archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'><br>
                            <a href='lib/pdf.php?caso=" . $value['id_caso'] . "' class='btn btn-danger'><i class='icon-white icon-book'></i> PDF</a>";

                //$botones = "<input type='button' value='Ver y adjuntar archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'><br>
                ;
            }


            $arreglo_interior = array($value['id_caso'],
                utf8_encode($value['tipo_proceso']),
                utf8_encode($value['estado_proceso']),
                utf8_encode($value['fecha_modificacion']),
                $botones);
            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function CambiarEstado($data) {
        date_default_timezone_set('America/Bogota');
        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_notificacion = new EnvioNotificacion();

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();



        $arreglo_up = array(":id_estado" => $data['id_estado'],
            ":id_usuario_modifico" => $arreglo_sesion['id_usuario'],
            ":id_caso" => $data['id_caso'],
            ":id_razon_estado" => $data['razon_estado'],
            ":fecha_modificacion" => date('Y-m-d H:i:s'));


        $sql_update = "UPDATE caso SET
                       id_estado = :id_estado,
                       id_usuario_modifico = :id_usuario_modifico,
                       fecha_modificacion=:fecha_modificacion,
                       id_razon_estado=:id_razon_estado
                       WHERE id_caso = :id_caso ";
        $result = $link->prepare($sql_update);
        $ejecucion = $result->execute($arreglo_up);

        if ($ejecucion) {

            $arreglo_correos = array();

            array_push($arreglo_correos, $arreglo_sesion['correo']);
            /* carrera.ing.ind@javeriana.edu.co */
            array_push($arreglo_correos, 'jccruz08@misena.edu.co');

            $sql_data_ca = "SELECT cas.id_caso,esp.estado_proceso,cas.fecha_modificacion,raz.razon
FROM caso cas 
INNER JOIN estado_proceso esp ON cas.id_estado = esp.id_estado_proceso
LEFT JOIN razon_estado raz ON raz.id_razon_estado = cas.id_razon_estado
WHERE cas.id_caso = " . $data['id_caso'] . "";
            $resul_data_ca = $obj_conexion->ResultSet($sql_data_ca, $link);

            $data_noti = array_unique($resul_data_ca);

            $rta_not = $obj_notificacion->EnviarCorreoCambioEstado($data_noti, $arreglo_correos);

            if ($rta_not == 1) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return 2;
        }
    }

    public function AdjuntarArchivoCaso($data, $files_data) {
        date_default_timezone_set('America/Bogota');
        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        if ($files_data['archivo']['error'] == 0) {
            $name = date('Ymdhis') . "_" . utf8_decode($files_data['archivo']['name']);
            $tipo_documento = $files_data['archivo']['type'];
            $tamanio_doc = $files_data['archivo']['size'];
            $move = move_uploaded_file($files_data['archivo']['tmp_name'], '../../Documentos/' . $name);

            if ($move) {

                $arreglo_in = array(":extension" => $tipo_documento,
                    ":nombre" => utf8_decode($files_data['archivo']['name']),
                    ":url" => "lib/Documentos/$name",
                    ":id_usr_creo" => $arreglo_sesion['id_usuario']);


                $sql_insert = "INSERT INTO documento(extension,nombre,url,id_usr_creo)
                                   VALUES (:extension,:nombre,:url,:id_usr_creo)";
                $result = $link->prepare($sql_insert);
                $ejecucion = $result->execute($arreglo_in);

                if ($ejecucion) {
                    $ultimo_id_doc = $link->lastInsertId();

                    $arreglo_doc_caso = array(":id_documento" => $ultimo_id_doc,
                        ":id_caso" => $data['id_caso'],
                        ":id_usuario_creo" => $arreglo_sesion['id_usuario']);

                    $sql_doc_caso = "INSERT INTO documento_caso(id_documento,id_caso,id_usuario_creo)VALUES
                                     (:id_documento,:id_caso,:id_usuario_creo)";

                    $result_doc_caso = $link->prepare($sql_doc_caso);
                    $ejecucion_doc_caso = $result_doc_caso->execute($arreglo_doc_caso);

                    if ($ejecucion_doc_caso) {
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
        } else {
            return 2;
        }
    }

    public function DocumentosAgregadosCaso($data) {
        $arreglo_retorno = array();

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT us.id_usuario,us.nombres,us.apellidos
                FROM documento_caso docc
                INNER JOIN usuario us ON us.id_usuario = docc.id_usuario_creo
                WHERE docc.id_caso = " . $data['id_caso'] . "
                GROUP BY us.id_usuario";

        $resul = $obj_conexion->ResultSet($sql, $link);
        $i = 0;
        foreach ($resul as $key => $value) {
            $arreglo_docs = array();
            $sql_docs_agregados = "SELECT doc.id_documento,doc.nombre,doc.url,doc.fecha_creacion
                                   FROM documento_caso docc
                                   INNER JOIN usuario us ON us.id_usuario = docc.id_usuario_creo
                                   INNER JOIN documento doc ON doc.id_documento = docc.id_documento
                                   WHERE docc.id_caso = " . $data['id_caso'] . "
                                   AND docc.id_usuario_creo = " . $value['id_usuario'] . "";

            $resul_caso = $obj_conexion->ResultSet($sql_docs_agregados, $link);

            $a = 0;
            foreach ($resul_caso as $key2 => $value2) {
                $arreglo_docs[$a]['id_documento'] = $value2['id_documento'];
                $arreglo_docs[$a]['nombre'] = utf8_encode($value2['nombre']);
                $arreglo_docs[$a]['url'] = $value2['url'];
                $arreglo_docs[$a]['fecha_creacion'] = $value2['fecha_creacion'];
                $a++;
            }
            $a = 0;


            $arreglo_retorno[$i]['id_usuario'] = $value['id_usuario'];
            $arreglo_retorno[$i]['usuario_nombres'] = utf8_encode($value['nombres'] . " " . $value['apellidos']);
            $arreglo_retorno[$i]['documentos'] = $arreglo_docs;

            $i++;
            $arreglo_docs = "";
        }

        $json = json_encode($arreglo_retorno);
        return $json;
    }

    public function TablaInformacionCasoAdmin($data) {



        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_informacion = "SELECT cam.id_campo,cam.nombre_campo,cam.campo_identi,cas.id_caso,cas.id_dato,tipp.tipo_proceso,cas.fecha_creacion
FROM caso cas
INNER JOIN tipo_proceso tipp ON cas.id_tipo_proceso = tipp.id_tipo_proceso
INNER JOIN tipo_proceso_campo tipc ON tipc.id_tipo_proceso = tipp.id_tipo_proceso
INNER JOIN campos cam ON cam.id_campo = tipc.id_campo
WHERE cas.id_caso = '" . $data['id_caso'] . "'
AND cam.perm != 'admin'";




        $resul_info = $obj_conexion->ResultSet($sql_informacion, $link);

        $id_dato;
        $sql_ver = "SELECT ";

        foreach ($resul_info as $key => $value) {
            $sql_ver .= $value['campo_identi'] . ",";
            $id_dato = $value['id_dato'];
        }
        $sql_ver = substr($sql_ver, 0, -1);
        $sql_ver .= " FROM dato WHERE id_dato = '" . $id_dato . "'";

        $resul_info2 = $obj_conexion->ResultSet($sql_ver, $link);

        $tabla = "<table class='table table-bordered table-striped'>
                 <thead>
                    <tr>
                        <th colspan='2'><h5><b>" . $resul_info[0]['tipo_proceso'] . "</b></h5></th>
                    </tr>
                 </thead>
                 <tbody>
                 <tr>
                    <td>IDENTIFICACION CASO</td>
                    <td>" . $data['id_caso'] . "</td>
                 </tr>
                 <tr>
                    <td>FECHA DE CREACION CASO</td>
                    <td>" . $resul_info[0]['fecha_creacion'] . "</td>
                 </tr>";

        foreach ($resul_info as $key => $value) {
            $campo_identi = $value["campo_identi"];

            $tabla .= "<tr>
                        <td>" . utf8_encode($value['nombre_campo']) . "</td>
                        <td>" . $resul_info2[0][$campo_identi] . "</td>
                    </tr>";

            //$tabla.= $value['nombre_campo']." : ".$resul_info2[0][$campo_identi];
        }

        $tabla .= "</tbody></table>";

        return $tabla;
    }

    public function InformacionPlana($data) {

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_informacion = "SELECT cam.id_campo,cam.nombre_campo,cam.campo_identi,cas.id_caso,cas.id_dato,tipp.tipo_proceso,cas.fecha_creacion
FROM caso cas
INNER JOIN tipo_proceso tipp ON cas.id_tipo_proceso = tipp.id_tipo_proceso
INNER JOIN tipo_proceso_campo tipc ON tipc.id_tipo_proceso = tipp.id_tipo_proceso
INNER JOIN campos cam ON cam.id_campo = tipc.id_campo
WHERE cas.id_caso = '" . $data['id_caso'] . "'";



        $resul_info = $obj_conexion->ResultSet($sql_informacion, $link);

        $tipo_proceso_seleccionado = $resul_info[0]['tipo_proceso'];
        $fecha_caso = $resul_info[0]['fecha_creacion'];

        $id_dato;
        $sql_ver = "SELECT ";

        foreach ($resul_info as $key => $value) {

            if ($value['campo_identi'] == 'motivo_inasistencia') {
                $sql_ver .= "otro_motivo_excusa,situacion_fuerza_mayor,";
            } else if ($value['campo_identi'] == 'medio_cumplio_requisito') {
                $sql_ver .= "nivel_clasificacion,nivel_cursado_aprobado,";
            }

            $sql_ver .= $value['campo_identi'] . ",";
            $id_dato = $value['id_dato'];
        }
        $sql_ver = substr($sql_ver, 0, -1);
        $sql_ver .= " FROM dato WHERE id_dato = '" . $id_dato . "'";


        $resul_info2 = $obj_conexion->ResultSet($sql_ver, $link);
        array_push($resul_info2, $fecha_caso);

        return $resul_info2;
    }

    public function EstadoRazon($data) {
        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_estado,id_razon_estado FROM caso WHERE id_caso = " . $data['caso'] . " ";
        $resul = $obj_conexion->ResultSet($sql, $link);

        $arreglo_retorno['id_estado'] = $resul[0]['id_estado'];
        $arreglo_retorno['id_razon'] = $resul[0]['id_razon_estado'];

        $json = json_encode($arreglo_retorno);

        return $json;
    }

}
