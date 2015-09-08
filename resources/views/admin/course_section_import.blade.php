@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Course Details Import Result</h1>
        </div>
        <div class="row clearfix">

            <button class="btn btn-outline btn-warning dim" type="button" id="test_filter"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            <!-- Test Tab -->
            <div id="myTabs" class="tabs-container">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#success" aria-controls="success" role="tab" data-toggle="tab">Success</a></li>
                    <li role="presentation"><a href="#notchange" aria-controls="notchange" role="tab" data-toggle="tab">Not Change</a></li>
                    <li role="presentation"><a href="#staff" aria-controls="staff" role="tab" data-toggle="tab">Staff</a></li>
                    <li role="presentation"><a href="#fail" aria-controls="fail" role="tab" data-toggle="tab">Fail</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="success">
                        <div class="panel-body">
                            <p>All these courses are inserted to database.</p>
                            <div class="table-responsive">
                                <table class="table table-hover issue-tracker">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="label label-success">Added</span>
                                        </td>
                                        <td class="issue-info">
                                            <a href="#">
                                                COURSE NO
                                            </a>
                                            <small>
                                                this can be section or teacher name.
                                            </small>
                                        </td>
                                        <td>
                                            Siwaphol Boonpan
                                        </td>
                                        <td>
                                            <span style="display: none;" class="pie">0.52,1.041</span><svg width="16" height="16" class="peity"><path fill="#1ab394" d="M 8 8 L 8 0 A 8 8 0 0 1 14.933563796318165 11.990700825968545 Z"></path><path fill="#d7d7d7" d="M 8 8 L 14.933563796318165 11.990700825968545 A 8 8 0 1 1 7.999999999999998 0 Z"></path></svg>
                                            2d
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-white btn-xs"> Tag</button>
                                            <button class="btn btn-white btn-xs"> Mag</button>
                                            <button class="btn btn-white btn-xs"> Rag</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="notchange">
                        <div class="panel-body">
                            <p>All these courses are not inserted to database due to a same course section is exist.</p>
                            <div class="table-responsive">
                                <table class="table table-hover issue-tracker">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="label label-warning">Fixed</span>
                                        </td>
                                        <td class="issue-info">
                                            <a href="#">
                                                ISSUE-07
                                            </a>

                                            <small>
                                                Always free from repetition, injected humour, or non-characteristic words etc.
                                            </small>
                                        </td>
                                        <td>
                                            Alex Ferguson
                                        </td>
                                        <td>
                                            28.11.2015 05:10 pm
                                        </td>
                                        <td>
                                            <span style="display: none;" class="pie">1,2</span><svg width="16" height="16" class="peity"><path fill="#1ab394" d="M 8 8 L 8 0 A 8 8 0 0 1 14.92820323027551 11.999999999999998 Z"></path><path fill="#d7d7d7" d="M 8 8 L 14.92820323027551 11.999999999999998 A 8 8 0 1 1 7.999999999999998 0 Z"></path></svg>
                                            2d
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-white btn-xs"> Tag</button>
                                            <button class="btn btn-white btn-xs"> Dag</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="staff">
                        <p>These courses are not taught by specific teacher, must be manually inserted.</p>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="fail">
                        <p>These data are not follow other rules but cannot be inserted to database, please see log for detail.</p>
                    </div>
                </div>

            </div>
            <!-- End Test Tab -->

            <div class="table-responsive">
                <table class="table" id="course_import_overview" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Course No</th>
                        <th>Title</th>
                        <th>Section</th>
                        <th>Teacher Name</th>
                        <th>Success</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th colspan="6" style="text-align:right" id="total_footer">Total: </th>
                    </tr>
                    </tfoot>

                    <tbody>
                        <tr>
                            <td>204111</td>
                            <td>FUN CS</td>
                            <td>001</td>
                            <td>Siwaphol Boonpan</td>
                            <td><span class="label label-success">Added</span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>204112</td>
                            <td>FUN CS 2</td>
                            <td>001</td>
                            <td>Siwaphol Boonpan</td>
                            <td><span class="label label-warning">No Change</span></td>
                            <td>Duplicate course exist</td>
                        </tr>
                        <tr>
                            <td>204112</td>
                            <td>FUN CS 2</td>
                            <td>001</td>
                            <td>Siwaphol Boonpan</td>
                            <td><span class="label label-warning">No Change</span></td>
                            <td>Not found teacher name or only "Staff" found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script_tag')
    <script>
        $(document).ready(function() {
            $('#myTabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            });

            var cimport_table = $('#course_import_overview').DataTable( {
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Update footer
                    $('#total_footer').html('This is total that succesfully add to the footer.');

                },
                "dom" : 'l<"#mycustombutton.dataTables_filter">ftipr'

            } );

            $('#mycustombutton').html('' +
                    '<label style="margin-left: 5px;"> Success Filter: ' +
                        '<select id="success_select">' +
                            '<option value="All">All</option>' +
                            '<option value="Added">Added</option>' +
                            '<option value="No Change">No Change</option>' +
                            '<option value="Fail">Fail</option>' +
                        '</select>' +
                    '</label>');

            $('#success_select').change(function () {
                if($(this).val() === "All"){
                    cimport_table.search('').draw();
                }else{
                    cimport_table.search($(this).val()).draw();
                }
            });

            $('#test_filter').click(function () {
                cimport_table.search('Added').draw();
            });
        } );
    </script>
@endsection