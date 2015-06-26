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
            set_time_limit(0);
            $sql=DB::select('select *  from course_section');
            $count=count($sql);
            for($i=0;$i<$count;$i++){
            //$course =Request::get('ddlCourse');
            //$sec =Request::get('ddlSection');
            $course = $sql[$i]->courseId;
            $sec = $sql[$i]->sectionId;

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
                                    $stu=DB::select('select *  from students Where id=?',array($code));

                                    $reg=DB::select(' select * from register where courseId=? and sectionId=? and studentId=?',array($course,$sec,$code));
                                    $rowstudent=count($stu);
                                    $rowregist=count($reg);
                                    if ($rowstudent==0 and $rowregist==0 ) {

                                        $command =DB::insert('insert into students (id,studentName,status) values (?,?,?)',array($code,$fullnames,$status)) ;

                                        $regis =DB::insert('insert into register (studentId,courseId,sectionId) values (?,?,?)',array($code,$course,$sec));



                                    }elseif ($rowstudent>=1 && $rowregist==0) {
                                        $regis =DB::insert('insert into register (studentId,courseId,sectionId) values (?,?,?)',array($code,$course,$sec));



                                    }
                                }

                            }
                        }
                        }

      ?>
      <h2 align="center"> import successful</h2>
      @endsection