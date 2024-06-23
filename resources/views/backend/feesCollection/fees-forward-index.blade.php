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
                        <div class="form-group col-sm-4">
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
                        <div class="form-group col-sm-4">
                            <level for="group">Group<small class="color">*</small></level>
                            <select id="group-dropdown" name="group_id" class="form-control">
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
    <form action="{{route('studentFeesForwardStore')}}" method="post">
        @csrf
    <div class="form-group col-md-12" hidden="hidden" id="studentFeeDiv">
        <div class="form-row">
            <h3><i class="fa fa-calendar" aria-hidden="true"></i>Previous Session Balance Fees</h3>
            <div class="pull-right">
                <span class="text text-danger pt6 bolds">Due Date:</span>{{ \Carbon\Carbon::now()->format('d-m-Y') }}
                <input id="due_date" name="due_date" placeholder="" type="hidden" class="form-control date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly="">
            </div>
        </div>
        <hr>
        <table class="table" id="studentTable">
            <thead>
            <tr>
                <th>Student Name</th>
                <th>Admission Number</th>
                <th>Admission Date</th>
                <th>Roll Number</th>
                <th>Father Name</th>
                <th>Balance</th>
            </tr>
            </thead>
            <tbody>
            </tbody>

        </table>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" name="action" value="fee_submit" class="btn btn-dark pull-right">Save
                </button>
            </div>
        </div>
    </div>
    </form>



@stop



@section('javascript')

    <script>
        $(document).ready(function () {
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchStudentForFeesForward')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            createRows(response);

                        }
                    });
                }

            });

            function createRows(response) {
                var len = 0;
                $('#studentFeeDiv').show();
                $('#studentTable tbody').empty();
                if (response['students'] != null) {
                    len = response['students'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var classId = response['students'][i].clase.id;
                        var groupId = response['students'][i].group.id;
                        var session = response['session'][0].id;
                        var studentId = response['students'][i].id;
                        var name = response['students'][i].full_name;
                        var admissionNumber = response['students'][i].admission_no;
                        var admissionDate = response['students'][i].admission_date;
                        var roll = response['students'][i].roll_number;
                        var fatherName = response['students'][i].father_name;
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
            }

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
