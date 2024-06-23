<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Enquiry;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class EnquiryController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $enquiry = Enquiry::where('id', \request("id"))->first();
        $enquiry->status = $enquiry->status==1?0:1;
        $enquiry->save();
        return redirect(route('voyager.enquiries.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $enquiry = Enquiry::withTrashed()->findorfail($id);
        $enquiry->forceDelete();

        return redirect(route('voyager.enquiries.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


