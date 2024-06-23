@extends('voyager::master')

@section('css')
    <style>
        .req {
            color: #e94542;
        }

        table {
            border-collapse: collapse;
        }

        h2 h3 {
            margin: 0;
            padding: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .table {
            background-cotor: Off;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table tr td {
            padding: 5px;
        }

        .table-bordered thead th,
        .table-bordered td,
        .table-bordered th {
            border: 1px solid black !important;
        }

        .table-bordered thead th {
            background-color: #cacaca;
        }
    </style>

@stop
@section('content')
    @if($students != null)
    <body>

    @foreach($students as $student)
        <div class="container">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6"
                     style="border: 1px solid #000; margin: 0px 110px 0px 110px;  background-color:rgba(19,64,19,0)">
                    <table border="0" width="100%">

                        <tbody>
                        <tr>
                            <td width="30%" style="padding: 10px;">
                                <img src="{{$student->student_image}}" style="height: 73px; width: 63px; border-radius: 5px;">
                            </td>
                            <td width="40%" class="text-center">
                                <p style="color: red; font-size: 20px; margin-bottom: 5px !important">
                                    <strong>ABC School</strong>
                                </p>
                                <p class="btn btn-primary" style="padding: 5px; font-size: 20px;"> Student Id Card</p>
                            </td>
                            <td width="30%" style="padding: 10px; float: right">
                                <img src="{{$student->student_image}}" style="height: 73px; width: 63px; border-radius: 5px;">
                            </td>
                        </tr>
                        <tr>
                            <td width="45%" style="padding: 10px 3px 10px 5px"><p style="font-size: 16px;">
                                    <strong>Name :</strong>{{$student->full_name}}
                                </p>
                            </td>
                            <td width="10%" style="padding: 10px 3px 10px 5px">
                            </td>
                            <td width="45%" style="padding: 10px 3px 10px 5px"><p style="font-size: 16px;">
                                    <strong>ID No :</strong>{{$student->admission_no}}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" style="padding: 10px 3px 10px 5px"><p style="font-size: 16px;">
                                    <strong>Session :</strong>{{$student->session->name}}
                                </p>
                            </td>
                            <td width="20%" style="padding: 10px 3px 10px 5px"><p style="font-size: 16px;">
                                    <strong>Class :</strong>{{$student->clase->name}}
                                </p>
                            </td>
                            <td width="40%" style="padding: 10px 3px 10px 5px"><p style="font-size: 16px;">
                                    <strong>Roll No :</strong>{{$student->roll_number}}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td width="33%" style="padding: 15px 3px 5px 3px"></td>
                            <td width="33%" style="padding: 15px 3px 5px 3px"></td>
                            <td width="33%" style="padding: 15px 3px 5px 3px"></td>
                        </tr>
                        <tr>
                            <td width="50%" style="padding: 10px 3px 10px 5px"><p style="font-size: 16px;">
                                    <strong>Mobile No :</strong>{{$student->mobile_number}}
                                </p>
                            </td>
                            <td></td>
                            <td></td>
                            <td class="text-center">
                                <hr style="border: solid 1px; width: 100%; color: #000; margin-bottom: 0px; margin-left: 0px;">
                                <p style="text-align: center;">Headmaster</p>
                            </td>
                        </tr>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    @endforeach
       {{-- @else
        <div class="container">
            <h4> No Record Found</h4>
        </div>
        @endif--}}
    </body>
    @else
        <body>
            <div class="container">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-6"
                         style="border: 1px solid #000; margin: 0px 110px 0px 110px;  background-color:rgba(19,64,19,0)">
                        <table border="0" width="100%">

                            <tbody>
                           <tr>
                               <th class="req">
                                   No Record Found
                               </th>
                           </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </body>
    @endif
@stop



@section('javascript')
    <script>
        $(document).ready(function () {
            var printCounter = 0;
            $('#studentIdCardTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    {
                        extend: 'excel',
                        messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
                    },
                    {
                        extend: 'pdf',
                        messageBottom: null
                    },
                    {
                        extend: 'print',
                        messageTop: function () {
                            printCounter++;

                            if (printCounter === 1) {
                                return 'This is the first time you have printed this document.';
                            } else {
                                return 'You have printed this document ' + printCounter + ' times';
                            }
                        },
                        messageBottom: null
                    }
                ]
            });
        });
    </script>
@stop

