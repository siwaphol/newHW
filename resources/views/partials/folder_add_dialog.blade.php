<div class="modal fade" id="addFolderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">เพิ่มโฟลเดอร์</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal addFolderForm" role="form">
          <div class="form-group">
            <label class="control-label col-sm-2" for="folderName">Section</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="folderName" id="folderName" placeholder="Enter Folder name here">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="addFolderOK">ตกลง</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->