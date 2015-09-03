<div class="modal fade" id="addFileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="js-title-step"></h4>
            </div>
            <div class="modal-body">
                {{-------------Start of modal step 1------------------}}
                <div class="row hide" data-step="1" data-title="Add new homework">
                    <div class="well">
                        <form class="form-horizontal addFileForm" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="homeworkname">Name<i
                                            style="color: red;">*</i></label>

                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="homeworkname" id="homeworkname"
                                               placeholder="Ex. lab01_{id} ,{id}_lab01_1">
                                        <span class="input-group-addon"
                                              id="homework-ext-label">no extension selected</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="section">File Type<i
                                            style="color: red;">*</i></label>

                                <div class="col-sm-8">
                                    <select id="filetype-list">
                                        <option value="">no extension</option>
                                        @foreach($filetype_list as $a_file_type)
                                            <option value="{{$a_file_type->id}}">{{$a_file_type->extension}}</option>
                                        @endforeach
                                        <option value="newfiletype">others...</option>
                                    </select>
                                </div>
                            </div>
                            {{--<div class="form-group newfiletype" style="display:none;">--}}
                            {{--<label class="control-label col-sm-2" for="newfiletypeid">New id<i style="color: red;">*</i></label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<input type="text" class="form-control" name="newfiletypeid" id="newfiletypeid" placeholder="Ex. word, powerpoint (no space)">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group newfiletype" style="display:none;">
                                <label class="control-label col-sm-2" for="newextension">Extension<i
                                            style="color: red;">*</i></label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="newextension" id="newextension"
                                           maxlength="20" placeholder="Ex. c, cpp (use comma for multiple extension)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="filedetail">Detail</label>

                                <div class="col-sm-8">
                                    <textarea style="resize:none" class="form-control" name="filedetail" id="filedetail"
                                              rows="3" placeholder="Enter file detail" required></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-------------End of modal step 1------------------}}
                {{-------------Start of modal step 2------------------}}
                <div class="row hide" data-step="2" data-title="Select section for this homework">
                    <div class="well">
                        <form class="form-horizontal addFileForm-selected-section" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="section">Section<i style="color: red;">*</i></label>

                                <div class="col-sm-8 clsAboveDatePicker">
                                    <select id="section-list" multiple="multiple">
                                        @foreach($section_list as $section)
                                            <option value="{{$section->section}}">Section {{$section->section}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="errorDisplay" class="alert alert-danger hidden">
                                <strong>Error</strong><br>
                                <ul>

                                </ul>
                            </div>

                            <div id="sectionTimeDatePicker" class="sectionRemovable">

                            </div>

                        </form>
                    </div>
                </div>
                {{-------------End of modal step 2------------------}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default js-btn-step pull-left" data-orientation="cancel"
                        data-dismiss="modal"></button>
                <button type="button" class="btn btn-warning js-btn-step" data-orientation="previous"></button>
                <button type="button" class="btn btn-success js-btn-step" data-orientation="next"></button>
                {{--<button type="button" class="btn btn-success" id="DTcaller" data-dismiss="modal">Test button</button>--}}
            </div>
        </div>
    </div>
</div>

@include('partials.datetimepickermodal')

<script>

</script>
<script type="text/javascript">
    $(document).ready(function () {

        //starttest
        var changingTxt = "";

        $('#dtpicker_modal').datetimepicker({
            inline: true,
            sideBySide: true,
            locale: 'en',
            format: 'DD/MM/YYYY HH:mm',
            defaultDate: moment("23:59:00", "hh:mm:ss")
        });
        function changeCurrentDateText(cText,sec_num) {
            changingTxt = cText+sec_num;
            //init minDate and maxDate
            $('#dtpicker_modal').data("DateTimePicker").minDate(false);
            $('#dtpicker_modal').data("DateTimePicker").maxDate(false);
            //check linked date
            if(cText === '#dueDate'){
                if($.trim($('#acceptUntil'+sec_num).val()).length > 0){
                    $('#dtpicker_modal').data("DateTimePicker").maxDate(moment($('#acceptUntil'+sec_num).val(),'DD/MM/YYYY HH:mm'));
                }else{
                    $('#dtpicker_modal').data("DateTimePicker").maxDate(false);
                }
            }else if(cText == '#acceptUntil'){
                if($.trim($('#dueDate'+sec_num).val()).length > 0){
                    $('#dtpicker_modal').data("DateTimePicker").minDate(moment($('#dueDate'+sec_num).val(),'DD/MM/YYYY HH:mm'));
                }else{
                    $('#dtpicker_modal').data("DateTimePicker").minDate(false);
                }
            }

            if ($.trim($(changingTxt).val()).length > 0) {
                $('#dtpicker_modal').data("DateTimePicker").date(moment("23:59:59", "hh:mm:ss"));
            } else {
                $('#dtpicker_modal').data("DateTimePicker").date($(changingTxt).val());
            }
            $('#dateTimePickerModal').modal('toggle');
        }

        function checkErrorBeforeModalStepComplete() {
            $('#errorDisplay ul').empty();
            var hasError = false;

            //check second wizard for datetimepicker
            $('#sectionTimeDatePicker input').each(function () {
                var current_input_id_value = $(this).attr('data-message');
                if ($.trim($(this).val()).length === 0) {
                    hasError = true;
                    $('#errorDisplay').removeClass('hidden');
                    $('#errorDisplay ul').append('<li>'+ current_input_id_value +' cannot be empty.</li>');
                    //input should be in format of asdaffddfdf
                } else if (!moment($(this).val(), 'DD/MM/YYYY HH:mm', true).isValid() || $.trim($(this).val()).length > 16) {
                    hasError = true;
                    $('#errorDisplay ul').append('<li>'+current_input_id_value+' incorrect format (DD/MM/YYYY HH:mm).</li>');
                    //date input is incorrect
                }
            });

            return hasError;
        }

        function getSectionInputString(section_text){

            return "" +
                    "<div class='panel panel-info section" + section_text + "'>" +
                    "<div class='panel-heading'>" +
                    "Section " + section_text +
                    "</div>" +
                    "<div class='panel-body'>" +
                    "<div class='form-group section" + section_text + "'>" +
                    "  <label class='control-label col-sm-3' style='text-align: left;' for='dueDate" + section_text + "'>Due Date</label>" +
                    "  <div class='col-sm-6 input-group date clsDatePicker'>" +
                    "    <input type='text' class='form-control' name='dueDate" + section_text + "' id='dueDate" + section_text + "' data-message='section "+ section_text +"&#39;due date '/>" +
                    "    <span class='input-group-addon' id='btn_due_date" + section_text + "'>" +
                    "      <span class='glyphicon glyphicon-calendar'></span>" +
                    "    </span>" +
                    "  </div>" +
                    "</div>" +
                    "<div class='form-group section" + section_text + "'>" +
                    "  <label class='control-label col-sm-3' style='text-align: left;' for='acceptUntil" + section_text + "'>Accept Until</label>" +
                    "  <div class='col-sm-6 input-group date clsDatePicker'>" +
                    "    <input type='text' class='form-control' name='acceptUntil" + section_text + "' id='acceptUntil" + section_text + "' data-message='section "+ section_text +"&#39;accept until '/>" +
                    "    <span class='input-group-addon' id='btn_accept_date" + section_text + "'>" +
                    "      <span class='glyphicon glyphicon-calendar'></span>" +
                    "    </span>" +
                    "  </div>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "";
        }

        $("#DT_OK_button").on("click", function () {
            $(changingTxt).val($('#dtpicker_modal').data("DateTimePicker").date().format("DD/MM/YYYY HH:mm"));
        });
        //endtest

        var baseUrl = "{{ url('/') }}";
        var token = "{{ Session::getToken() }}";

        $('#addFileModal').modalSteps({
            completeCallback: function () {
                if(!checkErrorBeforeModalStepComplete()){
                    console.log($('.addFileForm').serialize());
                }
                //$('#addFileModal').modal('hide');
            }
        });

        $('#section-list').multiselect({
            includeSelectAllOption: true,
            allSelectedText: 'All section selected',
            onChange: function (element, checked) {
                if (typeof element === 'undefined') {
                    if (checked === false) {
                        $('#sectionTimeDatePicker').empty();
                        $('#errorDisplay').addClass('hidden');
                    }
                } else {
                    if (checked === true) {
                        var this_section = "section" + element.val();
                        if (!$('.' + this_section)[0]) {
                            $('#sectionTimeDatePicker').append(getSectionInputString(element.val()));

                            var current_dbtn = "#btn_due_date" + element.val();
                            var current_abtn = "#btn_accept_date" + element.val();
                            var current_sec = element.val();
                            $(current_dbtn).on('click', function () {
                                changeCurrentDateText("#dueDate", current_sec);
                            });
                            $(current_abtn).on('click', function () {
                                changeCurrentDateText("#acceptUntil", current_sec);
                            });
                        }
                    }
                    else if (checked === false) {
                        var thisSection = ".section" + element.val();
                        $(thisSection).remove();
                        $('#errorDisplay').addClass('hidden');
                    }
                }
            },
            onSelectAll: function () {
                $('#section-list option').each(function () {
                    var this_section = "section" + $(this).val();
                    if (!$('.' + this_section)[0]) {
                        $('#sectionTimeDatePicker').append(getSectionInputString($(this).val()));

                        var current_dbtn = "#btn_due_date" + $(this).val();
                        var current_abtn = "#btn_accept_date" + $(this).val();
                        var current_sec = $(this).val();
                        $(current_dbtn).on('click', function () {
                            changeCurrentDateText("#dueDate", current_sec);
                        });
                        $(current_abtn).on('click', function () {
                            changeCurrentDateText("#acceptUntil", current_sec);
                        });
                    }
                });
            }
        });

        $('#filetype-list').multiselect({
            onChange: function (element, checked) {
                if (checked === true) {
                    if (element.val() === 'newfiletype') {
                        $('.newfiletype').show();
                        $('#homework-ext-label').html(trimed_text);
                    } else {
                        $('.newfiletype').hide();

                        $('#homework-ext-label').html(element.html());
                    }
                }
            }
        });

        $('#newextension').on('input', function () {
            var trimed_text = $(this).val().replace(/ /g, '');
            if (!trimed_text == '') {
                //check if , is at the end of string
                patt = /,$/g;
                if (patt.test(trimed_text)) {
                    trimed_text = trimed_text.substring(0, trimed_text.length - 1);
                    trimed_text = trimed_text.replace(/,/g, ', .');
                } else {
                    trimed_text = trimed_text.replace(/,/g, ', .');
                }

                trimed_text = '.' + trimed_text;
                trimed_text = trimed_text.toLowerCase();
            }

            $('#homework-ext-label').html(trimed_text);
        });
    });
</script>

