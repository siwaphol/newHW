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
            libxml_use_internal_errors(false);
            set_time_limit(0);

            $semester=Session::get('semester');
           $year=substr(Session::get('year'),-2);
            $sql=DB::select('select *  from course_section');
            $count=count($sql);

            for($i=0;$i<$count;$i++){
            //$course =Request::get('ddlCourse');
            //$sec =Request::get('ddlSection');
            $course = $sql[$i]->course_id;
            $sec = $sql[$i]->section;

            $fileupload_name = 'https://www3.reg.cmu.ac.th/regist'.$semester.$year.'/public/stdtotal_xlsx.php?var=maxregist&COURSENO='.$course.'&SECLEC='.$sec.'&SECLAB=000&border=1&mime=xlsx&ctype=&';
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

                               $reg=DB::select(' select * from course_student where course_id=? and section=? and student_id=?
                                                  and semester=? and year=?',array($course,$sec,$code,Session::get('semester'),Session::get('year')));
                               //$rowstudent=count($stu);
                               $user=DB::select('select * from users where id=? ',array($code));

                                $cuser=count($user);
                               $rowregist=count($reg);
                               if ($rowregist==0 && $cuser==0 ) {

                                 //  $command =DB::insert('insert into students (id,studentName,status) values (?,?,?)',array($code,$fullnames,$status)) ;
                                    $command =DB::insert('insert into users (id,firstname_th,lastname_th,role_id) values (?,?,?,?)',array($code,$fname,$lname,'0001')) ;

                                   $regis =DB::insert('insert into course_student(student_id,course_id,section,status,semester,year) values (?,?,?,?,?,?)',array($code,$course,$sec,$status,Session::get('semester'),Session::get('year')));



                               }
                                if ($rowregist==0 && $cuser>0 ) {

                                    //  $command =DB::insert('insert into students (id,studentName,status) values (?,?,?)',array($code,$fullnames,$status)) ;
                                       //$command =DB::insert('insert into users (id,firstname_th,lastname_th,role_id) values (?,?,?,?)',array($code,$fname,$lname,'0001')) ;

                                      $regis =DB::insert('insert into course_student(student_id,course_id,section,status,semester,year) values (?,?,?,?,?,?)',array($code,$course,$sec,$status,Session::get('semester'),Session::get('year')));



                                  }
                               if($rowregist>0){
                                   if($reg[0]->status!=$status){
                                      $update=DB::update('update course_student set status=? where student_id=?
                                                          and semester=? and year=?',array($status,$code,Session::get('semester'),Session::get('year')));
                                   }

                               }



                               }

                            }
                        }
                        }

      ?>
      <h2 align="center"> import successful</h2>

      @endsection
