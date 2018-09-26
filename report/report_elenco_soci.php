<?php
require_once '../classes/PHPExcel.php';
require_once '../classes/Socio.php';

$socio = Socio::get_all_socio();

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("GenitoriBelli")
         ->setLastModifiedBy("GenitoriBelli")
         ->setTitle("GenitoriBelli Elenco soci")
         ->setSubject("GenitoriBelli Elenco soci")
         ->setDescription("GenitoriBelli Elenco soci, generated using GenitoriBelli.")
         ->setKeywords("GenitoriBelli Elenco soci");

// Add some data

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "ELENCO SOCI AL ".date("d-m-Y"));
$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A2:H3");
$headerStyle = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THICK,
			'color' => array('rgb' => '000000')
		),
	),
	'font' => array(
            'bold'  => true,
	),
        'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
);
$headerDaysStyle = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '000000')
		),
	),
	'font' => array(
            'bold'  => true,
	),
        'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
);

$objPHPExcel->setActiveSheetIndex(0)->getStyle("A2:H3")->applyFromArray($headerStyle);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', "TESSERA")
            ->setCellValue('B5', "COGNOME")
            ->setCellValue('C5', "NOME")
            ->setCellValue('D5', 'CODICE FISCALE')
            ->setCellValue('E5', 'EMAIL')
            ->setCellValue('F5', 'TELEFONO')
            ->setCellValue('G5', 'DATA DI NASCITA')
            ->setCellValue('H5', 'NOTE');

$objPHPExcel->setActiveSheetIndex(0)->getStyle("A5:A5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("B5:B5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("C5:C5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("D5:D5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("E5:E5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("F5:F5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("G5:G5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("H5:H5")->applyFromArray($headerDaysStyle);

$line = 6;

if(isset($socio) && $socio != NULL)
{
    foreach ($socio as $id => $sc) {
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0, $line, $sc->getNumero_tessera());
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1, $line, $sc->getCognome());
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2, $line, $sc->getNome());
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3, $line, $sc->getCodice_fiscale());
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(4, $line, $sc->getEmail());
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(5, $line, $sc->getTel());
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(6, $line, $sc->getData_nascita_ita());
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(7, $line, $sc->getNote());
        $line++;
    }
}

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Elenco soci al '.date("d-m-Y"));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a clientâ€™s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="elenco_soci_'.date("d-m-Y").'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>