<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class SubjectController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $subject = Subject::where('id', \request("id"))->first();
        $subject->status = $subject->status==1?0:1;
        $subject->save();
        return redirect(route('voyager.subjects.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }

    /*public function permanentDelete($id)
    {

        $subject = Subject::destroy($id);
        if ($subject) {

            $response = $this->successfulMessage(200, 'Successfully deleted', true, 0, $subject);

        } else {

            $response = $this->notFoundMessage();
        }

        return response($response);
    }*/

    public function forceDelete($id)
    {

       // Subject::destroy($id);

        $subject = Subject::withTrashed()->findorfail($id);
        $subject->forceDelete();

        return redirect(route('voyager.subjects.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

    /*public function forceDelete($id)
    {

        $note = Subject::destroy($id);
        if ($note) {

            $response = $this->successfulMessage(200, 'Successfully deleted', true, 0, $note);

        } else {

            $response = $this->notFoundMessage();
        }

        return response($response);
    }*/
}

