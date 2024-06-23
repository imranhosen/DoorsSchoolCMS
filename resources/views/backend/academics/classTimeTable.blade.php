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
        <form action="{{route('timeTable.save')}}" method="post" id="searchStudentClassGroupWaise">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="alert alert-primary text-center" style="background-color:#ededff">
                                <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                            </div>

                            <div class="form-group col-sm-4">
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
                            <div class="form-group col-sm-4">
                                <level for="group">Group</level>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <level for="subject">Subject</level>
                                <select id="subject-dropdown" name="subject_id" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-sm-1" style="margin-top: 17px">
                                <button type="button" class="btn btn-primary" id="showTableBtn"><i
                                        class="fa-sharp fa-solid fa-magnifying-glass"></i> Search
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row" hidden="hidden" id="classTimetableDiv">
                <div class="col-lg-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <h4 class="bold"><i class="fa-regular fa-clock"></i> Class Timetable</h4>
                            <hr>
                            <table class="table" id="studentTable1">
                                <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Room Number</th>
                                </tr>
                                </thead>
                                <tbody>
                                <input type="hidden" value="Monday" name="day[]">
                                <tr>
                                    <th>Monday</th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour">10</span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute">59</span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian">AM</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="start_time[]" class="form-control"
                                                           id="stime_" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="end_time[]" class="form-control timepicker"
                                                           id="etime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" name="room[]" class="form-control" id="room_"
                                                   placeholder="Enter Room Number">
                                        </div>
                                    </th>
                                </tr>
                                <input type="hidden" value="Tuesday" name="day[]">
                                <tr>
                                    <th>
                                        Tuesday
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="start_time[]"
                                                           class="form-control timepicker" id="stime_"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="end_time[]" class="form-control timepicker"
                                                           id="etime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" name="room[]" class="form-control" id="room_"
                                                   placeholder="Enter Room Number">
                                        </div>
                                    </th>
                                </tr>
                                <input type="hidden" value="Wednesday" name="day[]">
                                <tr>
                                    <th>
                                        Wednesday
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="start_time[]"
                                                           class="form-control timepicker" id="stime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="end_time[]" class="form-control timepicker"
                                                           id="etime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" name="room[]" class="form-control" id="room_"
                                                   placeholder="Enter Room Number">
                                        </div>
                                    </th>
                                </tr>
                                <input type="hidden" value="Thursday" name="day[]">
                                <tr>
                                    <th>
                                        Thursday
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="start_time[]"
                                                           class="form-control timepicker" id="stime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="end_time[]" class="form-control timepicker"
                                                           id="etime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" name="room[]" class="form-control" id="room_"
                                                   placeholder="Enter Room Number">
                                        </div>
                                    </th>
                                </tr>
                                <input type="hidden" value="Friday" name="day[]">
                                <tr>
                                    <th>
                                        Friday
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="start_time[]"
                                                           class="form-control timepicker" id="stime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="end_time[]" class="form-control timepicker"
                                                           id="etime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" name="room[]" class="form-control" id="room_"
                                                   placeholder="Enter Room Number">
                                        </div>
                                    </th>
                                </tr>
                                <input type="hidden" value="Saturday" name="day[]">
                                <tr>
                                    <th>
                                        Saturday
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="start_time[]"
                                                           class="form-control timepicker" id="stime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="end_time[]" class="form-control timepicker"
                                                           id="etime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" name="room[]" class="form-control" id="room_"
                                                   placeholder="Enter Room Number">
                                        </div>
                                    </th>
                                </tr>
                                <input type="hidden" value="Sunday" name="day[]">
                                <tr>
                                    <th>
                                        Sunday
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="start_time[]"
                                                           class="form-control timepicker" id="stime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="#" data-action="incrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="incrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td class="meridian-column"><a href="#"
                                                                                       data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-up"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="bootstrap-timepicker-hour"></span></td>
                                                        <td class="separator">:</td>
                                                        <td><span class="bootstrap-timepicker-minute"></span></td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><span class="bootstrap-timepicker-meridian"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="#" data-action="decrementHour"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator"></td>
                                                        <td><a href="#" data-action="decrementMinute"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                        <td class="separator">&nbsp;</td>
                                                        <td><a href="#" data-action="toggleMeridian"><i
                                                                    class="glyphicon glyphicon-chevron-down"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group col-md-12">
                                                    <input type="time" name="end_time[]" class="form-control timepicker"
                                                           id="etime_">
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" name="room[]" class="form-control" id="room_"
                                                   placeholder="Enter Room Number">
                                        </div>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-dark" id="saveBtn">Save</button>
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

