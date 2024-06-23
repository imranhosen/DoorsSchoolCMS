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
        <div class="alerts">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <h3>Assign Exam</h3>
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="dt-not-orderable"><a>Exam Group</a></th>
                                    <th><a>Exam Type</a></th>
                                    <th>
                                        <a href="#">No of Exam
                                        </a>
                                    </th>
                                    <th class="actions text-right dt-not-orderable">Assign</th>
                                </tr>
                                </thead>
                                @foreach($examGroups as $examGroup)
                                <tbody>
                                <tr>
                                    <td>{{$examGroup->name}}</td>
                                    <td>
                                        <div>{{$examGroup->examType->name}}</div>
                                    </td>
                                    <td>{{$examGroup->exam_no}}</td>
                                    <td class="no-sort no-click bread-actions">
                                        <a href="{{route('studentExamGroupAssign',$examGroup)}}" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Assign</span>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                                    @endforeach
                            </table>
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
