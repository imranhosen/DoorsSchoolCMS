@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50">
        <div class="row">
            <div class="col-md-12">
                <div class="post-list" id="postList">
                    @foreach($chairmans as $chairman)
                        <table width="100%" border="0" style="font-size:11px">
                            <tr>
                                <td colspan="5" align="center">
                                    <img width="200" alt="sss" src="{{ Voyager::image($chairman->staff_image) }}"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" align="center"><b>{{$chairman->full_name}}</b></td>
                            </tr>
                            <tr>
                                <td colspan="5" align="center">সভাপতি</td>
                            </tr>
                            <tr>
                                <td colspan="5" align="center">গভর্নিং বডি</td>
                            </tr>
                            <tr>
                                <td colspan="5" align="center">ডোরস বিদ্যালয়</td>
                            </tr>
                        </table>
                    @endforeach
                        {{--<tr>
                            @foreach($members as $member)
                                <div class="col-md-3" style="margin-bottom: 50px;height: 315px;">
                                    <td>
                                        <table width="100%" cellpadding="5" cellspacing="5" border="0"
                                               style="font-size:11px">
                                            <tr>
                                                <td align="center"><img width="200" height="250"
                                                                        src="{{Voyager::image($member->image)}}"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center"><b>{{$member->full_name}}</b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">{{$member->designation->designation_name}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="center">গভর্নিং বডি</td>
                                            </tr>
                                        </table>
                                    </td>
                                </div>
                            @endforeach
                        </tr>--}}
                    {{--<table width="100%"  border="0" style="font-size:11px">

                        <tr>
                            <td colspan="5" align="center"><img width="150" alt="মোঃ মামুনুর রশীদ" src="{{asset('frontend/assets')}}/uploads/govtbody/rashid.png"/></td>
                        </tr>
                        <tr>
                            <td colspan="5" align="center"><b>মোঃ মামুনুর রশীদ</b></td>
                        </tr>
                        <tr>
                            <td colspan="5" align="center">সভাপতি</td>
                        </tr>
                        <tr>
                            <td colspan="5" align="center">গভর্নিং বডি</td>
                        </tr>
                        <tr>
                            <td colspan="5" align="center">কর্ণফুলী আবদুল জলিল চৌধুরী কলেজ</td>
                        </tr>
                        <tr>

                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="আলহাজ্ব নুরুন্নাহার বেগম চৌধুরী" src="{{asset('frontend/assets')}}/uploads/govtbody/nurrunnahar.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>আলহাজ্ব নুরুন্নাহার বেগম চৌধুরী</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center"> প্রতিষ্ঠাতা সদস্য</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="নজরুল ইসলাম চৌধুরী" src="{{asset('frontend/assets')}}/uploads/govtbody/nazrul.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>নজরুল ইসলাম চৌধুরী</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center"> বিদ্যোৎসাহী সদস্য</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="মোঃ আজিজুর রহমান" src="{{asset('frontend/assets')}}/uploads/govtbody/aziz.png"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>মোঃ আজিজুর রহমান</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center"> দাতা সদস্য</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="মোহাম্মদ ফোরকান উদ্দীন" src="{{asset('frontend/assets')}}/uploads/govtbody/forkhan.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>মোহাম্মদ ফোরকান উদ্দীন</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center"> বিদ্যোৎসাহী সদস্য</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="আমির আহমদ" src="{{asset('frontend/assets')}}/uploads/govtbody/amir.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>আমির আহমদ</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center"> বিদ্যোৎসাহী সদস্য</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>


                        </tr>

                        <tr>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="সৈয়দ জালাল আহমদ" src="{{asset('frontend/assets')}}/uploads/govtbody/jalal.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>সৈয়দ জালাল আহমদ</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">সদস্য</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="ডা. ফারহানা মমতাজ" src="{{asset('frontend/assets')}}/uploads/govtbody/farhana.png"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>ডা. ফারহানা মমতাজ<b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">সদস্য</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="মোহাম্মদ জাফর ইকবাল" src="{{asset('frontend/assets')}}/uploads/govtbody/jafar.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>মোহাম্মদ জাফর ইকবাল</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">অভিভাবক প্রতিনিধি</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="মোহাম্মদ হারুন-অর-রশিদ" src="{{asset('frontend/assets')}}/uploads/govtbody/harung.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>মোহাম্মদ হারুন-অর-রশিদ</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">অভিভাবক প্রতিনিধি</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="মোহাম্মদ ইলিয়াছ" src="{{asset('frontend/assets')}}/uploads/govtbody/elias.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>মোহাম্মদ ইলিয়াছ</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">অভিভাবক প্রতিনিধি</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>


                        <tr align="center">
                            <!--<td>&nbsp;</td>

                            <td>
                                 <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="শামীম আকতার চৌধুরী" src="http://kajcc.edu.bd/uploads/govtbody/shamim.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>শামীম আকতার চৌধুরী</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">শিক্ষক প্রতিনিধি</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                 </table>
                            </td>-->
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="নাজমা বেগম" src="{{asset('frontend/assets')}}/uploads/govtbody/najma.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>নাজমা বেগম</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">শিক্ষক প্রতিনিধি</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="ইন্দ্রজিত কর" src="{{asset('frontend/assets')}}/uploads/govtbody/indrojit.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>ইন্দ্রজিত কর</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">শিক্ষক প্রতিনিধি</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="নাজনীন সুলতানা" src="{{asset('frontend/assets')}}/uploads/govtbody/najnin.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>নাজনীন সুলতানা</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">শিক্ষক প্রতিনিধি</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="120" alt="মোহাম্মদ জসীম উদ্দীন" src="{{asset('frontend/assets')}}/uploads/govtbody/jasim.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>মোহাম্মদ জসীম উদ্দীন</b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">অধ্যক্ষ ও সদস্য সচিব</td>
                                    </tr>

                                    <tr>
                                        <td align="center">গভর্নিং বডি</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>--}}
                </div>
            </div>



        </div><!--./row-->
    </div><!--./container-->
@stop
