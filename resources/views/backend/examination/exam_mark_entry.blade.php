@extends('voyager::master')

@section('css')

    <style>
        .color {
            color: #e94542;
        }
    </style>

@stop
@section('content')
    <form action="{{route('saveStudentMarks')}}" method="post">
        @csrf
    <div class="page-content browse container-fluid">
        <form id="searchStudentClassGroupWaise">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                             @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <div class="alert alert-primary text-center" style="background-color:#ededff">
                                <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                            </div>

                            <div class="form-group col-sm-4">
                                <level for="class" class="bold">Class</level>
                                <small class="req">*</small>
                                <select name="class_id" id="class-dropdown" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}">
                                            {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('class_id') }}</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <level for="group" class="bold">Group</level>
                                <small class="req">*</small>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                                <span class="text-danger">{{ $errors->first('group_id') }}</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <level for="subject" class="bold">Subject</level>
                                <small class="req">*</small>
                                <select id="subject-dropdown" name="subject_id" class="form-control">
                                </select>
                                <span class="text-danger">{{ $errors->first('subject_id') }}</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <level for="session" class="bold">Session</level>
                                <small class="req">*</small>
                                <select name="session_id" id="session-dropdown" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($sessions as $session)
                                        <option value="{{$session->id}}">
                                            {{$session->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('session_id') }}</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <level for="exam" class="bold">Exam Type</level>
                                <small class="req">*</small>
                                <select name="exam_id" id="exam-dropdown" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($exams as $exam)
                                        <option value="{{$exam->id}}">
                                            {{$exam->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('exam_id') }}</span>
                            </div>
                            <div class="form-group col-sm-1" style="margin-top: 17px">
                                <button type="button" class="btn btn-primary" id="showTableBtn"><i
                                        class="fa-sharp fa-solid fa-magnifying-glass"></i> Search
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row" id="classTimetableDiv">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="form-group col-md-12" id="studentFeeDiv">
                            <div class="form-row">
                                <h3 class="bold"><i class="fa-solid fa-pen-to-square"></i>Students Marks Entry</h3>
                            </div>
                            <hr>
                            <table class="table" id="studentTable">
                                <thead>
                                <tr>
                                    <th>Roll Number</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Gender</th>
                                    <th>Marks</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-dark pull-right">Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

@stop

@section('javascript')

    <script>
        $(document).ready(function () {
            $('#showTableBtn').on('click',function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                //alert(classId);
                var groupId = $('#group-dropdown').val();
                var subjectId = $('#subject-dropdown').val();
               /* if(classId == ''){
                    /!*$.notify("Class is required !", {globalPosition:'top right', className:'error'});
                    return false;*!/
                }
                if(groupId == ''){
                    alert('hi');
                }
                if(subjectId == ''){
                    alert('hi');
                    return false;
                }*/
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchStudentForMarksEntry')}}",
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
                $('#studentFeeDiv').show();
                $('#studentTable tbody').empty();
                if (response['students'] != null) {
                    len = response['students'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                       /* var classId = response['students'][i].clase.id;
                        var groupId = response['students'][i].group.id;
                        var session = response['session'][0].id;
                        var studentId = response['students'][i].id;*/
                        var studentId = response['students'][i].id;
                        var name1 = response['students'][i].full_name;
                        if(name1 != null){
                            var name2 = name1.toUpperCase();
                        }else{
                            var name2 = 'No Name';
                        }

                        var roll = response['students'][i].roll_number;
                        var fatherName1 = response['students'][i].father_name;
                        if(fatherName1 != null){
                            var fatherName2 = fatherName1.toUpperCase();
                        }else{
                            var fatherName2 = 'No Name';
                        }
                       // var fatherName2 = fatherName1.toUpperCase();
                        var gender;
                        if (response['students'][i].gender == 1) {
                            gender = 'Male';
                        } else if (response['students'][i].gender == 2) {
                            gender = 'Female';
                        } else {
                            gender = 'Others';
                        }
                        var tr_str = "<tr>" +
                            "<input type='hidden' value='"+studentId+"' name='student_id[]'>"+
                            "<td>" + roll + "</td>" +
                            "<td>" + name2 + "</td>" +
                            "<td>" + fatherName2 + "</td>" +
                            "<td>" + gender + "</td>" +
                            "<td>" + "<input type='number' class='form-control' name='mark[]'>" + "</td>" +
                            "</tr>";
                        $("#studentTable").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";

                    $("#studentTable tbody").append(tr_str);
                }
            }

            $('#class-dropdown').on('change', function () {
                var classId = this.value;
                //console.log(idClass);
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
                        $('#group-dropdown').html('<option value="">Select</option>');
                        $.each(result.groups, function (key, value) {
                            $("#group-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
            $('#group-dropdown').on('change', function () {
                var groupId = this.value;
                $("#subject-dropdown").html('');
                $.ajax({
                    url: "{{route('fetchSubject')}}",
                    type: "POST",
                    data: {
                        group_id: groupId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#subject-dropdown').html('<option value="">Select</option>');
                        $.each(res.subjects, function (key, value) {
                            $("#subject-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');

                        });
                    }
                });
            });
        });
    </script>
@stop
