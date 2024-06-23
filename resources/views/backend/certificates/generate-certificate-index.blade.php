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
                            <div class="form-group col-md-3">
                                <level for="class">Class<small class="color">*</small></level>
                                <select name="class_id" id="class-dropdown" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}" class="bold">
                                            {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <level for="group">Group<small class="color">*</small></level>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <level for="certificate">Certificates<small class="color">*</small></level>
                                <select name="certificate_id" id="certificate-dropdown" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($certificates as $certificate)
                                        <option value="{{$certificate->id}}" class="bold">
                                            {{$certificate->certificate_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-1 float-right" style="margin-top:17px;">
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
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form id="createCertificate">
                            <div class="row col-sm-12">
                                <h4 style="color: #134013"><i class="fa-solid fa-user-group"></i><bold> Student List</bold></h4>
                                <button type="submit" class="allot-fees btn btn-dark btn-sm pull-right pull-top"
                                        id="load"
                                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait..">
                                    Generate
                                </button>
                            </div>
                            <div class=" col-sm-12">
                            <div class=" table-responsive">
                                <table class="table table-striped" id="studentTable">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"> All</th>
                                        <th>Admission Number</th>
                                        <th>Student Name</th>
                                        <th>Class</th>
                                        <th>Father Name</th>
                                        <th>Date of Birth</th>
                                        <th>Gender</th>
                                        <th>Group</th>
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



@stop



@section('javascript')

    <script>
        $(document).ready(function () {
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
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                var certificateId = $('#certificate-dropdown').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchStudentForCertificate')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId,
                            certificate_id: certificateId,
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
                    var certificateId = response['certificates'][0].id;
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
                            "<input type='hidden' id='certificate_id' name='certificate_id' value='" + certificateId + "'>" +
                            "<td>" + "<input class='checkbox' id='student_id' type='checkbox' name='student_ids' value='" + studentId + "'>" + "</td>" +
                            "<td>" + AdmissionNo + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + className + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + dob + "</td>" +
                            "<td>" + gender + "</td>" +
                            "<td>" + groupName + "</td>" +
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

            $('#createCertificate').submit(function (e) {
                e.preventDefault();
                var certificateId = $('#certificate_id').val();
                var myCheckboxes = new Array();
                $("input[name='student_ids']:checked").each(function () {
                    myCheckboxes.push($(this).val());
                });
                if (certificateId > 0) {
                    $.ajax({
                        url: "{{route('generateCertificate')}}",
                        type: "POST",
                        data: {
                            certificate_id: certificateId,
                            student_ids: myCheckboxes
                        },
                        dataType: 'json',
                        success: function (res) {
                            console.log(res);
                            $('#myModal').modal('show');
                            $('#myModal').html(res.modal)
                            //createRows(response);

                        }
                    });
                }
            });

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

        });
    </script>
@stop
