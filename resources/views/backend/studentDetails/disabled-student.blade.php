@extends('voyager::master')

@section('css')
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
                        <div class="form-group col-sm-5">
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
                        <div class="form-group col-sm-5">
                            <level for="group" class="bold">Group</level>
                            <select id="group-dropdown" name="group_id" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-sm-2" style="margin-top: 17px">
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
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                <h4 class="bold"><i class="fa-solid fa-user-group"></i>   Disabled Students</h4>
                <hr>
                <table class="table" id="studentTable1">
                    <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Admission Number</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Group</th>
                        <th>Session</th>
                        <th>Father Name</th>
                        <th>Father Phone</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Mobile Number</th>
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
                        $year = round($days_count/360,2);
                        /*    $admissionDate = strtotime($student->admission_date);
                        $year = round(($today - $admissionDate) / 60 / 60 / 24 / 360, 2);*/
                        // $year = floor($days_count/60/60/24/360);
                        ?>
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$student->admission_no}}</td>
                            <td>{{$student->full_name}}</td>
                            <td>{{$student->clase?->name}}</td>
                            <td>{{$student->group?->name}}</td>
                            <td>{{$student->session?->name}}</td>
                            <td>{{$student->father_name}}</td>
                            <td>{{$student->father_number}}</td>
                            <td>{{$student->birth_date}}</td>
                            @if($student->gender == 1)
                                <td>Male</td>
                            @elseif ($student->gender == 2)
                                <td>Female</td>
                            @else()
                                <td>Others</td>
                            @endif
                            <td>{{$student->mobile_number}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
            $('#class-dropdown').on('change', function () {
                var idClass = this.value;
                //console.log(idClass);
                $("#group-dropdown").html('');
                $.ajax({
                    url: "{{route('fetchGroup')}}",
                    type: "POST",
                    data: {
                        clase_id: idClass,
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

            $('#searchStudentClassGroupWaise').submit(function(e){
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                if (classId > 0) {
                    // $('#studentHistoryDiv1').hide();
                    $.ajax({
                        url: "{{route('fetchDisabledStudent')}}",
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
                $('#studentTable1 tbody').empty();
                if (response['students'] != null) {
                    len = response['students'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var gender;
                        if(response['students'][i].gender == 1){
                            gender = 'Male';
                        }else if(response['students'][i].gender == 2){
                            gender = 'Female';
                        }else{
                            gender = 'Others';
                        };
                        var admissionNumber = response['students'][i].admission_no;
                        var name = response['students'][i].full_name;
                        var className = response['students'][i].clase.name;
                        var groupName = response['students'][i].group.name;
                        var sessionName = response['students'][i].session.name;
                        var fatherName = response['students'][i].father_name;
                        var fatherNumber = response['students'][i].father_number;
                        var dob = response['students'][i].birth_date;
                        var mobileNumber = response['students'][i].mobile_number;
                        var tr_str = "<tr>" +
                            "<td>" + (i+1) + "</td>" +
                            "<td>" + admissionNumber + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + className + "</td>" +
                            "<td>" + groupName + "</td>" +
                            "<td>" + sessionName + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + fatherNumber + "</td>" +
                            "<td>" + dob + "</td>" +
                            "<td>" + gender + "</td>" +
                            "<td>" + mobileNumber + "</td>" +
                            "</tr>";
                        $("#studentTable1").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' style='color: #e94542'>No record found.</td>" +
                        "</tr>";
                    $("#studentTable1 tbody").append(tr_str);
                }
            }
        });
    </script>
@stop
