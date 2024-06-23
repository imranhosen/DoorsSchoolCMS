@extends('voyager::master')
@section('css')

@stop
@section('content')
    <div class="page-content browse container-fluid">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="form-group col-md-12">
                    <div class="alert alert-primary text-center" style="background-color: #999fac">
                        <h3 style="color: gainsboro">Select Criteria</h3>
                    </div>
                    <form action="{{route('studentShow')}}" method="post" id="searchStudentClass&GroupWaise">
                        @csrf
                        <div class="form-group col-sm-6">
                            <select name="class_id" id="class-dropdown" class="form-control">
                                <option value="">-- Select Class --</option>
                                @foreach ($classes as $class)
                                    <option value="{{$class->id}}">
                                        {{$class->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <select id="group-dropdown" name="group_id" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <button type="submit" class="btn btn-primary right" id="showTable"><i
                                    class="voyager-search">search</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="page-content browse container-fluid">
            <h3>Student List</h3>
            @include('voyager::alerts')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Member ID</th>
                                        <th>Library Card Number</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Date Of Admission</th>
                                        <th>Father Number</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->library_id }}</td>
                                            <td>{{ $student->full_name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->admission_date }}</td>
                                            <td>{{ $student->father_number }}</td>
                                            <td>
                                                <a href="{{route('student.libraryCardUpdate',$student->id)}}"
                                                   data-toggle="modal"
                                                   data-target="#studentLibraryCardNoAdd{{$student->id}}">@if($student->library_id == null)
                                                        <i class="voyager-plus"></i>@else<i
                                                            class="voyager-forward"></i>@endif
                                                </a>

                                            </td>

                                        </tr>
                                        <div class="modal fade" id="studentLibraryCardNoAdd{{$student->id}}"
                                             value="{{$student->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel{{$student->id}}">
                                                            Add Student</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('student.libraryCardUpdate',$student->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="libraryCard">Library Card Number</label>
                                                                    <input type="text" name="library_id"
                                                                           class="form-control" id="library_id"
                                                                           value="{{$student->library_id}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group text-left">
                                                                <button type="submit" class="btn btn-primary px-5">Add
                                                                </button>
                                                                <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        </form>
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



    {{--<div class="page-content browse container-fluid">
        <h3>Student List</h3>
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Library Card Number</th>
                                    <th>Admission Number</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Father Name</th>
                                    <th>Date Of Birth</th>
                                    <th>Gender</th>
                                    <th>Mobile Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->library_id }}</td>
                                        <td>{{ $student->library_id }}</td>
                                        <td>{{ $staff->full_name }}</td>
                                        <td>{{ $staff->staff_email }}</td>
                                        <td>{{ $staff->dob }}</td>
                                        <td>{{ $staff->contact_no }}</td>
                                        <td>
                                            --}}{{--<a  href="{{route('staff.addLibraryCardNo',$staff)}}" data-toggle="modal" data-target="#staffLibraryCardNoAdd"><i class="voyager-plus"></i></a>--}}{{--
                                            <a href="{{route('staff.libraryCardUpdate',$staff->id)}}"
                                               data-toggle="modal" data-target="#staffLibraryCardNoAdd{{$staff->id}}">@if($staff->library_id == null)<i class="voyager-plus"></i>@else<i class="voyager-forward"></i>@endif
                                                </a>

                                            --}}{{-- <a href="#staffLibraryCardNoAdd" data-toggle="modal"  onclick="{{ $staff->id }}">
                                                 <i class="voyager-plus"></i></a>--}}{{--
                                        </td>

                                    </tr>
                                        <div class="modal fade" id="staffLibraryCardNoAdd{{$staff->id}}" value="{{$staff->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel{{$staff->id}}">Add Member</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
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
                                                            <button type="submit" class="btn btn-primary px-5">Add</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                        </form>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </form>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}



    {{-- Single delete modal --}}
    {{--<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->--}}
@stop



@section('javascript')

    <script>
        $(document).ready(function () {
            $('#class-dropdown').on('change', function () {
                var idClass = this.value;
                $("#group-dropdown").html('');
                $.ajax({
                    url: "{{route('fetchGroup')}}",
                    type: "POST",
                    data: {
                        clase_id: idClass,
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
