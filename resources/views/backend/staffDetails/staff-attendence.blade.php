@extends('voyager::master')

@section('css')
    <style>
        .req {
            color: #e94542;
        }
    </style>

@stop
@section('content')
    <div class="page-content browse container-fluid">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="form-group col-md-12">
                    <div class="alert alert-primary text-center" style="background-color:#ededff">
                        <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                    </div>
                    <form id="searchStaffRoleWaise">
                        <div class="form-group col-sm-6">
                            <level for="role">Role</level>
                            <small class="req"> *</small>
                            <select name="role_id" id="role-dropdown" class="form-control">
                                <option value="">Select</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">
                                        {{$role->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="exampleInputEmail1">Attendance Date</label>
                            <small class="req"> *</small>
                            <input name="date" placeholder="" id="date" type="date" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" autocomplete="on">
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary" id="showTableBtn"><i class="voyager-search">search</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="form-group box box-info" hidden="hidden" id="attendanceDiv">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="voyager-window-list"></i> Staff List</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <form action="{{route('staffAttendance.save')}}" method="post">
                    @csrf
                    <div class="box-body" id="tableDiv">
                        <div class="table-responsive">
                            <div class="form-group float-right" id="saveBtnDiv">
                                <button type="submit" class="btn btn-dark" id="saveBtn">Save Attendance</button>
                            </div>
                            <table class="table table-striped" id="staffTable1">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Staff ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Attendence</th>
                                    <th>Note</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop



@section('javascript')
    <script>
        $(document).ready(function () {
            var printCounter = 0;

            // Append a caption to the table before the DataTables initialisation
           // $('#staffTable1').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');

            $('#staffTable1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    {
                        extend: 'excel',
                        messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
                    },
                    {
                        extend: 'pdf',
                        messageBottom: null
                    },
                    {
                        extend: 'print',
                        messageTop: function () {
                            printCounter++;

                            if ( printCounter === 1 ) {
                                return 'This is the first time you have printed this document.';
                            }
                            else {
                                return 'You have printed this document '+printCounter+' times';
                            }
                        },
                        messageBottom: null
                    }
                ]
            } );


            $('#searchStaffRoleWaise').submit(function (e) {
                e.preventDefault();
                var roleId = $('#role-dropdown').val();
                var date = $('#date').val();
                if (roleId > 0) {
                    // $('#studentHistoryDiv1').hide();
                    $.ajax({
                        url: "{{route('fetchStaffDataForAttendence')}}",
                        type: "POST",
                        data: {
                            role_id: roleId,
                            date: date
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            createRows(response);
                        }
                    });
                }

            });

            function createRows(response) {
                var len = 0;
                var roleName = response['roleName'][0].name;
                var roleId = response['roleId'];
                var date = response['date'];
                $('#attendanceDiv').show();
                $('#staffTable1 tbody').empty();
                if (response['staffs'] != null) {
                    len = response['staffs'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var staffId = response['staffs'][i].id;
                        var name = response['staffs'][i].full_name;
                        var Present = 'Present';
                        var Absent = 'Absent';
                        var Late = 'Late';
                        var HalfDay = 'Half Day';
                        var tr_str = "<tr>" +
                            "<input type='hidden' value='" + staffId + "' name='staffs[]'>" +
                            "<input type='hidden' value='" + date + "' name='date'>" +
                            "<input type='hidden' value='" + roleId + "' name='role_id'>" +
                            "<td>" + (i+1) + "</td>" +
                            "<td>" + staffId + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + roleName + "</td>" +
                            "<td>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='atdType[" + staffId + "]' checked='checked' value='1'>" + Present +
                            "</label>" +
                            "</div>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='atdType[" + staffId + "]' value='2'>" + Absent +
                            "</label>" +
                            "</div>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='atdType[" + staffId + "]' value='3'>" + Late +
                            "</label>" +
                            "</div>" +
                            "</div>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='atdType[" + staffId + "]' value='6'>" + HalfDay +
                            "</label>" +
                            "</div>" +
                            "</td>" +
                            "<td>" +
                            "<input type='text' value='' name='note[]'>" +
                            "</td>" +
                            "</tr>";
                        $("#staffTable1 tbody").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='req'>No record found.</td>" +
                        "</tr>";
                    $("#staffTable1 tbody").append(tr_str);
                }
            }
        });
    </script>
@stop
