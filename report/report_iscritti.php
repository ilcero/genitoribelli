<?php
require_once '../classes/PHPExcel.php';
require_once '../classes/CorsoElemento.php';
require_once '../classes/Socio.php';
require_once '../classes/Classe.php';
require_once '../classes/CorsoIscrizione.php';
require_once '../classes/Corso.php';

$iscritti = Array();

$socio = Socio::get_all_socio();
$classe = Classe::get_all();
$corsoElm = CorsoElemento::get_by_id($_GET["id_corso_elemento"]);
$corso = Corso::get_by_id($corsoElm->getCorso_id());
$corsoIscrList = CorsoIscrizione::get_by_corso_elemento_id($_GET["id_corso_elemento"]);


if($corso != NULL)
{
    $num = 0;
    foreach($corsoIscrList as $id => $obj)
    {
        $va[0] = $socio[$obj->getSocio_id()]->getCognome();
        $va[1] = $socio[$obj->getSocio_id()]->getNome();
        $va[2] = $classe[$obj->getClasse_id()]->getNome();
        $va[3] = $obj->getData_iscrizione_display();
        $va[4] = $socio[$obj->getSocio_id()]->getTel();
        $va[5] = "NO";
        if($obj->getPagato() == 1)
            $va[5] = "SI";
        
        $iscritti[$num] = $va;
        
        $num++;
    }
}  

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("GenitoriBelli")
         ->setLastModifiedBy("GenitoriBelli")
         ->setTitle("GenitoriBelli Iscritti per corso")
         ->setSubject("GenitoriBelli Iscritti per corso")
         ->setDescription("GenitoriBelli Iscritti per corso, generated using GenitoriBelli.")
         ->setKeywords("GenitoriBelli Iscritti per corso");

// Add some data

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "corso ".$corso->getNome()." - ".$corsoElm->getNome());
$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A2:F3");
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

$objPHPExcel->setActiveSheetIndex(0)->getStyle("A2:F3")->applyFromArray($headerStyle);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', "COGNOME")
            ->setCellValue('B5', "NOME")
            ->setCellValue('C5', 'CLASSE')
            ->setCellValue('D5', 'DATA ISCRIZIONE')
            ->setCellValue('E5', 'TELEFONO')
            ->setCellValue('F5', 'PAGATO');

$objPHPExcel->setActiveSheetIndex(0)->getStyle("A5:A5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("B5:B5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("C5:C5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("D5:D5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("E5:E5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("F5:F5")->applyFromArray($headerDaysStyle);

$line = 6;

if(isset($iscritti) && $iscritti != NULL)
{
    foreach ($iscritti as $gg => $is) {
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0, $line, $is[0]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1, $line, $is[1]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2, $line, $is[2]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3, $line, $is[3]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(4, $line, $is[4]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(5, $line, $is[5]);
        $line++;
    }
}

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Partecipanti ai corsi');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a clientâ€™s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="partecipanti_corsi_'.$corso->getNome().'.xls"');
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