
@extends('app');
@section('content')

<script type="text/javascript">
function onSubmitMain() {
	var msgErr = ""
	if($("#ddlCourse").val() == ""){
		msgErr += "กรุณาเลือกวิชา\n"
	}
	if($("#ddlSection").val() == ""){
		msgErr += "กรุณาเลือกตอน\n"
	}
	if(msgErr != ""){
		alert(msgErr)
		return false
	}else{
		return true
	}
}

	function ListSection(SelectValue)
    {
    frmMain.ddlSection.length = 0
    //*** Insert null Default Value ***//
    var myOption = new Option('เลือกตอน','')
    frmMain.ddlSection.options[frmMain.ddlSection.length]= myOption
    <?php
    $intRows = 0;
    $objQuery =DB::select('SELECT sectionId,courseId FROM course_section ORDER BY sectionId ASC ');
    $count=count($objQuery);
    $i=0;
    for($i=0;$i<$count;$i++)
    {
    $intRows++;
    ?>
    x = <?php echo $intRows;?>;
    mySubList = new Array();
    strGroup = "<?php echo $objQuery[$i]->courseId;?>";
    strValue = "<?php echo $objQuery[$i]->sectionId;?>";
    mySubList[x,0] = strGroup;
    mySubList[x,1] = strValue;
    if (mySubList[x,0] == SelectValue){
    var myOption = new Option(mySubList[x,1])
    frmMain.ddlSection.options[frmMain.ddlSection.length]= myOption
    }
    <?php
    }

    ?>
    }
    /*function MM_jumpMenu(targ,selObj,restore){ //v3.0
      eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
      if (restore) selObj.selectedIndex=0;
    }*/

    </script>

<h3 align="center">เลือกกระบวนวิชา ตอน</h3>
<form action="" method="post" name="frmMain" id="frmMain" onsubmit="return onSubmitMain()" class="form-control">

					<select id="ddlCourse" name="ddlCourse" onChange = "ListSection(this.value)" class="form-control" placeholder=".col-xs-4">
						<option selected value="">เลือกวิชา</option>
						<?php

						$sql=DB::select('select * from course_section');
                        $count=count($sql);
                        $i=0;
                          for($i=0;$i<$count;$i++){
						?>
						<option value={{$sql[$i]->courseId}}>{{$sql[$i]->courseId}}</option>
						<?php
						}
						?>
					</select>

					<select id="ddlSection" name="ddlSection" class="form-control" placeholder=".col-xs-4">
						<option selected value="">เลือกตอน</option>
					</select>



                    <input type="submit" name="ok" value="ตกลง"  class="form-control"/>

          </form>

    @endsection