<?php

// Creado por Juan Camilo Cruz Franco
//error_reporting(E_ALL);
date_default_timezone_set('Europe/London');

/** Librerias para crear Excel de PHP */
include_once '../../lib/config/BD.php';
require_once 'Classes/PHPExcel.php';



$obj_conexion = new BD();
$link = $obj_conexion->Conectar();


// Creando nuevo objeto de PHP
$objPHPExcel = new PHPExcel();
// Estableciendo las propiedades del archivo
$objPHPExcel->getProperties()->setCreator("Juan Camilo Cruz Franco")
        ->setLastModifiedBy("Juan Camilo Cruz Franco")
        ->setTitle("Office 2010 xlsx documento de prueba")
        ->setSubject("Office 2010 documento de prueba")
        ->setDescription("Documento de prueba para Office 2010.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Categoria -> Reportes");




$sql = "SELECT ca.id_caso,ca.fecha_creacion,us.nombres,us.apellidos,tip.tipo_proceso,esp.estado_proceso,ca.fecha_modificacion 
                FROM caso ca 
                INNER JOIN usuario us ON us.id_usuario = ca.id_usuario_creo 
                INNER JOIN tipo_proceso tip ON tip.id_tipo_proceso = ca.id_tipo_proceso 
                INNER JOIN estado_proceso esp ON esp.id_estado_proceso = ca.id_estado";
$resul = $obj_conexion->ResultSet($sql, $link);
$numero_filas = $obj_conexion->NumeroFilas($sql, $link);


//var_dump($resul);
//die();
//foreach ($resul as $key => $value) {
//    echo $value['id_caso'];
//}
//die();
//------------- Hoja 1s
$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', '')
        ->setCellValue('A4', 'Cantidad de datos:' . $numero_filas);

$objPHPExcel->getActiveSheet()->getComment('A1')->getText()->createTextRun('Documento generado y creado JAVERIANA');
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25); //Altura a la fila 1

$objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);


$objPHPExcel->getActiveSheet()->getStyle('A1:F3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1:F3')->getFill()->getStartColor()->setARGB('e6e6ff'); //357320
$objPHPExcel->getActiveSheet()->mergeCells('A1:F3'); //Unir celdas

$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->getFill()->getStartColor()->setARGB('0000cc'); //357320
$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
// Comentario de la celda
$objPHPExcel->getActiveSheet()->setCellValue('B4', PHPExcel_Shared_Date::PHPToExcel(gmmktime(0, 0, 0, date('m'), date('d'), date('Y'))));
$objPHPExcel->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX15);
$objPHPExcel->getActiveSheet()->getComment('B4')->getText()->createTextRun('Fecha de creación del reporte por el sistema.');

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB('0000cc');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A5', 'No solicitud')
        ->setCellValue('B5', 'Creador solicitud')
        ->setCellValue('C5', 'Tipo solicitud')
        ->setCellValue('D5', 'Estado solicitud')
        ->setCellValue('E5', 'Fecha creacion')
        ->setCellValue('F5', 'Fecha ultima modificacion');

$objPHPExcel->getActiveSheet()->getStyle('A5:F5')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->setAutoFilter('A5:F5');
$i = 6;
//while ($value = $resul){ 


foreach ($resul as $key => $value) {


    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, utf8_encode($value['id_caso']));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $i, utf8_encode($value['nombres'] . " " . $value['apellidos']));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $i, utf8_encode($value['tipo_proceso']));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $i, utf8_encode($value['estado_proceso']));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $i, $value['fecha_creacion']);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $i, $value['fecha_modificacion']);

    if ($i % 2 == 0) {
        $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':F' . $i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':F' . $i)->getFill()->getStartColor()->setARGB('e6e6ff'); //357320
    } else {
        $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':F' . $i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':F' . $i)->getFill()->getStartColor()->setARGB('e6e6ff'); //357320
    }
    $i += 1;
}
$objPHPExcel->getActiveSheet()->setTitle('SOLICITUDES');


$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('../../img/logoFooter.png');

$objDrawing->setHeight(70);
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// Establecer el índice de la hoja activa, Hoja que Excel abre como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);

// Redireccionar salida al navegador
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="caso_realizado.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>
