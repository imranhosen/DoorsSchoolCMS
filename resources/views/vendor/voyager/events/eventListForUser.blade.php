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
                            <h4 style="color: #134013"><em><strong>Events</strong></em></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="classTimetableDiv">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <h4 class="bold"><i class="far fa-calendar-alt"></i> Recent Events</h4>
                        <hr>
                        <table class="table table-responsive" id="dataTable">
                            <thead>
                            <tr>
                                <th width="2%" style="text-align: left">#Sl</th>
                                <th width="14%" style="text-align: left">Event Title</th>
                                <th width="14%" style="text-align: left">Venue</th>
                                <th width="30%" style="text-align: left">Date/Time</th>
                                <th width="30%" style="text-align: left">Details</th>
                                <th width="10%" style="text-align: left">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($events as $event)
                                <tr>
                                    <td width="2%" style="text-align: left">{{ $i++ }}</td>
                                    <td width="14%" style="text-align: left">{{ $event->event_title }}</td>
                                    <td width="14%" style="text-align: left">{{ $event->venue }}</td>
                                    <td width="30%"
                                        style="text-align: left">{{ date('m/d/Y',strtotime($event->event_start)) }}
                                        -{{ date('m/d/Y',strtotime($event->event_end)) }}</td>
                                    <td width="30%" style="text-align: left">{{ $event->description }}</td>
                                    <td width="10%" style="text-align: left">
                                        @if($event->status == 0)
                                            <span class="label label-danger">Inactive</span>
                                        @else
                                            <span class="label label-success">Active</span>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
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
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#subject-dropdown').on('change', function () {
                $('#showTableBtn').on('click', function () {
                    $('#classTimetableDiv').show();
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

            $('#group-dropdown').on('change', function () {
                var groupId = this.value;
                $("#subject-dropdown").html('');
                $.ajax({
                    url: "{{route('fetchSubject')}}",
                    type: "POST",
                    data: {
                        group_id: groupId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#subject-dropdown').html('<option value="">-- Select Subject --</option>');
                        $.each(res.subjects, function (key, value) {
                            $("#subject-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');

                        });
                    }
                });
            });
        });
    </script>
@stop

