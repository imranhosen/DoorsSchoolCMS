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
                                <level for="marksheet" class="bold">Admit Card Template</level>
                                <small class="color"> *</small>
                                <select name="admitcard_id" id="admitcard-dropdown" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($admitcards as $admitcard)
                                        <option value="{{$admitcard->id}}" class="bold">
                                            {{$admitcard->template_name}}
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
    <div class="page-content browse container-fluid" hidden="hidden" id="certificateDiv">
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
    {{--<div class="modal fade in" id="myModal" role="dialog" style="width: 100%; display: block;" aria-hidden="false">--}}
    <div class="modal-dialog modal-lg" style="width: 90%;" id="admitcardDiv">
        {{--<div class="modal fade in" id="myModal" role="dialog" style="width: 100%; display: block;" aria-hidden="false">
            <div class="modal-dialog modal-lg" style="width: 90%;">--}}
               {{-- <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">View Admit Card</h4>
                    </div>
                    <div class="modal-body" id="certificate_detail">


                        <meta charset="utf-8">
                        <link rel="icon" type="image/png" href="assets/img/s-favican.png">
                        <meta http-equiv="X-UA-Compatible" content="">
                        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
                        <meta name="theme-color" content="">
                        <style type="text/css">
                            *{padding: 0; margin:0;}
                            /*            body{padding: 0; margin:0; font-family: arial; color: #000; font-size: 14px; line-height: normal;}*/
                            .tableone{}
                            .tableone td{padding:5px 10px}
                            table.denifittable  {border: 1px solid #999;border-collapse: collapse;}
                            .denifittable th {padding: 10px 10px; font-weight: normal;  border-collapse: collapse;border-right: 1px solid #999; border-bottom: 1px solid #999;}
                            .denifittable td {padding: 10px 10px; font-weight: bold;border-collapse: collapse;border-left: 1px solid #999;}

                            .mark-container{
                                width: 1000px;position: relative;z-index: 2; margin: 0 auto; padding: 20px 30px;}

                            .tcmybg {
                                background:top center;
                                background-size: 100% 100%;
                                position: absolute;
                                top: 0;
                                left: 0;
                                bottom: 0;
                                z-index: 1;
                            }

                        </style>


                        <img src="https://demo.smart-school.in/uploads/admit_card/1684928289-1379369969646df72169629!19_October_33_bys_1.jpg?1684928292"
                             class="tcmybg" width="100%" height="100%">
                        <div class="mark-container">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tbody><tr>
                                    <td valign="top">
                                        <table cellpadding="0" cellspacing="0" width="100%">
                                            <tbody><tr>
                                                <td valign="top" align="center" width="100">
                                                    <img src="https://demo.smart-school.in/uploads/admit_card/1684928289-515890209646df721694c6!samplebackground12.png?1684928292" width="100" height="100">
                                                </td>
                                                <td valign="top">
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody><tr>
                                                            <td valign="top" style="font-size: 26px; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 10px;">HHHHHHHHHHH</td>
                                                        </tr>
                                                        <tr><td valign="top" height="5"></td></tr>
                                                        <tr>
                                                            <td valign="top" style="font-size: 20px;text-align: center; text-transform: uppercase; text-decoration: underline;">
                                                                TTTTTTTTTT</td>
                                                        </tr>
                                                        </tbody></table>
                                                </td>
                                                <td width="100" valign="top" align="center">
                                                    <img src="https://demo.smart-school.in/uploads/admit_card/1684928289-164032210646df721695a5!front_logo-5fb79a079219a1_61523641.jpg?1684928292" width="100" height="100">
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" style="text-align: center; text-transform: capitalize; text-decoration: underline; font-weight: bold; padding-top: 5px;">May-June 2023 Examinations </td>
                                </tr>
                                <tr><td valign="top" height="10"></td></tr>
                                <tr>
                                    <td valign="top">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="text-transform: uppercase;">
                                            <tbody><tr>
                                                <td valign="top">
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody><tr>
                                                            <td valign="top" width="25%" style="padding-bottom: 10px;"> Roll Number</td>
                                                            <td valign="top" width="30%" style="font-weight: bold;padding-bottom: 10px;">161066</td>
                                                            <td valign="top" width="20%" style="padding-bottom: 10px;"> Admission No</td>
                                                            <td valign="top" width="25%" style="font-weight: bold;padding-bottom: 10px;">18S168375</td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="padding-bottom: 10px;"> Candidates Name</td>
                                                            <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">Edward Thomas</td>
                                                            <td valign="top" style="padding-bottom: 10px;"> Class</td>
                                                            <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                                1 (A)
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="padding-bottom: 10px;">Date Of Birth</td>
                                                            <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">8/10/2002</td>
                                                            <td valign="top" style="padding-bottom: 10px;"> Gender</td>
                                                            <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">Male</td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="padding-bottom: 10px;">Father's Name</td>
                                                            <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">Olivier Thomas</td>
                                                            <td valign="top" style="padding-bottom: 10px;">Mother's Name</td>
                                                            <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">Caroline Thomas</td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="padding-bottom: 10px;">Address</td>
                                                            <td colspan="3" valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">56 Main Street, Suite 3, Brooklyn, NY 11210-0000</td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="padding-bottom: 10px;">School Name</td>
                                                            <td valign="top" colspan="3" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">SSSSSSSSSSSSSSSSS</td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" style="padding-bottom: 10px;">Exam Center</td>
                                                            <td valign="top" colspan="3" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"> ECCCCCCCCCCCCCCCCCC</td>
                                                        </tr>
                                                        </tbody></table>
                                                </td>
                                                <td valign="top" width="25%" align="right">
                                                    <img src="https://demo.smart-school.in/uploads/student_images/no_image.png?1684928292" width="100" height="100">
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                <tr><td valign="top" height="10"></td></tr>
                                <tr>
                                    <td valign="top">
                                        <table cellpadding="0" cellspacing="0" width="100%" class="denifittable">
                                            <tbody><tr>
                                                <th valign="top" style="text-align: center; text-transform: uppercase;">Theory Exam Date &amp; Time</th>
                                                <th valign="top" style="text-align: center; text-transform: uppercase;">Paper Code</th>
                                                <th valign="top" style="text-align: center; text-transform: uppercase;">Subject</th>
                                                <th valign="top" style="text-align: center; text-transform: uppercase;">Obtained By Student</th>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align: center;">03-Jun-2023 2 P.M. - 5 P.M.</td>
                                                <td style="text-align: center;text-transform: uppercase;">7713</td>
                                                <td style="text-align: center;text-transform: uppercase;">Mathematics</td>
                                                <td style="text-align: center;text-transform: uppercase;">TH</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align: center;">03-Jun-2023 2 P.M. - 5 P.M.</td>
                                                <td style="text-align: center;text-transform: uppercase;">7714</td>
                                                <td style="text-align: center;text-transform: uppercase;">Sceince</td>
                                                <td style="text-align: center;text-transform: uppercase;">TH</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align: center;">03-Jun-2023 2 P.M. - 5 P.M.</td>
                                                <td style="text-align: center;text-transform: uppercase;">7715</td>
                                                <td style="text-align: center;text-transform: uppercase;">English</td>
                                                <td style="text-align: center;text-transform: uppercase;">TH</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align: center;">03-Jun-2023 2 P.M. - 5 P.M.</td>
                                                <td style="text-align: center;text-transform: uppercase;">7716</td>
                                                <td style="text-align: center;text-transform: uppercase;">Social Science</td>
                                                <td style="text-align: center;text-transform: uppercase;">TH</td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                <tr><td valign="top" height="5"></td></tr>
                                <tr>
                                    <td valign="top" style="padding-bottom: 15px; line-height: normal;"> FTTTTTTTTTTTTTTTTT</td>
                                </tr>
                                <tr><td valign="top" height="20px"></td></tr>
                                <tr>
                                    <td align="right" valign="top">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="text-align: center;">
                                            <tbody><tr>
                                                <td valign="top">
                                                    <img src="https://demo.smart-school.in/uploads/admit_card/1684928289-1937143392646df721695ec!admin.png.jfif?1684928292" width="100" height="38">

                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>

                    </div>
                </div>--}}
            {{--</div>
        </div>--}}
        {{--<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">View Admit Card</h4>
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

                    /*            body{padding: 0; margin:0; font-family: arial; color: #000; font-size: 14px; line-height: normal;}*/
                    .tableone {
                    }

                    .tableone td {
                        padding: 5px 10px
                    }

                    table.denifittable {
                        border: 1px solid #999;
                        border-collapse: collapse;
                    }

                    .denifittable th {
                        padding: 10px 10px;
                        font-weight: normal;
                        border-collapse: collapse;
                        border-right: 1px solid #999;
                        border-bottom: 1px solid #999;
                    }

                    .denifittable td {
                        padding: 10px 10px;
                        font-weight: bold;
                        border-collapse: collapse;
                        border-left: 1px solid #999;
                    }

                    .mark-container {
                        width: 1000px;
                        position: relative;
                        z-index: 2;
                        margin: 0 auto;
                        padding: 20px 30px;
                    }

                    .tcmybg {
                        background: top center;
                        background-size: 100% 100%;
                        position: absolute;
                        top: 0;
                        left: 0;
                        bottom: 0;
                        z-index: 1;
                    }

                </style>

                <div class="mark-container">
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                        <tr>
                            <td valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                    <tr>
                                        <td valign="top" align="center" width="100">
                                            <img
                                                src="https://demo.smart-school.in/uploads/admit_card/1684834463-695510791646c889f9ebba!2.jpg?1684838608"
                                                width="100" height="100">
                                        </td>
                                        <td valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                <tr>
                                                    <td valign="top"
                                                        style="font-size: 26px; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 10px;">
                                                        SSC heading
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" height="5"></td>
                                                </tr>
                                                <tr>
                                                    <td valign="top"
                                                        style="font-size: 20px;text-align: center; text-transform: uppercase; text-decoration: underline;">
                                                        School Admit title
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td width="100" valign="top" align="center">
                                            <img
                                                src="https://demo.smart-school.in/uploads/admit_card/1684834463-1615989119646c889f9eccd!3.jpg?1684838608"
                                                width="100" height="100">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"
                                style="text-align: center; text-transform: capitalize; text-decoration: underline; font-weight: bold; padding-top: 5px;">
                                May-June 2023 Examinations
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" height="10"></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%" style="text-transform: uppercase;">
                                    <tbody>
                                    <tr>
                                        <td valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                <tr>
                                                    <td valign="top" width="25%" style="padding-bottom: 10px;"> Roll
                                                        Number
                                                    </td>
                                                    <td valign="top" width="30%"
                                                        style="font-weight: bold;padding-bottom: 10px;">161066
                                                    </td>
                                                    <td valign="top" width="20%" style="padding-bottom: 10px;">
                                                        Admission No
                                                    </td>
                                                    <td valign="top" width="25%"
                                                        style="font-weight: bold;padding-bottom: 10px;">18S168375
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" style="padding-bottom: 10px;"> Candidates Name</td>
                                                    <td valign="top"
                                                        style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                        Edward Thomas
                                                    </td>
                                                    <td valign="top" style="padding-bottom: 10px;"> Class</td>
                                                    <td valign="top"
                                                        style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                        1 (A)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" style="padding-bottom: 10px;">Date Of Birth</td>
                                                    <td valign="top"
                                                        style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                        8/10/2002
                                                    </td>
                                                    <td valign="top" style="padding-bottom: 10px;"> Gender</td>
                                                    <td valign="top"
                                                        style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                        Male
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" style="padding-bottom: 10px;">Father's Name</td>
                                                    <td valign="top"
                                                        style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                        Olivier Thomas
                                                    </td>
                                                    <td valign="top" style="padding-bottom: 10px;">Mother's Name</td>
                                                    <td valign="top"
                                                        style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                        Caroline Thomas
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" style="padding-bottom: 10px;">Address</td>
                                                    <td colspan="3" valign="top"
                                                        style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                        56 Main Street, Suite 3, Brooklyn, NY 11210-0000
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" style="padding-bottom: 10px;">School Name</td>
                                                    <td valign="top" colspan="3"
                                                        style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                        KJCC
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" style="padding-bottom: 10px;">Exam Center</td>
                                                    <td valign="top" colspan="3"
                                                        style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                        Aiditorium
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td valign="top" width="25%" align="right">
                                            <img
                                                src="https://demo.smart-school.in/uploads/student_images/no_image.png?1684838608"
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
                                <table cellpadding="0" cellspacing="0" width="100%" class="denifittable">
                                    <tbody>
                                    <tr>
                                        <th valign="top" style="text-align: center; text-transform: uppercase;">Theory
                                            Exam Date &amp; Time
                                        </th>
                                        <th valign="top" style="text-align: center; text-transform: uppercase;">Paper
                                            Code
                                        </th>
                                        <th valign="top" style="text-align: center; text-transform: uppercase;">
                                            Subject
                                        </th>
                                        <th valign="top" style="text-align: center; text-transform: uppercase;">Obtained
                                            By Student
                                        </th>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-align: center;">03-Jun-2023 2 P.M. - 5 P.M.</td>
                                        <td style="text-align: center;text-transform: uppercase;">7713</td>
                                        <td style="text-align: center;text-transform: uppercase;">Mathematics</td>
                                        <td style="text-align: center;text-transform: uppercase;">TH</td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-align: center;">03-Jun-2023 2 P.M. - 5 P.M.</td>
                                        <td style="text-align: center;text-transform: uppercase;">7714</td>
                                        <td style="text-align: center;text-transform: uppercase;">Sceince</td>
                                        <td style="text-align: center;text-transform: uppercase;">TH</td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-align: center;">03-Jun-2023 2 P.M. - 5 P.M.</td>
                                        <td style="text-align: center;text-transform: uppercase;">7715</td>
                                        <td style="text-align: center;text-transform: uppercase;">English</td>
                                        <td style="text-align: center;text-transform: uppercase;">TH</td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="text-align: center;">03-Jun-2023 2 P.M. - 5 P.M.</td>
                                        <td style="text-align: center;text-transform: uppercase;">7716</td>
                                        <td style="text-align: center;text-transform: uppercase;">Social Science</td>
                                        <td style="text-align: center;text-transform: uppercase;">TH</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" height="5"></td>
                        </tr>
                        <tr>
                            <td valign="top" style="padding-bottom: 15px; line-height: normal;"> Footer Text</td>
                        </tr>
                        <tr>
                            <td valign="top" height="20px"></td>
                        </tr>
                        <tr>
                            <td align="right" valign="top">
                                <table cellpadding="0" cellspacing="0" width="100%" style="text-align: center;">
                                    <tbody>
                                    <tr>
                                        <td valign="top">
                                            <img
                                                src="https://demo.smart-school.in/uploads/admit_card/1684834463-2131306147646c889f9ed46!4.jpg?1684838608"
                                                width="100" height="38">

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>--}}
    </div>
    {{--</div>--}}

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
                    $('#certificateDiv').show();
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
                var admitcardId = $('#admitcard-dropdown').val();
                var myCheckboxes = new Array();
                $("input[name='student_ids']:checked").each(function () {
                    myCheckboxes.push($(this).val());
                });
                if (admitcardId > 0) {
                    $.ajax({
                        url: "{{route('generateAdmitcard')}}",
                        type: "POST",
                        data: {
                            admitcard_id: admitcardId,
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
                    $('#certificateDiv').hide();
                    $('#admitcardDiv').show();
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
                        var address = res['students'][i].current_address;



                        var heading = res['admitcards'][0].heading;
                        var leftLogo = res['leftLogo'];
                        var rightLogo = res['rightLogo'];
                        var bgImage = res['bgimage'];
                        var signImage = res['sign'];
                        var title = res['admitcards'][0].title;
                        var examName = res['admitcards'][0].exam_name;
                        var schoolName = res['admitcards'][0].school_name;
                        var examCenter = res['admitcards'][0].exam_center;
                        var footerText = res['admitcards'][0].footer_text;

                        var tr_str = "<div class='modal-content'>" +
                            "<div class='modal-header'>" +
                           /* "<button type='button' class='close' data-dismiss='modal' autocomplete='off'>" + '×' + "</button>" +
                            "<h4 class='modal-title'>" + 'View Marksheet' + "</h4>" +*/
                            "</div>" +
                            "<div class='modal-body' id='certificate_detail'>" +
                            `<meta charset="utf-8">
                    <link rel="icon" type="image/png" href="assets/img/s-favican.png">
                    <meta http-equiv="X-UA-Compatible" content="">
                    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
                    <meta name="theme-color" content="">
                    <style type="text/css">
                        *{padding: 0; margin:0;}
                        /*            body{padding: 0; margin:0; font-family: arial; color: #000; font-size: 14px; line-height: normal;}*/
                        .tableone{}
                        .tableone td{padding:5px 10px}
                        table.denifittable  {border: 1px solid #999;border-collapse: collapse;}
                        .denifittable th {padding: 10px 10px; font-weight: normal;  border-collapse: collapse;border-right: 1px solid #999; border-bottom: 1px solid #999;}
                        .denifittable td {padding: 10px 10px; font-weight: bold;border-collapse: collapse;border-left: 1px solid #999;}

                        .mark-container{
                            width: 1000px;position: relative;z-index: 2; margin: 0 auto; padding: 20px 30px;}

                        .tcmybg {
                            background:top center;
                            background-size: 100% 100%;
                            position: absolute;
                            top: 0;
                            left: 0;
                            bottom: 0;
                            z-index: 1;
                        }

                    </style>`;

                            if(res['admitcards'][0].bg_image != null){
                                tr_str += '<img src="' + bgImage + '" class="tcmybg" width="100%" height="100%">'
                            }
                        tr_str +=
                            "<div class='mark-container'>"+
                            "<table cellpadding='0' cellspacing='0' width='100%'>"+
                            "<tbody>"+
                            "<tr>"+
                            "<td valign='top'>"+
                            "<table cellpadding='0' cellspacing='0' width='100%'>"+
                            "<tbody>"+
                            "<tr>";
                            /*'<img src="' + Voyager::image(imageLink) + '" width="100" height="100">'+*/
                        if(res['admitcards'][0].left_logo != null) {
                            tr_str += "<td valign='top' align='center' width='100'>"+
                                '<img src="' + leftLogo + '" width="100" height="100">'+
                                "</td>";
                        }

                        tr_str += "<td valign='top'>"+
                            "<table cellpadding='0' cellspacing='0' width='100%'>"+
                            "<tbody>"+
                            "<tr>"+
                            "<td valign='top' style='font-size: 26px; font-weight: bold; text-align: center; text-transform: uppercase; padding-top: 10px;'>"+
                            heading
                            + "</td>"+
                        "</tr>"+
                        "<tr>"+
                        "<td valign='top' height='5'>"+"</td>"+
                            "</tr>"+
                           "<tr>"+
                            "<td valign='top' style='font-size: 20px;text-align: center; text-transform: uppercase; text-decoration: underline;'>"+
                            title
                        +"</td>"+
                        "</tr>"+
                        "</tbody>"+
                        "</table>"+
                        "</td>";
                        if(res['admitcards'][0].left_logo != null) {
                         tr_str += "<td width='100' valign='top' align='center'>"+
                            '<img src="' + rightLogo + '" width="100" height="100">'+
                           "</td>";
                        }
                        tr_str += "</tr>"+
                            "</tbody>"+
                            "</table>"+
                            "</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td valign='top' style='text-align: center; text-transform: capitalize; text-decoration: underline; font-weight: bold; padding-top: 5px;'>"+
                            examName + "</td>"+
                        "</tr>"+
                        "<tr>"+
                        "<td valign='top' height='10'>"+"</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td valign='top'>"+
                            "<table cellpadding='0' cellspacing='0' width='100%' style='text-transform: uppercase;'>"+
                            "<tbody>"+
                            "<tr>"+
                            "<td valign='top'>"+
                            "<table cellpadding='0' cellspacing='0' width='100%'>"+
                            "<tbody>"+
                            "<tr>"+
                            "<td valign='top' width='25%' style='padding-bottom: 10px;'>" +'Roll Number'+
                        "</td>"+
                        "<td valign='top' width='30%' style='font-weight: bold;padding-bottom: 10px;'>"+rollNumber+
                            "</td>"+
                            "<td valign='top' width='20%' style='padding-bottom: 10px;'>"+
                            'Admission No'+
                        "</td>"+
                        "<td valign='top' width='25%' style='font-weight: bold;padding-bottom: 10px;'>"+admissiomNumber+
                        "</td>"+
                        "</tr>"+
                        "<tr>";
                        if(res['admitcards'][0].name != 0) {
                            tr_str += "<td valign='top' style='padding-bottom: 10px;'>" + 'Candidates Name' + "</td>" +
                                "<td valign='top' style='text-transform: uppercase; font-weight: bold;padding-bottom: 10px;'>" +
                                name +
                                "</td>";
                        }
                        if(res['admitcards'][0].class != 0) {
                            tr_str += "<td valign='top' style='padding-bottom: 10px;'>" + 'Class' + "</td>" +
                                "<td valign='top' style='text-transform: uppercase; font-weight: bold;padding-bottom: 10px;'>" +
                                className +
                                "</td>";
                        }
                        tr_str += "</tr>"+
                            "<tr>";
                        if(res['admitcards'][0].dob != 0) {
                            tr_str += "<td valign='top' style='padding-bottom: 10px;'>" + 'Date Of Birth' + "</td>" +
                                "<td valign='top' style='text-transform: uppercase; font-weight: bold;padding-bottom: 10px;'>" + dob + "</td>";
                        }
                        if(res['admitcards'][0].gender != 0) {
                            tr_str += "<td valign='top' style='padding-bottom: 10px;'>" + 'Gender' + "</td>" +
                            "<td valign='top' style='text-transform: uppercase; font-weight: bold;padding-bottom: 10px;'>" +
                            gender +
                            "</td>";
                        }
                        tr_str += "</tr>"+
                            "<tr>";
                        if(res['admitcards'][0].father_name != 0) {
                            tr_str += "<td valign='top' style='padding-bottom: 10px;'>" + 'Fathers Name' + "</td>" +
                                "<td valign='top' style='text-transform: uppercase; font-weight: bold;padding-bottom: 10px;'>" +
                                fatherName +
                                "</td>";
                        }
                        if(res['admitcards'][0].mother_name != 0) {
                            tr_str += "<td valign='top' style='padding-bottom: 10px;'>" + 'Mothers Name' + "</td>" +
                            "<td valign='top' style='text-transform: uppercase; font-weight: bold;padding-bottom: 10px;'>" +
                            motherName +
                            "</td>";
                        }
                        tr_str += "</tr>"+
                        "<tr>";
                        if(res['admitcards'][0].address != 0) {
                            tr_str += "<td valign='top' style='padding-bottom: 10px;'>" + 'Address' + "</td>" +
                            "<td colspan='3' valign='top' style='text-transform: uppercase; font-weight: bold;padding-bottom: 10px;'>" + address + "</td>";
                        }
                        tr_str += "</tr>"+
                        "<tr>"+"<td valign='top' style='padding-bottom: 10px;'>" + 'School Name' + "</td>" +
                                "<td valign='top' colspan='3' style='text-transform: uppercase; font-weight: bold;padding-bottom: 10px;'>" + schoolName + "</td>"+
                            "</tr>"+"<tr>"+
                            "<td valign='top' style='padding-bottom: 10px;'>"+'Exam Center'+"</td>"+
                        "<td valign='top' colspan='3' style='text-transform: uppercase; font-weight: bold;padding-bottom: 10px;'>"+ examCenter+ "</td>"+
                            "</tr>"+
                            "</tbody>"+
                            "</table>"+
                            "</td>"+
                            "<td valign='top' width='25%' align='right'>"+
                            /*"<img src='https://demo.smart-school.in/uploads/student_images/no_image.png?1684838608' width='100' height='100'>"+*/
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
                            "<table cellpadding='0' cellspacing='0' width='100%' class='denifittable'>"+
                            "<tbody>";

                        var len_schedules = res['schedules'].length;
                        if(len_schedules > 0){
                            tr_str +=  `<tr>
                            <th valign="top" style="text-align: center; text-transform: uppercase;">Theory
                        Exam Date & Time
                        </th>
                        <th valign="top" style="text-align: center; text-transform: uppercase;">Paper
                        Code
                        </th>
                        <th valign="top" style="text-align: center; text-transform: uppercase;">
                            Subject
                            </th>
                            <th valign="top" style="text-align: center; text-transform: uppercase;">Obtained
                        By Student
                        </th>
                        </tr>`;
                            for (var j = 0; j < len_schedules;  j++) {
                             var date = res['schedules'][j].date_of_exam;
                                var d = new Date(res['schedules'][j].date_of_exam);
                                var datestring = d.getDate()  + "-" + (d.getMonth()+1) + "-" + d.getFullYear();
                             var startTime = res['schedules'][j].start_time;
                             var startParts = startTime.split(":");
                                var startDate = new Date();
                                startDate.setHours(startParts[0]);
                                startDate.setMinutes(startParts[1]);
                                var formattedStartTime = startDate.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                             var endTime = res['schedules'][j].end_time;
                                var endParts = endTime.split(":");
                                var endDate = new Date();
                                endDate.setHours(endParts[0]);
                                endDate.setMinutes(endParts[1]);
                                var formattedEndTime = endDate.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                             var subjectName = res['schedules'][j].subject.name;
                             var subjectCode = res['schedules'][j].subject.subject_code;
                                tr_str += "<tr>"+
                                "<td valign='top' style='text-align: center;'>"+datestring+' '+'('+formattedStartTime+' - '+formattedEndTime+')' +"</td>"+
                                "<td style='text-align: center;text-transform: uppercase;'>"+subjectCode+"</td>"+
                                    "<td style='text-align: center;text-transform: uppercase;'>"+subjectName+"</td>"+
                                    "<td style='text-align: center;text-transform: uppercase;'>"+'TH'+"</td>"+
                                    "</tr>";
                            }
                            }
                        tr_str +=
                            "</tbody>"+
                            "</table>"+
                            "<tr>"+
                            "<td valign='top' style='padding-bottom: 15px; line-height: normal;'>"+footerText+"</td>"+
                        "</tr>"+
                        "<tr>"+
                        "<td valign='top' height='20px'>"+"</td>"+
                            "</tr>"+
                            "<tr>"+
                            "<td align=right'' valign=top''>"+
                            "<table cellpadding='0' cellspacing='0' width='100%' style='text-align: center;'>"+
                            "<tbody>"+
                            "<tr>"+
                            "<td valign='top'>"+
                            '<img src="' + signImage + '" width="100" height="38">'+
                            "</td>"+
                            "</tr>"+
                            "</td>"+
                            "</tr>"+
                            "</tbody>"+
                            "</table>"+
                            "</div>"+

                            "</div>"+
                            "</div>"+
                            "</div>";
                        $("#admitcardDiv").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";

                    $("#admitcardDiv").append(tr_str);
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
