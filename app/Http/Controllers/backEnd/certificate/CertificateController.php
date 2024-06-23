<?php

namespace App\Http\Controllers\backEnd\certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Clase;
use App\Models\IdCard;
use App\Models\Staff;
use App\Models\StaffIdCard;
use App\Models\StaffPayslip;
use App\Models\Student;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\Role;
use function Symfony\Component\Mime\Header\all;

class CertificateController extends Controller
{
    public function staffIdCardIndex()
    {
        $roles = Role::all();
        $staff_id_cards = StaffIdCard::where('status', 1)->get();
        return view('backend.certificates.generate-staff-idcard-index', compact('roles','staff_id_cards'));
    }
    public function fetchStaffForIdCard(Request $request)
    {
        $data['staffs'] = Staff::with('designation', 'department', 'role')->where('role_id', $request->role_id)->get();
        return response()->json($data);
    }
    public function generateStaffIdCard(Request $request)
    {

        //dd($request-all());
        //$data['staffs'] = Staff::with('designation', 'department', 'role')->whereIn('id', $request->staff_ids)->get();
        $data['staffidcards'] = StaffIdCard::where('id', $request->staffidcard_id)->get();
        $data['bgimage'] = Voyager::image($data['staffidcards'][0]->bg_image);
        $data['logo'] = Voyager::image($data['staffidcards'][0]->logo);
        $data['sign'] = Voyager::image($data['staffidcards'][0]->sign);
        foreach ($request->staff_ids as $key=> $staff){
            $data['staffs'][$key] = Staff::with('designation', 'department', 'role')->where('id', $staff)->first();
            $data['staffs'][$key]['staffImages'] = Voyager::image($data['staffs'][$key]->staff_image);
        }
    /*    $data['leftLogo'] = Voyager::image($data['admitcards'][0]->left_logo);
        $data['rightLogo'] = Voyager::image($data['admitcards'][0]->right_logo);
        $data['bgimage'] = Voyager::image($data['admitcards'][0]->bg_image);
        $data['sign'] = Voyager::image($data['admitcards'][0]->sign);*/

        return response()->json($data);
    }

    public function certificateIndex(){
        $this->authorize('browse_certificates-index');
        $classes = Clase::where('status', 1)->get();
        $certificates = Certificate::where('status', 1)->get();
        return view('backend.certificates.generate-certificate-index',compact('classes','certificates'));

    }
    public function fetchStudentForCertificate(Request $request)
    {
        //dd($request->all());
        $data['students'] = Student::with('clase', 'group')->where('class_id', $request->class_id)->where('group_id', $request->group_id)->get();
        $data['certificates'] = Certificate::where('id', $request->certificate_id)->get();
        return response()->json($data);
    }
    public function generateCertificate(Request $request)
    {
        //dd($request->all());
        $modal = "";
        $students = Student::with('clase', 'group')->whereIn('id', $request->student_ids)->get();
        $certificates = Certificate::where('id', $request->certificate_id)->get();
        foreach ($students as $key=>$student){
           $modal .='<div class="modal-dialog modal-lg" style="width: 90%;">
          <!--<div>
            <button class="btn" onclick="window.print()">Print</button>
            </div>-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" autocomplete="off">×</button>
                        <h4 class="modal-title">View Certificate</h4>
                    </div>
                    <div class="modal-body" id="certificate_detail">
                        <style type="text/css">
                            * {
                                padding: 0;
                                margin: 0;
                            }

                            body {
                                font-family: \'arial\';
                            }

                            .tc-container {
                                width: 100%;
                                position: relative;
                                text-align: center;
                                padding: 2%;
                            }

                            .tc-container tr td {
                                vertical-align: bottom;
                            }

                            .tcmybg {
                                background: top center;
                                position: absolute;
                                top: 0;
                                left: 0;
                                bottom: 0;
                                z-index: 1;
                            }

                            .tc-container tr td h1, h2, h3 {
                                margin-top: 0;
                                font-weight: normal;
                            }
                        </style>
                        <div class="" style="position: relative; text-align: center; font-family: \'arial\';">
                            <img src=' . Voyager::image($certificates[0]->background_image). '
                                 style="width: 100%; height: 100vh">

                            <table width="100%" cellspacing="0" cellpadding="0"
                                   style="position: absolute;top: 0; margin-left: auto; margin-right: auto;left: 0;right: 0;width:810px">
                                <tbody>
                                <tr>
                                    <td style="position: absolute;right:0;">
                                        <img style="position: relative; top:230px;"
                                             src=' . Voyager::image($student->student_image). ' width="100"
                                             height="auto">
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" style="text-align:left; position: relative; top:360px"></td>
                                    <td valign="top" style="text-align:center; position: relative; top:360px"></td>
                                    <td valign="top" style="text-align:right; position: relative; top:360px">'.$certificates[0]->right_header.'
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" valign="top" style="position: relative;top:400px">
                                        <p style="font-size: 14px; text-align:center;line-height: normal;">This is certify that <b>'.$student->full_name.'</b> has born on '.$student->birth_date.'  <br>
                                        and have following details '.$student->current_address.' '.$student->guardian_name.'</td>
                                </tr>
                                <tr style="">
                                    <td valign="top" style="text-align:left;position: relative; top:480px">
                                        '.$certificates[0]->left_footer.'
                                    </td>
                                    <td valign="top" style="text-align:center;position: relative; top:480px">
                                      '.$certificates[0]->center_footer.'
                                    </td>
                                    <td valign="top" style="text-align:right;position: relative; top:480px">
                                        '.$certificates[0]->right_footer.'
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>';
        }
        return response()->json(['modal'=>$modal]);
    }
    public function idCardIndex(){
        $this->authorize('browse_id-card-index');
        $classes = Clase::where('status', 1)->get();
        $id_cards = IdCard::where('status', 1)->get();
        return view('backend.certificates.generate-idCard-index',compact('classes','id_cards'));

    }
    public function fetchStudentForIdCard(Request $request)
    {
        //dd($request->all());
        $data['students'] = Student::with('clase', 'group')->where('class_id', $request->class_id)->where('group_id', $request->group_id)->get();
        $data['id_cards'] = IdCard::where('id', $request->idCard_id)->get();
        return response()->json($data);
    }
    public function generateIdCard(Request $request)
    {
        //dd($request->all());
        $modal = "";
        $students = Student::with('clase', 'group')->whereIn('id', $request->student_ids)->get();
        $id_cards = IdCard::where('id', $request->idCard_id)->get();
        foreach ($students as $key=>$student){
            $modal .='<div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" autocomplete="off">×</button>
                <h4 class="modal-title">View ID Card</h4>
            </div>
            <div class="modal-body" id="certificate_detail">        <style type="text/css">
            { margin:0; padding: 0;}

     /*       body{ font-family: \'arial\'; margin:0; padding: 0;font-size: 12px; color: #000;}*/
            .tc-container{width: 100%;position: relative; text-align: center;}
            .tcmybg {
                background: top center;
                background-size: contain;
                position: absolute;
                left: 0;
                bottom: 10px;
                width: 200px;
                height: 200px;
                margin-left: auto;
                margin-right: auto;
                right: 0;
            }
            /*begin students id card*/
            .studentmain{background: #efefef;width: 100%; margin-bottom: 30px;}
            .studenttop img{width:30px;vertical-align: top;}
            .studenttop{background: #595959;padding:2px;color: #fff;overflow: hidden;
                        position: relative;z-index: 1;}
            .sttext1{font-size: 24px;font-weight: bold;line-height: 30px;}
            .stgray{background: #efefef;padding-top: 5px; padding-bottom: 10px;}
            .staddress{margin-bottom: 0; padding-top: 2px;}
            .stdivider{border-bottom: 2px solid #000;margin-top: 5px; margin-bottom: 5px;}
            .stlist{padding: 0; margin:0; list-style: none;}
            .stlist li{text-align: left;display: inline-block;width: 100%;padding: 0px 5px;}
            .stlist li span{width:65%;float: right;}
            .stimg{
                /*margin-top: 5px;*/
                width: 80px;
                height: auto;
                /*margin: 0 auto;*/
            }
            .stimg img{width: 100%;height: auto;border-radius: 2px;display: block;}
            .staround{padding:3px 10px 3px 0;position: relative;overflow: hidden;}
            .staround2{position: relative; z-index: 9;}
            .stbottom{background: #453278;height: 20px;width: 100%;clear: both;margin-bottom: 5px;}
            /*.stidcard{margin-top: 0px;
                color: #fff;font-size: 16px; line-height: 16px;
                padding: 2px 0 0; position: relative; z-index: 1;
                background: #453277;
                text-transform: uppercase;}*/
            .principal{margin-top: -40px;margin-right:10px; float:right;}
            .stred{color: #000;}
            .spanlr{padding-left: 5px; padding-right: 5px;}
            .cardleft{width: 20%;float: left;}
            .cardright{width: 77%;float: right; }
        </style>
        <table cellpadding="0" cellspacing="0" width="100%">
            <tbody><tr>
                <td valign="top" width="32%" style="padding: 3px;">
                    <table cellpadding="0" cellspacing="0" width="100%" class="tc-container" style="background: #efefef;">
                        <tbody><tr>
                            <td valign="top">
                                <img src=' . Voyager::image($id_cards[0]->background). ' class="tcmybg" style="opacity: .1"></td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <div class="studenttop">
                                    <div class="sttext1"><img src=' . Voyager::image($id_cards[0]->logo). ' width="30" height="30">
                                        '.$id_cards[0]->school_name.'</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="center" style="padding: 1px 0;">
                                <p> '.$id_cards[0]->school_address.'</p>
                            <!-- <p>Phone:0761 424242 <span class="spanlr">|</span> E-mail:mountcarmel@gmail.com</p> -->
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" style="color: #fff;font-size: 16px; padding: 2px 0 0; position: relative; z-index: 1;background: #595959;text-transform: uppercase;">ID CARD</td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="staround">
                                    <div class="cardleft">
                                        <div class="stimg">
                                            <img src=' . Voyager::image($student->student_image). ' class="img-responsive">
                                        </div>
                                    </div><!--./cardleft-->
                                    <div class="cardright">
                                        <ul class="stlist">
                                            <li>Student Name<span>'.$student->full_name.'</span></li>
                                            <li>Admission Number<span>'.$student->admission_no.'</span></li>
                                            <li>Class<span>'.$student->clase->name.'</span></li>
                                            <li>Father\'s Name<span>'.$student->father_name.'</span></li>
                                            <li>D.O.B<span>'.$student->date_of_birth.'</span></li>
                                             <li class="stred">Blood Group<span>'.$student->blood_group.'</span></li>
                                        </ul>
                                    </div><!--./cardright-->
                                </div><!--./staround-->
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="principal"><img src=' . Voyager::image($id_cards[0]->sign_image). ' width="66" height="40"></td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody></table>
        </div>
        </div>
    </div>';
        }
        return response()->json(['modal'=>$modal]);
    }
}



