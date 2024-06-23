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
                            <h4 style="color: #134013"><em><strong>Your Details</strong></em></h4>
                            @foreach($students as $student)
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid" id="studentHistoryDiv1">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <h4 class="bold" style="text-align: center"><i class="voyager-book"></i>Your Subjects</h4>
                        <hr>
                        <table class="table" id="studentTable1">
                            <thead>
                            <tr>
                                <th width="50%" style="text-align: center">Name</th>
                                <th width="50%" style="text-align: center">Class</th>
                            </tr>
                            </thead>
                            @foreach($subjectNames as $subject)
                            <tbody>
                            <td width="50%" style="text-align: center">{{$subject->name}}</td>
                            <td width="50%" style="text-align: center">{{$className}}</td>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content browse container-fluid" hidden="hidden" id="studentHistoryDiv2">
        <h4 class="bold"><i class="fa-solid fa-user-group"></i> Student History</h4>
        <hr>
        <table class="table" id="studentTable2">
            <thead>
            <tr>
                <th>Serial</th>
                <th>Admission Number</th>
                <th>Student Name</th>
                <th>Admission Date</th>
                {{--<th>Class(Start-End)</th>--}}
                <th>Session(Start-End)</th>
                <th>Years</th>
                <th>Mobile Number</th>
                <th>Guardian Name</th>
                <th>Guardian Phone</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
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
                var sessionYear = $('#year-option').val();
                if (classId > 0) {
                    // $('#studentHistoryDiv1').hide();
                    $.ajax({
                        url: "{{route('fetchStudentHistory')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            session_year: sessionYear
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
                $('#studentTable1 tbody').empty();
                if (response['students'] != null) {
                    len = response['students'].length;
                }
                if (len > 0) {
                    var date = new Date();
                    var today = date.getFullYear();
                    for (var i = 0; i < len; i++) {
                        var admissionNumber = response['students'][i].admission_no;
                        var name = response['students'][i].full_name;
                        var admissionDate = response['students'][i].admission_date;
                        var admissionYear = new Date(response['students'][i].admission_date);
                        var getYear = admissionYear.getFullYear();
                        var totalYear = today - getYear;
                        var className = response['students'][i].clase.name;
                        var sessionName = response['students'][i].session.name;
                        var mobileNumber = response['students'][i].mobile_number;
                        var guardianName = response['students'][i].guardian_name;
                        var guardianPhone = response['students'][i].guardian_number;
                        var tr_str = "<tr>" +
                            "<td>" + (i + 1) + "</td>" +
                            "<td>" + admissionNumber + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + admissionDate + "</td>" +
                            "<td>" + className + ('-') + className + "</td>" +
                            "<td>" + sessionName + "</td>" +
                            "<td>" + totalYear + "</td>" +
                            "<td>" + mobileNumber + "</td>" +
                            "<td>" + guardianName + "</td>" +
                            "<td>" + guardianPhone + "</td>" +
                            "</tr>";
                        $("#studentTable1").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";
                    $("#studentTable1 tbody").append(tr_str);
                }
            }
        });
    </script>
@stop
