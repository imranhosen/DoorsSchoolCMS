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
        <form id="searchStudentClassGroupWaise">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="alert alert-primary text-center" style="background-color:#ededff">
                                <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                            </div>

                            <div class="form-group col-sm-5">
                                <level for="class" class="bold">Class</level>
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
                            <div class="form-group col-sm-5">
                                <level for="group" class="bold">Group</level>
                                <small class="req"> *</small>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                            {{-- <div class="form-group float-right">
                                 <button type="submit" class="btn btn-primary" id="showTableBtn"><i class="voyager-search">search</i>
                                 </button>
                             </div>--}}
                            <div class="form-group col-sm-2" style="margin-top: 17px">
                                <button type="submit" class="btn btn-primary" id="showTableBtn"><i
                                        class="fa-sharp fa-solid fa-magnifying-glass"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="page-content browse container-fluid" hidden="hidden" id="promoteDiv">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="box-header with-border">
                            <h3 class="bold"><i class="fa-solid fa-list"></i> Promote Students In Next
                                Session</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <form action="{{route('promoteStudent.save')}}" method="post">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Promote In Session </label><small
                                                class="req"> *</small>

                                            <select id="session_id" name="session_id" class="form-control">
                                                <option value="">Select Session</option>
                                                @foreach($sessions as $session)
                                                    <option value="{{ $session->id }}">{{ $session->name }}</option>
                                                @endforeach
                                            </select>

                                            <span class="text-danger" id="session_id_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <level for="class" class="bold">Class</level>
                                            <small class="req"> *</small>
                                            <select name="class_id" id="class-dropdown2" class="form-control">
                                                <option value="">-- Select Class --</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{$class->id}}">
                                                        {{$class->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <level for="group" class="bold">Group</level>
                                            <small class="req"> *</small>
                                            <select id="group-dropdown2" name="group_id" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="studentTable1">
                                        <thead>
                                        <tr>
                                            <th>Admission Number</th>
                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>Date Of Birth</th>
                                            <th class="">Current Result</th>
                                            <th class="">Next Session Status</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="form-group float-right" id="saveBtnDiv">
                                    <button type="submit" class="btn btn-success" id="saveBtn">Promote</button>
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
                if (classId > 0) {
                    // $('#studentHistoryDiv1').hide();
                    $.ajax({
                        url: "{{route('fetchStudentData')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId
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
                $('#promoteDiv').show();
                $('#studentTable1 tbody').empty();
                if (response['students'] != null) {
                    len = response['students'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var studentId = response['students'][i].id;
                        var admissionNumber = response['students'][i].admission_no;
                        var name = response['students'][i].full_name;
                        var fatherName = response['students'][i].father_name;
                        var dob = response['students'][i].birth_date;
                        var Pass = 'Pass';
                        var Fail = 'Fail';
                        var Continue = 'Continue';
                        var Leave = 'Leave';
                        var tr_str = "<tr>" +
                            "<input type='hidden' value='" + studentId + "' name='student[]'>" +
                            "<td>" + admissionNumber + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + dob + "</td>" +
                            "<td>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='result[" + studentId + "]' checked='checked' value='pass'>" + Pass +
                            "</label>" +
                            "</div>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='result[" + studentId + "]' value='fail'>" + Fail +
                            "</label>" +
                            "</div>" +
                            "</td>" +
                            "<td>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='sessionStatus[" + studentId + "]' checked='checked' value='continue'>" + Continue +
                            "</label>" +
                            "</div>" +
                            "<div class='radio-inline'>" +
                            "<label>" +
                            "<input type='radio' name='sessionStatus[" + studentId + "]' value='leave'>" + Leave +
                            "</label>" +
                            "</div>" +
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


            $('#group-dropdown').on('change', function () {
                $('#showTableBtn').on('click', function () {
                    $('#assignSubjectDiv1').show();
                    $('#saveBtnDiv').show();
                });
            });

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
            $('#class-dropdown2').on('change', function () {
                var classId = this.value;
                $("#group-dropdown2").html('');
                $.ajax({
                    url: "{{route('fetchGroup')}}",
                    type: "POST",
                    data: {
                        clase_id: classId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#group-dropdown2').html('<option value="">-- Select Group --</option>');
                        $.each(result.groups, function (key, value) {
                            $("#group-dropdown2").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>
@stop

