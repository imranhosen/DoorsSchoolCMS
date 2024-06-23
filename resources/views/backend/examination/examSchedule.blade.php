@extends('voyager::master')

@section('css')
    <style>
        .color {
            color: #e94542;
        }
    </style>
@stop
@section('content')
    <div class="page-content browse container-fluid">
        <form action="{{route('examScheduleStore')}}" method="post" id="searchStudentClassGroupWaise">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="alert alert-primary text-center" style="background-color:#ededff">
                                <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                            </div>

                            <div class="form-group col-sm-4">
                                <level for="exam">Exam Name</level>
                                <select name="exam_id" id="exam-dropdown" class="form-control">
                                    <option value="">-- Select --</option>
                                    @foreach ($exams as $exam)
                                        <option value="{{$exam->id}}">
                                            {{$exam->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <level for="class">Class</level>
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
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" hidden="hidden" id="examScheduleDiv">
                <div class="col-lg-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <h4><i class="far fa-clock"></i> Exam Schedule</h4>
                            <hr>
                            <table class="table" id="examTable">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Room Number</th>
                                    <th>Full Marks</th>
                                    <th>Passing Marks</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-dark" id="saveBtn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



@stop
@section('javascript')
    <script>
        $(document).ready(function () {
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

            $('#group-dropdown').on('change', function () {
                $('#examScheduleDiv').show();
                var groupId = this.value;
                $.ajax({
                    url: "{{route('fetchSubject')}}",
                    type: "POST",
                    data: {
                        group_id: groupId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        console.log(res);
                        $('#examTable tbody').html();
                        var trData = `
                                            <th>
                                              <div class="form-group">
                                                <div class="input-group col-md-12">
                                                  <input name="date_of_exam[]" placeholder="" id="date" type="date" class="form-control" value="" autocomplete="on">
                                                </div>
                                              </div>
                                             </th>
                            <th>
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <div class="input-group col-md-12">
                                            <input type="time" name="start_time[]" class="form-control" id="stime_"
                                                   autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <div class="input-group col-md-12">
                                            <input type="time" name="end_time[]" class="form-control timepicker"
                                                   id="etime_">
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="form-group">
                                    <input type="text" name="room_no[]" class="form-control" id="room_"
                                           placeholder="Enter Room Number">
                                </div>
                            </th>
                            <th>
                                <div class="form-group">
                                    <input type="text" name="full_marks[]" class="form-control" id="room_"
                                           placeholder="Enter Full Mark">
                                </div>
                            </th>
                            <th>
                                <div class="form-group">
                                    <input type="text" name="pass_marks[]" class="form-control" id="room_"
                                           placeholder="Enter Pass Mark">
                                </div>
                            </th>

                            `
                        $.each(res.subjects, function (key, value) {
                            var strp = "<th>" + "<input type='hidden' value='" + value.id + "' name='subject_id[]'>" + value.name + "</th>";
                            $('#examTable tbody').append(
                                "<tr>" + strp + trData + "</tr>");

                        });
                    }
                });
            });
        });
    </script>
@stop

