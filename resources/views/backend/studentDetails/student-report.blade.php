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
                            <div class="form-group col-sm-3">
                                <level for="group" class="bold">Group</level>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <level for="class" class="bold">Gender</level>
                                <select id="gender-option" name="gender" class="form-control">
                                    <option value="">None</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Others</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <level for="rte" class="bold">RTE</level>
                                <select id="rte-option" name="rte" class="form-control">
                                    <option value="">None</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
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
    <div class="page-content browse container-fluid" hidden="hidden" id="studentReportDiv">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <h4 class="bold"><i class="fa-solid fa-user-group"></i> Student Report</h4>
                        <hr>
                        <table class="table DataTable" id="studentTable">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Group</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Mobile Number</th>
                                <th>National Identification Number</th>
                                <th>Local Identification Number</th>
                                <th>Email</th>
                                <th>RTE</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop



@section('javascript')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
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
                var genderValue = $('#gender-option').val();
                var rteValue = $('#rte-option').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchStudentReport')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId,
                            gender_val: genderValue,
                            rte_val: rteValue
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
                        var gender;
                        if (response['students'][i].gender == 1) {
                            gender = 'Male';
                        } else if (response['students'][i].gender == 2) {
                            gender = 'Female';
                        } else {
                            gender = 'Others';
                        }
                        ;
                        var rte;
                        if (response['students'][i].rte == 0) {
                            rte = 'No';
                        } else {
                            rte = 'Yes';
                        }
                        var group = response['students'][i].group.name;
                        var name = response['students'][i].full_name;
                        var fatherName = response['students'][i].father_name;
                        var dob = response['students'][i].birth_date;
                        var mobileNumber = response['students'][i].mobile_number;
                        var nid = response['students'][i].national_id;
                        var localId = response['students'][i].local_id;
                        var email = response['students'][i].email;

                        var tr_str = "<tr>" +
                            "<td>" + (i + 1) + "</td>" +
                            "<td>" + group + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + dob + "</td>" +
                            "<td>" + gender + "</td>" +
                            "<td>" + mobileNumber + "</td>" +
                            "<td>" + nid + "</td>" +
                            "<td>" + localId + "</td>" +
                            "<td>" + email + "</td>" +
                            "<td>" + rte + "</td>" +
                            "</tr>";
                        $("#studentTable").append(tr_str);


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
        $('#studentTable').DataTable({
            dom: 'Brt',
            buttons: [
                // 'copy',
                {
                    extend: 'excel',
                    messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
                },
                {
                    extend: 'pdf',
                    messageBottom: null
                }
                /* {
                     extend: 'print',
                     messageTop: function () {
                         printCounter++;

                         if ( printCounter === 1 ) {
                             return 'This is the first time you have printed this document.';
                         }
                         else {
                             return 'You have printed this document '+printCounter+' times';
                         }
                     },
                     messageBottom: null
                 }*/
            ]
        });
       /* $(document).ready(function () {
            $('#studentTable').DataTable({
                ajax: 'data/arrays.txt',
            });
        });*/

    </script>
@stop
