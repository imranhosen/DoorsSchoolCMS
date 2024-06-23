<?php

namespace App\Http\Controllers\frontEnd\admission;

use App\Http\Controllers\Controller;
use App\Models\Clase;
use App\Models\Content;
use App\Models\ContentType;
use App\Models\OnlineAdmission;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;

class AdmissionController extends Controller
{
    public function hscGeneral(){
        $content_type_id = ContentType::where(['content_type'=>'Admission Form','status'=>1])->value('id');
        $forms = Content::where(['type'=>$content_type_id,'status'=>1,'title'=>'Admission Form (Hsc General)'])->get();
        return view('frontend.admission.hsc-general',compact('forms'));
    }
    public function hscBMT(){
        $content_type_id = ContentType::where(['content_type'=>'Admission Form','status'=>1])->value('id');
        $forms = Content::where(['type'=>$content_type_id,'status'=>1,'title'=>'Admission Form (Hsc BMT)'])->get();
        return view('frontend.admission.hsc-bmt',compact('forms'));
    }
    public function OnlineAdmissionIndex(){
        $classes = Clase::where('status', 1)->get();
        $sessions = Session::where('status', 1)->get();
        $content_type_id = ContentType::where(['content_type'=>'Admission Form','status'=>1])->value('id');
        $forms = Content::where(['type'=>$content_type_id,'status'=>1,'title'=>'Admission Form (Hsc BMT)'])->get();
        return view('frontend.admission.online_admission',compact('forms','classes','sessions'));
    }
    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $online_admission = OnlineAdmission::where('id', \request("id"))->first();
        $online_admission->status = $online_admission->status==1?0:1;
        $online_admission->save();
        return redirect(route('voyager.online-admissions.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $online_admission = OnlineAdmission::withTrashed()->findorfail($id);
        if ($online_admission->student_image != null) {
            $oldFileExists = Storage::disk('public')->exists($online_admission->student_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($online_admission->student_image);
            }
        }
        if ($online_admission->guardian_image != null) {
            $oldFileExists = Storage::disk('public')->exists($online_admission->guardian_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($online_admission->guardian_image);
            }
        }
        $online_admission->forceDelete();

        return redirect(route('voyager.online-admissions.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }
    public function OnlineAdmissionStore(Request $request){
        //dd($request->all());
        /*if ($request->student_image) {
            $position = strpos($request->student_image, ';');
            $sub = substr($request->student_image, 0, $position);
            $ext = explode('/', $sub)[0];
            $name = time() . "." . $ext;
            dd($name);
            //$img = Image::make($request->student_image)->resize(240, 200);
            $img = Image::make($request->student_image);
           // $upload_path = 'backend/employee/';
            $upload_path = Storage::disk(config('voyager.storage.disk'));
            //dd($upload_path);
            $img_url = $upload_path . $name;
            dd($img_url);
            $img->save($img_url);
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->doj = $request->doj;
            $employee->photo = '/'.$img_url;
            $employee->save();
        }*/

        $admission = new OnlineAdmission();
        $file = $request->file('student_image');

        if (isset($file)) {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $fileName = $currentDate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('online-admissions')) {
                Storage::disk('public')->makeDirectory('online-admissions');
            }
            //old imag delete
            /*  if(Storage::disk('public')->exists('CMD/ContentFiles/'.$admin->avatar)){
                  Storage::disk('public')->delete('profile/'.$admin->avatar);
              }*/
            //dd('online-admissions/'.$fileName);

            $uploadImageToLocalDirectory = Image::make($file)->resize(100, 128)->stream();
            Storage::disk('public')->put('online-admissions/' . $fileName, $uploadImageToLocalDirectory);

            $admission->student_image = 'online-admissions/'.$fileName;
        }
        $file2 = $request->file('guardian_image');
        if (isset($file2)) {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $fileName = $currentDate . '-' . uniqid() . '.' . $file2->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('online-admissions')) {
                Storage::disk('public')->makeDirectory('online-admissions');
            }
            //old imag delete
            /*  if(Storage::disk('public')->exists('CMD/ContentFiles/'.$admin->avatar)){
                  Storage::disk('public')->delete('profile/'.$admin->avatar);
              }*/
            //dd('online-admissions/'.$fileName);

            $uploadImageToLocalDirectory = Image::make($file2)->resize(100, 128)->stream();
            Storage::disk('public')->put('online-admissions/' . $fileName, $uploadImageToLocalDirectory);

            $admission->guardian_image = 'online-admissions/'.$fileName;
        }
        $admission->clase_id = $request->clase_id;
        $admission->group_id = $request->group_id;
        $admission->first_name = $request->first_name;
        $admission->last_name = $request->last_name;
        $admission->gender = $request->gender;
        $admission->dob = $request->dob;
        $admission->mobile_number = $request->mobile_number;
        $admission->email = $request->email;
        //$admission->student_image = $request->student_image;
        $admission->father_name = $request->father_name;
        $admission->mother_name = $request->mother_name;
        $admission->guardian_name = $request->guardian_name;
        $admission->guardian_relation = $request->guardian_relation;
        $admission->guardian_email = $request->guardian_email;
        //$admission->guardian_image = $request->guardian_image;
        $admission->guardian_phone = $request->guardian_number;
        $admission->guardian_occupation = $request->guardian_occupation;
        $admission->guardian_address = $request->guardian_address;
        $admission->current_address = $request->current_address;
        $admission->permanent_address = $request->parmanent_address;
        $admission->nid = $request->national_id;
        $admission->lin = $request->local_id;
        $admission->previous_school_details = $request->previousCollege_details;
        $admission->file = $request->document;
        $admission->save();
        return redirect()->back()->with(['message' => "Apply for admission is submitted successfully!", 'alert-type' => 'success']);
    }
}
