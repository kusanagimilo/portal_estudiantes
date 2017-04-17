<?php
session_start();
$usuario = $_SESSION['Usuario'];
//error_reporting(E_ALL);
date_default_timezone_set('America/Bogota');
/**/
//include '../../lib/config/wb_config.php';
//include '../../lib/config/conexion.php';
if (isset($usuario['tokens_crsf_app']['token_frm_reports'])) {
require '../../lib/config/BD.php';
/* * ******** */
$obj_bd = new BD();
/* * ******** */
ob_start();
$idEmpresa = filter_var(trim($_GET['code']), FILTER_SANITIZE_STRING);
$ttk = trim($_GET['ttk']);
if ($usuario['tokens_crsf_app']['token_frm_reports'] == $ttk) {
$sql_reporte_excel = "SELECT 
                                    t1.IdEmpresaComercializadora,
                                        t1.TipoInsumo,
                                        t1.SemillasSiembra,
                                        t1.MedicamentosVeterinarios,
                                        t1.BiologicosVeterinarios,
                                        t1.SalesMineralizadas,
                                        t1.AlimentosAnimales,
                                        t1.SemenEmbriones,
                                        t1.PlaguicidasPecuario,
                                        t1.PlaguicidasAgricola,
                                        t1.SemillasCultivaresConv,
                                        t1.SemillasCultivaresOVM,
                                        t1.Fertilizantes,
                                        t1.AcondicionadorSuelo,
                                        t1.Bioinsumos,
                                        t1.Coadyudantes,
                                        t1.AnimalesVivos,
                                        t1.NombresContacto,
                                        t1.ApellidosContacto,
                                        t1.DocumentoId,
                                        t1.TelefonoContacto,
                                        t1.TelefonoCelular,
                                        t1.DireccionCorresp,
                                        t1.CorreoContacto,
                                        t1.RazonSocial,
                                        t1.EstablecimientoCom,
                                        t1.DireccionCom,
                                        t1.TelefonoCom,
                                        t1.FaxCom,
                                        t1.CorreoCom,
                                        t1.DireccionBod,
                                        t1.NumeroRegistro,
                                        t1.FechaExpedicion,
                                        t1.LatitudCom,
                                        t1.LongitudCom,
                                        t1.CertificadoExistencia,
                                        t1.CertificadoMatriculaM,
                                        t1.ConceptoFuncionamiento,
                                        t1.CertificadoUsoSuelo,
                                        t1.Factura,
                                        t1.ActaVisita,
                                        t1.Observaciones,
                                        t1.EmpresaFunciona,
                                        t1.ProcesoAdmin,
                                        t1.FechaSistema,
                                        t2.Nombre AS 'idDepartamento',
                                        t3.Nombre AS 'idMunicipio',
                                        t4.NombreUsuario AS idIdentificacion,
                                        t1.NitCom
                                    FROM EmpreComercializadora t1
                                    JOIN departamento t2 ON t1.idDepartamento=t2.idDepartamento
                                    JOIN municipio t3 ON t1.idMunicipio=t3.idMunicipio
                                    JOIN Usuarios t4 ON t1.idIdentificacion=t4.idIdentificacion
                                    WHERE t1.IdEmpresaComercializadora='" . $idEmpresa . "'";
$result = $obj_bd->EjecutaConsulta($sql_reporte_excel);
if (!$result) {
    die("Invalid query: " . mysql_error());
}
?>
<page footer="date;heure;page">
    <bookmark title="Informacion" level="0" ></bookmark>
    <div style="rotate: 90; position: absolute; width: 300mm; height: 4mm; left: 245mm; top: 100px; font-style: italic; font-weight: bold; text-align: center; font-size: 3.9mm;">
        Esta documento es informativo, pero no se constituye como documento oficial del ICA, por lo cual debe acercarse a la seccional m&aacute;s cercana.
    </div>
    <table cellspacing="0" style="width: 90%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 25%;"><img src="../../images/logo-ica.png" alt="Logo" height="81" width="129"></td>
            <td style="width: 60%; color: #444444;"><h1>Informaci&oacute;n de la comercializadora</h1><br></td>
            <td style="width: 5%;"><img src="../../images/logo-insumos.png" alt="Logo" height="110" width="110"></td>
        </tr>
    </table>
    <p style="padding-left: 40px;padding-right: 40px;">
    <table border="1" style="font-size: 16px;" width="100%">

        <?php
        while ($row = mysql_fetch_array($result)) {
            $IdEmpresaComercializadora = $row[0];
            $TipoInsumo = $row[1];
            $SemillasSiembra = $row[2];

            $MedicamentosVeterinarios = $row[3];

            $BiologicosVeterinarios = $row[4];
            if ($BiologicosVeterinarios == '') {
                $BiologicosVeterinarios = 'No';
            }
            $SalesMineralizadas = $row[5];

            $AlimentosAnimales = $row[6];

            $SemenEmbriones = $row[7];

            $PlaguicidasPecuario = $row[8];

            $PlaguicidasAgricola = $row[9];

            $SemillasCultivaresConv = $row[10];

            $SemillasCultivaresOVM = $row[11];

            $Fertilizantes = $row[12];

            $AcondicionadorSuelo = $row[13];

            $Bioinsumos = $row[14];

            $Coadyudantes = $row[15];

            $AnimalesVivos = $row[16];

            $NombresContacto = $row[17];
            $ApellidosContacto = $row[18];
            $DocumentoId = $row[19];
            $TelefonoContacto = utf8_decode($row[20]);
            $TelefonoCelular = utf8_decode($row[21]);
            $DireccionCorresp = utf8_decode($row[22]);
            $CorreoContacto = $row[23];
            $RazonSocial = $row[24];
            $EstablecimientoCom = utf8_decode($row[25]);
            $DireccionCom = utf8_decode($row[26]);
            $TelefonoCom = utf8_decode($row[27]);
            $FaxCom = $row[28];
            $CorreoCom = $row[29];
            $DireccionBod = utf8_decode($row[30]);
//		                                                        $NumeroRegistro = utf8_decode($row[49]);
	    $NumeroRegistro = $row[31];
            $FechaExpedicion = utf8_decode($row[32]);
            $LatitudCom = $row[33];
            $LongitudCom = $row[34];
            $CertificadoExistencia = $row[35];

            $CertificadoMatriculaM = $row[36];

            $ConceptoFuncionamiento = $row[37];

            $CertificadoUsoSuelo = $row[38];

            $Factura = $row[39];

            $ActaVisita = $row[40];

            $Observaciones = $row[41];
            $EmpresaFunciona = utf8_decode($row[42]);
            $ProcesoAdmin = utf8_decode($row[43]);
            $FechaSistema = utf8_decode($row[44]);
            $idDepartamento = $row[45];
            $idMunicipio = $row[46];
            $idIdentificacion = $row[47];
            $Nitcom = $row[48];
            ?>
            <tr> 
                <td><b>N&uacute;mero de registro</b></td>
                <td><?php echo $IdEmpresaComercializadora; ?></td>
            </tr>    
            <tr> 
                <td><b>Tipo de insumos</b></td>
                <td><?php echo $TipoInsumo; ?></td>
            </tr>    
            <tr> 
                <td><b>Semilla</b></td>
                <td><?php echo $SemillasSiembra; ?></td>
            </tr>
            <tr>
                <td><b>Medicamentos Veterinarios</b></td>
                <td><?php echo $MedicamentosVeterinarios; ?></td>
            </tr>

            <tr>
                <td><b>Biol&oacute;gicos Veterinarios</b></td>
                <td><?php echo $BiologicosVeterinarios; ?></td>
            </tr>
            <tr>
                <td><b>Sales Mineralizadas</b></td>
                <td><?php echo $SalesMineralizadas; ?></td>
            </tr>
            <tr>
                <td><b>Alimentos Animales</b></td>
                <td><?php echo $AlimentosAnimales; ?></td>
            </tr>
            <tr>
                <td><b>Semen Embriones</b></td>
                <td><?php echo $SemenEmbriones; ?></td>
            </tr>
            <tr>
                <td><b>Plaguicidas Pecuario</b></td>
                <td><?php echo $PlaguicidasPecuario; ?></td>
            </tr>
            <tr>
                <td><b>Plaguicidas Agricola</b></td>
                <td><?php echo $PlaguicidasAgricola; ?></td>
            </tr>
            <tr>
                <td><b>Semillas Cultivares Conv</b></td>
                <td><?php echo $SemillasCultivaresConv; ?></td>
            </tr>
            <tr>
                <td><b>Semillas Cultivares OVM</b></td>
                <td><?php echo $SemillasCultivaresOVM; ?></td>
            </tr>
            <tr>
                <td><b>Fertilizantes</b></td>
                <td><?php echo $Fertilizantes; ?></td>
            </tr>
            <tr>
                <td><b>Acondicionador Suelo</b></td>
                <td><?php echo $AcondicionadorSuelo; ?></td>
            </tr>
            <tr>
                <td><b>Bioinsumos</b></td>
                <td><?php echo $Bioinsumos; ?></td>
            </tr>
            <tr>
                <td><b>Coadyudantes</b></td>
                <td><?php echo $Coadyudantes; ?></td>
            </tr>
            <tr>
                <td><b>Animales Vivos</b></td>
                <td><?php echo $AnimalesVivos; ?></td>
            </tr>
            <tr>
                <td><b>Nombre</b></td>
                <td><?php echo $NombresContacto; ?></td>
            </tr>
            <tr>
                <td><b>Apellido</b></td>
                <td><?php echo $ApellidosContacto; ?></td>
            </tr>
            <tr>
                <td><b>Identificaci&oacute;n</b></td>
                <td><?php echo $DocumentoId; ?></td>
            </tr>
            <tr>
                <td><b>Tel&eacute;fono</b></td>
                <td><?php echo $TelefonoContacto; ?></td>
            </tr>
            <tr>
                <td><b>Celular</b></td>
                <td><?php echo $TelefonoCelular; ?></td>
            </tr>
            <tr>
                <td><b>Direcci&oacute;n</b></td>
                <td><?php echo $DireccionCorresp; ?></td>
            </tr>
            <tr>
                <td><b>Correo contacto</b></td>
                <td><?php echo $CorreoContacto; ?></td>
            </tr>
            <tr>
                <td><b>Raz&oacute;n social</b></td>
                <td><?php echo $RazonSocial; ?></td>
            </tr>
            <tr>
                <td><b>Establecimiento</b></td>
                <td><?php echo $EstablecimientoCom; ?></td>
            </tr>
            <tr>
                <td><b>Direcci&oacute;n comercializadora</b></td>
                <td><?php echo $DireccionCom; ?></td>
            </tr>
            <tr>
                <td><b>Telefono Comercializadora</b></td>
                <td><?php echo $TelefonoCom; ?></td>
            </tr>
            <tr>
                <td><b>Fax</b></td>
                <td><?php echo $FaxCom; ?></td>
            </tr>
            <tr>
                <td><b>Correo Comercilizadora</b></td>
                <td><?php echo $CorreoCom; ?></td>
            </tr>
            <tr>
                <td><b>Direcci&oacute;n Bodega</b></td>
                <td><?php echo $DireccionBod; ?></td>
            </tr>
            <tr>
                <td><b>NIT</b></td>
                <td><?php echo $Nitcom ?></td>
            </tr>
            <tr>
                <td><b>N&uacute;mero de registro ICA</b></td>
                <td><?php echo $NumeroRegistro; ?></td>
            </tr>
            <tr>
                <td><b>Fecha expedici&oacute;n</b></td>
                <td><?php echo $FechaExpedicion; ?></td>
            </tr>
            <tr>
                <td><b>Latitud</b></td>
                <td><?php echo $LatitudCom; ?></td>
            </tr>
            <tr>
                <td><b>Longitud</b></td>
                <td><?php echo $LongitudCom; ?></td>
            </tr>
            <tr>
                <td><b>Certificado Existencia</b></td>
                <td><?php echo $CertificadoExistencia; ?></td>
            </tr>
            <tr>
                <td><b>Certificado Matr&iacute;cula M</b></td>
                <td><?php echo $CertificadoMatriculaM; ?></td>
            </tr>
            <tr>
                <td><b>Concepto Funcionamiento</b></td>
                <td><?php echo $ConceptoFuncionamiento; ?></td>
            </tr>
            <tr>
                <td><b>Certificado Uso Suelo</b></td>
                <td><?php echo $CertificadoUsoSuelo; ?></td>
            </tr>
            <tr>
                <td><b>Factura</b></td>
                <td><?php echo $Factura; ?></td>
            </tr>
            <tr>
                <td><b>Documentaci&oacute;n registro</b></td>
                <td><?php echo $ActaVisita; ?></td>
            </tr>
            <tr>
                <td><b>Observaciones</b></td>
                <td><?php echo $Observaciones; ?></td>
            </tr>
            <tr>
                <td><b>Funciona empresa</b></td>
                <td><?php echo $EmpresaFunciona; ?></td>
            </tr>
            <tr>
                <td><b>Acta Visita</b></td>
                <td><?php echo $ProcesoAdmin; ?></td>
            </tr>
            <tr>
                <td><b>Fecha del registro</b></td>
                <td><?php echo $FechaSistema; ?></td>
            </tr>
            <tr>
                <td><b>Departamento</b></td>
                <td><?php echo $idDepartamento; ?></td>
            </tr>
            <tr>
                <td><b>Municipio</b></td>
                <td><?php echo $idMunicipio; ?></td>
            </tr>
            <tr>
                <td><b>Usuario</b></td>                                                           
                <td><?php echo $idIdentificacion; ?></td>                                                           
            </tr>
            <?php
        }
        ?>  
    </table>
</p>
</page>
<?php
    $content = ob_get_clean();
    //        require_once(dirname(__FILE__) . '/components/html2pdf/html2pdf.class.php');
    require_once ('html2pdf.class.php');
    try {

        $html2pdf = new HTML2PDF('P', 'b4', 'es', false, 'ISO-8859-15', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('empresa.pdf','D');
    } catch (HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
}else{
    session_destroy();
    header('Location: index.php');
}    
} else {
    session_destroy();
    header('Location: index.php');
}
?>

