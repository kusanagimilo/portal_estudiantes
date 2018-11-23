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
    $tabla = $obj_caso->InformacionPlana($data);
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
        <div style="margin-left: 282px; margin-top: -31px;"><h4> SOLICITUD DE RETIRO TEMPORAL</h4></div>
        <br>
        <br>
        <div style="margin-left: 700px;"><b><?php echo $tabla[0]['consecutivo']; ?></b></div>
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
                        Programa Acad&eacute;mico:
                    </td>
                    <td>CARRERA INGENIER&Iacute;A INDUSTRIAL</td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        Estudiante :</td>
                    <td>
                        <?php echo utf8_decode($tabla[0]['nombre']); ?>
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
                        Tel&eacute;fono:
                    </td>
                    <td>
                        <?php echo utf8_decode($tabla[0]['telefono']); ?>
                    </td>
                    <td td style="font-weight: bold">
                        &Uacute;ltimo per&iacute;odo cursado :
                    </td>
                    <td>
                        <?php echo $tabla[0]['ultimo_perido_cursado']; ?>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        Direcci&oacute;n Permanente:</td>
                    <td>
                        <?php echo utf8_decode($tabla[0]['direccion']); ?>
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
                        Solicita reserva<br> de programa a <br>partir del periodo:
                    </td>
                    <td>
                        <?php echo $tabla[0]['periodo_retiro']; ?>
                    </td>
                    <td style="font-weight: bold">Del a&ntilde;o</td>
                    <td> <?php echo $tabla[0]['anio_retiro']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        Para reingresar <br>en el per&iacute;odo
                    </td>
                    <td>
                        <?php echo $tabla[0]['periodo_ingreso']; ?>
                    </td>
                    <td style="font-weight: bold">Del a&ntilde;o</td>
                    <td><?php echo $tabla[0]['anio_ingreso']; ?></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="font-weight: bold">Por razones de &iacute;ndole:</td>
                    <td>
                        <?php echo utf8_decode($tabla[0]['motivo']); ?>
                    </td>
                </tr>

            </table>
            <table>
                <tr>
                    <td style="font-weight: bold">Descripcion de la causa:</td>
                    <td>
                        <?php echo utf8_decode($tabla[0]['causa_retiro_adm']); ?>
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
                        <?php echo utf8_decode($tabla[0]['nombre']); ?> (Estudiante)
                    </td>
                </tr>
            </table>
            <br>
            <div style="border: 1px 1px 1px 1px solid #00000; padding: 2px 2px 2px 2px;">
                * Nota: Para determinar la situaci&oacute;n acad&eacute;mica de retiro del estudiante ser&aacute; necesario adjuntar el 
                certificado de notas que incluye el &uacute;ltimo periodo cursado.  
            </div>
        </div>
        <div style="margin-left: 300px;"><h4>Datos de el periodo acad&eacute;mico</h4></div>
        <table>
            <tr>
                <td style="font-weight: bold">
                    Estado acad&eacute;mico:
                </td>
                <td>
                    <?php echo utf8_decode($tabla[0]['estado_academico']); ?>
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold">
                    Promedio acumulado:
                </td>
                <td>
                    <?php echo utf8_decode($tabla[0]['promedio_ponderado_acumulado']); ?>
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
                    <?php echo utf8_decode($tabla[0]['nombre_director_carrera']); ?> (Director carrera)
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
        $html2pdf->Output('SOLICITUD.pdf', 'I');
    } catch (HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
} else {
    header('Location: index.php');
}
?>
