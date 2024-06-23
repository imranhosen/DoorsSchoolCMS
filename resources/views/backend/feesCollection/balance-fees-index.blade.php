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
    <div class="page-content browse container-fluid" hidden="hidden" id="feesBalanceDiv">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form id="createCertificate">
                            <div class="row col-sm-12">
                                <h4 style="color: #134013"><i class="fa-solid fa-user-group"></i><bold> Student Fees Report</bold></h4>
                            </div>
                            <div class=" col-sm-12">
                                <div class=" table-responsive">
                                    <table class="table table-striped" id="studentTable">
                                        <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Admission Number</th>
                                            <th>Roll Number</th>
                                            <th>Father Name</th>
                                            <th>Fee Group</th>
                                            <th>Total Fees (TK)</th>
                                            <th>Discount (TK)</th>
                                            <th>Fine (TK)</th>
                                            <th>Paid Fees (TK)</th>
                                            <th>Balance (TK)</th>
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
            $('#studentTable').DataTable( {
                dom: 'Bfrt',
                buttons: [
                    // 'copy',
                    {
                        extend: 'excel',
                        messageTop: 'The information of Student Library Mmbership.'
                    },
                    {
                        extend: 'pdf',
                        messageBottom: null
                    },
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
            } );
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                if (classId > 0) {
                    $.ajax({
                         url: "{{route('studentBalanceFeesSearch')}}",
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
                $('#feesBalanceDiv').show();
                $('#studentTable tbody').empty();
                if (response['student_fees'] != null) {
                    len = response['student_fees'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var studentName = response['student_fees'][i].student.full_name;
                        var admissionNumber = response['student_fees'][i].student.admission_no;
                        var rollNumber = response['student_fees'][i].student.roll_number;
                        var fatherName = response['student_fees'][i].student.father_name;
                        var feeGroupName = response['student_fees'][i].fee_group.fee_group_name;
                        var amount = response['student_fees'][i].amount;
                        var discount = response['student_fees'][i].amount_discount;
                        var fine = response['student_fees'][i].fine;
                        var paid = response['student_fees'][i].paid;
                        var balance = response['student_fees'][i].balance;
                        var tr_str = "<tr>" +
                            "<td>" + studentName + "</td>" +
                            "<td>" + admissionNumber + "</td>" +
                            "<td>" + rollNumber + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + feeGroupName + "</td>" +
                            "<td>" + amount + "</td>" +
                            "<td>" + discount + "</td>" +
                            "<td>" + fine + "</td>" +
                            "<td>" + paid + "</td>" +
                            "<td>" + balance + "</td>" +
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
