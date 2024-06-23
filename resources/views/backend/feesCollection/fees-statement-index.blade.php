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
                        <div class="form-group col-sm-3">
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
                        <div class="form-group col-sm-3">
                            <level for="group">Group<small class="color">*</small></level>
                            <select id="group-dropdown" name="group_id" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <level for="students">Students<small class="color">*</small></level>
                            <select id="student-dropdown" name="student_id" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-sm-3 float-right" style="margin-top:17px;">
                            <button type="submit" class="btn btn-primary" id="showTableBtn">Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" hidden="hidden" id="studentFeeDiv">
        <div class="box box-primary">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="box-title">Student Fees</h3>
                    </div>
                    <div class="col-md-8 ">
                        <div class="btn-group pull-right">
                            <a href="http://kajcc.edu.bd/studentfee" type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-arrow-left"></i> </a>
                        </div>
                    </div>
                </div>
            </div><!--./box-header-->
            <div class="box-body" style="padding-top:0;">
                <div class="row">
                    <div class="col-md-2">
                        <div class="sfborder" id="image"></div>
                    </div>
                    <div class="col-md-10">
                        <table class="table table-striped mb0 font13">
                            <tbody id="tbody1">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="col-md-12 mDMb10">
                        <span class="pull-right">Date:{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover example table-fixed-header dataTable no-footer dtr-inline"
                               id="dataTable" role="grid" style="width: 1121px;">
                            <thead class="header" style="margin: 0px auto; width: 1114px;">
                            <tr role="row">
                                <th align="left" class="sorting_disabled" rowspan="1" colspan="1" style="width: 102px;">
                                    Fees Group
                                </th>
                                <th align="left" class="sorting_disabled" rowspan="1" colspan="1" style="width: 90px;">
                                    Fees Type
                                </th>
                                <th align="left" class="text text-left sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 74px;">Due Date
                                </th>
                                <th align="left" class="text text-left sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 77px;">Status
                                </th>
                                <th class="text text-right sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 84px;">Amount <span>(TK)</span></th>
                                <th class="text text-left sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 75px;">Payment Id
                                </th>
                                <th class="text text-left sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 38px;">Mode
                                </th>
                                <th class="text text-left sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 74px;">Date
                                </th>
                                <th class="text text-right sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 90px;">Discount <span>(TK)</span></th>
                                <th class="text text-right sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 60px;">Fine <span>(TK)</span></th>
                                <th class="text text-right sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 72px;">Paid <span>(TK)</span></th>
                                <th class="text text-right sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 85px;">Balance <span>(TK)</span></th>
                            </tr>
                            </thead>

                                <tbody id="tbody2">


                                {{--<tr class="dark-gray odd" role="row">
                                    <td tabindex="0"><input class="checkbox" type="checkbox" name="fee_checkbox"
                                                            data-fee_master_id="452" data-fee_session_group_id="3"
                                                            data-fee_groups_feetype_id="2"></td>
                                    <td align="left">{{$student_fee->feeGroup->fee_group_name}}</td>
                                    <td align="left">{{$student_fee->feeType->fee_name}}</td>
                                    <td align="left" class="text text-left">

                                        {{$student_fee->due_date}}
                                    </td>
                                    <td align="left" class="text text-left width85">
                                        @if($student_fee->status == 0)<span class="label label-danger">Unpaid</span>@else<span class="label label-success">Paid</span> @endif
                                    </td>
                                    <td class="text text-right">{{ $student_fee->amount }}</td>

                                    <td class="text text-left">{{ $student_fee->payment_id }}</td>
                                    <td class="text text-left">{{ $student_fee->payment_mode }}</td>
                                    <td class="text text-left">{{ $student_fee->date }}</td>
                                    <td class="text text-right">{{ $student_fee->amount_discount }}</td>
                                    <td class="text text-right">{{ $student_fee->fine }}</td>
                                    <td class="text text-right">{{ $student_fee->paid }}</td>
                                    <td class="text text-right">{{ $student_fee->balance }}</td>
                                    <td>
                                        @if($student_fee->status == 0)
                                            <div class="btn-group pull-right">
                                                <button type="button" value="{{$student_fee->id}}" class="btn btn-xs btn-default myCollectFeeBtn" title="Add Fees"><i class="voyager-plus"></i></button>

                                                 <button class="btn btn-xs btn-default printInv" data-fee_master_id="452"
                                                         data-fee_session_group_id="3" data-fee_groups_feetype_id="2"
                                                         title="Print"><i class="fa fa-print"></i></button>
                                            </div>
                                        @endif
                                    </td>



                                </tr>--}}
                                {{--@if($student_fee->status == 1)
                                    <tr class="white-td even" role="row">
                                        <td align="left" tabindex="0"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td class="text-right"><img src="http://kajcc.edu.bd/backend/images/table-arrow.png"
                                                                    alt=""></td>
                                        <td class="text text-left">


                                            <a href="#" data-toggle="popover" class="detail_popover" data-original-title=""
                                               title="">{{ $student_fee->payment_id }}</a>
                                            <div class="fee_detail_popover" style="display: none">
                                                <p class="text text-info">{{ $student_fee->user->name }}</p>
                                            </div>


                                        </td>
                                        <td class="text text-left">{{ $student_fee->payment_mode }}</td>
                                        <td class="text text-left">
                                            {{ $student_fee->date }}
                                        </td>
                                        <td class="text text-right">{{ $student_fee->amount_discount }}</td>
                                        <td class="text text-right">{{ $student_fee->fine }}</td>
                                        <td class="text text-right">{{ $student_fee->paid }}</td>
                                        <td></td>
                                     --}}{{--   <td class="text text-right">
                                            <div class="btn-group pull-right">

                                                <a href="{{route('deleteStudentFees',$student_fee)}}"><button  type="button"
                                                                                                               class="btn btn-xs btn-default" title="Add Fees"><i class="voyager-dot-2"></i></button></a>

                                                <button class="btn btn-xs btn-default printDoc" data-main_invoice="2"
                                                        data-sub_invoice="1" title="Print"><i class="fa fa-print"></i></button>
                                            </div>
                                        </td>--}}{{--
                                    </tr>
                                @endif--}}
                                </tbody>
                            <tr class="box box-solid total-bg even" role="row" id="total">

                            </tr>


                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>


    </div>



@stop



@section('javascript')

    <script>
        $(document).ready(function () {
            /*$('#dataTable').DataTable( {
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
                    /!*{
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
                    }*!/
                ]
            } );*/
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                var studentId = $('#student-dropdown').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchStudentFees')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId,
                            student_id: studentId,
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            $('#studentFeeDiv').show();
                            $('#image').html(response.img);
                            $('#tbody1').html(response.tbody);
                            $('#tbody2').html(response.tbody2);
                            $('#total').html(response.total);
                            //createRows(response);

                        }
                    });
                }

            });

            /*function createRows(response) {
                var len = 0;
                $('#studentFeeDiv').show();
                $('#studentTable tbody').empty();
                if (response['studentFees'] != null) {
                    len = response['studentFees'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var classId = response['studentFees'][i].clase.name;
                        var groupId = response['studentFees'][i].group.id;
                        var session = response['session'][0].id;
                        var studentId = response['studentFees'][i].id;
                        var name = response['studentFees'][i].full_name;
                        var admissionNumber = response['studentFees'][i].admission_no;
                        var admissionDate = response['studentFees'][i].admission_date;
                        var roll = response['studentFees'][i].roll_number;
                        var fatherName = response['studentFees'][i].father_name;
                        var tr_str = "<tr>" +
                            "<input type='hidden' value='"+session+"' name='session_id'>"  +
                            "<input type='hidden' value='"+classId+"' name='clase_id'>"  +
                            "<input type='hidden' value='"+groupId+"' name='group_id'>"  +
                            "<input type='hidden' value='"+studentId+"' name='student_id[]'>"+
                            "<td>" + name + "</td>" +
                            "<td>" + admissionNumber + "</td>" +
                            "<td>" + admissionDate + "</td>" +
                            "<td>" + roll + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + "<input type='number' class='form-control' name='amount[]'>" + "</td>" +
                            "</tr>";
                        $("#studentTable").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";

                    $("#studentTable tbody").append(tr_str);
                }
            }*/

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
                $('#group-dropdown').on('change', function () {
                    var groupId = this.value;
                    //console.log(idClass);
                    $("#student-dropdown").html('');
                    $.ajax({
                        url: "{{route('fetchStudent')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            console.log(result);
                            $('#student-dropdown').html('<option value="">Name</option>');
                            $.each(result.students, function (key, value) {
                                $("#student-dropdown").append('<option value="' + value
                                    .id + '">' + value.full_name + '</option>');
                            });
                        }
                    });
                });
            });

        });
    </script>
@stop
