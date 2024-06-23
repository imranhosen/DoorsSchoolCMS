<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class CertificateController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $certificate = Certificate::where('id', \request("id"))->first();
        $certificate->status = $certificate->status==1?0:1;
        $certificate->save();
        return redirect(route('voyager.certificates.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $certificate = Certificate::withTrashed()->findorfail($id);
        if ($certificate->background_image != null) {
            $oldFileExists = Storage::disk('public')->exists($certificate->background_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($certificate->background_image);
            }
        }
        if ($certificate->student_image != null) {
            $oldFileExists = Storage::disk('public')->exists($certificate->student_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($certificate->student_image);
            }
        }
        if ($certificate->logo_image != null) {
            $oldFileExists = Storage::disk('public')->exists($certificate->logo_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($certificate->logo_image);
            }
        }
        $certificate->forceDelete();
        return redirect(route('voyager.certificates.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);


    }

}


