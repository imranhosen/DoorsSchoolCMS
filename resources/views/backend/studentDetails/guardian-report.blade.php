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
    <div class="page-content browse container-fluid" hidden="hidden" id="studentReportDiv">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <h4 class="bold"><i class="fa-solid fa-user-group"></i> Guardian Report</h4>
                            <hr>
                            <table class="table" id="studentTable">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Class(Group)</th>
                                    <th>Admission Number</th>
                                    <th>Student Name</th>
                                    <th>Mobile Number</th>
                                    <th>Guardian Name</th>
                                    <th>Guardian Relation</th>
                                    <th>Guardian Phone</th>
                                    <th>Father Name</th>
                                    <th>Father Phone</th>
                                    <th>Mother Name</th>
                                    <th>Mother Phone</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
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


            // $('#showTableBtn').on('click', function () {
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchGuardianReport')}}",
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
                $('#studentTable tbody').empty();
                if (response['students'] != null) {
                    len = response['students'].length;
                }
                if (len > 0) {
                    $('#studentReportDiv').show();
                    for (var i = 0; i < len; i++) {
                        var claseName = response['students'][i].clase.name;
                        var groupName = response['students'][i].group.name;
                        var admissionNumber = response['students'][i].admission_no;
                        var name = response['students'][i].full_name;
                        var mobileNumber = response['students'][i].mobile_number;
                        var guardianName = response['students'][i].guardian_name;
                        var guardianRelation = response['students'][i].guardian_relation;
                        var guardianPhone = response['students'][i].guardian_number;
                        var fatherName = response['students'][i].father_name;
                        var fatherPhone = response['students'][i].father_number;
                        var motherName = response['students'][i].mother_name;
                        var motherPhone = response['students'][i].mother_number;
                        var tr_str = "<tr>" +
                            "<td>" + (i + 1) + "</td>" +
                            "<td>" + claseName + '(' + groupName + ')' + "</td>" +
                            "<td>" + admissionNumber + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + mobileNumber + "</td>" +
                            "<td>" + guardianName + "</td>" +
                            "<td>" + guardianRelation + "</td>" +
                            "<td>" + guardianPhone + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + fatherPhone + "</td>" +
                            "<td>" + motherName + "</td>" +
                            "<td>" + motherPhone + "</td>" +
                            "</tr>";
                        $("#studentTable tbody").append(tr_str);
                    }
                } else {
                    $('#studentReportDiv').show();
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";
                    $("#studentTable tbody").append(tr_str);
                }
            }
        });
    </script>
@stop
