<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Clase;
use App\Models\Content;
use App\Models\ContentType;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class ContentTypeController extends VoyagerBaseController
{
    public function active(){
        $content_type = ContentType::where('id', \request("id"))->first();
        $content_type->status = $content_type->status==1?0:1;
        $content_type->save();
        return redirect(route('voyager.content-types.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {
        $content_type = ContentType::withTrashed()->findorfail($id);
        $content_type->forceDelete();
        return redirect(route('voyager.content-types.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);
    }
    public function assignmentList(){
        $this->authorize('browse_assignment-lists');
        $assignments = Content::where('type', 1)->get();
        return view('downloadCentre.assignment-list',compact('assignments'));
    }
    public function studyMaterialList(){
        $this->authorize('browse_studyMaterial-lists');
        $studyMaterials = Content::where('type', 2)->get();
        return view('downloadCentre.studyMaterial-list',compact('studyMaterials'));
    }
    public function syllabusList(){
        $this->authorize('browse_syllabus-lists');
        $syllabuses = Content::where('type', 3)->get();
        return view('downloadCentre.syllabus-list',compact('syllabuses'));
    }
    public function otherDownloadList(){
        $this->authorize('browse_other_download_list');
        $otherDownloads = Content::where('type', 4)->get();
        return view('downloadCentre.otherDownload-list',compact('otherDownloads'));
    }

}


