@extends('voyager::master')
{{--
@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))--}}

@section('content')

    <div class="page-content browse container-fluid">
        <h3>Staff Member List</h3>
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
                                        <td>
                                           {{-- <a href="{{route('staff.libraryCardUpdate',$staff->id)}}"
                                               data-toggle="modal" data-target="#staffLibraryCardNoAdd{{$staff->id}}">@if($staff->library_id == null)<i class="voyager-plus"></i>@else<i class="voyager-forward"></i>@endif
                                            </a>--}}
                                            <a href="{{route('staff.libraryCardUpdate',$staff->id)}}"
                                               data-toggle="modal" data-target="#staffLibraryCardNoAdd{{$staff->id}}">@if($staff->library_id == null)<i class="voyager-plus"></i>@else<i class="voyager-forward"></i>@endif
                                            </a>
                                        </td>

                                    </tr>
                                        <div class="modal fade" id="staffLibraryCardNoAdd{{$staff->id}}" value="{{$staff->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('javascript')
@stop
