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
        <div class="panel panel-bordered">
            <div class="panel-body">
                <div class="col-md-4">
                    <h3 class="box-title"><i class="fa-solid fa-user-group"></i> Student</h3>
                </div>
                <div class="col-md-8 ">
                    <div class="btn-group pull-right">
                        <a href="{{route('studentFeeIndex')}}" type="button" class="btn btn-primary btn-xs">
                            <i class="fa fa-arrow-left"></i> </a>
                    </div>
                </div>
            </div>
        </div><!--./box-header-->
        <div class="box-body" style="padding-top:0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="sfborder">
                        <div class="col-md-2">
                            <img width="150" height="145" class="round5"
                                 src="{{ Voyager::image($student->student_image) }}" alt="No Image">
                        </div>

                        <div class="col-md-10">
                            <div class="row">
                                <table class="table table-striped mb0 font13">
                                    <tbody>
                                    <tr>
                                        <th class="bozero">Name</th>
                                        <td class="bozero">{{ $student->full_name }}</td>

                                        <th class="bozero">Class Group</th>
                                        <td class="bozero">{{ $student->clase->name }}({{$student->group->name}})
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Father Name</th>
                                        <td>{{ $student->father_name }}</td>
                                        <th>Admission Number</th>
                                        <td>{{$student->admission_no}}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile Number</th>
                                        <td>{{ $student->mobile_number }}</td>
                                        <th>Roll Number</th>
                                        <td>{{$student->roll_number}}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{$student->group->name}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-12">
                    <div style="background: #dadada; height: 1px; width: 100%;">
                        <h3 class="bold"><i class="fa-solid fa-bangladeshi-taka-sign"></i> Fees Details</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span class="pull-right">Date:{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span>
                </div>
            </div>
            <div class="table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <table id="dataTable" class="table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            {{--<th style="width: 14px;" class="sorting_disabled" rowspan="1" colspan="1" aria-sort="descending">#</th>--}}
                            <th>Fees Group</th>
                            <th>Fees Type</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Amount <span>(TK)</span></th>
                            <th>Payment Id</th>
                            <th>Mode</th>
                            <th>Date</th>
                            <th>Discount <span>(TK)</span></th>
                            <th>Fine <span>(TK)</span></th>
                            <th>Paid <span>(TK)</span></th>
                            <th>Balance <span>(TK)</span></th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach($student_fees as $student_fee)
                            <tbody>
                            <tr>
                                <td align="left">{{$student_fee->feeGroup->fee_group_name}}</td>
                                <td align="left">{{$student_fee->feeType->fee_name}}</td>
                                <td align="left" class="text text-left">{{$student_fee->due_date}}</td>
                                <td align="left" class="text text-left width85">
                                    @if($student_fee->status == 0)<span
                                        class="label label-danger">Unpaid</span>@else<span
                                        class="label label-success">Paid</span> @endif
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
                                            <button type="button" value="{{$student_fee->id}}"
                                                    class="btn btn-xs btn-primary myCollectFeeBtn" title="Add Fees">
                                                <i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @if($student_fee->status == 1)
                                <tr>
                                    <td align="left"></td>
                                    <td align="left"></td>
                                    <td align="left"></td>
                                    <td align="left"></td>
                                    <td class="text-right"><img
                                            src="http://kajcc.edu.bd/backend/images/table-arrow.png"
                                            alt=""></td>
                                    <td class="text text-left">
                                        <a href="#" data-toggle="popover" class="detail_popover"
                                           data-original-title=""
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
                                    <td class="text text-right">
                                        <div class="btn-group pull-right">

                                            {{--<a href="{{route('deleteStudentFees',$student_fee)}}" id="delete_form_{{$student_fee}}"><button  type="button"
                                                       class="btn btn-xs btn-default" title="Remove Fees" onclick="deleteFee({{$student_fee}})"><i class="voyager-dot-2"></i></button></a>--}}
                                            <button type="submit"
                                                    class="btn btn-xs btn-danger" title="Remove Fees"
                                                    onclick="deleteFee({{$student_fee->id}})"><i
                                                    class="fa-solid fa-minus"></i></button>

                                            {{--<button class="btn btn-xs btn-default printDoc" data-main_invoice="2"
                                                    data-sub_invoice="1" title="Print"><i class="fa fa-print"></i></button>--}}
                                        </div>
                                        <form id="delete_form_{{$student_fee->id}}" method="post"
                                              action="{{route('deleteStudentFees',$student_fee)}}"
                                              style="display: none;">
                                            @method('DELETE')
                                            @csrf

                                        </form>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        @endforeach
                        <tr>
                            <td align="left"></td>
                            <td align="left"></td>
                            <td align="left"></td>
                            <td align="left" class="text text-left">Grand Total</td>
                            <td class="text text-right">TK {{$sumAmount}}</td>
                            <td class="text text-left"></td>
                            <td class="text text-left"></td>
                            <td class="text text-left"></td>

                            <td class="text text-right">TK {{$sumDiscountAmount}}</td>
                            <td class="text text-right">TK {{$sumFine}}</td>
                            <td class="text text-right">TK {{$sumPaid}}</td>
                            <td class="text text-right">TK {{$sumBalance}}</td>
                            <td class="text text-right"></td>
                        </tr>
                    </table>
                    <div class="modal fade" id="myFeesModal" role="dialog">
                        <div class="modal-dialog">
                            <form action="{{route('updateStudentFees')}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: linear-gradient(to right,#03709e,#18c3fd 100%);
    background-image: linear-gradient(to right, rgb(3, 112, 158), rgb(24, 195, 253) 100%);
    background-position-x: initial;
    background-position-y: initial;
    background-size: initial;
    background-repeat-x: initial;
    background-repeat-y: initial;
    background-attachment: initial;
    background-origin: initial;
    background-clip: initial;">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title title text-center fees_title">Collect Fees
                                            of {{ $student->full_name }}</h4>
                                    </div>
                                    <div class="modal-body pb0">
                                        <div class="form-horizontal">
                                            <div class="box-body">
                                                <input type="hidden" class="form-control" id="student_fee_id"
                                                       name="student_fee_id" readonly="readonly">
                                                <div class="form-group">
                                                    <label for="inputEmail3"
                                                           class="col-sm-3 control-label">Date<small
                                                            class="color">*</small></label>
                                                    <div class="col-sm-9">
                                                        <input id="date" name="date" placeholder="" type="text"
                                                               class="form-control date"
                                                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                               readonly="readonly">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3"
                                                           class="col-sm-3 control-label">Amount<small
                                                            class="color">*</small></label>
                                                    <div class="col-sm-9">

                                                        <input type="text" autofocus=""
                                                               class="form-control modal_amount" id="amount"
                                                               name="amount">

                                                        <span class="text-danger" id="amount_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-3 control-label">Discount
                                                        Group</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control modal_discount_group"
                                                                id="discount_group">
                                                        </select>

                                                        <span class="text-danger" id="amount_error"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group mb0">
                                                    <label for="inputPassword3"
                                                           class="col-sm-3 control-label">Discount</label>
                                                    <div class="col-sm-9">

                                                        <div class="col-md-5 col-sm-5">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control"
                                                                       id="amount_discount" name="amount_discount">

                                                                <span class="text-danger" id="amount_error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 ltextright">

                                                            <label for="inputPassword3"
                                                                   class="row control-label">Fine</label>
                                                        </div>
                                                        <div class="col-md-5 col-sm-5">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="fine"
                                                                       name="fine">

                                                                <span class="text-danger"
                                                                      id="amount_fine_error"></span>
                                                            </div>
                                                        </div>

                                                    </div><!--./col-sm-9-->
                                                </div>


                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-3 control-label">Payment
                                                        Mode<small class="color">*</small></label>
                                                    <div class="col-sm-9">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="payment_mode" value="Cash"
                                                                   checked="checked">Cash </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="payment_mode" value="Cheque">Cheque
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="payment_mode" value="DD">DD
                                                        </label>
                                                        <span class="text-danger" id="payment_mode_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3"
                                                           class="col-sm-3 control-label">Note</label>

                                                    <div class="col-sm-9">
                                                            <textarea class="form-control" rows="3" id="description"
                                                                      name="description" placeholder=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="box-body">
                                            <button type="button" class="btn btn-dark pull-left"
                                                    data-dismiss="modal">Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary" id="load"
                                                    data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">
                                                TK Collect Fees
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@stop
@section('javascript')
    <script type="text/javascript">
        function deleteFee(id) {
            swal({
                title: 'Are you sure?',
                text: "This will delete Income of Head and also revert Student Fees !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete_form_' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {

                }
            })
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
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
            $('.myCollectFeeBtn').on('click', function () {
                var studentFeeId = $(this).val();
                $('#myFeesModal').modal('show');
                $.ajax({
                    url: "fetchStudentFee/" + studentFeeId,
                    type: "GET",
                    success: function (response) {
                        console.log(response);
                        $('#student_fee_id').val(studentFeeId);
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
            /* $('#dataTable').DataTable({
                 dom: 'Brt',
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
             });*/

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
