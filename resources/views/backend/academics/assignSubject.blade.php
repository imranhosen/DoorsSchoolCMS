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
        <form action="{{route('assignSubject.save')}}" method="post" id="searchStudentClassGroupWaise">
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
                                <small class="color"> *</small>
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
                                <small class="color"> *</small>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-sm-2" style="margin-top: 17px">
                                <button type="button" class="btn btn-primary" id="showTableBtn"><i
                                        class="fa-sharp fa-solid fa-magnifying-glass"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" hidden="hidden" id="assignSubjectDiv">
                <div class="col-lg-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div id="assignSubjectDiv1">
                                <div class="form-group addItem">
                                    <h4 class="bold"><i class="fa-solid fa-user-group"></i> Assign Subject</h4>
                                    <hr>
                                    <div class="form-group col-sm-5">
                                        <level for="subject">Subject</level>
                                        <small class="color"> *</small>
                                        <select id="subject-dropdown" name="subject_id[]" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-5">
                                        <level for="teacher">Teacher</level>
                                        <small class="color"> *</small>
                                        <select name="staff_id[]" id="staff-dropdown" class="form-control">
                                            <option value="">-- Select Teacher --</option>
                                            @foreach ($staffs as $staff)
                                                <option value="{{$staff->id}}">
                                                    {{$staff->full_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2" style="margin-top: 18px">
                                        <span class="btn btn-primary addEventMore" id="addEventMore"><i
                                                class="fa-solid fa-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group float-right" hidden="hidden" id="saveBtnDiv">
                                <button type="submit" class="btn btn-dark" id="saveBtn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div style="display: none" id="assignSubjectDiv2">
            <div id="assignSubjectDiv3">
                <hr>
                <div class="form-group col-sm-5">
                    <level for="subject">Subject</level>
                    <small class="color"> *</small>
                    <select id="subject-dropdown2" name="subject_id[]" class="form-control">
                    </select>
                </div>
                <div class="form-group col-sm-5">
                    <level for="teacher">Teacher</level>
                    <small class="color"> *</small>
                    <select name="staff_id[]" id="staff-dropdown" class="form-control">
                        <option value="">-- Select Teacher --</option>
                        @foreach ($staffs as $staff)
                            <option value="{{$staff->id}}">
                                {{$staff->full_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-2" style="margin-top: 18px">
                    <span class="btn btn-primary addEventMore" id="addEventMore"><i class="fa-solid fa-plus"></i></span>
                    <span class="btn btn-danger removeEventMore" id="removeEventMore"><i class="fa-solid fa-minus"></i></span>
                </div>
            </div>
        </div>
    </div>


@stop
@section('javascript')
    <script>
        $(document).ready(function () {
            $('#group-dropdown').on('change', function () {
                $('#showTableBtn').on('click', function () {
                    $('#assignSubjectDiv').show();
                    $('#saveBtnDiv').show();
                });
            });

            $(document).ready(function () {
                var counter = 0;
                $(document).on("click", ".addEventMore", function () {
                    var itemAdd = $("#assignSubjectDiv2").html();
                    $(this).closest("#assignSubjectDiv1").append(itemAdd);
                    counter++;
                });
                $(document).on("click", ".removeEventMore", function () {
                    $(this).closest("#assignSubjectDiv3").remove();
                    counter -= 1;
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

            $('#group-dropdown').on('change', function () {
                var groupId = this.value;
                $("#subject-dropdown").html('');
                $("#subject-dropdown2").html('');
                $.ajax({
                    url: "{{route('fetchSubject')}}",
                    type: "POST",
                    data: {
                        group_id: groupId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#subject-dropdown').html('<option value="">-- Select Subject --</option>');
                        $.each(res.subjects, function (key, value) {
                            $("#subject-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');

                        });
                        $('#subject-dropdown2').html('<option value="">-- Select Subject --</option>');
                        $.each(res.subjects, function (key, value) {
                            $("#subject-dropdown2").append('<option value="' + value.id + '">' + value.name + '</option>');

                        });
                    }
                });
            });
        });
    </script>
@stop

