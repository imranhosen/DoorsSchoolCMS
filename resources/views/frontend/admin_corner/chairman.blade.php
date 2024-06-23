@extends('frontend.layouts.master')
@section('content')
    @foreach($chairman as $man)
    <div class="container spacet50 spaceb50 centerAndFont">
        <div class="row">

            <div class="col-md-12">
                <p style="align-content: center"><img width="700" height="800" class="round5"
                                                   src="{{ Voyager::image($man->staff_image) }}" alt="No Image"></p>

                <table border="0" font-size:="" helvetica="" style="border-spacing: 0px; border-collapse: collapse; font-family: " width="100%">
                    <tbody style="box-sizing: border-box;">
                    <tr style="box-sizing: border-box;">
                        <td style="box-sizing: border-box; padding: 0px; text-align: justify; text-align: center; font-size: large"><span style="box-sizing: border-box; font-weight: 700;">{{$man->first_name}} {{$man->last_name}}</span></td>
                    </tr>
                    <tr style="box-sizing: border-box;">
                        <td colspan="5" style="box-sizing: border-box; padding: 0px; text-align: center; font-size: large">সভাপতি</td>
                    </tr>
                    <tr style="box-sizing: border-box;">
                        <td colspan="5" style="box-sizing: border-box; padding: 0px; text-align: center; font-size: large">গভর্নিং বডি</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div><!--./row-->
    </div>
    @endforeach
@stop
