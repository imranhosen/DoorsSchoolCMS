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
                            <div class="form-group  col-md-3 ">
                                <label class="control-label" for="name">Date From<small class="color">*</small></label>
                                <input type="date" class="form-control" id="date_from" name="date_from" placeholder="Date">
                            </div>
                            <div class="form-group  col-md-3 ">
                                <label class="control-label" for="name">Date To<small class="color">*</small></label>
                                <input type="date" class="form-control" id="date_to" name="date_to" placeholder="Date">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="incomeHead">Expense Head<small class="color">*</small></label>
                                <select name="expense_head_id" id="expense_head_id" class="form-control">
                                    <option value="">-- Select --</option>
                                    @foreach ($expense_heads as $expense_head)
                                        <option value="{{$expense_head->id}}">
                                            {{$expense_head->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 float-right" style="margin-top:22px;">
                                <button type="submit" class="btn btn-primary" id="showTableBtn"><i class="fa fa-search"></i>Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid" hidden="hidden"  id="incomeDiv">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form id="createCertificate">
                            <div class=" table-responsive">
                                <table class="table table-striped" id="studentTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Invoice Number</th>
                                        <th>Expense of Head</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
                var dateFrom = $('#date_from').val();
                var dateTo = $('#date_to').val();
                var ExpenseHeadId = $('#expense_head_id').val();
                if (ExpenseHeadId > 0) {
                    $.ajax({
                        url: "{{route('fetchExpense')}}",
                        type: "POST",
                        data: {
                            date_from: dateFrom,
                            date_to: dateTo,
                            expense_head_id: ExpenseHeadId
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
                if (response['expenses'] != null) {
                    len = response['expenses'].length;
                }
                if (len > 0) {
                    $('#incomeDiv').show();
                    for (var i = 0; i < len; i++) {
                        var expenseName = response['expenses'][i].name;
                        var invoiceNo = response['expenses'][i].invoice_no;
                        var expenseHead = response['expenses'][i].expense_head.name;
                        var date = response['expenses'][i].date;
                        var amount = response['expenses'][i].amount;
                        var tr_str = "<tr>" +
                            "<td>" + expenseName + "</td>" +
                            "<td>" + invoiceNo + "</td>" +
                            "<td>" + expenseHead + "</td>" +
                            "<td>" + date + "</td>" +
                            "<td>" + amount + "</td>" +
                            "</tr>";
                        $("#studentTable").append(tr_str);


                    }
                } else {
                    $('#incomeDiv').show();
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";

                    $("#studentTable tbody").append(tr_str);
                }
            }
        });
    </script>
@stop
