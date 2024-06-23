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
                            <div class="form-group col-sm-6">
                                <level for="class" class="bold">Class</level>
                                <select name="class_id" id="class-dropdown" class="form-control">
                                    <option value="">-- Select Class --</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}">
                                            {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <level for="year" class="bold">Admission Year</level>
                                <select id="year-option" name="year" class="form-control">
                                    <option value="">None</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                </select>
                            </div>
                            <div class="form-group float-right" style="margin-right: 13px">
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
    <div class="page-content browse container-fluid" id="studentHistoryDiv1">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <h4 class="bold"><i class="fa-solid fa-user-group"></i> Student History</h4>
                        <hr>
                        <table class="table" id="studentTable1">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Admission Number</th>
                                <th>Student Name</th>
                                <th>Admission Date</th>
                                <th>Class(Start-End)</th>
                                <th>Session(Start-End)</th>
                                <th>Years</th>
                                <th>Mobile Number</th>
                                <th>Guardian Name</th>
                                <th>Guardian Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 0;
                            $currentDate = Carbon\Carbon::now();
                            /*$liveDate = Date('m-d-Y');
                            $today = strtotime($liveDate);*/
                            ?>
                            @foreach($students as $student)
                                <?php
                                $days_count = Carbon\Carbon::parse($student->admission_date)->diffInDays($currentDate);
                                $year = round($days_count / 360, 2);
                                /*    $admissionDate = strtotime($student->admission_date);
                                $year = round(($today - $admissionDate) / 60 / 60 / 24 / 360, 2);*/
                                // $year = floor($days_count/60/60/24/360);
                                ?>
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$student->admission_no}}</td>
                                    <td>{{$student->full_name}}</td>
                                    <td>{{$student->admission_date}}</td>
                                    <td>{{$student->clase?->name}}-{{$student->clase?->name}}</td>
                                    <td>{{$student->session?->name}}</td>
                                    <td>{{$year}}</td>
                                    <td>{{$student->mobile_number}}</td>
                                    <td>{{$student->guardian_name}}</td>
                                    <td>{{$student->guardian_number}}</td>
                                </tr>
                            @endforeach
                            </tbody>
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
