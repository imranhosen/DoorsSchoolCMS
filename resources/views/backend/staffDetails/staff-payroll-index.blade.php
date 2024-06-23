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
                            <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <form id="searchByRole">
                                    <div class="form-group col-sm-4">
                                        <label for="role">Role<small class="req">*</small></label>
                                        <select name="role_id" id="role_id" class="form-control">
                                            <option value="">-- Select --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}">
                                                    {{$role->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="role">Month<small class="req">*</small></label>
                                        <select name="month" id="month_id" class="form-control">
                                            <option value=""> Select</option>
                                            <option value="1"> January</option>
                                            <option value="2"> February</option>
                                            <option value="3"> March</option>
                                            <option value="4"> April</option>
                                            <option value="5"> May</option>
                                            <option value="6"> June</option>
                                            <option value="7"> July</option>
                                            <option value="8"> August</option>
                                            <option value="9"> September</option>
                                            <option value="10"> October</option>
                                            <option value="11"> November</option>
                                            <option value="12"> December</option>
                                        </select>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="year">Year<small class="req">*</small></label>
                                        <select name="year" id="year_id" class="form-control">
                                            <option value=""> Select</option>
                                            <option value="2025"> 2025</option>
                                            <option value="2024"> 2024</option>
                                            <option value="2023"> 2023</option>
                                            <option value="2022"> 2022</option>
                                            <option value="2021"> 2021</option>
                                        </select>
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-2" style="margin-top: 22px">
                                        <button type="submit" name="search" value="search_filter"
                                                class="btn btn-primary btn-sm pull-right checkbox-toggle"><i
                                                class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid" hidden="hidden" id="staffPayrollDiv">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="tab-pane table-responsive no-padding" id="tab_2">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                <table
                                    class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline"
                                    cellspacing="0" width="100%" id="staffTable" role="grid"
                                    aria-describedby="DataTables_Table_0_info" style="width: 100%;">
                                    <thead>
                                    <tr role="row">
                                        <th>Staff ID</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Phone</th>
                                        {{--<th>Status</th>--}}
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody1">
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
            $('#searchByRole').submit(function (e) {
                e.preventDefault();
                var roleId = $('#role_id').val();
                var month = $('#month_id').val();
                var year = $('#year_id').val();
                if (roleId > 0 && month != 0 && year != 0) {
                    $.ajax({
                        url: "{{route('fetchStaffByRoleMonthYear')}}",
                        type: "POST",
                        data: {
                            role_id: roleId,
                            month: month,
                            year: year
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            createRows(response);
                            /*$('#tbody1').empty();
                            $('#tbody1').html(response.tbody1);
                            $('#cardDiv').empty();
                            $('#cardDiv').html(response.tbody2);*/
                        }
                    });
                }

            });
            function createRows(response) {
                var len = 0;
                $('#staffPayrollDiv').show();
                $('#staffTable tbody').empty();
                var month = response.month;
                var year = response.year;
                if (response['staffs'] != null) {
                    len = response['staffs'].length;
                }
                var status = " ";
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                       /* if(response['payslips'][i].status){
                            status = 'Not Generate';
                        }else{
                            status = 'Generate';
                        }*/
                        var staffId = response['staffs'][i].id;
                        var staffName = response['staffs'][i].full_name;
                        var staffRole = response['staffs'][0].role.name;
                        var department = response['staffs'][i].department.department_name;
                        var designation = response['staffs'][i].designation.designation_name;
                        var phone = response['staffs'][i].contact_no;
                        //var status = response['staffs'][i].admission_date;
                        var tr_str = "<tr>" +
                            "<input type='hidden' value='"+month+"' name='month'>"  +
                            "<input type='hidden' value='"+year+"' name='year'>"  +
                            "<td>" + staffId + "</td>" +
                            "<td>" + staffName + "</td>" +
                            "<td>" + staffRole + "</td>" +
                            "<td>" + department + "</td>" +
                            "<td>" + designation + "</td>" +
                            "<td>" + phone + "</td>" +
                            /*"<td>" + status + "</td>" +*/
                            "<td>" + "<button type='button' value='" + staffId + "' class='btn-xs btn-default staffBtn' title='Generate' id='myCollectFeeBtn'>" + 'Generate Payroll' + "</button>"

                        "</tr>";
                        $("#staffTable").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";

                    $("#studentTable tbody").append(tr_str);
                }
                $('body').on('click', '.staffBtn', function () {
                    var staffId = $(this).val();
                    var month = response.month;
                    var year = response.year;
                    window.location.href = "fetchStaffPayroll/"+staffId+"/"+month+"/"+year;
                });
            }

        });
    </script>
@stop
