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
                                <level for="fee_group_id">Fees Group<small class="color">*</small></level>
                                <select id="feeGroup-dropdown" name="fee_group_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($feeGroups as $feeGroup)
                                        <option value="{{$feeGroup->id}}">{{$feeGroup->fee_group_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <level for="class">Class<small class="color">*</small></level>
                                <select name="class_id" id="class-dropdown" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}">
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
                            <div class="form-group col-md-1 pull-right" style="margin-top:17px;">
                                <button type="submit" class="btn btn-primary" id="showTableBtn"><i
                                        class="fa fa-search"></i>Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid" hidden="hidden" id="studentFeeDiv">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <h4 class="color"><i class="fa-sharp fa-solid fa-bangladeshi-taka-sign"></i> Due Fees</h4>
                            <hr>
                            <table class="table table-hover" id="studentTable">
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
                                    <th>Action</th>
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

    <div class="modal fade" id="myFeesModal" role="dialog">
        <div class="modal-dialog">
            <form action="{{route('collectDueFees')}}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header" style="background-color: lightblue">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title title text-center fees_title">Collect Fees</h4>
                    </div>
                    <div class="modal-body pb0">
                        <div class="form-horizontal">
                            <div class="box-body">
                                <input type="hidden" class="form-control" id="student_fee_id" name="student_fee_id"
                                       readonly="readonly">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Date<small
                                            class="color">*</small></label>
                                    <div class="col-sm-9">
                                        <input id="date" name="date" placeholder="" type="text"
                                               class="form-control date"
                                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Amount<small
                                            class="color">*</small></label>
                                    <div class="col-sm-9">

                                        <input type="text" autofocus="" class="form-control modal_amount" id="amount"
                                               name="amount">

                                        <span class="text-danger" id="amount_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Discount Group</label>
                                    <div class="col-sm-9">
                                        <select class="form-control modal_discount_group" id="discount_group">
                                        </select>

                                        <span class="text-danger" id="amount_error"></span>
                                    </div>
                                </div>


                                <div class="form-group mb0">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Discount</label>
                                    <div class="col-sm-9">

                                        <div class="col-md-5 col-sm-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="amount_discount"
                                                       name="amount_discount">

                                                <span class="text-danger" id="amount_error"></span></div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 ltextright">

                                            <label for="inputPassword3" class="row control-label">Fine</label>
                                        </div>
                                        <div class="col-md-5 col-sm-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="fine" name="fine">

                                                <span class="text-danger" id="amount_fine_error"></span>
                                            </div>
                                        </div>

                                    </div><!--./col-sm-9-->
                                </div>


                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Payment Mode<small
                                            class="color">*</small></label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="payment_mode" value="Cash" checked="checked">Cash
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="payment_mode" value="Cheque">Cheque </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="payment_mode" value="DD">DD </label>
                                        <span class="text-danger" id="payment_mode_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Note</label>

                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="3" id="description" name="description"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="box-body">
                            <button type="button" class="btn btn-dark pull-left" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="load"
                                    data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> TK
                                Collect Fees
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>


@stop



@section('javascript')
    <script>
        $(document).ready(function () {
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var feeGroupId = $('#feeGroup-dropdown').val();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('studentDueFeesSearch')}}",
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
                       // $("#studentTable").append(excell);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";

                    $("#studentTable tbody").append(tr_str);
                }
            }

            $('body').on('click', '.myCollectFeeBtn', function () {
                var dueFeeId = $(this).val();
                $('#myFeesModal').modal('show');
                $.ajax({
                    url: "fetchDueFee/" + dueFeeId,
                    type: "GET",
                    success: function (response) {
                        console.log(response);
                        $('#student_fee_id').val(dueFeeId);
                        $('#amount').val(response.student_fee.amount);
                        $('#discount_group').html('<option value="">-- Select Discount Group --</option>');
                        $.each(response.fee_discounts, function (key, value) {
                            $("#discount_group").append('<option value="' + value.discount_amount + '">' + value.fee_discount_name + '</option>');
                        });
                        $("#discount_group").on('change', function () {
                            var discountAmount = this.value;
                            $("#amount_discount").val(discountAmount);
                            $("#amount").val(response.student_fee.amount - discountAmount);
                            var div = (response.student_fee.amount - discountAmount);
                            $('#fine').on('change', function () {
                                var fine = this.value;
                                var amount = (div + +fine);
                                $('#amount').val(amount);

                            })
                        });

                        /* $('#student_id').val(response.student_fee.student_id);
                         $('#session_id').val(response.student_fee.session_id);
                         $('#feemaster_id').val(response.student_fee.feemaster_id);
                         $('#due_date').val(response.student_fee.due_date);
                         $('#feegroup_id').val(response.student_fee.feegroup_id);
                         $('#feetype_id').val(response.student_fee.feetype_id);*/
                    }
                });
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
                        $('#group-dropdown').html('<option value="">Select</option>');
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
