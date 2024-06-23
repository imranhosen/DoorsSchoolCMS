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
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="alert alert-primary text-center" style="background-color:#ededff">
                            <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                        </div>
                        <form id="searchStudentClassGroupWaise">
                            <div class="form-group col-sm-3">
                                <span class="text-danger">{{$errors->first('class_id')}}</span>
                                <level for="class" class="bold">Class</level>
                                <small class="req"> *</small>
                                <select name="class_id" id="class-dropdown" class="form-control">
                                    <option value="" class="bold">None</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}" class="bold">
                                            {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('class_id')}}</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <level for="group" class="bold">Group</level>
                                <small class="req"> *</small>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                                <span class="text-danger">{{$errors->first('group_id')}}</span>
                            </div>
                            <div class="form-group col-sm-4">
                                <level for="section" class="bold">Section</level>
                                <small class="req"> *</small>
                                <select id="section-dropdown" name="section_id" class="form-control">
                                    <option value="" class="bold">None</option>
                                    @foreach ($sections as $section)
                                        <option value="{{$section->id}}" class="bold">
                                            {{$section->section}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('section_id')}}</span>
                            </div>
                            <div class="form-group col-sm-1" style="margin-top: 17px">
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
    <div class="page-content browse container-fluid" hidden="hidden" id="studentFeeDiv">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form method="post" action="{{route('studentExamAssignStore')}}" id="assign_form">
                            @csrf
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa-solid fa-pen-to-square"></i> Assign Exam </h3>
                                    <div class="box-tools pull-right">
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <input type="hidden" name="exam_id"
                                                   value="{{$exam->id}}">
                                            <div class=" table-responsive">
                                                <table class="table table-striped" id="studentTable">
                                                    <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="select_all"> All</th>
                                                        <th>Admission Number</th>
                                                        <th>Student Name</th>
                                                        <th>Father Name</th>
                                                        <th>Category</th>
                                                        <th>Gender</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right"
                                                    id="load"
                                                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait..">
                                                Assign
                                            </button>

                                            <br>
                                            <br>
                                        </div>
                                    </div>

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
            $('#select_all').change(function () {
                $('.checkbox').prop('checked', $(this).prop('checked'));
            });
            // $('#showTableBtn').on('click', function () {
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                var sectionId = $('#section-dropdown').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchStudentForExam')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId,
                            section_id: sectionId
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
                $('#studentTable tbody').empty();
                if (response['students'] != null) {
                    len = response['students'].length;
                }
                if (len > 0) {
                    $('#studentFeeDiv').show();
                    for (var i = 0; i < len; i++) {
                        var gender;
                        if (response['students'][i].gender == 1) {
                            gender = 'Male';
                        } else if (response['students'][i].gender == 2) {
                            gender = 'Female';
                        } else {
                            gender = 'Others';
                        }
                        var studentId = response['students'][i].id;
                        var AdmissionNo = response['students'][i].admission_no;
                        var name = response['students'][i].full_name;
                        var className = response['students'][i].clase.name;
                        var categoryName;
                        if ((response['students'][i].student_category) == null) {
                            categoryName = 'None';
                        } else {
                            categoryName = response['students'][i].student_category.name;
                        }
                        var classId = response['students'][i].class_id;
                        var groupId = response['students'][i].group_id;
                        var fatherName = response['students'][i].father_name;
                        var groupName = response['students'][i].group.name;
                        // var gender = response['students'][i].gender;
                        var tr_str = "<tr>" +
                            "<input type='hidden' name='clase_id[]' value='" + classId + "'>" +
                            "<input type='hidden' name='group_id[]' value='" + groupId + "'>" +
                            "<td>" + "<input class='checkbox' type='checkbox' name='student_ids[]' value='" + studentId + "'>" + "</td>" +
                            "<td>" + AdmissionNo + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + categoryName + "</td>" +
                            "<td>" + gender + "</td>" +
                            "</tr>";
                        $("#studentTable").append(tr_str);


                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";
                    $('#studentFeeDiv').show();
                    $('#load').hide();
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
                        $('#group-dropdown').html('<option value="" class="bold">None</option>');
                        $.each(result.groups, function (key, value) {
                            $("#group-dropdown").append('<option value="' + value
                                .id + '" class="bold">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@stop
