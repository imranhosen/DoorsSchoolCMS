@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50">
        <div class="row">
            <div class="col-md-12">
                <div class="post-list" id="postList">
                    @foreach($principle as $prin)
                    <table width="100%" border="0" style="font-size:11px">
                                <tr>
                                    <td colspan="5" align="center">
                                        <img width="200" alt="sss" src="{{ Voyager::image($prin->staff_image) }}"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="center"><b>{{$prin->full_name}}</b></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="center">{{$prin->designation->designation_name}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="center">( {{$prin->qualifications}} )</td>
                                </tr>
                                @if($prin->staff_email != null)
                                <tr>
                                    <td colspan="5" align="center">{{$prin->staff_email}}</td>
                                </tr>
                                @endif
                                @if($prin->contact_no != null)
                                <tr>
                                                    <td align="center">Mobile: {{$prin->contact_no}}</td>
                                                </tr>
                                                @endif
                    </table>
                        @endforeach
                        {{--  <tr>
                              <td colspan="5" align="center"><img width="200" alt="sss" src="{{asset('frontend/assets')}}/uploads/staff_images/2.jpg"/></td>
                          </tr>
                          <tr>
                              <td colspan="5" align="center"><b>Mohammad Jashim Uddin </b></td>
                          </tr>
                          <tr>
                              <td colspan="5" align="center">PRINCIPAL</td>
                          </tr>
                          <tr>
                              <td colspan="5" align="center">( B.SC(HONOURS), M.SC IN ZOOLOGY )</td>
                          </tr>
                          <tr>
                              <td colspan="5" align="center">principal@kajcc.edu.bd</td>
                          </tr>--}}

                        <tr>
                            @foreach($teachers as $teacher)
                                    <div class="col-md-3" style="margin-bottom: 50px;height: 315px;">
                                        <td>
                                            <table width="100%" cellpadding="5" cellspacing="5" border="0"
                                                   style="font-size:11px">
                                                <tr>
                                                    <td align="center"><img width="200" height="250"
                                                                            src="{{Voyager::image($teacher->staff_image)}}"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center"><b>{{$teacher->full_name}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td align="center">{{$teacher->designation->designation_name}}</td>
                                                </tr>
                                                @if($teacher->qualifications != null)
                                                    <tr>
                                                        <td align="center">( {{$teacher->qualifications}} )</td>
                                                    </tr>
                                                @endif
                                                @if($teacher->staff_email != null)
                                                <tr>
                                                    <td align="center">{{$teacher->staff_email}}</td>
                                                </tr>
                                                @endif
                                                 @if($teacher->contact_no != null)
                                                <tr>
                                                    <td align="center">Mobile: {{$teacher->contact_no}}</td>
                                                </tr>
                                                @endif
                                            </table>
                                        </td>
                                    </div>
                            @endforeach
                        </tr>
                        {{--<tr>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Samir Ranjan Nath " src="{{asset('frontend/assets')}}/uploads/staff_images/3.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Samir Ranjan Nath </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">VICE PRINCIPAL</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( M.COM(Accounting) )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">srnctg@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Pradip Roy " src="{{asset('frontend/assets')}}/uploads/staff_images/4.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Pradip Roy </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">ASSISTANT PROFESSOR</td>
                                    </tr>
                                    <tr>
                                        <td align="center">roypradip03@yahoo.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Md. Shafiqur Rashid " src="{{asset('frontend/assets')}}/uploads/staff_images/5.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Md. Shafiqur Rashid </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">ASSISTANT PROFESSOR</td>
                                    </tr>
                                    <tr>
                                        <td align="center">Shafiq63@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Shamim Akhter Chowdhury " src="{{asset('frontend/assets')}}/uploads/staff_images/6.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Shamim Akhter Chowdhury </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">ASSISTANT PROFESSOR</td>
                                    </tr>
                                    <tr>
                                        <td align="center">s.akhterchowdhury@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="H M Abu Obaida " src="{{asset('frontend/assets')}}/uploads/staff_images/7.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>H M Abu Obaida </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">ASSISTANT PROFESSOR</td>
                                    </tr>
                                    <tr>
                                        <td align="center">obaidactg@gmail.com</td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Taznin Ferdous " src="{{asset('frontend/assets')}}/uploads/staff_images/8.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Taznin Ferdous </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">ASSISTANT PROFESSOR</td>
                                    </tr>
                                    <tr>
                                        <td align="center">taznin.ferdous@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Nazma Begum " src="{{asset('frontend/assets')}}/uploads/staff_images/9.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Nazma Begum </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">ASSISTANT PROFESSOR</td>
                                    </tr>
                                    <tr>
                                        <td align="center">nazmabegumteacher@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Indrojit kar " src="{{asset('frontend/assets')}}/uploads/staff_images/10.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Indrojit kar </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">SENIOR LECTURER </td>
                                    </tr>
                                    <tr>
                                        <td align="center">ik.ctg75@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Roksana Khatun " src="{{asset('frontend/assets')}}/uploads/staff_images/11.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Roksana Khatun </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">SENIOR LECTURER </td>
                                    </tr>
                                    <tr>
                                        <td align="center">Roksana@kajcc.edu.bd</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Nazneen Sultana " src="{{asset('frontend/assets')}}/uploads/staff_images/12.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Nazneen Sultana </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">SENIOR LECTURER </td>
                                    </tr>
                                    <tr>
                                        <td align="center">najneen@kajcc.edu.bd</td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Abdul Kaiyoum " src="{{asset('frontend/assets')}}/uploads/staff_images/13.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Abdul Kaiyoum </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">SENIOR LECTURER </td>
                                    </tr>
                                    <tr>
                                        <td align="center">( MSc in Mathematics )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">masudmath@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Sujon Das " src="{{asset('frontend/assets')}}/uploads/staff_images/14.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Sujon Das </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">ctgsujandas100@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Biswajit Biswas " src="{{asset('frontend/assets')}}/uploads/staff_images/15.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Biswajit Biswas </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( Bsc(honours) in Zology, Msc in Zology(Fisheries)B.Ed )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">bbiswascu@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Abdul Jalil " src="{{asset('frontend/assets')}}/uploads/staff_images/17.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Abdul Jalil </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">jalilabdul@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Ershadul Islam " src="{{asset('frontend/assets')}}/uploads/staff_images/18.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Ershadul Islam </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( ma in philosophy )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">ershad.ukcoxs@gmail.com</td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Monwara Begum " src="{{asset('frontend/assets')}}/uploads/staff_images/19.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Monwara Begum </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( MA in English )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">monoa5178@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Mst. Rowshan Akther " src="{{asset('frontend/assets')}}/uploads/staff_images/20.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Mst. Rowshan Akther </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( BA(honours) MA in islamic history & culture )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">rowshanamn@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Mobarak Hossain " src="{{asset('frontend/assets')}}/uploads/staff_images/21.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Mobarak Hossain </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( M.a in bengali )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">mobarakdohel19900@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Mohammad Harun-Ur-Rashid " src="{{asset('frontend/assets')}}/uploads/staff_images/22.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Mohammad Harun-Ur-Rashid </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">harun.ctg55@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Ashraf Ali " src="{{asset('frontend/assets')}}/uploads/staff_images/23.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Ashraf Ali </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( MA in Bengalia )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">mdashrafali7701@gmail.com</td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Anupam Das Gupta " src="{{asset('frontend/assets')}}/uploads/staff_images/24.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Anupam Das Gupta </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( Bsc(honours), Msc-chemistry )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">anupom_cu@yahoo.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Fatema Farhana " src="{{asset('frontend/assets')}}/uploads/staff_images/25.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Fatema Farhana </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( Bbs, Mbs(accounting) & b.ed )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">fatama.farhana7@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Mohammed Nurul Amin " src="{{asset('frontend/assets')}}/uploads/staff_images/26.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Mohammed Nurul Amin </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">DEMONSTRATOR</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( M.sc (physics) )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">amin194648@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Pushpen Bhattacharjee " src="{{asset('frontend/assets')}}/uploads/staff_images/27.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Pushpen Bhattacharjee </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">DEMONSTRATOR</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( m.sc (zoology) )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">bhattacharjeepushpen@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Biplob Kumar Chowdhury " src="{{asset('frontend/assets')}}/uploads/staff_images/28.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Biplob Kumar Chowdhury </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">DEMONSTRATOR</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( Bsc(pass) cu )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">biplob10011971@gmail.com</td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Md. Habibur Rahman " src="{{asset('frontend/assets')}}/uploads/staff_images/30.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Md. Habibur Rahman </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">PHYSICAL EDUCATION TEACHER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( mss(political science) bped (1st class) )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">habiburctg2@gmail.com</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%" cellpadding="5" cellspacing="5" border="0" style="font-size:11px">
                                    <tr>
                                        <td align="center"><img width="200" alt="Rahima Akter " src="{{asset('frontend/assets')}}/uploads/staff_images/45.jpg"/></td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b>Rahima Akter </b></td>
                                    </tr>

                                    <tr>
                                        <td align="center">LECTURER</td>
                                    </tr>
                                    <tr>
                                        <td align="center">( BBA(honours)MBA IN FINANCE )</td>
                                    </tr>
                                    <tr>
                                        <td align="center">rahimaanne92@gmail.com</td>
                                    </tr>--}}

                  {{--  </td>
                    </tr>
                    </table>--}}
                </div>
            </div>
        </div><!--./row-->
    </div><!--./container-->
@stop
