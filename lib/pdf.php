<?php
session_start();
$usuario = $_SESSION['Usuario'];
date_default_timezone_set('America/Bogota');

//$perfil = $usuario['PERFIL'];
if ($usuario['nombre_usuario'] != NULL || $usuario['nombre_usuario'] != '') {
    ob_start();
    include_once 'config/BD.php';
    @include_once 'Caso/Modelo/Caso.php';
    $obj_caso = new Caso();

    $data["id_caso"] = $_REQUEST['caso'];
    $tabla = $obj_caso->TablaInformacionCaso($data);
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
    <page footer="date;heure;page">
        <br>
        <br>
        <br>
        <br>
        <div style="margin-left: 20px;">
            <img  src="../img/logo_uj.png" img style="float: left; width: 248px; height: 83px;" >

        </div>
        
        <br>
        <br>
        <br>
        <br>
        <br>
        <div id="contenido" style="margin-left: 250px; float: left">
            <?php
            echo $tabla;
            ?>
           
        </div>
        <h5 style="width:200px;  text-align:center; background:#fff">Documento generado automaticamente. <?php echo date('Y-m-d h:i:s'); ?></h5>
        
    </page>
    <?php
    $content = ob_get_clean();
//        require_once(dirname(__FILE__) . '/components/html2pdf/html2pdf.class.php');
    require_once ('../html2pdf/html2pdf.class.php');
    try {

        $html2pdf = new HTML2PDF('P', 'b4', 'es', false, 'ISO-8859-15', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('SOLICITUD.pdf','D');
    } catch (HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
    //var_dump($usuario);
} else {
    header('Location: index.php');
}
?>
