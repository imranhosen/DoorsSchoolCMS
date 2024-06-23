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
                                <option value="">Select</option>
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
                            <label for="Date">Attendance Date</label>
                            <small class="req"> *</small>
                            <input name="date" placeholder="" id="date" type="date" class="form-control"
                                   value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" autocomplete="on">
                        </div>
                        {{--<div class="form-group float-right">
                            <button type="submit" class="btn btn-primary" id="showTableBtn"><i class="voyager-search">search</i>
                            </button>
                        </div>--}}
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
                    <h3 class="bold"><i class="fa-solid fa-list"></i> Attendance List</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="studentTable1">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Class Name</th>
                                <th>Group Name</th>
                                <th>Total Present</th>
                                <th>Total Absent</th>
                                <th>Total Late</th>
                                <th>Total Late with Excuse</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
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
                        url: "{{route('fetchAttendenceData')}}",
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
                var className = response['className'][0].name;
                var groupName = response['groupName'][0].name;
                var date = response['date'];
                var present = response['present'];
                var absent = response['absent'];
                var late = response['late'];
                var lateWithExcuse = response['lateWithExcuse'];
                $('#attendanceDiv').show();
                $('#studentTable1 tbody').empty();
                if (date != null) {
                    var tr_str = "<tr>" +
                        "<td>" + date + "</td>" +
                        "<td>" + className + "</td>" +
                        "<td>" + groupName + "</td>" +
                        "<td>" + present + "</td>" +
                        "<td>" + absent + "</td>" +
                        "<td>" + late + "</td>" +
                        "<td>" + lateWithExcuse + "</td>" +
                        "</tr>";
                    $("#studentTable1 tbody").append(tr_str);
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
            /*   var date_format = 'Y-m-d';
               $('#date').datepickerInput({
                   format: date_format,
                   autoclose: true
               });*/
        });
    </script>
@stop
