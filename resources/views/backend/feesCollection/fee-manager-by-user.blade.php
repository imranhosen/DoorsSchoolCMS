@extends('voyager::master')

@section('css')

    <style>
        .req {
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
                            <h4 style="color: #134013"><em><strong>Fee Manager</strong></em></h4>
                        </div>
                        <form id="searchStudentClassGroupWaise">
                            <div class="form-group col-sm-3">
                                <label for="exampleInputEmail1" class="bold">Date From</label>
                                <small class="req"> *</small>
                                <input name="date1" placeholder="" id="date1" type="date" class="form-control"
                                       value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" autocomplete="on">
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="exampleInputEmail1" class="bold">Date To</label>
                                <small class="req"> *</small>
                                <input name="date2" placeholder="" id="date2" type="date" class="form-control"
                                       value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" autocomplete="on">
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group col-sm-3" style="margin-top: 5px">
                                <lebel for="status" class="bold">Status<small class="req"> *</small></lebel>
                                <select id="status-dropdown" name="status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Paid</option>
                                    <option value="0">Unpaid</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-3 float-right" style="margin-top:21px;">
                                <button type="submit" class="btn btn-primary" id="showTableBtn">Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content browse container-fluid" id="studentFeeDiv1">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="box-header with-border">
                            <h3 class="bold"><i class="fa-sharp fa-solid fa-bangladeshi-taka-sign"></i> Fee Details</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th width="2%" style="text-align: center">#Sl</th>
                                        <th width="8%" style="text-align: center">Student</th>
                                        <th width="5%" style="text-align: center">Session</th>
                                        <th width="5%" style="text-align: center">Fee Group</th>
                                        <th width="10%" style="text-align: center">Fee Type</th>
                                        <th width="10%" style="text-align: center">Due Date</th>
                                        <th width="10%" style="text-align: center">Total Amount</th>
                                        <th width="10%" style="text-align: center">Discount</th>
                                        <th width="10%" style="text-align: center">Fine</th>
                                        <th width="10%" style="text-align: center">Paid</th>
                                        <th width="10%" style="text-align: center">Paid Date</th>
                                        <th width="10%" style="text-align: center">status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($student_fees as $fee)
                                        <tr>
                                            <input type="hidden" value="{{$fee->student->id}}" id="student_id">
                                            <td width="2%" style="text-align: center">{{$i++}}</td>
                                            <td width="8%" style="text-align: center">{{$fee->student->full_name}}</td>
                                            <td width="8%" style="text-align: center">{{$fee->session->name}}</td>
                                            <td width="10%"
                                                style="text-align: center">{{$fee->feeGroup->fee_group_name}}</td>
                                            <td width="10%" style="text-align: center">{{$fee->feeType->fee_name}}</td>
                                            <td width="10%" style="text-align: center">{{$fee->due_date}}</td>
                                            <td width="10%" style="text-align: center">{{$fee->amount}}</td>
                                            <td width="10%" style="text-align: center">{{$fee->amount_discount}}</td>
                                            <td width="10%" style="text-align: center">{{$fee->fine}}</td>
                                            <td width="10%" style="text-align: center">{{$fee->paid}}</td>
                                            <td width="10%" style="text-align: center">{{$fee->date}}</td>
                                            <td width="10%" style="text-align: center">
                                                @if($fee->status == 1)<span class="label label-success">Paid</span>
                                                @else <span class="label label-danger">Unpaid</span>
                                                @endif
                                            </td>
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
    </div>
    <div class="page-content browse container-fluid" hidden="hidden" id="studentFeeDiv2">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="box-header with-border">
                            <h3 class="bold"><i class="fa-sharp fa-solid fa-bangladeshi-taka-sign"></i> Fee Details</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable2">
                                    <thead>
                                    <tr>
                                        <th width="2%" style="text-align: center">#Sl</th>
                                        <th width="8%" style="text-align: center">Student</th>
                                        <th width="5%" style="text-align: center">Session</th>
                                        <th width="5%" style="text-align: center">Fee Group</th>
                                        <th width="10%" style="text-align: center">Fee Type</th>
                                        <th width="10%" style="text-align: center">Due Date</th>
                                        <th width="10%" style="text-align: center">Total Amount</th>
                                        <th width="10%" style="text-align: center">Discount</th>
                                        <th width="10%" style="text-align: center">Fine</th>
                                        <th width="10%" style="text-align: center">Paid</th>
                                        <th width="10%" style="text-align: center">Paid Date</th>
                                        <th width="10%" style="text-align: center">status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    //'copy',
                    {
                        extend: 'excel',
                        messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
                    },
                    {
                        extend: 'pdf',
                        messageBottom: null
                    },
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
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var date1 = $('#date1').val();
                var date2 = $('#date2').val();
                var status = $('#status-dropdown').val();
                var student_id = $('#student_id').val();
                //alert(student_id);
                if (status != null) {
                    // $('#studentHistoryDiv1').hide();
                    $.ajax({
                        url: "{{route('fetchFeeManagerByUser')}}",
                        type: "POST",
                        data: {
                            date1: date1,
                            date2: date2,
                            status: status,
                            student_id: student_id
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
                $('#studentFeeDiv1').hide();
                $('#studentFeeDiv2').show();
                $('#dataTable2 tbody').empty();
                if (response['student_fees'] != null) {
                    len = response['student_fees'].length;
                }
                var j = 1;
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var studentName = response['student_fees'][i].student.full_name;
                        var session = response['student_fees'][i].session.name;
                        var feeGroup = response['student_fees'][i].fee_group.fee_group_name;
                        var feeType = response['student_fees'][i].fee_type.fee_name;
                        var due_date = response['student_fees'][i].due_date;
                        var amount = response['student_fees'][i].amount;
                        var amount_discount = response['student_fees'][i].amount_discount;
                        var fine = response['student_fees'][i].fine;
                        var paid = response['student_fees'][i].paid;
                        var date = response['student_fees'][i].date;
                        var status = response['student_fees'][i].status;
                        if(status == 0){
                            status = "<span class='label label-danger'>"+'Unpaid'+"</span>"
                        }else{
                            status = "<span class='label label-success'>"+'Paid'+"</span>"
                        }
                        var tr_str1 = "<tr>" +
                            "<td width='2%' style='text-align: center'>" + (j++) + "</td>" +
                            "<td width='8%' style='text-align: center'>" + studentName + "</td>" +
                            "<td width='8%' style='text-align: center'>" + session + "</td>" +
                            "<td width='10%' style='text-align: center'>" + feeGroup + "</td>" +
                            "<td width='10%' style='text-align: center'>" + feeType + "</td>" +
                            "<td width='10%' style='text-align: center'>" + due_date + "</td>" +
                            "<td width='10%' style='text-align: center'>" + amount + "</td>" +
                            "<td width='10%' style='text-align: center'>" + amount_discount + "</td>" +
                            "<td width='10%' style='text-align: center'>" + fine + "</td>" +
                            "<td width='10%' style='text-align: center'>" + paid + "</td>" +
                            "<td width='10%' style='text-align: center'>" + date + "</td>" +
                            "<td width='10%' style='text-align: center'>" + status + "</td>" +
                            "</tr>";
                        $("#dataTable2 tbody").append(tr_str1);
                    }
                } else {
                    var tr_str2 = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";

                    $("#dataTable2 tbody").append(tr_str2);
                }
            }
        });
    </script>
@stop
