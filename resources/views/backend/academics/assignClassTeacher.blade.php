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
        <form action="{{route('assignClassTeacher.save')}}" method="post" id="searchStudentClassGroupWaise">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="alert alert-primary text-center" style="background-color:#ededff">
                                <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                            </div>

                            <div class="form-group col-sm-6">
                                <level for="class" class="bold">Class</level>
                                <small class="color"> *</small>
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
                                <level for="group" class="bold">Group</level>
                                <small class="color"> *</small>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                            <br/>
                            <div class="form-group col-sm-4">
                                <h4 class="bold"><i class="fa-solid fa-user-group"></i>
                                    Assign Class Teachers</h4>
                                <input type="checkbox" id="select_all"> Select All
                                <hr/>
                                @foreach($staffs as $staff)
                                    <div class="checkbox">
                                        <label>
                                            <input class="checkbox" type="checkbox" name="teachers[]"
                                                   value="{{$staff->id}}">{{$staff->full_name}}
                                        </label>
                                    </div>
                                @endforeach
                                <span class="text-danger"></span>
                                <div class="form-group float-left">
                                    <button type="submit" class="btn btn-dark" id="saveBtn">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>


@stop
@section('javascript')
    <script>
        $(document).ready(function () {
            $('#select_all').change(function () {
                $('.checkbox').prop('checked', $(this).prop('checked'));
                $('.checkbox').on('click', function () {
                    if ($('.checkbox:checked').length == $('.checkbox').length) {
                        $('#select_all').prop('checked', true);
                    } else {
                        $('#select_all').prop('checked', false);
                    }
                });
            });
            $('#class-dropdown').on('change', function () {
                var classId = this.value;
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

