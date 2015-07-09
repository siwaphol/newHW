<div class="modal fade" id="addFileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="js-title-step"></h4>
      </div>
      <div class="modal-body">
        <div class="row hide" data-step="1" data-title="เพิ่มการบ้าน">
          <div class="well">
            <form class="form-horizontal addFileForm" role="form">
              <div class="form-group">
                <label class="control-label col-sm-2" for="homeworkname">ชื่อ</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="homeworkname" id="homeworkname" placeholder="Ex. lab01_{id} ,lab01_{section}_{id}">
                </div>
              </div>
              {{--<div class="form-group">--}}
                {{--<label class="control-label col-sm-2" for="filetype">ประเภท</label>--}}
                {{--<div class="col-sm-8">--}}
                  {{--<input type="text" class="form-control" name="filetype" id="filetype" placeholder="Choose file type">--}}
                {{--</div>--}}
              {{--</div>--}}
            <div class="form-group">
              <label class="control-label col-sm-2" for="section">File Type</label>
              <div class="col-sm-8">
                <select id="filetype-list">
                  @foreach($filetype_list as $a_file_type)
                      <option value="{{$a_file_type->id}}">{{$a_file_type->id}} ({{$a_file_type->extension}})</option>
                  @endforeach
                  <option value="newfiletype">Create new file type</option>
                </select>
              </div>
            </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="filedetail">รายละเอียดเพิ่มเติม</label>
                <div class="col-sm-8">
                  <textarea style="resize:none" class="form-control" name="filedetail" id="filedetail" rows="3" placeholder="Enter file detail" required></textarea>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row hide" data-step="2" data-title="Select section for this homework">
          <div class="well">
            <form class="form-horizontal addFileForm-selected-section" role="form">
              <div class="form-group">
                <label class="control-label col-sm-2" for="section">Section</label>
                <div class="col-sm-8 clsAboveDatePicker">
                  <select id="section-list" multiple="multiple">
                    @foreach($section_list as $section)
                        <option value="{{$section->section}}">Section {{$section->section}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div id="sectionTimeDatePicker" class="sectionRemovable">

              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default js-btn-step pull-left" data-orientation="cancel" data-dismiss="modal"></button>
        <button type="button" class="btn btn-warning js-btn-step" data-orientation="previous"></button>
        <button type="button" class="btn btn-success js-btn-step" data-orientation="next"></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            locale: 'en',
            format: 'DD/MM/YYYY LT',
            defaultDate: moment("23:59:00","hh:mm:ss")
        });
    });
    $(function () {
        $('#datetimepicker2').datetimepicker({
            locale: 'en',
            format: 'DD/MM/YYYY LT',
            defaultDate: moment("23:59:00","hh:mm:ss")
        });
    });
</script>

<script>
    $('#addFileModal').modalSteps({
      completeCallback: function(){alert('COMPLETE !!');}
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#section-list').multiselect({
            includeSelectAllOption: true,
            allSelectedText: 'All section selected',
            onChange: function(element, checked) {
                 if(typeof element === 'undefined'){
                    if(checked === false){
                       $('#sectionTimeDatePicker').empty();
                    }
                 }else{
                     if(checked === true) {
                        $('#sectionTimeDatePicker').append("" +
                            "<div class='form-group section" + element.val() + "'>" +
                            "  <label class='control-label col-sm-4' for='dueDate" + element.val() + "'>Section " + element.val() + " Due Date </label>" +
                            "  <div class='col-sm-6 input-group date clsDatePicker' id='duedatetimepicker" + element.val() + "'>" +
                            "    <input type='text' class='form-control' name='dueDate" + element.val() + "' id='dueDate" + element.val() + "'/>" +
                            "    <span class='input-group-addon'>" +
                            "      <span class='glyphicon glyphicon-calendar'></span>" +
                            "    </span>" +
                            "  </div>" +
                            "</div>" +
                            "<div class='form-group section" + element.val() + "'>" +
                            "  <label class='control-label col-sm-4' for='acceptUntil" + element.val() + "'>Section " + element.val() + " Accept Until </label>" +
                            "  <div class='col-sm-6 input-group date clsDatePicker' id='acceptdatetimepicker" + element.val() + "'>" +
                            "    <input type='text' class='form-control' name='acceptUntil" + element.val() + "' id='acceptUntil" + element.val() + "'/>" +
                            "    <span class='input-group-addon'>" +
                            "      <span class='glyphicon glyphicon-calendar'></span>" +
                            "    </span>" +
                            "  </div>" +
                            "</div>" +
                          "");
                        var due_date = "#duedatetimepicker" + element.val();
                        $(due_date).datetimepicker({
                            locale: 'en',
                            format: 'DD/MM/YYYY LT',
                            defaultDate: moment()
                        });
                        var accept_date = "#acceptdatetimepicker" + element.val();
                        $(accept_date).datetimepicker({
                            locale: 'en',
                            format: 'DD/MM/YYYY LT',
                            defaultDate: moment()
                        });
                    }
                    else if(checked === false) {
                        var thisSection = ".section" + element.val();
                        $(thisSection).remove();
                    }
                }
            },
            onSelectAll: function() {
                $('#section-list option').each(function() {
                    var this_section = "section" + $(this).val();
                    if(!$('.' + this_section)[0]){
                        $('#sectionTimeDatePicker').append("" +
                            "<div class='form-group section" + $(this).val() + "'>" +
                            "  <label class='control-label col-sm-4' for='dueDate" + $(this).val() + "'>Section " + $(this).val() + " Due Date </label>" +
                            "  <div class='col-sm-6 input-group date clsDatePicker' id='duedatetimepicker" + $(this).val() + "'>" +
                            "    <input type='text' class='form-control' name='dueDate" + $(this).val() + "' id='dueDate" + $(this).val() + "'/>" +
                            "    <span class='input-group-addon'>" +
                            "      <span class='glyphicon glyphicon-calendar'></span>" +
                            "    </span>" +
                            "  </div>" +
                            "</div>" +
                            "<div class='form-group section" + $(this).val() + "'>" +
                            "  <label class='control-label col-sm-4' for='acceptUntil" + $(this).val() + "'>Section " + $(this).val() + " Accept Until </label>" +
                            "  <div class='col-sm-6 input-group date clsDatePicker' id='acceptdatetimepicker" + $(this).val() + "'>" +
                            "    <input type='text' class='form-control' name='acceptUntil" + $(this).val() + "' id='acceptUntil" + $(this).val() + "'/>" +
                            "    <span class='input-group-addon'>" +
                            "      <span class='glyphicon glyphicon-calendar'></span>" +
                            "    </span>" +
                            "  </div>" +
                            "</div>" +
                          "");
                        var due_date = "#duedatetimepicker" + $(this).val();
                        $(due_date).datetimepicker({
                            locale: 'en',
                            format: 'DD/MM/YYYY HH:mm',
                            defaultDate: moment()
                        });
                        var accept_date = "#acceptdatetimepicker" + $(this).val();
                        $(accept_date).datetimepicker({
                            locale: 'en',
                            format: 'DD/MM/YYYY HH:mm',
                            defaultDate: moment()
                        });
                    }
               });
            }
        });
        $('#filetype-list').multiselect({
            onChange: function(element, checked) {
                if(checked === true) {
                    if(element.val() === 'newfiletype'){

                    }
                }
            }
        });
    });
</script>

