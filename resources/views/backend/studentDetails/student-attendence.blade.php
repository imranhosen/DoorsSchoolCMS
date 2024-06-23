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
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="alert alert-primary text-center" style="background-color:#ededff">
                            <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                        </div>
                        <form id="searchStudentClassGroupWaise">
                            <div class="form-group col-sm-3">
                                <level for="class">Class</level>
                                <small class="req"> *</small>
                                <select name="class_id" id="class-dropdown" class="form-control">
                                    <option value="">-- Select Class --</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}">
                                            {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <level for="group">Group</level>
                                <small class="req"> *</small>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="exampleInputEmail1">Attendance Date</label>
                                <small class="req"> *</small>
                                <input name="date" placeholder="" id="date" type="date" class="form-control"
                                       value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" autocomplete="on">
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group col-sm-1" style="margin-top: 22px">
                                <button type="submit" class="btn btn-primary" id="showTableBtn"><i
                                        class="fa-sharp fa-solid fa-magnifying-glass"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid" hidden="hidden" id="attendanceDiv">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="box-header with-border">
                            <h3 class="bold"><i class="fa-solid fa-list"></i> Student List</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <form action="{{route('studentAttendance.save')}}" method="post">
                            @csrf
                            <div class="box-body">
                                <div class="table-responsive">
                                    <div class="form-group float-right" id="saveBtnDiv">
                                        <button type="submit" class="btn btn-dark" id="saveBtn">Save Attendance</button>
                                    </div>
                                    <table class="table table-striped" id="studentTable1">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Admission Number</th>
                                            <th>Roll Number</th>
                                            <th>Name</th>
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
        </div>
    </div>


@stop



@section('javascript')

    <script>
        $(document).ready(function () {
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                var date = $('#date').val();
                if (classId > 0) {
                    // $('#studentHistoryDiv1').hide();
                    $.ajax({
                        url: "{{route('fetchStudentDataForAttendence')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId,
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
                // alert('hi');
                var len = 0;
                var classId = response['classId'];
                var groupId = response['groupId'];
                var date = response['date'];
                $('#attendanceDiv').show();
                $('#studentTable1 tbody').empty();
                if (response['students'] != null) {
                    len = response['students'].length;
                }
                if (len > 0) {
                    //var attendenceType = response['attendenceTypes'][i].type;
                    //alert(attendenceType);
                    for (var i = 0; i < len; i++) {
                        var studentId = response['students'][i].id;
                        var admissionNumber = response['students'][i].admission_no;
                        var rollNumber = response['students'][i].roll_number;
                        var name = response['students'][i].full_name;
                        var Present = 'Present';
                        var Absent = 'Absent';
                        var Late = 'Late';
                        var Late2 = 'Late With Excuse';
                        var tr_str = "<tr>" +
                            "<input type='hidden' value='" + studentId + "' name='students[]'>" +
                            "<input type='hidden' value='" + classId + "' name='clase_id'>" +
                            "<input type='hidden' value='" + groupId + "' name='group_id'>" +
                            "<input type='hidden' value='" + date + "' name='date'>" +
                            "<td>" + (i + 1) + "</td>" +
                            "<td>" + admissionNumber + "</td>" +
                            "<td>" + rollNumber + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='atdType[" + studentId + "]' checked='checked' value='1'>" + Present +
                            "</label>" +
                            "</div>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='atdType[" + studentId + "]' value='2'>" + Absent +
                            "</label>" +
                            "</div>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='atdType[" + studentId + "]' value='3'>" + Late +
                            "</label>" +
                            "</div>" +
                            "</div>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='atdType[" + studentId + "]' value='4'>" + Late2 +
                            "</label>" +
                            "</div>" +
                            "</td>" +
                            "<td>" +
                            "<input type='text' value='' name='note[]'>" +
                            "</td>" +
                            "</tr>";
                        $("#studentTable1 tbody").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='req'>No record found.</td>" +
                        "</tr>";
                    $("#studentTable1 tbody").append(tr_str);
                }
            }

            $('#class-dropdown').on('change', function () {
                var classId = this.value;
                $("#group-dropdown").html('');
                $.ajax({
                    url: "{{route('fetchGroup')}}",
                    type: "POST",
                    data: {
                        clase_id: classId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#group-dropdown').html('<option value="">-- Select Group --</option>');
                        $.each(result.groups, function (key, value) {
                            $("#group-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
            var date_format = 'Y-m-d';
            $('#date').datepickerInput({
                format: date_format,
                autoclose: true
            });
        });
    </script>
@stop
