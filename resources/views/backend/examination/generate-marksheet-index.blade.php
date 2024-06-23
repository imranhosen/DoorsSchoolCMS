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
                        <form id="searchStudentClassGroupSectionWaise">
                            <div class="form-group col-md-4">
                                <level for="examGroup" class="bold">Exam Group</level>
                                <small class="color"> *</small>
                                <select name="examgroup_id" id="examgroup-dropdown" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($examGroups as $examGroup)
                                        <option value="{{$examGroup->id}}" class="bold">
                                            {{$examGroup->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <level for="exam" class="bold">Exam</level>
                                <small class="color"> *</small>
                                <select id="exam-dropdown" name="exam_id" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <level for="session" class="bold">Session</level>
                                <small class="color"> *</small>
                                <select name="session_id" id="session-dropdown" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($sessions as $session)
                                        <option value="{{$session->id}}" class="bold">
                                            {{$session->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <level for="class" class="bold">Class</level>
                                <small class="color"> *</small>
                                <select name="class_id" id="class-dropdown" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}" class="bold">
                                            {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <level for="group" class="bold">Group</level>
                                <small class="color"> *</small>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <level for="section" class="bold">Section</level>
                                <small class="color"> *</small>
                                <select name="section_id" id="section-dropdown" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($sections as $section)
                                        <option value="{{$section->id}}" class="bold">
                                            {{$section->section}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <level for="marksheet" class="bold">Marksheet Template</level>
                                <small class="color"> *</small>
                                <select name="marksheet_id" id="marksheet-dropdown" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($marksheets as $marksheet)
                                        <option value="{{$marksheet->id}}" class="bold">
                                            {{$marksheet->template_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-1 pull-right">
                                <button type="submit" class="btn btn-primary" id="showTableBtn">Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid" hidden="hidden" id="studentDiv">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form id="createMarksheet">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <h4 style="color: #134013; margin-top: 12px"><i class="fa-solid fa-user-group"></i>
                                        <bold> Student List</bold>
                                    </h4>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <button type="submit" class="btn btn-dark btn-sm pull-right pull-top"
                                            id="load" style="margin-bottom: 10px">
                                        Generate
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class=" table-responsive">
                                    <table class="table table-striped" id="studentTable">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select_all"> All</th>
                                            <th>Admission Number</th>
                                            <th>Student Name</th>
                                            <th>Roll Number</th>
                                            <th>Father Name</th>
                                            <th>Date of Birth</th>
                                            <th>Gender</th>
                                            <th>Mobile Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog" style="width: 100%; display: none;" aria-hidden="true">

    </div>

    <div class="modal-dialog modal-lg" style="width: 95%; " id="marksheet">
        {{--<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" autocomplete="off">×</button>
                <h4 class="modal-title">View Marksheet</h4>
            </div>
            <div class="modal-body" id="certificate_detail">


                <meta charset="utf-8">
                <link rel="icon" type="image/png" href="assets/img/s-favican.png">
                <meta http-equiv="X-UA-Compatible" content="">
                <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
                      name="viewport">
                <meta name="theme-color" content="">
                <style type="text/css">
                    * {
                        padding: 0;
                        margin: 0;
                    }

                    .body {
                        padding: 0;
                        margin: 0;
                        font-family: arial;
                        color: #000;
                        font-size: 14px;
                        line-height: normal;
                    }

                    .tableone {
                    }

                    .tableone td {
                        border: 1px solid #000;
                        padding: 5px 0
                    }

                    .denifittable th {
                        border-top: 1px solid #999;
                    }

                    .denifittable th,
                    .denifittable td {
                        border-bottom: 1px solid #999;
                        border-collapse: collapse;
                        border-left: 1px solid #999;
                    }

                    .denifittable tr th {
                        padding: 10px 10px;
                        font-weight: bold;
                    }

                    .denifittable tr td {
                        padding: 10px 10px;
                        font-weight: bold;
                    }

                    .tcmybg {
                        background: top center;
                        background-size: 100% 100%;
                        position: absolute;
                        top: 0;
                        left: 0;
                        bottom: 0;
                        z-index: 0;
                    }
                </style>


                <div
                    style="width: 100%; margin: 0 auto; border:1px solid #000; padding: 10px 5px 5px;position: relative;">
                    <img
                        src="https://demo.smart-school.in/uploads/marksheet/1684294560-4142030064644ba04acef!2.jpg?1684295176"
                        width="100%" height="300px;">

                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                        <tr>
                            <td valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="100" valign="top" align="center" style="padding-left: 0px;">
                                            <img
                                                src="https://demo.smart-school.in/uploads/marksheet/1684294560-46981366164644ba04aa1d!3.jpg?1684295176"
                                                width="100" height="100">
                                        </td>
                                        <td valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                <tr>
                                                    <td valign="top"
                                                        style="font-size: 20px; font-weight: bold; text-align: center; text-transform: uppercase;">
                                                        Final
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" height="5"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center; font-weight: bold" valign="top">
                                                        2021
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td width="100" valign="top" align="right" style="padding-right: 0px;">
                                            <img
                                                src="https://demo.smart-school.in/uploads/marksheet/1684294560-160119333864644ba04aaf1!4.jpg?1684295176"
                                                width="100" height="100">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" height="10"></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%" class="">
                                    <tbody>
                                    <tr>
                                        <td valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%" class="denifittable">
                                                <tbody>
                                                <tr>
                                                    <th valign="top"
                                                        style="text-align: center; text-transform: uppercase;">
                                                        Admission No
                                                    </th>

                                                    <th valign="top"
                                                        style="text-align: center; text-transform: uppercase; border-right:1px solid #999">
                                                        Roll Number
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <td valign="" style="text-transform: uppercase;text-align: center;">
                                                        XXXXXX
                                                    </td>
                                                    <td valign=""
                                                        style="text-transform: uppercase;text-align: center;border-right:1px solid #999">
                                                        XXXXXX
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" colspan="5"
                                                        style="text-align: center; text-transform: uppercase; border:0">

                                                        Certificated That
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td width="100" valign="top" align="center" style="padding-left: 5px;">
                                            <img
                                                src="https://demo.smart-school.in/uploads/student_images/no_image.png?1684295176"
                                                width="100" height="100">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" height="5"></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%" class="">
                                    <tbody>
                                    <tr>
                                        <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;">
                                            Mr/Ms<span style="padding-left: 30px; font-weight: bold;">Reeta singh</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;">
                                            Father / Husband Name<span style="padding-left: 30px; font-weight: bold;">Mangu singh</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;">
                                            Mother Name<span style="padding-left: 30px; font-weight: bold;">sombati singh</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"> Date
                                            Of Birth<span
                                                style="padding-left: 30px; font-weight: bold;">12-01-2022</span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;"> Class<span
                                                style="padding-left: 30px; font-weight: bold;">
                                                                                            1 (A)
                                                                                        </span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;">
                                            School Name<span style="padding-left: 30px; font-weight: bold;">ABC</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-transform: uppercase; padding-bottom: 15px;">Exam
                                            Center<span
                                                style="text-transform: uppercase; padding-top: 15px; font-weight: bold; padding-bottom: 20px; padding-left: 30px;">College Venue</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top"
                                            style="text-transform: uppercase; padding-bottom: 15px; line-height: normal;">
                                            Here goes body text
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%" class="denifittable"
                                       style="text-align: center; text-transform: uppercase;">
                                    <tbody>
                                    <tr>
                                        <th valign="middle" width="35%">Subjects</th>
                                        <th valign="middle" style="text-align: center;">Max Marks</th>
                                        <th valign="middle" style="text-align: center;">Min Marks</th>
                                        <th valign="top" style="text-align: center;">Marks Obtained</th>
                                        <th valign="middle" style="border-right:1px solid #999; text-align: center;">
                                            Remarks
                                        </th>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-align: left;">Hindi [special]</td>
                                        <td valign="top" style="text-align: center;">100</td>
                                        <td valign="top" style="text-align: center;">33</td>
                                        <td valign="top" style="text-align: center;">085</td>
                                        <td valign="top" style="text-align: center;border-right:1px solid #999;">
                                            Distin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-align: left;">English [General]</td>
                                        <td valign="top" style="text-align: center;">100</td>
                                        <td valign="top" style="text-align: center;">33</td>
                                        <td valign="top" style="text-align: center;">051</td>
                                        <td valign="top" style="text-align: center;border-right:1px solid #999"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-align: left;">Physics</td>
                                        <td valign="top" style="text-align: center;">100</td>
                                        <td valign="top" style="text-align: center;">25</td>
                                        <td valign="top" style="text-align: center;">066</td>
                                        <td valign="top" style="text-align: center;border-right:1px solid #999"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-align: left;">Chemistry</td>
                                        <td valign="top" style="text-align: center;">100</td>
                                        <td valign="top" style="text-align: center;">027</td>
                                        <td valign="top" style="text-align: center;">049</td>
                                        <td valign="top" style="text-align: center;border-right:1px solid #999"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-align: left;">Mathematics</td>
                                        <td valign="top" style="text-align: center;">100</td>
                                        <td valign="top" style="text-align: center;">33</td>
                                        <td valign="top" style="text-align: center;">033</td>
                                        <td valign="top" style="text-align: center;border-right:1px solid #999"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top"></td>
                                        <td valign="top" colspan="0" style="border-left:0">500</td>
                                        <td valign="top" colspan="0">Grand Total</td>
                                        <td valign="top" style="text-align: center;">284</td>
                                        <td valign="top" style="text-align: center;border-right:1px solid #999"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="5" width="20%"
                                            style="font-weight: normal; text-align: left; border-right: 1px solid #999;">
                                            Grand Total In Words: <span
                                                style="text-align: left;font-weight: bold; padding-left: 30px;">Two hundred eighty four</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="5" width="20%"
                                            style="font-weight: normal; text-align: left; border-top:0;border-right: 1px solid #999;">
                                            Result<span style="text-align: left;font-weight: bold; padding-left: 30px;">Pass In Second Division</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" height="10"></td>
                        </tr>
                        <tr>
                            <td valign="top" style="font-weight: bold; padding-left: 30px; padding-top: 10px;">
                                05/17/2023
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" height="30"></td>
                        </tr>
                        <tr>
                            <td valign="top"
                                style="text-transform: uppercase; padding-bottom: 15px; line-height: normal;"> Here
                                footerbody text
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%" class="">
                                    <tbody>
                                    <tr>
                                        <td valign="bottom" style="font-size: 12px;">
                                        </td>
                                        <td valign="bottom" align="center" style="text-transform: uppercase;">
                                            <img
                                                src="https://demo.smart-school.in/uploads/marksheet/1684294560-103147836964644ba04ab9b!5.jpg?1684295176"
                                                width="100" height="50">
                                        </td>
                                        <td valign="bottom" align="center" style="text-transform: uppercase;">

                                            <img
                                                src="https://demo.smart-school.in/uploads/marksheet/1684294560-174751021964644ba04abef!6.jpg?1684295176"
                                                width="100" height="50">
                                        </td>
                                        <td valign="bottom" align="center" style="text-transform: uppercase;">
                                            <img
                                                src="https://demo.smart-school.in/uploads/marksheet/1684294560-4614125164644ba04ac49!7.jpg?1684295176"
                                                width="100" height="50">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" height="20"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>--}}
    </div>

@stop



@section('javascript')

    <script>
        $(document).ready(function () {
            /*$('#searchStudentClassGroupSectionWaise').validate({
                rules: {
                    class_id: {
                        required: true,
                    },
                    group_id: {
                        required: true,
                    },
                    section_id: {
                        required: true,
                    },
                    examgroup_id: {
                        required: true,
                    },
                    exam_id: {
                        required: true,
                    },
                    session_id: {
                        required: true,
                    },
                    marksheet_id: {
                        required: true,
                    }
                },
                messages: {

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-valid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-valid');
                }
            });*/
            $('#select_all').change(function () {
                $('.checkbox').prop('checked', $(this).prop('checked'));
                $('.checkbox').on('click', function () {
                    if ($('.checkbox:checked').length == $('.checkbox').length) {
                        $('#select_all').prop('checked', true);
                    } else {
                        $('#select_all').prop('checked', false);
                    }
                });
            });
            $('#searchStudentClassGroupSectionWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                var examGroupId = $('#examgroup-dropdown').val();
                var examId = $('#exam-dropdown').val();
                var sessionId = $('#session-dropdown').val();
                var sectionId = $('#section-dropdown').val();
                var marksheetId = $('#marksheet-dropdown').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchStudentForMarksheet')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId,
                            examgroup_id: examGroupId,
                            exam_id: examId,
                            session_id: sessionId,
                            section_id: sectionId,
                            marksheet_id: marksheetId
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
                    $('#studentDiv').show();
                    //var certificateId = response['certificates'][0].id;
                    //alert(certificateId);
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
                        var rollNo = response['students'][i].roll_number;
                        var name = response['students'][i].full_name;
                        var className = response['students'][i].clase.name;
                        var classId = response['students'][i].class_id;
                        var groupId = response['students'][i].group_id;
                        var fatherName = response['students'][i].father_name;
                        var dob = response['students'][i].birth_date;
                        var groupName = response['students'][i].group.name;
                        var mobileNumber = response['students'][i].mobile_number;
                        // var gender = response['students'][i].gender;
                        var tr_str = "<tr>" +
                            "<input type='hidden' name='clase_id[]' value='" + classId + "'>" +
                            "<input type='hidden' name='group_id[]' value='" + groupId + "'>" +
                            /*"<input type='hidden' id='certificate_id' name='certificate_id' value='" + certificateId + "'>" +*/
                            "<td>" + "<input class='checkbox' id='student_id' type='checkbox' name='student_ids' value='" + studentId + "'>" + "</td>" +
                            "<td>" + AdmissionNo + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + rollNo + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + dob + "</td>" +
                            "<td>" + gender + "</td>" +
                            "<td>" + mobileNumber + "</td>" +
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

            $('#createMarksheet').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                var examGroupId = $('#examgroup-dropdown').val();
                var examId = $('#exam-dropdown').val();
                var sessionId = $('#session-dropdown').val();
                var sectionId = $('#section-dropdown').val();
                var marksheetId = $('#marksheet-dropdown').val();
                var myCheckboxes = new Array();
                $("input[name='student_ids']:checked").each(function () {
                    myCheckboxes.push($(this).val());
                });
                if (marksheetId > 0) {
                    $.ajax({
                        url: "{{route('generateMarksheet')}}",
                        type: "POST",
                        data: {
                            marksheet_id: marksheetId,
                            student_ids: myCheckboxes,
                            exam_group_id: examGroupId,
                            exam_id: examId,
                            session_id: sessionId,
                            section_id: sectionId,
                            class_id: classId,
                            group_id: groupId

                        },
                        dataType: 'json',
                        success: function (res) {
                            console.log(res);
                            /*$('#myModal').modal('show');
                            $('#myModal').html(res.modal);*/
                            createRows2(res);

                        }
                    });
                }
            });
            function createRows2(res) {
                var len = 0;
                var len2 = 0;
                if (res['students'] != null) {
                    len = res['students'].length;
                }
                if (len > 0) {
                    $('#studentDiv').hide();
                    $('#marksheet').show();
                    //var certificateId = response['certificates'][0].id;
                    //alert(certificateId);
                    for (var i = 0; i < len; i++) {
                        var gender;
                        if (res['students'][i].gender == 1) {
                            gender = 'Male';
                        } else if (res['students'][i].gender == 2) {
                            gender = 'Female';
                        } else {
                            gender = 'Others';
                        }
                        var studentId = res['students'][i].id;
                        var admissiomNumber = res['students'][i].admission_no;
                        var rollNumber = res['students'][i].roll_number;
                        var name = res['students'][i].full_name;
                        var className = res['students'][i].clase.name;
                        var sessionName = res['students'][i].session.name;
                        var classId = res['students'][i].class_id;
                        var groupId = res['students'][i].group_id;
                        var fatherName = res['students'][i].father_name;
                        var motherName = res['students'][i].mother_name;
                        var dob = res['students'][i].birth_date;
                        var groupName = res['students'][i].group.name;
                        var mobileNumber = res['students'][i].mobile_number;



                        var examName = res['marksheets'][0].exam_name;
                        var schoolName = res['marksheets'][0].school_name;
                        var examCenter = res['marksheets'][0].exam_center;
                        var bodyText = res['marksheets'][0].body_text;

                        var tr_str = "<div class='modal-content'>" +
                            "<div class='modal-header'>" +
                            "<button type='button' class='close' data-dismiss='modal' autocomplete='off'>" + '×' + "</button>" +
                            "<h4 class='modal-title'>" + 'View Marksheet' + "</h4>" +
                            "</div>" +
                            "<div class='modal-body' id='certificate_detail'>" +
                            `<meta charset="utf-8">
                            <link rel="icon" type="image/png" href="assets/img/s-favican.png">
                            <meta http-equiv="X-UA-Compatible" content="">
                            <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
                            <meta name="theme-color" content="">
                            <style type="text/css">
                            *{padding: 0; margin:0;}
                    .body{padding: 0; margin:0; font-family: arial; color: #000; font-size: 14px; line-height: normal;}
                    .tableone{}
                    .tableone td{border:1px solid #000; padding: 5px 0}
                    .denifittable th{border-top: 1px solid #999;}
                    .denifittable th,
                    .denifittable td {border-bottom: 1px solid #999;
                            border-collapse: collapse;border-left: 1px solid #999;}
                    .denifittable tr th {padding: 10px 10px; font-weight: bold;}
                    .denifittable tr td {padding: 10px 10px; font-weight: bold;}
                    .tcmybg {
                            background:top center;
                            background-size: 100% 100%;
                            position: absolute;
                            top: 0;
                            left: 0;
                            bottom: 0;
                            z-index: 0;
                        }
                    </style>`+
                            "<div style='width: 100%; margin: 0 auto; border:1px solid #000; padding: 10px 5px 5px;position: relative;'>"+
                            /*"<img src='https://demo.smart-school.in/uploads/marksheet/1684294560-4142030064644ba04acef!2.jpg?1684295176' width='100%' height='300px'>"+*/

                            "<table cellpadding='0' cellspacing='0' width='100%'>"+
                            "<tbody>"+
                            "<tr>"+
                            "<td valign='top'>"+
                            "<table cellpadding='0' cellspacing='0' width='100%'>"+
                            "<tbody>"+
                            "<tr>"+
                            "<td width='100' valign='top' align='center' style='padding-left: 0px;'>"+
                            /*"<img src='https://demo.smart-school.in/uploads/marksheet/1684294560-46981366164644ba04aa1d!3.jpg?1684295176'width='100' height='100'>"+*/
                            "</td>"+
                            "<td valign='top'>"+
                            "<table cellpadding='0' cellspacing='0' width='100%'>"+
                            "<tbody>"+
                            "<tr>"+
                            "<td valign='top' style='font-size: 20px; font-weight: bold; text-align: center; text-transform: uppercase;'>"+ examName +
                            "</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td valign='top' height='5'>"+"</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td style='text-align: center; font-weight: bold' valign='top'>"+ sessionName +
                            "</td>"+
                            "</tr>"+
                            "</tbody>"+
                            "</table>"+
                            "</td>"+
                            "<td width='100' valign='top' align='right' style='padding-right: 0px;'>"+
                            "<img src='https://demo.smart-school.in/uploads/marksheet/1684294560-160119333864644ba04aaf1!4.jpg?1684295176' width='100' height='100'>"+
                            "</td>"+
                            "</tr>"+
                            "</tbody>"+
                            "</table>"+
                            "</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td valign='top' height='10'>"+"</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td valign='top'>"+
                            "<table cellpadding='0' cellspacing='0' width='100%' class=''>"+
                            "<tbody>"+
                            "<tr>"+
                            "<td valign='top'>"+
                            "<table cellpadding='0' cellspacing='0' width='100%' class='denifittable'>"+
                            "<tbody>"+
                            "<tr>"+
                            "<th valign='top' style='text-align: center; text-transform: uppercase;'>"+ 'Admission No'+
                            "</th>"+
                        "<th valign='top' style='text-align: center; text-transform: uppercase; border-right:1px solid #999'>"+ 'Roll Number'+
                        "</th>"+

                        "</tr>"+
                        "<tr>"+
                        "<td valign='' style='text-transform: uppercase;text-align: center;'>"+admissiomNumber+
                            "</td>"+
                         "<td valign='' style='text-transform: uppercase;text-align: center;border-right:1px solid #999'>"+rollNumber+
                            "</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td valign='top' colspan='5' style='text-align: center; text-transform: uppercase; border:0'>"+'Certificated That'+"</td>"+
                            "</tr>"+
                        "</tbody>"+
                        "</table>"+
                        "</td>"+
                        "<td width='100' valign='top' align='center' style='padding-left: 5px;'>"+
                            /*"<img src='https://demo.smart-school.in/uploads/student_images/no_image.png?1684295176' width='100' height='100'>"+*/
                            "</td>"+
                            "</tr>"+
                            "</tbody>"+
                            "</table>"+
                            "</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td valign='top' height='5'>"+"</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td valign='top'>"+
                            "<table cellpadding='0' cellspacing='0' width='100%' class=''>"+
                            "<tbody>";
                            if(res['marksheets'][0].name != 0){
                            tr_str +=
                                "<tr>"+"<td valign='top' style='text-transform: uppercase; padding-bottom: 15px;'>"+
                            'Mr/Ms :'+"<span style='padding-left: 30px; font-weight: bold;'>"+ name +"</span>"+"</td>"+
                                "</tr>";
                            }
                        if(res['marksheets'][0].father_name != 0){
                            tr_str += "<tr>"+
                        "<td valign='top' style='text-transform: uppercase; padding-bottom: 15px;'>"+
                            'Father / Husband Name :'+"<span style='padding-left: 30px; font-weight: bold;'>"+ fatherName+"</span>"+
                        "</td>"+
                        "</tr>";
                        }
                        if(res['marksheets'][0].mother_name != 0){
                        tr_str += "<tr>"+
                        "<td valign='top' style='text-transform: uppercase; padding-bottom: 15px;'>"+
                            'Mother Name :'+"<span style='padding-left: 30px; font-weight: bold;'>"+ motherName +"</span>"+
                        "</td>"+
                        "</tr>";
                        }
                        if(res['marksheets'][0].dob != 0){
                        tr_str += "<tr>"+
                        "<td valign='top' style='text-transform: uppercase; padding-bottom: 15px;'>"+ 'Date of Birth :'+ "<span style='padding-left: 30px; font-weight: bold;'>"+dob+"</span>"+"</td>"+
                        "</tr>";}

                        if(res['marksheets'][0].class != 0){
                            tr_str += "<tr>"+
                        "<td valign='top' style='text-transform: uppercase; padding-bottom: 15px;'>"+ 'Class :' +
                            "<span style='padding-left: 30px; font-weight: bold;'>"+className+ "</span>"+
                         "</td>"+
                        "</tr>";
                        }
                        tr_str += "<tr>"+
                        "<td valign='top' style='text-transform: uppercase; padding-bottom: 15px;'>"+ 'SchoolName :'+
                            "<span style='padding-left: 30px; font-weight: bold;'>"+schoolName+"</span>"+
                            "</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td valign='top' style='text-transform: uppercase; padding-bottom: 15px;'>"+'ExamCenter'+
                            "<span style='text-transform: uppercase; padding-top: 15px; font-weight: bold; padding-bottom: 20px; padding-left: 30px;'>"+examCenter+"</span>"+
                        "</td>"+
                        "</tr>"+
                        "<tr>"+
                        "<td valign='top' style='text-transform: uppercase; padding-bottom: 15px; line-height: normal;'>"+bodyText+"</td>"+
                        "</tr>"+
                        "</tbody>"+
                        "</table>"+
                        "</td>"+
                        "</tr>";

                        var len_marks = res['students'][i]['marks'].length;
                        if (len_marks > 0) {
                            tr_str += "<tr id='row1'>" +
                                "<td valign='top'>" +
                                "<table cellpadding='0' cellspacing='0' width='100%' class='denifittable' style='text-align: center; text-transform: uppercase;'>" +
                                "<tbody>" +
                                "<tr>" +
                                "<th valign='middle' width='35%'>" + 'Subjects' + "</th>" +
                                "<th valign='middle' style='text-align: center;'>" + 'Max Marks' + "</th>" +
                                "<th valign='middle' style='text-align: center;'>" + 'Pass Marks' + "</th>" +
                                "<th valign='top' style='text-align: center;'>" + 'Marks Obtained' + "</th>" +
                                "<th valign='middle' style='border-right:1px solid #999; text-align: center;'>" + 'Remarks' + "</th>" +
                                "</tr>";
                            var getMarks = 0;
                            var totalMarks = 0;
                            for (var j = 0; j < len_marks;  j++) {

                                var subjectName = res['students'][i]['marks'][j].subject.name;
                                var marks = res['students'][i]['marks'][j].mark;
                                var getMarks = (getMarks+ +marks);
                                tr_str += "<tr>" +
                                    "<td valign='top' style='text-align: left;'>" + subjectName + "</td>";

                                       var len_ranges = res['students'][i]['marks'][j]['ranges'].length;
                                       if(len_ranges > 0){
                                           for (var k = 0; k < len_ranges;  k++) {
                                               var maxMark = res['students'][i]['marks'][j]['ranges'][k].full_marks;
                                               var totalMarks = (totalMarks + + maxMark);
                                               var passMark = res['students'][i]['marks'][j]['ranges'][k].pass_marks;
                                               tr_str +=  "<td valign='top' style='text-align: center;'>" + maxMark + "</td>" +
                                                   "<td valign='top' style='text-align: center;'>" + passMark + "</td>" ;
                                           }

                                       }
                                tr_str +=  "<td valign='top' style='text-align: center;'>" + marks + "</td>" +
                                    "<td valign='top' style='text-align: center;border-right:1px solid #999;'>" + 'Distin' + "</td>" +
                                    "</tr>";
                            }
                           // var numberToWords = require('number-to-words');
                            //alert(toWords(totalMarks));
                            tr_str += "<tr>"+
                                "<td valign='top'>"+'Total Marks'+"</td>"+
                                "<td valign='top' colspan='0' style='border-left:0'>"+totalMarks+"</td>"+
                                "<td valign='top' colspan='0'>"+'Grand Total'+"</td>"+
                                "<td valign='top' style='text-align: center;'>"+getMarks+"</td>"+
                                "<td valign='top' style='text-align: center;border-right:1px solid #999'>"+"</td>"+
                                "</tr>"+
                                "</tbody>" +
                                "</table>" +
                                "</td>" +
                                "</tr>";
                        }
                        tr_str +=  "</div></div>";
                        $("#marksheet").append(tr_str);
                        /*for(var j = 0; j < len2; j++){
                            var subjectName = res['marks'][j].subject.name;
                            var marks = res['marks'][j].mark;
                            var tr_str2 = "<td valign='top'>"+
                                "<table cellpadding='0' cellspacing='0' width='100%' class='denifittable' style='text-align: center; text-transform: uppercase;'>"+
                                "<tbody>"+
                                "<tr>"+
                                "<th valign='middle' width='35%'>"+'Subjects'+"</th>"+
                                "<th valign='middle' style='text-align: center;'>"+'Max Marks'+"</th>"+
                            "<th valign='middle' style='text-align: center;'>"+'Min Marks'+"</th>"+
                            "<th valign='top' style='text-align: center;'>"+'Marks Obtained'+"</th>"+
                            "<th valign='middle' style='border-right:1px solid #999; text-align: center;'>"+ 'Remarks' +"</th>"+
                                "</tr>"+
                                "<tr>"+
                                "<td valign='top' style='text-align: left;'>"+subjectName+"</td>"+
                                "<td valign='top' style='text-align: center;'>"+'100'+"</td>"+
                                "<td valign='top' style='text-align: center;'>"+'33'+"</td>"+
                                "<td valign='top' style='text-align: center;'>"+marks+"</td>"+
                                "<td valign='top' style='text-align: center;border-right:1px solid #999;'>"+'Distin'+"</td>"+
                                "</tr>"+
                            "</tbody>"+
                            "</table>"+
                            "</td>";
                            $("#row1").append(tr_str2);
                        }*/
                        /*for(var j = 1; j < len2; j++){
                            var subjectName = res['marks'][j].subject.name;
                            var marks = res['marks'][j].mark;
                            var tr_str2 = "<td valign='top'>"+
                                "<table cellpadding='0' cellspacing='0' width='100%' class='denifittable' style='text-align: center; text-transform: uppercase;'>"+
                                "<tbody>"+
                                "<tr>"+
                                "<th valign='middle' width='35%'>"+'Subjects'+"</th>"+
                                "<th valign='middle' style='text-align: center;'>"+'Max Marks'+"</th>"+
                                "<th valign='middle' style='text-align: center;'>"+'Min Marks'+"</th>"+
                                "<th valign='top' style='text-align: center;'>"+'Marks Obtained'+"</th>"+
                                "<th valign='middle' style='border-right:1px solid #999; text-align: center;'>"+ 'Remarks' +"</th>"+
                                "</tr>"+
                                "<tr>"+
                                "<td valign='top' style='text-align: left;'>"+subjectName+"</td>"+
                                "<td valign='top' style='text-align: center;'>"+'100'+"</td>"+
                                "<td valign='top' style='text-align: center;'>"+'33'+"</td>"+
                                "<td valign='top' style='text-align: center;'>"+marks+"</td>"+
                                "<td valign='top' style='text-align: center;border-right:1px solid #999;'>"+'Distin'+"</td>"+
                                "</tr>"+
                                "</tbody>"+
                                "</table>"+
                                "</td>";
                            $("#row1").append(tr_str2);
                        }*/
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";

                    $("#marksheet").append(tr_str);
                }
                /*for(var j = 0; j < len2; j++){
                    var subjectName = res['marks'][j].subject.name;
                    var marks = res['marks'][j].mark;
                    var tr_str2 = "<td valign='top'>"+
                        "<table cellpadding='0' cellspacing='0' width='100%' class='denifittable' style='text-align: center; text-transform: uppercase;'>"+
                        "<tbody>"+
                        "<tr>"+
                        "<th valign='middle' width='35%'>"+'Subjects'+"</th>"+
                        "<th valign='middle' style='text-align: center;'>"+'Max Marks'+"</th>"+
                        "<th valign='middle' style='text-align: center;'>"+'Min Marks'+"</th>"+
                        "<th valign='top' style='text-align: center;'>"+'Marks Obtained'+"</th>"+
                        "<th valign='middle' style='border-right:1px solid #999; text-align: center;'>"+ 'Remarks' +"</th>"+
                        "</tr>"+
                        "<tr>"+
                        "<td valign='top' style='text-align: left;'>"+subjectName+"</td>"+
                        "<td valign='top' style='text-align: center;'>"+'100'+"</td>"+
                        "<td valign='top' style='text-align: center;'>"+'33'+"</td>"+
                        "<td valign='top' style='text-align: center;'>"+marks+"</td>"+
                        "<td valign='top' style='text-align: center;border-right:1px solid #999;'>"+'Distin'+"</td>"+
                        "</tr>"+
                        "</tbody>"+
                        "</table>"+
                        "</td>";
                    $("#row1").append(tr_str2);
                }*/
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
                        $('#group-dropdown').html('<option value="">None</option>');
                        $.each(result.groups, function (key, value) {
                            $("#group-dropdown").append('<option value="' + value
                                .id + '" class="bold">' + value.name + '</option>');
                        });
                    }
                });
            });
            $('#examgroup-dropdown').on('change', function () {
                var examGroupId = this.value;
                //console.log(idClass);
                $("#exam-dropdown").html('');
                $.ajax({
                    url: "{{route('fetchExam')}}",
                    type: "POST",
                    data: {
                        examgroup_id: examGroupId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#exam-dropdown').html('<option value="">None</option>');
                        $.each(result.exams, function (key, value) {
                            $("#exam-dropdown").append('<option value="' + value
                                .id + '" class="bold">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>
@stop
