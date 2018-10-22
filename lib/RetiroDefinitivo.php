<?php
session_start();
$usuario = $_SESSION['Usuario'];
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set('America/Bogota');
if ($usuario['nombre_usuario'] != NULL || $usuario['nombre_usuario'] != '') {
    ob_start();
    include_once 'config/BD.php';
    @include_once 'Caso/Modelo/Caso.php';
    $obj_caso = new Caso();

    $data["id_caso"] = $_REQUEST['caso'];
    $tabla = $obj_caso->InformacionRetiros($data);
    $fecha_caso = $tabla[1];
    // InformacionRetiros
    ?>
    <style>
        /* 
      Generic Styling, for Desktops/Laptops 
        */
        table { 
            width: 100%; 
            border-collapse: collapse;
        }
        /* Zebra striping */
        th { 
            background: #333; 
            color: white; 
            font-weight: bold; 
        }
        td, th { 
            padding: 6px; 
            border: 1px solid #ccc; 
            text-align: left;
            border-color: transparent;
            padding-top:12px;
        }
    </style>
    <page backtop="8mm" backbottom="10mm" backleft="15mm" backright="15mm" style="font-size: 12pt">

        <img  src="../img/logo_uj.png" img style="margin-left: 290px; width: 248px; height: 83px;" ><br>
        <div style="margin-left: 270px;"><h4>PONTIFICIA UNIVERSIDAD JAVERIANA</h4></div>
        <div style="margin-left: 310px; margin-top: -31px;"><h4>FACULTAD DE INGENIERIA</h4></div>
        <div style="margin-left: 282px; margin-top: -31px;"><h4> SOLICITUD DE RETIRO DEFINITIVO</h4></div>

        <div style="margin-top: 30px; font-size: 14px;">
            <table>
                <tr>
                    <td style="font-weight: bold">
                        Fecha de solicitud:
                    </td>
                    <td>
                        <?php echo $fecha_caso; ?>
                    </td>
                    <td td style="font-weight: bold">
                        Programa academico:
                    </td>
                    <td>CARRERA INGENIERIA INDUSTRIAL</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        Estudiante :</td>
                    <td>
                        <?php echo $tabla[0]['nombre']; ?>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>

                </tr>
                <tr>
                    <td style="font-weight: bold">
                        Documento:</td>
                    <td>
                        <?php echo $tabla[0]['numero_documento'] . "-" . $tabla[0]['tipo_documento']; ?>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        Telefono:
                    </td>
                    <td>
                        <?php echo $tabla[0]['telefono']; ?>
                    </td>
                    <td td style="font-weight: bold">
                        Ultimo periodo cursado :
                    </td>
                    <td>
                        <?php echo $tabla[0]['ultimo_perido_cursado']; ?>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        Direccion permanente:</td>
                    <td>
                        <?php echo $tabla[0]['direccion']; ?>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        E-mail:</td>
                    <td>
                        <?php echo $tabla[0]['correo_electronico']; ?>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        Periodo de retiro:
                    </td>
                    <td>
                        <?php echo $tabla[0]['periodo_retiro']; ?>
                    </td>
                    <td style="font-weight: bold">Año de retiro:</td>
                    <td> <?php echo $tabla[0]['anio_retiro']; ?></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="font-weight: bold">Por razones de indole:</td>
                    <td>
                        <?php echo $tabla[0]['motivo']; ?>
                    </td>
                </tr>

            </table>
            <table>
                <tr>
                    <td style="font-weight: bold">Descripcion de la causa:</td>
                    <td>
                        <?php echo $tabla[0]['descripcion_motivo']; ?>
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <table>
                <tr>
                    <td style="font-weight: bold">
                        ______________________________________
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        <?php echo $tabla[0]['nombre']; ?> (Estudiante)
                    </td>
                </tr>
            </table>
            <br>
            <div style="border: 1px 1px 1px 1px solid #00000; padding: 2px 2px 2px 2px;">
                * Nota: Para determinar la situacion academica de retiro del estudiante 
                sera necesario adjuntar el certificado de notas que incluye el ultimo periodo cursado.
            </div>
        </div>
        <div style="margin-left: 300px;"><h4>Datos de el periodo academico</h4></div>
        <table>
            <tr>
                <td style="font-weight: bold">
                    Estado academico:
                </td>
                <td>
                    <?php echo $tabla[0]['estado_academico']; ?>
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold">
                    Promedio acumulado:
                </td>
                <td>
                    <?php echo $tabla[0]['promedio_ponderado_acumulado']; ?>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <table>
            <tr>
                <td style="font-weight: bold">
                    ______________________________________
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold">
                    <?php echo $tabla[0]['nombre_director_carrera']; ?> (Director carrera)
                </td>
            </tr>
        </table>

    </page>
    <?php
    $content = ob_get_clean();
    require_once ('../html2pdf/html2pdf.class.php');
    try {

        $html2pdf = new HTML2PDF('P', 'b4', 'es', false, 'ISO-8859-15', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('SOLICITUD.pdf', 'D');
    } catch (HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
} else {
    header('Location: index.php');
}
?>
