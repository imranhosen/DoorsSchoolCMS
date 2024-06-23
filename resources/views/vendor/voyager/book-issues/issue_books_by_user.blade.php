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
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="alert alert-primary text-center" style="background-color:#ededff">
                            <h4 style="color: #134013"><em><strong>Books</strong></em></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content browse container-fluid" id="attendanceDiv">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="box-header with-border">
                            <h3 class="bold"><i class="fas fa-book-open"></i> Issued Books</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th width="2%" style="text-align: center">#Sl</th>
                                        <th width="5%" style="text-align: center">Name</th>
                                        <th width="5%" style="text-align: center">Book No</th>
                                        <th width="8%" style="text-align: center">Publisher</th>
                                        <th width="20%" style="text-align: center">Author</th>
                                        <th width="20%" style="text-align: center">Subject</th>
                                        <th width="10%" style="text-align: center">Rack No</th>
                                        <th width="10%" style="text-align: center">Issue Date</th>
                                        <th width="10%" style="text-align: center">Return Date</th>
                                        <th width="10%" style="text-align: center">Is Returned?</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($books as $book)
                                        <tr>
                                            <td width="2%" style="text-align: center">{{$i++}}</td>
                                            <td width="10%" style="text-align: center">{{$book->book->book_title}}</td>
                                            <td width="5%" style="text-align: center">{{$book->book->book_no}}</td>
                                            <td width="10%" style="text-align: center">{{$book->book->publisher}}</td>
                                            <td width="15%" style="text-align: center">{{$book->book->author}}</td>
                                            <td width="18%" style="text-align: center">{{$book->book->subject}}</td>
                                            <td width="10%" style="text-align: center">{{$book->book->rack_no}}</td>
                                            <td width="10%" style="text-align: center">{{$book->issue_date}}</td>
                                            <td width="10%" style="text-align: center">{{$book->return_date}}</td>
                                            <td width="10%" style="text-align: center">@if($book->is_returned == 1)<span class="label label-success">YES</span> @else <span class="label label-danger">NO</span> @endif</td>
                                        </tr>
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
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var month = $('#month-dropdown').val();
                var year = $('#year-dropdown').val();
                if (month > 0) {
                    // $('#studentHistoryDiv1').hide();
                    $.ajax({
                        url: "{{route('fetchAttendenceDataByUser')}}",
                        type: "POST",
                        data: {
                            month: month,
                            year: year
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
                var date1 = 'Name/Date';
                $('#attendanceDiv').show();
                $('#studentTable1 thead tr').empty();
                $('#studentTable1 tbody tr').empty();
                if (response['attendences'] != null) {
                    len = response['attendences'].length;
                }
                if (len > 0) {
                    var th = "<th>" + date1 + "</th>";
                    var student = response['attendences'][0].student.full_name;
                    var clase = response['attendences'][0].clase.name;
                    var group = response['attendences'][0].group.name;
                    var studentName = "<th>" + student+" ("+clase+"-"+"("+group+"))"+"</th>";
                    $("#studentTable1 thead tr").append(th);
                    $("#studentTable1 tbody tr").append(studentName);
                    for (var i = 0; i < len; i++) {
                        var  date = response['attendences'][i].date;
                        // var mn  = date.getFullYear();
                        //alert(mn);
                        var atd_type = response['attendences'][i].atd_type.type;
                        /*var clase = response['attendences'][i].clase.name;
                        var group = response['attendences'][i].group.name;*/
                        var th_str =
                            "<th>" + date + "</th>";
                        var tr_str =
                            "<td>" + atd_type + "</td>";
                        /* "<td>" + clase + "</td>" +
                         "<td>" + group + "</td>" +*/
                        $("#studentTable1 thead tr").append(th_str);
                        $("#studentTable1 tbody tr").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='req'>No record found.</td>" +
                        "</tr>";
                    $("#studentTable1 tbody").append(tr_str);
                }
            }

            /* function createRows(response) {
                 var className = response['className'][0].name;
                 var groupName = response['groupName'][0].name;
                 var date = response['attendences'];
                 var present = response['present'];
                 var absent = response['absent'];
                 var late = response['late'];
                 var lateWithExcuse = response['lateWithExcuse'];
                 $('#attendanceDiv').show();
                 $('#studentTable1 tbody').empty();
                 if (date != null) {
                     var tr_str = "<tr>" +
                         "<td>" + date + "</td>" +
                         "<td>" + className + "</td>" +
                         "<td>" + groupName + "</td>" +
                         "<td>" + present + "</td>" +
                         "<td>" + absent + "</td>" +
                         "<td>" + late + "</td>" +
                         "<td>" + lateWithExcuse + "</td>" +
                         "</tr>";
                     $("#studentTable1 tbody").append(tr_str);
                 } else {
                     var tr_str = "<tr>" +
                         "<td align='center' colspan='4' class='req'>No record found.</td>" +
                         "</tr>";
                     $("#studentTable1 tbody").append(tr_str);
                 }
             }*/

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
            /*   var date_format = 'Y-m-d';
               $('#date').datepickerInput({
                   format: date_format,
                   autoclose: true
               });*/
        });
    </script>
@stop
