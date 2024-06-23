@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50">
        <div class="row">

            <div class="col-md-12">
                <div class="post-list" id="postList">
                    <table width="100%"  border="0" style="font-size:11px">
                        <tr>
                            @foreach($employees as $employee)
                                <div class="col-md-3" style="margin-bottom: 50px;">
                                    <td>
                                        <table width="100%" cellpadding="5" cellspacing="5" border="0"
                                               style="font-size:11px; height: 315px;">
                                            <tr>
                                                <td align="center"><img width="200" height="250"
                                                                        src="{{Voyager::image($employee->staff_image)}}"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center"><b>{{$employee->full_name}}</b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">{{$employee->designation->designation_name}}</td>
                                            </tr>
                                            @if($employee->qualifications != null)
                                                <tr>
                                                    <td align="center">( {{$employee->qualifications}} )</td>
                                                </tr>
                                            @endif
                                             @if($employee->contact_no != null)
                                                <tr>
                                                    <td align="center">Mobile: {{$employee->contact_no}}</td>
                                                </tr>
                                                @endif
                                            <tr>
                                                <td align="center">{{$employee->staff_email}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </div>
                            @endforeach
                        </tr>
                        {{--<tr>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Md. Nayem Uddin" src="{{asset('frontend/assets')}}/uploads/staff_images/32.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Md. Nayem Uddin</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">OFFICE ASSISTANT CUM ACCOUNTANT</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( Mba in Management )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">info@kajcc.nayem.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Krishna Kanta Nath" src="{{asset('frontend/assets')}}/uploads/staff_images/35.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Krishna Kanta Nath</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">OFFICE ASSISTANT CUM ACCOUNTANT</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( H.S.C )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">info@kajcc.krishna.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Farida Yeasmin " src="{{asset('frontend/assets')}}/uploads/staff_images/29.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Farida Yeasmin </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER - LIBRARY</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( M.ss (political science)
                                            p.g.d(library  & information) )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">faridayeasminruno@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Bably Aktar " src="{{asset('frontend/assets')}}/uploads/staff_images/31.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Bably Aktar </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">ASSISTSNT TEACHER - LIBRARY & INFO SCIENCE</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( degree pass & diploma library & information science )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">bablyaktar88@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>--}}
                    </table>
                </div>
            </div>



        </div><!--./row-->
    </div><!--./container-->
@stop
