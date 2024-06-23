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
                        <form action="{{ route('studentSearch') }}" method="post" id="searchStudentClassGroupWaise">
                            @csrf
                            <div class="form-group col-sm-5">
                                <level for="class" class="bold">Class</level><small class="req">*</small>
                                <select name="class_id" id="class-dropdown" class="form-control">
                                    <option value="">-- Select Class --</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}">
                                            {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-5">
                                <level for="group" class="bold">Group</level><small class="req">*</small>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-sm-2" style="margin-top: 17px">
                                <button type="submit" class="btn btn-primary" id="showTableBtn"><i
                                        class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-content browse container-fluid" id="studentDatatDiv">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
        <h4 class="bold"><i class="fa-solid fa-list"></i> Student List</h4>
        <hr>
        <table class="table" id="studentTable">
            <thead>
            <tr>
                <th>Class</th>
                <th>Group</th>
                <th>Admission Number</th>
                <th>Student Name</th>
                <th>Father Name</th>
                <th>Date of Birth</th>
                <th>Mobile Number</th>
                <th>Action</th>
            </tr>
            </thead>
            @foreach($students as $student)
            <tbody>
                <td>{{ $student->clase->name }}</td>
                <td>{{ $student->group->name }}</td>
                <td>{{ $student->admission_no }}</td>
                <td>{{ $student->full_name }}</td>
                <td>{{ $student->father_name }}</td>
                <td>{{ $student->dob }}</td>
                <td>{{ $student->mobile_number }}</td>
                <td>
                    <a  href="{{route('addStudentFee',$student)}}" class="btn btn-dark btn-sm">TK Collect Fees</a>
                </td>
            </tbody>
            @endforeach
        </table>
    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('javascript')
    <script>
        $(document).ready(function () {
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
