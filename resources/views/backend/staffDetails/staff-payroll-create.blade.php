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
            <!-- left column -->
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3 class="box-title">Staff Details</h3>
                                        </div>
                                        <div class="col-md-8 ">
                                            <div class="btn-group pull-right">
                                                <a href="{{route('staffPayrollIndex')}}" type="button"
                                                   class="btn btn-primary btn-xs">
                                                    <i class="fa fa-arrow-left"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--./box-header-->
                                <div class="box-body" style="padding-top:0;">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-12">
                                            <div class="sfborder">
                                                <div class="col-md-2">
                                                    <div class="row">
                                                        <img width="115" height="140" class="round5"
                                                             src="{{ \TCG\Voyager\Facades\Voyager::image($staff->staff_image) }}"
                                                             alt="No Image">
                                                    </div>
                                                </div>

                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <table class="table mb0 font13">
                                                            <tbody>
                                                            <tr>
                                                                <th class="bozero">Name</th>
                                                                <td class="bozero">{{$staff->full_name}}</td>

                                                                <th class="bozero">Staff ID</th>
                                                                <td class="bozero">{{$staff->id}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Phone</th>
                                                                <td>{{$staff->contact_no}}</td>
                                                                <th>Email</th>
                                                                <td>{{$staff->staff_email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>EPF No</th>
                                                                <td>{{$staff->epf_no}}</td>
                                                                <th>Role</th>
                                                                <td>{{$staff->role->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Department</th>
                                                                <td>{{$staff->department->department_name}}</td>
                                                                <th>Designation</th>
                                                                <td>{{$staff->designation->designation_name}}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                            </div>
                                        </div><!--./col-md-8-->
                                        <div class="col-md-4 col-sm-12">

                                            <div class="sfborder relative overvisible">
                                                <div class="letest">
                                                    <div class="rotatetest">Attendance</div>
                                                </div>
                                                <div class="padd-en-rtl33">
                                                    <table class="table mb0 font13">
                                                        <tbody>
                                                        <tr>
                                                            <th class="bozero">Month</th>
                                                            <th class="bozero"><span data-toggle="tooltip"
                                                                                     title="Present">P</span>
                                                            </th>
                                                            <th class="bozero"><span data-toggle="tooltip" title="Late">L</span>
                                                            </th>
                                                            <th class="bozero"><span data-toggle="tooltip"
                                                                                     title="Absent">A</span>
                                                            </th>
                                                            <th class="bozero"><span data-toggle="tooltip"
                                                                                     title="Half Day">F</span>
                                                            </th>
                                                            <th class="bozero"><span data-toggle="tooltip"
                                                                                     title="Holiday">H</span>
                                                            </th>

                                                            <th class="bozero"><span data-toggle="tooltip"
                                                                                     title="Approved Leave">V</span>
                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <td><?php if($month1 == 1){echo 'january';}elseif($month1==2){echo 'February';}
                                                            elseif($month1==3){echo 'March';}elseif($month1==4){echo 'April';}
                                                            elseif($month1==5){echo 'May';}elseif($month1==6){echo 'June';}
                                                            elseif($month1==7){echo 'July';}elseif($month1==8){echo 'August';}
                                                            elseif($month1==9){echo 'September';}elseif($month1==10){echo 'October';}
                                                            elseif($month1==11){echo 'November';}else{echo 'December';} ?></td>
                                                            {{--<td>{{$attendence->date}}</td>--}}
                                                            <td>{{$present}}</td>
                                                            <td>{{$leave}}</td>
                                                            <td>{{$absent}}</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                            <td>0</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div><!--./col-md-8-->
                                        <div class="col-md-12">
                                            <div
                                                style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <form class="form-horizontal" action="{{route('staffPayrollStore')}}" method="post" id="employeeform">
                                    @csrf
                                    <div class="box-header">
                                        <div class="row display-flex">
                                            <div class="col-md-4 col-sm-4">
                                                <h3 class="box-title">Earning</h3>
                                                <button type="button" onclick="add_more()" class="plusign btn-primary pull-right" style="margin-left: 4px; margin-top: 2px">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <div class="sameheight">
                                                    <div class="feebox">
                                                        <table class="table3" id="tableID">
                                                            <tbody><tr id="row0">
                                                                <td><input type="text" class="form-control" id="allowance_type" name="allowance_type[]" placeholder="Type"></td>
                                                                <td><input type="text" id="allowance_amount" name="allowance_amount[]" class="form-control" value="0"></td>

                                                            </tr>
                                                            </tbody></table>
                                                    </div>
                                                </div>
                                            </div><!--./col-md-4-->
                                            <div class="col-md-4 col-sm-4">

                                                <h3 class="box-title">Deduction</h3>
                                                <button type="button" onclick="add_more_deduction()" class="plusign btn-primary pull-right" style="margin-left: 4px; margin-top: 2px">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <div class="sameheight">
                                                    <div class="feebox">
                                                        <table class="table3" id="tableID2">
                                                            <tbody><tr id="deduction_row0">
                                                                <td><input type="text" id="deduction_type" name="deduction_type[]" class="form-control" placeholder="Type"></td>
                                                                <td><input type="text" id="deduction_amount" name="deduction_amount[]" class="form-control" value="0"></td>

                                                            </tr>

                                                            </tbody></table>
                                                    </div>
                                                </div>
                                            </div><!--./col-md-4-->
                                            <div class="col-md-4 col-sm-4">

                                                <h3 class="box-title">Payroll Summary(TK)</h3>
                                                <button type="button" onclick="add_allowance()" class="pull-right" style="margin-bottom: 0px">
                                                    <i class="fa fa-calculator"></i> Calculate
                                                </button>
                                                <div class="sameheight">
                                                    <div class="payrollbox feebox">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" style="margin-top: 30px">Basic Salary</label>
                                                            <div class="col-sm-8" style="margin-top: 5px">
                                                                <input class="form-control" name="basic" id="basic" value="0" type="text">
                                                            </div>
                                                        </div><!--./form-group-->
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Earning</label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" name="total_allowance" id="total_allowance" type="text">
                                                            </div>
                                                        </div><!--./form-group-->
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Deduction</label>
                                                            <div class="col-sm-8 deductiondred">
                                                                <input class="form-control" name="total_deduction" id="total_deduction" type="text" style="color:#f50000">
                                                            </div>
                                                        </div><!--./form-group-->

                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Gross Salary</label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" name="gross_salary" id="gross_salary" value="0" type="text">
                                                            </div>
                                                        </div><!--./form-group-->
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Tax</label>
                                                            <div class="col-sm-8 deductiondred">
                                                                <input class="form-control" name="tax" id="tax" value="0" type="text">
                                                            </div>
                                                        </div><!--./form-group-->

                                                        <hr>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Net Salary</label>
                                                            <div class="col-sm-8 net_green">
                                                                <input class="form-control greentest" name="net_salary" id="net_salary" type="text">
                                                                <span class="text-danger" id="err"></span>

                                                                <input class="form-control" name="staff_id" value="{{$staff->id}}" type="hidden">

                                                                <input class="form-control" name="month" value="{{$month}}" type="hidden">
                                                                <input class="form-control" name="year" value="{{$year}}" type="hidden">
                                                                <input class="form-control" name="role_id" value="{{$staff->role->id}}" type="hidden">

                                                                {{--<input class="form-control" name="status" value="generated" type="hidden">--}}

                                                            </div>
                                                        </div><!--./form-group-->
                                                    </div>
                                                </div>
                                            </div><!--./col-md-4-->
                                            <div class="col-md-12 col-sm-12">

                                                <button type="submit" id="contact_submit" class="btn btn-info pull-right">Save</button>
                                            </div><!--./col-md-12-->

                                        </div><!--./row-->
                                    </div></form><!--./box-header-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col (left) -->
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">

        function add_allowance() {
            //alert('hi');

            var basic_pay = $("#basic").val();
            var allowance_type = document.getElementsByName('allowance_type[]');
            var allowance_amount = document.getElementsByName('allowance_amount[]');
            //var leave_deduction = $("#leave_deduction").val();
            var tax = $("#tax").val();
            var total_allowance = 0;

            var deduction_type = document.getElementsByName('deduction_type[]');
            var deduction_amount = document.getElementsByName('deduction_amount[]');

            var total_deduction = 0;

            for (var i = 0; i < allowance_amount.length; i++) {

                var inp = allowance_amount[i];

                if (inp.value == '') {

                    var inpvalue = 0;
                } else {
                    var inpvalue = inp.value;
                }

                total_allowance += parseInt(inpvalue);

            }

            for (var j = 0; j < deduction_amount.length; j++) {


                var inpd = deduction_amount[j];

                if (inpd.value == '') {

                    var inpdvalue = 0;

                } else {

                    var inpdvalue = inpd.value;
                }
                total_deduction += parseInt(inpdvalue);
            }


//total_deduction += parseInt(leave_deduction) ;

            var gross_salary = parseInt(basic_pay) + parseInt(total_allowance) - parseInt(total_deduction);

            var net_salary = parseInt(basic_pay) + parseInt(total_allowance) - parseInt(total_deduction) - parseInt(tax);

            $("#total_allowance").val(total_allowance);
            $("#total_deduction").val(total_deduction);
            $("#total_allow").html(total_allowance);
            $("#total_deduc").html(total_deduction);
            $("#gross_salary").val(gross_salary);
            $("#net_salary").val(net_salary);

        }
        function add_more() {

            var table = document.getElementById("tableID");
            var table_len = (table.rows.length);
            var id = parseInt(table_len);
            var row = table.insertRow(table_len).outerHTML = "<tr id='row" + id + "'>" +
                "<td><input type='text' class='form-control' id='allowance_type' name='allowance_type[]' placeholder='Type'></td>" +
                "<td><input type='text' class='form-control' id='allowance_amount' name='allowance_amount[]'  value='0'></td>" +
                "<td><button type='button' onclick='delete_row(" + id + ")' class='closebtn btn-danger'><i class='fa fa-remove'></i></button></td></tr>";
        }

        function delete_row(id) {


            var table = document.getElementById("tableID");
            var rowCount = table.rows.length;
            $("#row" + id).html("");
//table.deleteRow(id);
        }


        function add_more_deduction() {

            var table = document.getElementById("tableID2");
            var table_len = (table.rows.length);
            var id = parseInt(table_len);
            var row = table.insertRow(table_len).outerHTML = "<tr id='deduction_row" + id + "'><td><input type='text' class='form-control' id='deduction_type' name='deduction_type[]' placeholder='Type'></td>" +
                "<td><input type='text' id='deduction_amount' name='deduction_amount[]' class='form-control' value='0'></td>" +
                "<td><button type='button' onclick='delete_deduction_row(" + id + ")' class='closebtn btn-danger'><i class='fa fa-remove'></i></button></td></tr>";

        }

        function delete_deduction_row(id) {


            var table = document.getElementById("tableID2");
            var rowCount = table.rows.length;
            $("#deduction_row" + id).html("");
//table.deleteRow(id);
        }
        function getEmployeeName(role) {

            var base_url = 'http://192.168.1.77/ss4/';
            $("#name").html("<option value=''>select</option>");
            var div_data = "";
            $.ajax({
                type: "POST",
                url: base_url + "admin/staff/getEmployeeByRole",
                data: {'role': role},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value='" + obj.name + "'>" + obj.name + "</option>";
                    });
                    $('#name').append(div_data);
                }
            });
        }


        function getSectionByClass(class_id, section_id) {
            if (class_id != "" && section_id != "") {
                $('#section_id').html("");
                var base_url = 'http://192.168.1.77/ss4/';
                var div_data = '<option value="">Select</option>';
                $.ajax({
                    type: "GET",
                    url: base_url + "sections/getByClass",
                    data: {'class_id': class_id},
                    dataType: "json",
                    success: function (data) {
                        $.each(data, function (i, obj)
                        {
                            var sel = "";
                            if (section_id == obj.section_id) {
                                sel = "selected";
                            }
                            div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                        });
                        $('#section_id').append(div_data);
                    }
                });
            }
        }

        $(document).ready(function () {
            var class_id = $('#class_id').val();
            var section_id = '';
            getSectionByClass(class_id, section_id);
            $(document).on('change', '#class_id', function (e) {
                $('#section_id').html("");
                var class_id = $(this).val();
                var base_url = 'http://192.168.1.77/ss4/';
                var div_data = '<option value="">Select</option>';
                $.ajax({
                    type: "GET",
                    url: base_url + "sections/getByClass",
                    data: {'class_id': class_id},
                    dataType: "json",
                    success: function (data) {
                        $.each(data, function (i, obj)
                        {
                            div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                        });
                        $('#section_id').append(div_data);
                    }
                });
            });
        });

        $("#contact_submit").click(function (event) {

            var net = $("#net_salary").val();
            if (net == "") {

                $("#err").html("Net Salary should not be empty.");
                $("#net_salary").focus();
                return false;
                event.preventDefault();
            } else {
                $("#err").html("");
            }
        });
    </script>
    {{--<script>
        $(document).ready(function () {
            $(document).ready(function () {
                var counter = 0;
                $(document).on("click", ".addEventMore1", function () {
                    var itemAdd = $("#earningDiv3 tbody tr").html();
                    alert(itemAdd);
                    $(this).closest("#tableID tbody tr ").append(itemAdd);
                    counter++;
                });
                $(document).on("click", ".closebtn1", function () {
                    $(this).closest("#earningDiv3").remove();
                    counter -= 1;
                });

            });
            $('body').on('click', '.staffBtn', function () {
                var staffId = $(this).val();
                // $('#myFeesModal').modal('show');
                $.ajax({
                    url: "fetchStaffPayroll/" + staffId,
                    type: "GET",
                    /*success: function (response) {
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

                        /!* $('#student_id').val(response.student_fee.student_id);
                         $('#session_id').val(response.student_fee.session_id);
                         $('#feemaster_id').val(response.student_fee.feemaster_id);
                         $('#due_date').val(response.student_fee.due_date);
                         $('#feegroup_id').val(response.student_fee.feegroup_id);
                         $('#feetype_id').val(response.student_fee.feetype_id);*!/
                    }*/
                });
            });

        });
    </script>--}}
@stop
