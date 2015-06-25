
<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
  die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$result =DB::select('SELECT id,studentname FROM students st
          left join register re on st.id=re.studentid
          where re.courseid=? and re.sectionid=?',array($course['co'],$course['sec']));

$count=count($result);

$row = 1;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'ที่')
                              ->setCellValue('B'.$row, 'รหัสนักศึกษา')
                              ->setCellValue('C'.$row, 'ชื่อ นามสกุล');


$row++;

for($i=0;$i<$count;$i++) {
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $i+1)
                                  ->setCellValue('B'.$row, $result[$i]->id)
                                  ->setCellValue('C'.$row, $result[$i]->studentname);

   $row++;
}
$objPHPExcel->getActiveSheet()->setTitle('รายชื่อนักศึกษากระบวนวิชา');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);


                // Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="studentname.csv"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
                $objWriter->save('php://output');
?>