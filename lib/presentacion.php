<?php
session_start();
$usuario = $_SESSION['Usuario'];
date_default_timezone_set('America/Bogota');
if ($usuario['nombre_usuario'] != NULL || $usuario['nombre_usuario'] != '') {
    ob_start();
    include_once 'config/BD.php';
    @include_once 'Caso/Modelo/Caso.php';
    $obj_caso = new Caso();

    $data["id_caso"] = $_REQUEST['caso'];
    $tabla = $obj_caso->InformacionPlana($data);
    $fecha_caso = $tabla[1];


    $asignaturas = trim($tabla[0]['nombre_asignatura']);
    $profe = $tabla[0]['nombre_profesor'];
    $hoy = strftime("%d %B") . " de " . date('Y');
    $director = utf8_decode($tabla[0]['nombre_director_carrera']);
    /* var_dump($tabla[0]['nombre_profesor']);
      die(); */
    // InformacionRetiros
//    echo "<pre>";
//    var_dump($tabla);
//    echo "</pre>";
//    die();
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
        tr:nth-of-type(odd) { 
            background: #eee; 
        }
        th { 
            background: #333; 
            color: white; 
            font-weight: bold; 
        }
        td, th { 
            padding: 6px; 
            border: 1px solid #ccc; 
            text-align: left; 
        }
    </style>
    <page backtop="8mm" backbottom="10mm" backleft="15mm" backright="15mm" style="font-size: 12pt">
        <img  src="../img/logo_uj.png" img style="width: 244px; height: 79px;" ><br>
        <br>
        <br>
        <br>
        Bogot&aacute; D.C., <?php echo $hoy; ?>
        <br>
        <br>
        <br>        
        <div style="margin-left: 700px;"><b><?php echo $tabla[0]['consecutivo']; ?></b></div>
        <br>
        <br>
        <?php echo utf8_decode($tabla[0]['tratamiento']); ?><br>
        <?php echo utf8_decode($tabla[0]['nombre_responsable_empresa']); ?><br>
        <?php echo utf8_decode($tabla[0]['cargo_responsable_empresa']); ?><br>
        <?php echo utf8_decode($tabla[0]['nombre_empresa']); ?><br>
        Ciudad<br>
        <br>
        <br>
        <br>
        <?php echo utf8_decode($tabla[0]['saludo']); ?> <?php echo utf8_decode($tabla[0]['nombre_responsable_empresa']); ?>,<br><br> 
        Atentamente nos dirigimos a usted con el fin de solicitar su autorizaci&oacute;n para que los estudiantes del programa de Ingenier&iacute;a 
        Industrial mencionados a continuaci&oacute;n, realicen una visita t&eacute;cnica a las instalaciones de su empresa:
        <br>
        <br>
        <br>
        <table>

            <thead>
                <tr>
                    <th>Nombres y apellidos</th>
                    <th>Doc. identidad</th>
                    <th>T&eacute;lefono</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nombres_alumnos = explode("|", $tabla[0]['nombre']);
                $tipos_documentos_alumnos = explode("|", $tabla[0]['tipo_documento']);
                $numeros_documentos_alumnos = explode("|", $tabla[0]['numero_documento']);
                $telefonos_alumnos = explode("|", $tabla[0]['telefono']);

                for ($index = 0; $index < count($nombres_alumnos); $index++) {
                    $tabla = "<tr>
                            <td>" . $nombres_alumnos[$index] . "</td>
                            <td>" . $tipos_documentos_alumnos[$index] . " " . $numeros_documentos_alumnos[$index] . "</td>
                            <td>" . $telefonos_alumnos[$index] . "</td>
                            
                </tr>";

                    echo $tabla;
                }
                ?>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        Esta visita permitir&aacute; el desarrollo de un trabajo de investigaci&oacute;n para la asignatura(s) <?php echo utf8_decode($asignaturas); ?>, con los
        profesor(es) <?php echo utf8_decode($profe) ?>. Los estudiantes se comprometen a acatar y respetar las normas que ustedes 
        tengan establecidas, teniendo en cuenta que la informaci&oacute;n ser&aacute; utilizada para fines netamente acad&eacute;micos.
        <br>
        <br>
        De antemano, agradezco su atenci&oacute;n y la colaboraci&oacute;n que les puedan brindar.
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
        <b><?php echo $director; ?></b>
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

