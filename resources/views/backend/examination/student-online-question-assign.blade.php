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
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="alert alert-primary text-center" style="background-color:#ededff">
                            <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                        </div>
                        <form id="searchQuestion">
                            <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                <label for="exampleInputEmail1" class="bold">Question Type</label><small
                                    class="req">
                                    *</small>
                                <select id="question_type" name="question_type" class="form-control bold">
                                    <option value=" ">Select</option>
                                    <option value="singlechoice">Single Choice</option>
                                    <option value="multichoice">Multiple Choice</option>
                                    <option value="true_false">True/False</option>
                                    <option value="descriptive">Descriptive</option>
                                </select>
                                <span class="text-danger">{{$errors->first('question_type')}}</span>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                <label for="exampleInputEmail1" class="bold">Question Level</label>
                                <small class="req">*</small>
                                <select id="question_level" name="question_level" class="form-control bold">
                                    <option value=" ">Select</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                                <span class="text-danger">{{$errors->first('question_level')}}</span>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                <label for="exampleInputEmail1" class="bold">Subject</label><small class="req">
                                    *</small>
                                <select id="subject_dropdown" name="subject_id" class="form-control bold">
                                    <option value=" ">Select</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('subject_id')}}</span>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                <label for="exampleInputEmail1" class="bold">Class</label>
                                <small class="req"> *</small>
                                <select name="class_id" id="class-dropdown" class="form-control bold">
                                    <option value="" class="bold">Select</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}">
                                            {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('class_id')}}</span>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                <label for="group" class="bold">Group</label>
                                <small class="req"> *</small>
                                <select id="group-dropdown" name="group_id" class="form-control bold">
                                </select>
                                <span class="text-danger">{{$errors->first('group_id')}}</span>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-3">
                                <label for="section" class="bold">Section</label>
                                <small class="req"> *</small>
                                <select id="section-dropdown" name="section_id" class="form-control bold">
                                    <option value="" class="bold">Select</option>
                                    @foreach ($sections as $section)
                                        <option value="{{$section->id}}">
                                            {{$section->section}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('section_id')}}</span>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 pull-left" style="margin-top: 22px">
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
    <div class="page-content browse container-fluid" id="studentFeeDiv">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form method="post" action="{{route('studentOnlineExamQuestionAssignStore')}}" id="assign_form">
                            @csrf
                            <input type="hidden" name="online_exam_id"
                                   value="{{$exam->id}}" placeholder="question marks"
                                   class="inpwidth40">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="box-title"><i class="fa-solid fa-pen-to-square"></i> Assign Question
                                    </h3>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-dark pull-right" id="showTableBtn">
                                        Assign Q
                                    </button>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 2px" id="questionDiv">
                                <style type="text/css">
                                    .inpwidth40 {
                                        width: 50px;
                                        height: 20px;
                                    }
                                </style>
                                @foreach($questions as $question)
                                    <div class="checkbox" style="margin-left: 20px">
                                        <input type="checkbox" class="question_chk" name="question_ids[]"
                                               value="{{$question->id}}">
                                    </div>
                                    <span style="font-weight: 700"> Q. ID: {{$question->id}}</span>
                                    <br>
                                    {{$question->name}}
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div>
                                                <label for="email" style="font-weight: 700">Marks:</label>
                                                <input type="text" name="question_marks[]"
                                                       value="1.00" placeholder="question marks"
                                                       class="inpwidth40">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="email" style="font-weight: 700">Negative Marks:</label>
                                            <input type="text" name="question_neg_marks[]"
                                                   value="0.25" placeholder="question marks"
                                                   class="inpwidth40">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="email" style="font-weight: 700">Question Type:</label>
                                            @if($question->question_type == 'multichoice')
                                                Multiple Choice
                                            @elseif($question->question_type == 'singlechoice')
                                                Single Choice
                                            @elseif($question->question_type == 'true_false')
                                                True/False
                                            @elseif($question->question_type == 'descriptive')
                                                Descriptive
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <label for="email" style="font-weight: 700">Level:</label>
                                            {{$question->question_level}}
                                        </div>
                                        <div class="col-md-2">
                                            <label for="email" style="font-weight: 700">Subject:</label>
                                            {{$question->subject->name}}
                                        </div>
                                    </div>
                                    <hr>
                                    <!--./row-->
                                @endforeach
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
            $('#searchQuestion').submit(function (e) {
                //alert('hi');
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var questionType = $('#question_type').val();
                var questionLevel = $('#question_level').val();
                var subjectId = $('#subject_dropdown').val();
                var groupId = $('#group-dropdown').val();
                var sectionId = $('#section-dropdown').val();
                if (questionType) {
                    $.ajax({
                        url: "{{route('fetchQuestionForAssignExam')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId,
                            section_id: sectionId,
                            question_type: questionType,
                            question_level: questionLevel,
                            subject_id: subjectId
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
                if (response['questions'] != null) {
                    len = response['questions'].length;
                }
                if (len > 0) {
                    $('#questionDiv').empty();
                    for (var i = 0; i < len; i++) {
                        var q_type;
                        if (response['questions'][i].question_type == 'multichoice') {
                            q_type = 'Multiple Choice';
                        } else if (response['questions'][i].question_type == 'singlechoice') {
                            q_type = 'Single Choice';
                        } else if (response['questions'][i].question_type == 'true_false') {
                            q_type = 'True/False';
                        } else {
                            q_type = 'descriptive';
                        }
                        var QId = response['questions'][i].id;
                        var name = response['questions'][i].name;
                        var questionLevel = response['questions'][i].question_level;
                        var subject = response['questions'][i].subject.name;
                        var tr_str = `<style type="text/css">
                                    .inpwidth40 {
                                        width: 50px;
                                        height: 20px;
                                    }
                                </style>
                        <div class="checkbox" style="margin-left: 20px">
                            <input type="checkbox" class="question_chk" name="question_ids[]"
                                   value="${QId}">
                                    </div>
                                    <span style="font-weight: 700"> Q. ID: ${QId}</span>
                                    <br>
                                    ${name}
                        <div class="row">
                            <div class="col-md-2">
                                <div>
                                    <label for="email" style="font-weight: 700">Marks:</label>
                                    <input type="text" name="question_marks[]"
                                           value="1.00" placeholder="question marks"
                                           class="inpwidth40">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="email" style="font-weight: 700">Negative Marks:</label>
                                <input type="text" name="question_neg_marks[]"
                                       value="0.25" placeholder="question marks"
                                       class="inpwidth40">
                            </div>
                            <div class="col-md-3">
                                <label for="email" style="font-weight: 700">Question Type:</label>
                              ${q_type}
                        </div>
                        <div class="col-md-2">
                            <label for="email" style="font-weight: 700">Level:</label>
                            ${questionLevel}
                        </div>
                        <div class="col-md-2">
                            <label for="email" style="font-weight: 700">Subject:</label>
                            ${subject}
                        </div>
                    </div>
                    <hr>`;
                        $("#questionDiv").append(tr_str);

                    }
                } else {
                    var tr_str = `<div class="col-md-12" align='center'>
                        <h1 class="req"><i>No Record Found</i></h1>
                    </div>`;
                    //$('#studentFeeDiv').show();
                   // $('#load').hide();
                    $('#questionDiv').empty();
                    $("#questionDiv").append(tr_str);
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
                        $('#group-dropdown').html('<option value="">Select</option>');
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
