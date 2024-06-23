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
                        <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                    </div>
                    <form id="searchStudentClassGroupWaise">
                        <div class="form-group col-sm-5">
                            <level for="month" class="bold">Month</level>
                            <small class="req"> *</small>
                            <select name="month" id="month-dropdown" class="form-control">
                                <option value="">Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>

                            </select>
                        </div>
                        <div class="form-group col-sm-5">
                            <level for="year" class="bold">Year</level>
                            <small class="req"> *</small>
                            <select id="year-dropdown" name="year_id" class="form-control">
                                <option value="">Year</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2" style="margin-top: 16px">
                            <button type="submit" class="btn btn-primary" id="showTableBtn"><i
                                    class="fa-sharp fa-solid fa-magnifying-glass"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="page-content browse container-fluid" hidden="hidden" id="attendanceDiv">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                <div class="box-header with-border">
                    <h3 class="bold"><i class="fa-solid fa-list"></i> Attendance Details</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="studentTable1">
                            <thead>
                            <tr>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            </tr>
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
                    var th = "<th width='20%'>" + date1 + "</th>";
                    var student = response['attendences'][0].student.full_name;
                    var clase = response['attendences'][0].clase.name;
                    var group = response['attendences'][0].group.name;
                    var studentName = "<th width='20%'>" + student+" ("+clase+"-"+"("+group+"))"+"</th>";
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
                            "<th width='10%'>" + date + "</thwidth>";
                        var tr_str =
                            "<td width='10%'>" + atd_type + "</td>";
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
