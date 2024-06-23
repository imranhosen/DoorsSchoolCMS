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
                            <div class="form-group col-md-5">
                                <level for="class">Class<small class="color">*</small></level>
                                <select name="class_id" id="class-dropdown" class="form-control">
                                    <option value="">-- Select Class --</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}">
                                            {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <level for="group">Group<small class="color">*</small></level>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-md-2 pull-right" style="margin-top:17px;">
                                <button type="submit" class="btn btn-primary" id="showTableBtn">Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid" id="certificateDiv">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form id="createCertificate">
                            <div class="row col-sm-12">
                                <h4 style="color: #134013"><i class="fa-solid fa-user-group"></i><bold> Student List</bold></h4>
                            </div>
                            <div class=" col-sm-12">
                                <div class=" table-responsive">
                                    <table class="table table-striped" id="studentTable">
                                        <thead>
                                        <tr>
                                            <th>Member ID</th>
                                            <th>Library Card Number</th>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Date Of Admission</th>
                                            <th>Father Number</th>
                                            <th>Action</th>
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
@stop



@section('javascript')

    <script>
        $(document).ready(function () {
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchStudentForLibraryCard')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId,
                            feegroup_id: feeGroupId
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
                $('#studentFeeDiv').show();
                $('#studentTable tbody').empty();
                if (response['dueFees'] != null) {
                    len = response['dueFees'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var dueFeesId = response['dueFees'][i].id;
                        var session = response['dueFees'][i].session.name;
                        var name = response['dueFees'][i].student.full_name;
                        var fatherName = response['dueFees'][i].student.father_name;
                        var dob = response['dueFees'][i].student.birth_date;
                        var mobile = response['dueFees'][i].student.mobile_number;
                        var feeGroup = response['dueFees'][i].fee_group.fee_group_name;
                        var feeType = response['dueFees'][i].fee_type.fee_name;
                        var amount = response['dueFees'][i].amount;
                        var description = response['dueFees'][i].description;
                        var dueDate = response['dueFees'][i].due_date;
                        var paymentMode = response['dueFees'][i].payment_mode;
                        var status = 'Unpaid';
                        var collectedBy = response['dueFees'][i].user.name;
                        var paidDate = response['dueFees'][i].date;
                        var totalPaid = response['dueFees'][i].paid;
                        var balance = response['dueFees'][i].balance;
                        var tr_str = "<tr>" +
                            "<td>" + session + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + dob + "</td>" +
                            "<td>" + mobile + "</td>" +
                            "<td>" + feeGroup + "</td>" +
                            "<td>" + feeType + "</td>" +
                            "<td>" + amount + "</td>" +
                            "<td>" + description + "</td>" +
                            "<td>" + dueDate + "</td>" +
                            "<td>" + paymentMode + "</td>" +
                            "<td>" + "<span class='label label-danger'>" + status + "</td>" +
                            "<td>" + collectedBy + "</td>" +
                            "<td>" + paidDate + "</td>" +
                            "<td>" + totalPaid + "</td>" +
                            "<td>" + balance + "</td>" +
                            "<td>" + "<button type='button' value='" + dueFeesId + "' class='btn-xs btn-default myCollectFeeBtn' title='Add Fees' id='myCollectFeeBtn'>" + "<i class='voyager-plus'>" + "</i>" + "</button>"
                            + "</td>" +
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
        });
    </script>
@stop
