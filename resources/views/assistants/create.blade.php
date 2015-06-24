@extends('app')

@section('content')
<script type="text/javascript">
function onSubmitMain() {
	var msgErr = ""
	if($("#courseId").val() == ""){
		msgErr += "กรุณาเลือกวิชา\n"
	}
	if($("#sectionId").val() == ""){
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
    frmMain.sectionId.length = 0
    //*** Insert null Default Value ***//
    var myOption = new Option('เลือกตอน','')
    frmMain.sectionId.options[frmMain.sectionId.length]= myOption
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
    frmMain.sectionId.options[frmMain.sectionId.length]= myOption
    }
    <?php
    }

    ?>
    }


    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h1>Create a new assistant</h1>
                        <hr/>

                        <!--{!! Form::open(['url' => 'assistants/create/save']) !!}
                        -->
                        <form action="create/save" method="post" name="frmMain" id="frmMain" onsubmit="return onSubmitMain()" class="form-horizontal"  align="center">
                        <div class="form-group">
                        <select id="courseId" name="courseId" onChange = "ListSection(this.value)" class="form-control">
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
                    </div><div class="form-group">
                   <select id="sectionId" name="sectionId" class="form-control">
                   						<option selected value="">เลือกตอน</option>
                   					</select>
                    </div><div class="form-group">
                         <select id="taId" name="taId"  class="form-control">
                                                                    <option selected value="">เลือกนักศึกษาช่วยสอน</option>
                                                <?php $sql=DB::select('select * from tas');
                                                                       $count=count($sql);
                                                                        for($i=0;$i<$count;$i++){
                                                                        ?>


                                                                    					<option value ={{$sql[$i]->id}}>{{$sql[$i]->taName}} </option>




                                                                        <?php } ?>
                                                                        </select>
                    </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                        </form>>
                        <!--{!! Form::close() !!}
                            -->
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection