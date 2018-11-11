<?php
session_start();
$usuario = $_SESSION['Usuario'];
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, "es_ES");
if ($usuario['nombre_usuario'] != NULL || $usuario['nombre_usuario'] != '') {
    ob_start();
    include_once 'config/BD.php';
    @include_once 'Caso/Modelo/Caso.php';
    $obj_caso = new Caso();

    $data["id_caso"] = $_REQUEST['caso'];
    $tabla = $obj_caso->InformacionPlana($data);

    $fecha_caso = $tabla[1];


    $hoy = strftime("%d %B") . " de " . date('Y');


    $motivo = "";
    if ($tabla[0]['motivo_inasistencia'] == 'OTRO') {
        $motivo = $tabla[0]['otro_motivo_excusa'];
    } else {
        $motivo = $tabla[0]['motivo_inasistencia'];
    }
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
        <img  src="../img/logo_uj.png" img style="width: 244px; height: 79px;" ><br>
        <br>
        <br>
        <br>
        Bogot&aacute;, D.C. <?php echo $hoy; ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <b>Profesores</b><br>
        Carrera de Ingenier&iacute;a Industrial<br>
        Pontificia Universidad Javeriana<br>
        Ciudad
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        Estimados profesores:
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        Reciban un cordial saludo. Por medio de esta comunicaci&oacute;n, me permito informar que
        <b><?php echo $tabla[0]['nombre']; ?> (<?php echo $tabla[0]['tipo_documento'] ?> <?php echo $tabla[0]['numero_documento'] ?>)</b>, estudiante del programa de
        Ingenier&iacute;a Industrial, no asistir&aacute; a clases durante los d&iacute;as comprendidos entre
        las fechas <b><?php echo $tabla[0]['fecha_inicio_inasistencia']; ?></b> y <b><?php echo $tabla[0]['fecha_fin_inasistencia']; ?></b>. El motivo de la inasistencia corresponde a
        <b><?php echo $motivo; ?>.</b>
        <br>
        <br>
        En consecuencia, solicito tener en cuenta dicha situaci&oacute;n justificada para el
        control de su asistencia, adem&aacute;s de permitir la presentaci&oacute;n de pruebas acad&aacute;micas
        realizadas durante ese periodo, tales como talleres, quices, laboratorios, entre
        otros.
        <br>
        <br>
        Este documento no tendr&aacute; validez para el caso de parciales. Por lo anterior, el
        estudiante deber&aacute; realizar el tr&aacute;mite estipulado en los numerales 69,70 y 71 del
        Reglamento de Estudiantes, correspondiente a la solicitud de una evaluaci&aacute;n
        supletoria.
        <br>
        <br>
        Agradezco su colaboraci&oacute;n.
        <br>
        <br>
        Cualquier aclaraci&oacute;n al respecto con gusto ser&aacute; atendida.
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        Cordialmente,
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <b>Ing. David Barrera Ferro</b><br>
        Director<br>
        Carrera Ingenier&iacute;a Industrial<br>
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