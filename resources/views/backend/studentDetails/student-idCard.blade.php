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
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="form-group col-md-12">
                    <div class="alert alert-primary text-center" style="background-color:#ededff">
                        <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                    </div>
                    <form  action="{{ route('studentIdCardGenerate') }}" method="post" id="searchStudentClassGroupWaise">
                        @csrf
                        <div class="form-group col-sm-6">
                            <level for="class">Class</level>
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
                            <level for="year">Admission Year</level>
                            <select id="year-option" name="year" class="form-control">
                                <option value="">None</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                                <option value="2015">2015</option>
                            </select>
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary" id="showTableBtn"><i class="voyager-search">search</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop



@section('javascript')
@stop

