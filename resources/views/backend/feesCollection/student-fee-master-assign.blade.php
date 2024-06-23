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
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="form-group col-md-12">
                    <div class="alert alert-primary text-center" style="background-color:#ededff">
                        <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                    </div>
                    <form id="searchStudentClassGroupWaise">
                        <div class="form-group col-sm-4">
                            <level for="class">Class</level>
                            <select name="class_id" id="class-dropdown" class="form-control">
                                <option value="">-- Select Class --</option>
                                @foreach ($classes as $class)
                                    <option value="{{$class->id}}">
                                        {{$class->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <level for="group">Group</level>
                            <select id="group-dropdown" name="group_id" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <level for="class">Gender</level>
                            <select id="gender-option" name="gender" class="form-control">
                                <option value="">None</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Others</option>
                            </select>
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary" id="showTableBtn"><i class="voyager-search">search</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid" >
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="form-group col-md-12" hidden="hidden" id="studentFeeDiv">
                    <form method="post" action="{{route('studentFeeMasterAssignStore')}}" id="assign_form">
                        @csrf
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="voyager-group"></i> Assign Fees Group </h3>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="table-responsive">
                                                <h4>
                                                    <input type="hidden" name="session_id"
                                                           value="{{$fee_master->session_id}}">
                                                    <input type="hidden" name="feemaster_id"
                                                           value="{{$fee_master->id}}">
                                                    <input type="hidden" name="amount"
                                                           value="{{$fee_master->amount}}">
                                                    <input type="hidden" name="feegroup_id"
                                                           value="{{$fee_master->feeGroup->id}}">
                                                    <input type="hidden" name="feetype_id"
                                                           value="{{$fee_master->feeType->id}}">
                                                    <input type="hidden" name="due_date"
                                                           value="{{$fee_master->due_date}}">
                                                    <a href="#" data-toggle="popover"
                                                       class="detail_popover">{{$fee_master->feeGroup->fee_group_name}}</a>
                                                </h4>
                                                <table class="table">
                                                    <tbody>
                                                    <tr class="mailbox-name">
                                                        <td>
                                                            Code - {{$fee_master->feeType->fee_code}}
                                                        </td>
                                                    </tr>
                                                    <tr class="mailbox-name">
                                                        <td>
                                                            {{$fee_master->feeType->fee_name}}
                                                        </td>
                                                        <td>
                                                            {{$fee_master->amount}}TK
                                                        </td>
                                                    </tr>


                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class=" table-responsive">
                                                <table class="table table-striped" id="studentTable">
                                                    <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="select_all"> All</th>

                                                        <th>Admission Number</th>
                                                        <th>Student Name</th>

                                                        <th>Class</th>
                                                        <th>Father Name</th>
                                                        <th>Group</th>
                                                        <th>Gender</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{--<tr>
                                                        <td>
                                                            <input class="checkbox" type="checkbox"
                                                                   name="student_id" value="">
                                                            <input type="hidden" name="student_fees_master_id"
                                                                   value="{{$fee_master->id}}">
                                                            <input type="hidden" name="student_ids[]" value="653">
                                                        </td>

                                                        <td>02200417</td>
                                                        <td>Mohammad Saidul Islam</td>
                                                        <td>ELEVEN(SCIENCE)</td>
                                                        <td>Mohammad Jahangir Alam</td>
                                                        <td>Male</td>

                                                    </tr>--}}
                                                    </tbody>
                                                </table>

                                            </div>
                                            <button type="submit" class="allot-fees btn btn-primary btn-sm pull-right"
                                                    id="load"
                                                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait..">
                                                Save
                                            </button>

                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
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
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                var genderValue = $('#gender-option').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchStudentForFeeMaster')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId,
                            gender_val: genderValue
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
                    $('#studentFeeDiv').show();
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
                        var groupName = response['students'][i].group.name;
                       // var gender = response['students'][i].gender;
                        var tr_str = "<tr>" +
                            "<input type='hidden' name='clase_id[]' value='"+classId+ "'>"+
                            "<input type='hidden' name='group_id[]' value='"+groupId+ "'>"+
                            "<td>" + "<input class='checkbox' type='checkbox' name='student_ids[]' value='"+studentId+ "'>"+ "</td>" +
                            "<td>" + AdmissionNo + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + className + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + groupName + "</td>" +
                            "<td>" + gender + "</td>" +
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
        });
    </script>
@stop
