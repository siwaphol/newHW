<?php

 /* Created by PhpStorm.
 * User: boonchuay
 * Date: 23/6/2558
 * Time: 0:08
 */
 ?>
 @extends('app')

 @section('content')
 <?php
 require_once '../Classes/PHPExcel/IOFactory.php';

            //$course =Request::get('ddlCourse');
            //$sec =Request::get('ddlSection');
            $course = $cours['co'];
            $sec = $cours['sec'];

            $fileupload_name = 'https://www3.reg.cmu.ac.th/regist257/public/stdtotal_xlsx.php?var=maxregist&COURSENO='.$course.'&SECLEC='.$sec.'&SECLAB=000&border=1&mime=xlsx&ctype=&';
                        $fileupload='../temp/file.xlsx';

                        //chmod($fileupload, 0755);
                        	//chmod($fileupload_name, 0755);
                        copy($fileupload_name,$fileupload);

                        //$objPHPExcel = new PHPExcel();
                        $objPHPExcel = PHPExcel_IOFactory::load($fileupload);

                        //$objPHPExcel ->load($fileupload)->get();
                        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                            $worksheetTitle     = $worksheet->getTitle();
                            $highestRow         = $worksheet->getHighestRow(); // e.g. 10
                            $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
                            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                            $nrColumns = ord($highestColumn) - 64;

                            for ($row =8; $row <= $highestRow; ++ $row) {
                                //echo '<tr>';
                                //for ($col = 1; $col < $highestColumnIndex; ++ $col) {
                                $cell = $worksheet->getCellByColumnAndRow(1, $row);
                                $no = $cell->getValue();
                                $cell = $worksheet->getCellByColumnAndRow(2, $row);
                                $code = (string)$cell->getValue();
                                $cell = $worksheet->getCellByColumnAndRow(3, $row);
                                $fname = $cell->getValue();
                                $cell = $worksheet->getCellByColumnAndRow(4, $row);
                                $lname = $cell->getValue();
                                 $status=" ";
                                $cell=$worksheet->getCellByColumnAndRow(5, $row);
                                $status=$cell->getValue();
                                /*if(isset($cell)){
                                $status=" ";

                                }else{
                                $status=$cell->getValue();
                                }
                                */
                                $fullnames=$fname."  ".$lname;
                                //echo $no;
                                if ($no>0 && $no<=200) {
                                    //$stu=DB::select('select *  from users Where id=? and role_id=0001',array($code));

                                    $reg=DB::select(' select * from course_student where course_id=? and section=? and student_id=?',array($course,$sec,$code));
                                    //$rowstudent=count($stu);

                                    $rowregist=count($reg);
                                   if ($rowregist==0 ) {

                                        //  $command =DB::insert('insert into students (id,studentName,status) values (?,?,?)',array($code,$fullnames,$status)) ;

                                          $regis =DB::insert('insert into course_student(student_id,course_id,section,status) values (?,?,?,?)',array($code,$course,$sec,$status));



                                      }
                                      if($rowregist>0){
                                          if($reg[0]->status!=$status){
                                             $update=DB::update('update course_student set status=? where student_id=?',array($status,$code));
                                          }

                                      }
                                    }
                                }

                            }

      ?>
       <h2 align="center"> import successful</h2>
      @endsection