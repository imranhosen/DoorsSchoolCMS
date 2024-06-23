@extends('voyager::master')
{{--
@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))--}}

@section('content')

    <div class="page-content browse container-fluid">
        <h3><i class="fa-solid fa-user-group"></i> Staff Member List</h3>
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Member ID</th>
                                    <th>Library Card Number</th>
                                    <th>Staff Name</th>
                                    <th>Email</th>
                                    <th>Date Of Birth</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($staffs as $staff)
                                    <tr>
                                        <td>{{ $staff->id }}</td>
                                        <td>{{ $staff->library_id }}</td>
                                        <td>{{ $staff->full_name }}</td>
                                        <td>{{ $staff->staff_email }}</td>
                                        <td>{{ $staff->dob }}</td>
                                        <td>{{ $staff->contact_no }}</td>
                                        {{--<td>
                                            <a href="{{route('staff.libraryCardUpdate',$staff->id)}}"
                                               data-toggle="modal" data-target="#staffLibraryCardNoAdd{{$staff->id}}">@if($staff->library_id == null)<i class="voyager-plus"></i>@else<i class="voyager-forward"></i>@endif
                                            </a>
                                        </td>--}}
                                        <td>
                                            <button type="button" value="{{$staff->id}}" class="btn btn-dark myCollectFeeBtn">@if($staff->library_id == null)<i class="voyager-plus"></i>
                                                @else<i class="voyager-forward"></i>@endif
                                            </button>
                                        </td>

                                    </tr>
                                   {{-- <div class="modal fade" id="staffLibraryCardNoAdd{{$staff->id}}" value="{{$staff->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color:  skyblue">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel{{$staff->id}}">Add Member</h5>
                                                    <button type="button" class="close pull-top" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('staff.libraryCardUpdate',$staff->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="libraryCard">Library Card Number</label>
                                                                <input type="text" name="library_id" class="form-control" id="library_id" value="{{$staff->library_id}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <button type="submit" class="btn btn-primary px-5">@if($staff->library_id == null)Add @else Remove @endif</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>

                                        </div>
                                    </div>--}}
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myLibraryModal" role="dialog">
        <div class="modal-dialog">
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="lineModalLabel">Add Member</h3>
                </div>
                <div class="modal-body">
                    <!-- content goes here -->
                    <form action="{{route('updateStaffLibraryCard')}}" id="add_member" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="staff_id" id="staff_id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Library Card Number</label>
                            <input type="name" class="form-control" name="library_card_no" id="library_card_no">
                            <span class="text-danger" id="library_card_no_error"></span>
                        </div>
                        <button type="submit" class="btn btn-dark btn-sm add-member" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait..">Add</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable( {
                dom: 'Bfrtip',
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
            $('body').on('click', '.myCollectFeeBtn', function () {
                var staffId = $(this).val();
                //alert(staffId);
                $.ajax({
                    url: "fetch-staff-library-number/" + staffId,
                    type: "GET",
                    success: function (response) {
                        console.log(response);
                        $('#myLibraryModal').modal('show');
                        $('#staff_id').val(staffId);
                        $('#library_card_no').val(response.staff.library_id);
                        if(response.staff.library_id == null){
                            $('#myLibraryModal').modal('show').find('.add-member').text('Add');
                        }else {
                            $('#myLibraryModal').modal('show').find('.add-member').text('Remove');
                        }
                    }
                });
            });
        });
    </script>
@stop
