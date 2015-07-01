@extends('app')

@section('header_content')
  <meta name="generator" content="Bootstrap Listr" />

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('/css/listr.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('/css/bootstrap-dialog.css') }}" />
@endsection

@section('content')

    <div class="container">
        <ol class="breadcrumb" dir="ltr">
              <li><a href="/newHW/public"><span class="glyphicon glyphicon-home"></span></a></li>
            </ol>
            <div class="row">
              <div class="col-xs-6 col-sm-3 col-xs-offset-6 col-sm-offset-9">
                <div class="form-group has-feedback">
                  <label class="control-label sr-only" for="search">Search</label>
                  <input type="text" class="form-control" id="search" placeholder="Search">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
               </div>
              </div>
            </div>
            <div class="row" style="margin-bottom: 15px;">
              <div class="col-xs-6 col-sm-3  col-xs-offset-6 col-sm-offset-9">
                <button type="button" class="btn btn-default" id="file_add_btn">           <span class="glyphicon glyphicon glyphicon-file"></span>        </button>        <button type="button" class="btn btn-default" id="folder_add_btn">           <span class="glyphicon glyphicon glyphicon-folder-open"></span>        </button>      </div>
            </div>
            <div class="table-responsive">
              <table id="bs-table" class="table table-hover">
                <thead>
                  <tr>
                    <th class="col-lg-8 text-left" data-sort="string">Name</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <td colspan="1">
                      <small class="pull-left text-muted" dir="ltr">1 folder and 1 file, 0 bytes in total</small>
                                  </td>
                  </tr>
                </tfoot>
                <tbody>
                  <tr>
                    <td class="text-left" data-sort-value="lab01"><span class="glyphicon glyphicon-folder-close"></span>&nbsp;<a href="lab01/" ><strong>lab01</strong></a></td>
                  </tr>
                  <tr>
                    <td class="text-left" data-sort-value="lab02_[0-9]{9} (word)"><span class="glyphicon glyphicon-file"></span>&nbsp;<a href="lab02_%5B0-9%5D%7B9%7D%20%28word%29"  data-modified="0 KB">lab02_[0-9]{9} (word)</a></td>
                  </tr>
                </tbody>
              </table>
    </div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/stupidtable/0.0.1/stupidtable.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-searcher/0.2.0/jquery.searcher.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/listr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap-dialog.js') }}"></script>

<div id="modal" class="hidden"><form class="form-horizontal" role="form">
  <div class="form-group">
    <label class="control-label col-sm-2" for="section">Section</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="section" placeholder="Enter course section (blank for all)">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="homeworkname">Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="homeworkname" placeholder="Enter homework name">
    </div>
  </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="filetype">Type</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="filetype" placeholder="Choose file type">
      </div>
    </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="filedetail">Detail</label>
    <div class="col-sm-8">
      {{--<input type="text" class="form-control" id="filedetail" placeholder="Enter file detail">--}}
      <textarea style="resize:none" class="form-control" id="filedetail" rows="3" placeholder="Enter file detail" required></textarea>
    </div>
  </div>
</form>
</div>

<div class="hidden" id="fileadd">
	BootstrapDialog.show({
        title: 'เพิ่มการบ้าน',
        message: fileAddWithReplace(),
        buttons: [{
            label: 'ตกลง',
            action: function(dialog) {
                dialog.setTitle('ตกลง');
            }
        }, {
            label: 'ยกเลิก',
            action: function(dialog) {
                dialog.setTitle('ยกเลิก');
            }
        }]
    });
</div>
<div class="hidden" id="folderadd">
	BootstrapDialog.show({
        title: 'เพิ่มโฟลเดอร์',
        message: $('<textarea class="form-control" placeholder="Try to input multiple lines here..."></textarea>'),
        buttons: [{
            label: 'Title 1',
            action: function(dialog) {
                dialog.setTitle('Title 1');
            }
        }, {
            label: 'Title 2',
            action: function(dialog) {
                dialog.setTitle('Title 2');
            }
        }]
    });
</div>
<script>
		var code1 = $("#fileadd").html();
		var code2 = $("#folderadd").html();
		$("#file_add_btn").on('click', {code: code1}, function(event){
			eval(event.data.code);
		});
        $("#folder_add_btn").on('click', {code: code2}, function(event){
            eval(event.data.code);
        });

        function fileAddWithReplace() {
            var s = $("#modal").html();
            s = s.replace(/(\r\n|\n|\r|[ ](?=[^\>]*?(?:\<|$)))/gm,"");
            return s;
        }
</script>
@endsection