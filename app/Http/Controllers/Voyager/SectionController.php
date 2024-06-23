<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Section;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class SectionController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $section = Section::where('id', \request("id"))->first();
        $section->status = $section->status==1?0:1;
        $section->save();
        return redirect(route('voyager.sections.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }

    public function forceDelete($id)
    {

        // Subject::destroy($id);

        $section = Section::withTrashed()->findorfail($id);
        $section->forceDelete();

        return redirect(route('voyager.sections.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }
}

