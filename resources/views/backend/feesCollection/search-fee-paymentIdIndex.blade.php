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
                    <form id="searchFeeByPaymentId">
                        <div class="form-group col-sm-4 bold">
                            <level for="class">Payment Id</level>
                           <input class="form-control" name="payment_id" id="payment_id">
                        </div>
                        <div class="form-group col-sm-4" style="margin-top:15px;">
                            <level for="class"></level>
                            <button type="submit" class="btn btn-primary" id="showTableBtn"><i class="fa fa-search"></i>Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-12" hidden="hidden" id="studentFeeDiv">
        <h4><i class="voyager-group fa-xs"></i> Fees Statement</h4>
        <hr>
        <table class="table" id="studentTable">
            <thead>
            <tr>
                <th>Session</th>
                <th>Student Name</th>
                <th>Father Name</th>
                <th>Date of Birth</th>
                <th>Mobile Number</th>
                <th>Fees Group</th>
                <th>Fees Type</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Payment Mode</th>
                <th>Status</th>
                <th>Collected By</th>
                <th>Paid Date</th>
                <th>Total Paid</th>
                <th>Balance</th>
            </tr>
            </thead>
                <tbody>
                </tbody>

        </table>
    </div>


@stop



@section('javascript')

    <script>
        $(document).ready(function () {
            $('#studentTable').DataTable( {
                dom: 'Bfrt',
                buttons: [
                    //'copy',
                    {
                        extend: 'excel',
                        messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
                    },
                    {
                        extend: 'pdf',
                        messageBottom: null
                    }
                    /*{
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
            $('#searchFeeByPaymentId').submit(function (e) {
                e.preventDefault();
                var paymentId = $('#payment_id').val();
                if (paymentId > 0) {
                    $.ajax({
                        url: "{{route('fetchFeeByPaymentId')}}",
                        type: "POST",
                        data: {
                            payment_id: paymentId
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
                if (response['studentFees'] != null) {
                    len = response['studentFees'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var session = response['studentFees'][i].session.name;
                        var name = response['studentFees'][i].student.full_name;
                        var fatherName = response['studentFees'][i].student.father_name;
                        var dob = response['studentFees'][i].student.birth_date;
                        var mobile = response['studentFees'][i].student.mobile_number;
                        var feeGroup = response['studentFees'][i].fee_group.fee_group_name;
                        var feeType = response['studentFees'][i].fee_type.fee_name;
                        var amount = response['studentFees'][i].amount;
                        var description = response['studentFees'][i].description;
                        var dueDate = response['studentFees'][i].due_date;
                        var paymentMode = response['studentFees'][i].payment_mode;
                        var status = 'Paid'
                        var collectedBy = response['studentFees'][i].user.name;
                        var paidDate = response['studentFees'][i].date;
                        var totalPaid = response['studentFees'][i].paid;
                        var balance = response['studentFees'][i].balance;
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
                            "<td>" + "<span class='label label-success'>"+status + "</td>" +
                            "<td>" + collectedBy + "</td>" +
                            "<td>" + paidDate + "</td>" +
                            "<td>" + totalPaid + "</td>" +
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
