<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Upload File</h4>
      </div>
      <div class="modal-body">
            <div class="dropzone" id="dropzoneFileUpload">

            </div>
      </div>
      <div class="modal-footer">

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">

    var baseUrl = "{{ url('/') }}";
    var token = "{{ Session::getToken() }}";

    Dropzone.autoDiscover = false;
     var myDropzone = new Dropzone("div#dropzoneFileUpload", {

         url: "uploadFiles",
         params: {
            _token: token,
            course_id: '{{$course['co']}}',
            section: '{{$course['sec']}}'
          },
          init: function () {
            this.on("sending", function(file, xhr, data) {
                data.append("path", dzfullpath);
                data.append("template_name", templatename);
                data.append("type_id", typeid);
                data.append("student_id", '{{\Auth::user()->id}}');
                data.append("homework_id", homework_id);
                data.append("due_date", due_date);
                data.append("accept_date", accept_date);
            });
           }
     });
     Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        accept: function(file, done) {

        }
      };
 </script>