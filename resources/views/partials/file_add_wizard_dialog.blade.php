<div class="modal fade" id="addFileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="js-title-step"></h4>
      </div>
      <div class="modal-body">
        <div class="row hide" data-step="1" data-title="Input necessary data">
          <div class="well">
            <form class="form-horizontal addFileForm" role="form">
              <div class="form-group">
                <label class="control-label col-sm-2" for="section">Section</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="section" id="section" placeholder="Enter course section (blank for all)">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="homeworkname">Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="homeworkname" id="homeworkname" placeholder="Ex. lab01_{id} ,lab01_{section}_{id}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="filetype">Type</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="filetype" id="filetype" placeholder="Choose file type">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="filedetail">Detail</label>
                <div class="col-sm-8">
                  <textarea style="resize:none" class="form-control" name="filedetail" id="filedetail" rows="3" placeholder="Enter file detail" required></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="dueDate">Due Date</label>
                <div class='col-sm-8 input-group date clsDatePicker' id='datetimepicker1'>
                  <input type='text' class="form-control" name="dueDate" id="dueDate"/>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="acceptUntil">Accept Until</label>
                <div class='col-sm-8 input-group date clsDatePicker' id='datetimepicker2'>
                  <input type='text' class="form-control" name="acceptUntil" id="acceptUntil"/>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row hide" data-step="2" data-title="Select section for this homework">
          <div class="well">
            <select id="example-getting-started" multiple="multiple">
                <option value="cheese">Cheese</option>
                <option value="tomatoes">Tomatoes</option>
                <option value="mozarella">Mozzarella</option>
                <option value="mushrooms">Mushrooms</option>
                <option value="pepperoni">Pepperoni</option>
                <option value="onions">Onions</option>
            </select>
            <form class="form-horizontal addFileForm-selected-section" role="form">
              <div class="form-group">
                <label class="control-label col-sm-2" for="section">Section</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="section" id="section" placeholder="Enter course section (blank for all)">
                </div>
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
            defaultDate: moment("11:59:00","hh:mm:ss")
        });
    });
    $(function () {
        $('#datetimepicker2').datetimepicker({
            locale: 'en',
            format: 'DD/MM/YYYY LT',
            defaultDate: moment("11:59:00","hh:mm:ss")
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
        $('#example-getting-started').multiselect({
            includeSelectAllOption: true,
            allSelectedText: 'All section selected'
        });
    });
</script>

