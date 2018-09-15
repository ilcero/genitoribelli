<?php
require_once '../classes/PHPExcel.php';
require_once '../classes/CorsoElemento.php';
require_once '../classes/Socio.php';
require_once '../classes/Classe.php';
require_once '../classes/CorsoIscrizione.php';

$classe = Classe::get_by_id($_GET["classe_id"]);
$soci = Socio::get_all_socio();
$corsi_elementi = CorsoElemento::get_all_corso_elemento();

$cis = CorsoIscrizione::get_by_classe_period($_GET["classe_id"], $_GET["period"]);
if($cis != NULL)
{
    foreach ($cis as $ci_id => $ci) {
        $ce = $corsi_elementi[$ci->getCorso_id()];
        $ggs = explode("|", $ce->getGiorni_settimana());
        $socio = $soci[$ci->getSocio_id()];
        foreach ($ggs as $key => $gg) {
            $days[$gg][$socio->getId()] = $socio->getCognomeNome();
        }
    }
//    echo'<pre>';
//    print_r($days);
//    echo'</pre>';
}

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("GenitoriBelli")
         ->setLastModifiedBy("GenitoriBelli")
         ->setTitle("GenitoriBelli Partecipanti per classe")
         ->setSubject("GenitoriBelli Partecipanti per classe")
         ->setDescription("GenitoriBelli Partecipanti per classe, generated using GenitoriBelli.")
         ->setKeywords("GenitoriBelli Partecipanti classe");

// Add some data

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "CLASSE ".$classe->getNome());
$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A2:E3");
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

$objPHPExcel->setActiveSheetIndex(0)->getStyle("A2:E3")->applyFromArray($headerStyle);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', "LUNEDI")
            ->setCellValue('B5', "MARTEDI")
            ->setCellValue('C5', 'MERCOLEDI')
            ->setCellValue('D5', 'GIOVEDI')
            ->setCellValue('E5', 'VENERDI');

$objPHPExcel->setActiveSheetIndex(0)->getStyle("A5:A5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("B5:B5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("C5:C5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("D5:D5")->applyFromArray($headerDaysStyle);
$objPHPExcel->setActiveSheetIndex(0)->getStyle("E5:E5")->applyFromArray($headerDaysStyle);

if(isset($days) && $days != NULL)
{
    foreach ($days as $gg => $arr_soci) {
        $line = 6;
        foreach ($arr_soci as $id_socio => $nomecog)
        {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($gg, $line, $nomecog);
            $line++;
        }
    }
}

$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Partecipanti ai corsi');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a clientâ€™s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="partecipanti_corsi_'.$classe->getNome().'.xls"');
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