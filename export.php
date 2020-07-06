<?php
include'db.php';
include'Classes/PHPExcel.php';
 
$objPHPExcel    =   new PHPExcel();
$link=opendb();
$sql = "SELECT * FROM diak";
$result =  $result = mysqli_query($link, $sql);
 
$objPHPExcel->setActiveSheetIndex(0);
 
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Vezetéknév');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Keresztnév');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'E-mail');
 
$objPHPExcel->getActiveSheet()->getStyle("A1:C1")->getFont()->setBold(true);
 
$rowCount   =   2;
while($row  =   mysqli_fetch_array($result)){
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, mb_strtoupper($row['vezeteknev'],'UTF-8'));
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, mb_strtoupper($row['keresztnev'],'UTF-8'));
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, mb_strtoupper($row['email1'],'UTF-8'));
    $rowCount++;
}
 
 
$objWriter  =   new PHPExcel_Writer_Excel2007($objPHPExcel);
 
 
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="you-file-name.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->save('php://output');
?>