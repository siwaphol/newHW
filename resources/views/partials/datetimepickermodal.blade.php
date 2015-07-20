<div class="modal fade" id="dataTimePickerModal" tabindex="-1" role="dialog" aria-labelledby="Datetimepicker" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <div class="container">Hey! hello</div>
        <div style="overflow:hidden;">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                        <div id="datetimepicker12">

                        </div>
                        <div class='col-sm-6 input-group date'>
                            <input type='text' class='form-control' name='dueDate' id='dueDate'/>
                            <span class='input-group-addon'>
                              <span class='glyphicon glyphicon-calendar'></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    var myDTpicker = $('#datetimepicker12').datetimepicker({
                        inline: true,
                        sideBySide: true,
                        locale: 'en',
                        format: 'DD/MM/YYYY HH:mm',
                        defaultDate: moment("23:59:00","hh:mm:ss")
                    });

                });
            </script>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">OK</button>
      </div>
    </div>
  </div>
</div>