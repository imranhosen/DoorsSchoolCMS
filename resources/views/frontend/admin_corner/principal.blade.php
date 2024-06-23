@extends('frontend.layouts.master')
@section('content')
    @foreach($principle as $prin)
    <div class="container spacet50 spaceb50">
        <div class="row">

            <div class="col-md-12">
                <p style="margin-left: 245px"><img width="700" height="800" class="round5"
                                                   src="{{ Voyager::image($prin->staff_image) }}" alt="No Image"></p>

                <table border="0" cellpadding="5" cellspacing="5" font-size:="" helvetica="" style="border-spacing: 0px; border-collapse: collapse; font-family: " width="100%">
                    <tbody style="box-sizing: border-box;">
                    <tr style="box-sizing: border-box;">
                        <td style="box-sizing: border-box; padding: 0px; text-align: justify; text-align: center; font-size: large"><span style="box-sizing: border-box; font-weight: 700;">{{$prin->first_name}} {{$prin->last_name}}</span></td>
                    </tr>
                    <tr style="box-sizing: border-box;">
                        <td style="box-sizing: border-box; padding: 0px; text-align: justify; text-align: center; font-size: large">প্রধান শিক্ষক চেয়ারম্যান</td>
                    </tr>
                    <tr style="box-sizing: border-box;">
                        <td style="box-sizing: border-box; padding: 0px; text-align: justify; text-align: center; font-size: large">গভর্নিং বডি</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div><!--./row-->
    </div>
    @endforeach
@stop
