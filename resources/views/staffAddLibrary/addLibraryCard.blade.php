@extends('voyager::master')


@section('content')

    <div class="row">
        <div class="offset-2 col-lg-8 center">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center">Add Library Card</div>
                    <hr>
                    <form action="{{ route('staff.libraryCardUpdate',$staff) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="input-1">Library Card Number</label>
                            <input type="text" name="library_id" class="form-control" id="library_id" value="{{$staff->library_id}}">

                        </div>
                        <div class="form-group text-left">
                            <button type="submit" class="btn btn-primary px-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
@stop

